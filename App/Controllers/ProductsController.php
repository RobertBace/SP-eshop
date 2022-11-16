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

    public function delete(){
        $id = $this->request()->getValue('id');
        $deleteProduct = Product::getOne($id);

        $rem = Product::getOne($id);
        if($rem->getPath()){
            unlink($rem->getPath());
        }

        if($deleteProduct){
            $deleteProduct->delete();
            return $this->redirect("?c=products");
        }
        return NULL;
    }
}