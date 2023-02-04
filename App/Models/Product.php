<?php

namespace App\Models;

use App\Core\Model;

class Product extends Model
{
    protected $id;
    protected $brand;
    protected $subclass;
    protected $price;
    protected $description;
    protected $path;
    protected $type;

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
    public function getBrandID()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrandID($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getSubclass()
    {
        return $this->subclass;
    }

    /**
     * @param mixed $subclass
     */
    public function setSubclass($subclass): void
    {
        $this->subclass = $subclass;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getBrand(){
        return Brand::getOne($this->getBrandID())->getName();
    }
}