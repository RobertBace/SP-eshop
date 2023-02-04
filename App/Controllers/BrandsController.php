<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Brand;
use App\Models\Product;

class BrandsController extends AControllerBase
{
    public function index(): Response
    {
        $brands = Brand::getAll();
        $data = ['znacky' => $brands, 'message' => "",'messageInfo' => ""];
        return $this->html($data, viewName: 'index');
    }

    public function store()
    {
        $id = $this->request()->getValue('id');
        $brand = ($id ? Brand::getOne($id) : new Brand());

        $brandName = $this->request()->getValue('title');

        if (Brand::getAll("name = ?", [@$brandName]) == null) {
            $brand->setName($brandName);

            $brand->save();
            $brands = Brand::getAll();
            $data = ['znacky' => $brands, 'message' => "",'messageInfo' => ""];
            return $this->html($data, viewName: 'index');
        } else {
            $brands = Brand::getAll();
            $data = ['znacky' => $brands, 'message' => "Zadaná značka už existuje",'messageInfo' => ""];
            return $this->html($data, viewName: 'index');
        }
    }

    public function delete()
    {
        $id = $this->request()->getValue('id');
        $deleteBrand = Brand::getOne($id);


        if ($deleteBrand) {
            if (Product::getAll("brand = ?", [$deleteBrand->getId()]) == null) {
                $deleteBrand->delete();

                $brands = Brand::getAll();
                $data = ['znacky' => $brands, 'messageInfo' => ""];
                return $this->html($data, viewName: 'index');
            } else {
                $brands = Brand::getAll();
                $data = ['znacky' => $brands, 'messageInfo' => "Nemožno zmazať, značka sa použiva"];
                return $this->html($data, viewName: 'index');
            }
        }
        $brands = Brand::getAll();
        $data = ['znacky' => $brands, 'messageInfo' => ""];
        return $this->html($data, viewName: 'index');
    }

    public function update(){
        $id = $this->request()->getValue('id');
        $data = ['brand' => Brand::getOne($id)];
        return $this->html($data, viewName: 'update');
    }
}