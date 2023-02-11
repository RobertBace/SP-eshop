<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;


class ProductsController extends AControllerBase
{

    public function index(): Response
    {
        $products = Product::getAll();
        return $this->html($products, viewName: 'index');
    }

    public function delete(): Response
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged() ? User::getOne($auth->getLoggedUserId())->getRight() == 'all' : false) {
            $id = $this->request()->getValue('id');
            $deleteProduct = Product::getOne($id);

            $rem = Product::getOne($id);
            if ($rem != null) {
                if ($rem->getPath()) {
                    unlink($rem->getPath());
                }
            }


            if ($deleteProduct) {
                $deleteProduct->delete();
                if ($deleteProduct->getType() == "cestny") {
                    return $this->cestne();
                } else if ($deleteProduct->getType() == "horsky") {
                    return $this->horske();
                } else {
                    return $this->ebike();
                }
            }
            return $this->index();
        } else {
            return $this->redirect("?c=admin&a=index");
        }
    }

    public function create()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged() ? User::getOne($auth->getLoggedUserId())->getRight() == 'all' : false) {
            return $this->html(new Product(), viewName: 'create');
        } else {
            return $this->redirect("?c=admin&a=index");
        }
    }

    public function store()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged() ? User::getOne($auth->getLoggedUserId())->getRight() == 'all' : false) {
            $id = $this->request()->getValue('id');

            $product = ($id ? Product::getOne($id) : new Product());

            $brandName = $this->request()->getValue('title');
            $subclass = $this->request()->getValue('subclass');
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

            if ($type == "cestny") {
                return $this->cestne();
            } else if ($type == "horsky") {
                return $this->horske();
            } else {
                return $this->ebike();
            }
        } else {
            return $this->redirect("?c=admin&a=index");
        }
    }

    public function edit()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged() ? User::getOne($auth->getLoggedUserId())->getRight() == 'all' : false) {
            $id = $this->request()->getValue('id');
            $editProduct = Product::getOne($id);

            return $this->html($editProduct, viewName: 'create');
        } else {
            return $this->redirect("?c=admin&a=index");
        }
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