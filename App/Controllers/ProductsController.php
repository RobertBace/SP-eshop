<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Brand;
use App\Models\Product;


class ProductsController extends AControllerBase
{

    public function index(): Response
    {
        $products = Product::getAll();
        return $this->html($products, viewName: 'index');
    }

    public function delete() : Response
    {
        $id = $this->request()->getValue('id');
        $deleteProduct = Product::getOne($id);

        $rem = Product::getOne($id);
        if($rem != null){
            if ($rem->getPath()) {
                unlink($rem->getPath());
            }
        }


        if ($deleteProduct) {
            $deleteProduct->delete();
            if($deleteProduct->getType() == "cestny"){
                return $this->cestne();
            } else if($deleteProduct->getType() == "horsky"){
                return $this->horske();
            } else {
                return $this->ebike();
            }
        }
       return $this->index();
    }

    public function create()
    {
        return $this->html(new Product(), viewName: 'create');
    }

    public function store()
    {
        $id = $this->request()->getValue('id');

        $product = ($id ? Product::getOne($id) : new Product());

        $brandName = $this->request()->getValue('title');
        $subclass =  $this->request()->getValue('subclass');
        $price = $this->request()->getValue('price');
        $type = $this->request()->getValue('type');
        $description = $this->request()->getValue('description');
        $brandID = Brand::getAll("name = ?", [@$brandName])[0]->getId();

        if (!is_null($price) && !is_null($type) &&
            ($type == "cestny" || $type == "horsky" || $type == "ebike") &&
            is_float(is_numeric($price) ? (float)$price : $price) && $price > 0 &&
            is_string($subclass) && strlen($subclass) <= 40 &&
            is_string($description)
            ) {
            $product->setBrandID($brandID);
            $product->setSubclass($subclass);
            $product->setPrice($price);
            $product->setType($type);
            $product->setDescription($description);

            $image = $this->request()->getFiles()['img'];
            if (!is_null($image) && $image['error'] == UPLOAD_ERR_OK) {
                $newname = "public" . "/" . "images" . "/" . time() . "_" . $image['name'];
                if (move_uploaded_file($image["tmp_name"], $newname)) {
                    if ($product->getPath() != $newname && ($product->getPath())) {
                        unlink($product->getPath());
                    }
                    $product->setPath($newname);
                }
            }
            $product->save();
        }

        if($type == "cestny"){
            return $this->cestne();
        } else if($type == "horsky"){
            return $this->horske();
        } else {
            return $this->ebike();
        }
    }

    public function edit()
    {
        $id = $this->request()->getValue('id');
        $editProduct = Product::getOne($id);

        return $this->html($editProduct, viewName: 'create');
    }

    public function cestne(): Response
    {
        $data = Product::getAll("type = ?", ['cestny']);
        return $this->html($data, viewName: 'index');
    }
    public function horske(): Response
    {
        $data = Product::getAll("type = ?", ['horsky']);
        return $this->html($data, viewName: 'index');
    }
    public function ebike(): Response
    {
        $data = Product::getAll("type = ?", ['ebike']);
        return $this->html($data, viewName: 'index');
    }
}