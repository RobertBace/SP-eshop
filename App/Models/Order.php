<?php

namespace App\Models;

use App\Core\Model;

class Order extends Model
{
    protected $id;
    protected $user;
    protected $date;
    protected $status;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        $products = OrdersProduct::getAll("orderId = ?", [$this->getId()]);
        $suma = 0;
        foreach ($products as $current){
            $suma += Product::getOne($current->getProductId())->getPrice() * $current->getCount();
        }
        return $suma;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getOrtderedProduct()
    {
        $product = OrdersProduct::getAll("orderId = ?", [$this->getId()]);
        $orderedProduct = [];
        foreach ($product as $current){
            array_push($orderedProduct, Product::getOne($current->getProductId()));
        }

        return $orderedProduct;
    }
    /**
     * @return mixed
     */
    public function getCountOfProduct()
    {
        $product = OrdersProduct::getAll("orderId = ?", [$this->getId()]);
        $count = 0;
        foreach ($product as $current){
            $count += $current->getCount();
        }

        return $count;
    }
}