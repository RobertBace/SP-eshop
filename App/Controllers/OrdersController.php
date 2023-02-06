<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\IAuthenticator;
use App\Core\Responses\Response;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Product;
use http\Client\Curl\User;

class OrdersController extends AControllerBase
{
    public function index(): Response
    {
        $auth = $this->app->getAuth();
        $data = Order::getAll("user = ?", [$auth->getLoggedUserId()]);
        return $this->html($data,'index');
    }

    public function ordered() : Response
    {
        $id = $this->request()->getValue('id');
        $order = Order::getOne($id);
        $data = ['id' => $id, 'products' => $order->getOrtderedProduct(), 'status' => $order->getStatus()];
        return $this->html($data,'order');
    }

    public function update()
    {
        $id = $this->request()->getValue('id');
        $order = Order::getOne($id);
        $order->setStatus("Vybavena");
        $order->save();
        return $this->index();
    }

    public function add()
    {
        $id = $this->request()->getValue('id');
        if(!Product::getOne($id)){
            return $this->json(['e' => "Error, Product does not exist"]);
        }
        $order = Order::getAll("status = ?", ['Prebieha']);
        if(sizeof($order) == 0){
            $order = $this->create();
        } else {
            $order = $order[0];
        }

        $ordProduct = OrdersProduct::getAll("productId = ? and orderId = ?", [$id, $order->getId()]);
        if(sizeof($ordProduct) == 0){
            $ordProduct = new OrdersProduct();
            $ordProduct->setOrderId($order->getId());
            $ordProduct->setProductId($id);
            $ordProduct->setCount(1);
        } else {
            $ordProduct = $ordProduct[0];
            $ordProduct->setCount($ordProduct->getCount() + 1);
        }


        $ordProduct->save();
        return $this->json(['count' => $order->getCountOfProduct()]);
//        $type = Product::getOne($id)->getType();
//        if($type == "cestny"){
//            return $this->redirect('?c=products&a=cestne');
//        } else if($type == "horsky"){
//            return $this->redirect('?c=products&a=horske');
//        } else {
//            return $this->redirect('?c=products&a=ebike');
//        }
    }

    public function create()
    {
        $auth = $this->app->getAuth();
        $order = new Order();
        $order->setUser($auth->getLoggedUserId());
        $order->setDate(date("Y-m-d"));
        $order->setStatus("Prebieha");
        $order->save();

        return $order;
    }

    public function delete()
    {
        $order = Order::getAll("status = ?", ['Prebieha']);
        if(sizeof($order) == 0){
            return $this->html('order');
        } else {
            $order = $order[0];
        }
        $id = $this->request()->getValue('id');
        $ordProduct = OrdersProduct::getAll("productId = ? and orderId = ?", [$id, $order->getId()]);
        if($ordProduct[0]->getCount() > 1){
            $ordProduct[0]->setCount($ordProduct[0]->getCount() - 1);
            $ordProduct[0]->save();
        } else {
            $ordProduct[0]->delete();
        }


        $id = Order::getAll("status = ?", ['Prebieha'])[0]->getId();
        $order = Order::getOne($id);
        $data = ['id' => $id, 'products' => $order->getOrtderedProduct(), 'status' => $order->getStatus()];
        return $this->html($data,'order');
    }
}