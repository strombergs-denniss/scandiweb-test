<?php

namespace Application\Repository;

use Application\Model\ProductTypeModel;
use PDO;

// collection of functions responsible for product type table manipulations
class ProductTypeRepository
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($productType)
    {
        $query = $this->pdo->prepare("INSERT INTO product_type (code, name) VALUES (?, ?)");
        $result = $query->execute([$productType->getCode(), $productType->getName()]);
        $productType->setId($this->pdo->lastInsertId());
        return $result;
    }

    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM product_type");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, ProductTypeModel::class);
    }

    public function findById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM product_type WHERE id = ?");
        $query->execute([$id]);
        return $query->fetchObject(ProductTypeModel::class);
    }

    public function update($productType)
    {
        $query = $this->pdo->prepare("UPDATE product_type SET code = ?, name = ? WHERE id = ?");
        return $query->execute([$productType->getCode(), $productType->getName(), $productType->getID()]);
    }

    public function delete($productTypeIds)
    {
        $query = $this->pdo->prepare("DELETE FROM product_type WHERE id IN (" . str_repeat("?, ", count($productTypeIds) - 1) . "?)");
        $query->execute($productTypeIds);
        return $query->rowCount();
    }

    // attribute group
    public function createAttributesGroups($attributeGroupValues)
    {
        $query = $this->pdo->prepare("INSERT INTO product_type_attribute_group (product_type, attribute_group) VALUES " . str_repeat("(?, ?), ", count($attributeGroupValues) / 2 - 1). "(?, ?)");
        $query->execute($attributeGroupValues);
    }

    public function findAllAttributeGroups($productTypeID) {
        $query = $this->pdo->prepare("SELECT attribute_group.* FROM product_type_attribute_group AS ptag LEFT JOIN attribute_group ON (ptag.attribute_group = attribute_group.id) WHERE ptag.product_type = ?");
        $query->execute([$productTypeID]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAllAttributes($productTypeID) {
        $query = $this->pdo->prepare("SELECT aga.id, attribute.code, attribute.name, attribute.description, attribute.type, attribute.metadata, aga.attribute_group AS attributeGroup FROM product_type_attribute_group AS ptag INNER JOIN attribute_group_attribute AS aga ON (ptag.attribute_group = aga.attribute_group) INNER JOIN attribute ON (aga.attribute = attribute.id) WHERE ptag.product_type = ?");
        $query->execute([$productTypeID]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteAllAttributeGroups($productType)
    {
        $query = $this->pdo->prepare("DELETE FROM product_type_attribute_group WHERE product_type = ?");
        $query->execute([$productType]);
        return $query->rowCount();
    }
}
