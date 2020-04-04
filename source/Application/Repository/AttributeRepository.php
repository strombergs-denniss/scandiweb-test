<?php

namespace Application\Repository;

use Application\Model\AttributeModel;
use PDO;

// collection of functions responsible for attribute table manipulations
class AttributeRepository
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($attribute)
    {
        $query = $this->pdo->prepare("INSERT INTO attribute (code, name, description, type, metadata) VALUES (?, ?, ?, ?, ?)");
        $result = $query->execute([$attribute->getCode(), $attribute->getName(), $attribute->getDescription(), $attribute->getType(), $attribute->getMetadata()]);
        $attribute->setId($this->pdo->lastInsertId());
        return $result;
    }

    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM attribute");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, AttributeModel::class);
    }

    public function update($attribute)
    {
        $query = $this->pdo->prepare("UPDATE attribute SET code = ?, name = ?, description = ?, type = ?, metadata = ? WHERE id = ?");
        return $query->execute([$attribute->getCode(), $attribute->getName(), $attribute->getDescription(), $attribute->getType(), $attribute->getMetadata(), $attribute->getID()]);
    }

    public function delete($attributeIds)
    {
        $query = $this->pdo->prepare("DELETE FROM attribute WHERE id IN (" . str_repeat("?, ", count($attributeIds) - 1) . "?)");
        $query->execute($attributeIds);
        return $query->rowCount();
    }
}
