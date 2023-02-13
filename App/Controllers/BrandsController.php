<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;

class BrandsController extends AControllerBase
{
    public function index(): Response
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged()) {
            $brands = Brand::getAll();
            $data = ['znacky' => $brands, 'message' => "", 'messageInfo' => ""];
            return $this->html($data, viewName: 'index');
        }
        return $this->redirect("?c=home&a=index");
    }

    public function store()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged() ? User::getOne($auth->getLoggedUserId())->getRight() == 'all' : false) {
            $id = $this->request()->getValue('id');
            $brand = ($id ? Brand::getOne($id) : new Brand());

            $brandName = $this->request()->getValue('title');

            if (Brand::getAll("name = ?", [@$brandName]) == null) {
                $brand->setName($brandName);

                $brand->save();
                $brands = Brand::getAll();
                $data = ['znacky' => $brands, 'message' => "", 'messageInfo' => ""];
                return $this->html($data, viewName: 'index');
            } else {
                $brands = Brand::getAll();
                $data = ['znacky' => $brands, 'message' => "Zadaná značka už existuje", 'messageInfo' => ""];
                return $this->html($data, viewName: 'index');
            }
        } else {
            return $this->redirect("?c=admin&a=index");
        }
    }

    public function delete()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged() ? User::getOne($auth->getLoggedUserId())->getRight() == 'all' : false) {
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
        } else {
            return $this->redirect("?c=admin&a=index");
        }
    }

    public function update()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged() ? User::getOne($auth->getLoggedUserId())->getRight() == 'all' : false) {
            $id = $this->request()->getValue('id');
            $brand = Brand::getOne($id);
            if ($brand) {
                $data = ['brand' => $brand];
                return $this->html($data, viewName: 'update');
            }
            return $this->html('index');
        } else {
            return $this->redirect("?c=admin&a=index");
        }
    }
}