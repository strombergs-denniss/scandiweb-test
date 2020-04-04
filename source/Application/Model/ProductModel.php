<?php

namespace Application\Model;

use Core\Model;

// represents product table in database
class ProductModel extends Model
{
    protected $id;
    protected $sku;
    protected $name;
    protected $type;
    protected $price;
    protected $quantity;
    protected $attributeGroups;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function getSKU()
    {
        return $this->sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setAttributeGroups($attributeGroups)
    {
        $this->attributeGroups = $attributeGroups;
    }

    public function getAttributeGroups()
    {
        return $this->attributeGroups;
    }

    public function validate()
    {
        return !(
            empty($this->sku) ||
            empty($this->name) ||
            ($this->quantity < 0 || $this->quantity > 1000000 || !is_numeric($this->quantity)) ||
            ($this->price < 0.01 || $this->price > 1000000 || !is_numeric($this->price))
        );
    }
}
