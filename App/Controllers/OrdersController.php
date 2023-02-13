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
        if ($auth->isLogged()) {
            $auth = $this->app->getAuth();
            $data = Order::getAll("user = ?", [$auth->getLoggedUserId()]);
            return $this->html($data, 'index');
        }
        return $this->redirect("?c=auth&a=login");
    }

    public function ordered(): Response
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged()) {
            $id = $this->request()->getValue('id');
            $order = Order::getOne($id);
            if ($order) {
                $data = ['id' => $id, 'products' => $order->getOrtderedProduct(), 'status' => $order->getStatus()];
                return $this->html($data, 'order');
            } else {
                return $this->html('index');
            }

        } else {
            return $this->redirect("?c=auth&a=info");
        }
    }

    public function update()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged()) {
            $id = $this->request()->getValue('id');
            $order = Order::getOne($id);
            if ($order) {
                $order->setStatus("Vybavena");
                $order->save();
            }
            return $this->index();
        } else {
            return $this->redirect("?c=auth&a=info");
        }
    }

    public function add()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged()) {
            $id = $this->request()->getValue('id');
            if (!Product::getOne($id)) {
                return $this->json(['e' => "Error, Product does not exist"]);
            }
            $userId = $this->app->getAuth()->getLoggedUserId();
            $order = Order::getAll("status = ? and user = ?", ['Prebieha', $userId]);
            if (sizeof($order) == 0) {
                $order = $this->create();
            } else {
                $order = $order[0];
            }

            $ordProduct = OrdersProduct::getAll("productId = ? and orderId = ?", [$id, $order->getId()]);
            if (sizeof($ordProduct) == 0) {
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
        } else {
            return $this->redirect("?c=auth&a=info");
        }
    }

    public function create()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged()) {
            $auth = $this->app->getAuth();
            $order = new Order();
            $order->setUser($auth->getLoggedUserId());
            $order->setDate(date("Y-m-d"));
            $order->setStatus("Prebieha");
            $order->save();

            return $order;
        } else {
            return $this->redirect("?c=auth&a=info");
        }
    }

    public function delete()
    {
        $auth = $this->app->getAuth();
        if ($auth->isLogged()) {
            $userId = $this->app->getAuth()->getLoggedUserId();
            $order = Order::getAll("status = ? and user = ?", ['Prebieha', $userId]);
            if (sizeof($order) == 0) {
                return $this->html('order');
            } else {
                $order = $order[0];
            }
            $id = $this->request()->getValue('id');
            $ordProduct = OrdersProduct::getAll("productId = ? and orderId = ?", [$id, $order->getId()]);
            if (sizeof($ordProduct) > 0) {
                if ($ordProduct[0]->getCount() > 1) {
                    $ordProduct[0]->setCount($ordProduct[0]->getCount() - 1);
                    $ordProduct[0]->save();
                } else {
                    $ordProduct[0]->delete();
                }
            }


            $id = $order->getId();
            $order = Order::getOne($id);
            $data = ['id' => $id, 'products' => $order->getOrtderedProduct(), 'status' => $order->getStatus()];
            return $this->html($data, 'order');
        } else {
            return $this->redirect("?c=auth&a=info");
        }
    }
}