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


}