<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Product;

class ProductsController extends AControllerBase
{

    public function index(): Response
    {
        $products = Product::getAll();
        return $this->html($products);
    }

    public function delete()
    {
        $id = $this->request()->getValue('id');
        $deleteProduct = Product::getOne($id);

        $rem = Product::getOne($id);
        if ($rem->getPath()) {
            unlink($rem->getPath());
        }

        if ($deleteProduct) {
            $deleteProduct->delete();
            return $this->redirect("?c=products");
        }
        return NULL;
    }

    public function create()
    {
        return $this->html(new Product(), viewName: 'create');
    }

    public function store()
    {
        $id = $this->request()->getValue('id');

        $product = ($id ? Product::getOne($id) : new Product());

        $title = $this->request()->getValue('title');
        $subclass =  $this->request()->getValue('subclass');
        $price = $this->request()->getValue('price');
        $type = $this->request()->getValue('type');
        $description = $this->request()->getValue('description');

        if (!is_null($price) && !is_null($type) &&
            ($type == "cestny" || $type == "horsky" || $type == "ebike") &&
            is_float(is_numeric($price) ? (float)$price : $price) && $price > 0 &&
            is_string($title) && strlen($title) <= 15 &&
            is_string($subclass) && strlen($subclass) <= 40 &&
            is_string($description)
        ) {
            $product->setTitle($title);
            $product->setSubclass($subclass);
            $product->setPrice($price);
            $product->setType($type);
            $product->setDescription($description);

            $image = $this->request()->getFiles()['img'];
            if (!is_null($image) && $image['error'] == UPLOAD_ERR_OK) {
                $newname = "public" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . time() . "_" . $image['name'];
                if (move_uploaded_file($image["tmp_name"], $newname)) {
                    if ($product->getPath() != $newname && ($product->getPath())) {
                        unlink($product->getPath());
                    }
                    $product->setPath($newname);
                }
            }
            $product->save();
        }

        return $this->redirect("?c=products");
    }

    public function edit()
    {
        $id = $this->request()->getValue('id');
        $editProduct = Product::getOne($id);
        return $this->html($editProduct, viewName: 'create');
    }
}