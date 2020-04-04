<?php

namespace Application\Model;

use Core\Model;

// represents attribute group table in database
class AttributeGroupModel extends Model
{
    protected $id;
    protected $code;
    protected $name;
    protected $description;
    protected $display;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDisplay($display)
    {
        $this->display = $display;
    }

    public function getDisplay()
    {
        return $this->display;
    }
}
