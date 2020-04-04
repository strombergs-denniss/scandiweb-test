<?php
namespace Core;

use JsonSerializable;

// responsible for handling data fetched from database
abstract class Model implements JsonSerializable {
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public static function fromArray($array) {
        $model = new static();

        foreach ($array as $key => $value) {
            $model->{$key} = $value;
        }

        return $model;
    }

    public function toArray() {
        return get_object_vars($this);
    }

    // so data from database can be assigned automatically
    public function __set($key, $value) {}
}
