<?php

namespace Application\Repository;

use Application\Model\ProductAttributeModel;
use Application\Model\ProductModel;
use PDO;

// collection of functions responsible for product table manipulations
class ProductRepository
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($product)
    {
        $query = $this->pdo->prepare("INSERT INTO product (sku, name, type, price, quantity, attribute_groups) VALUES (?, ?, ?, ?, ?, ?)");
        $result = $query->execute([$product->getSKU(), $product->getName(), $product->getType(), $product->getPrice(), $product->getQuantity(), $product->getAttributeGroups()]);
        $product->setId($this->pdo->lastInsertId());
        return $result;
    }

    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT product.id, product.sku, product.name, product_type.name as type, product.price, product.quantity, product.attribute_groups as attributeGroups FROM product LEFT JOIN product_type ON (product.type = product_type.id)");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, ProductModel::class);
    }

    public function findById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM product WHERE id = ?");
        $query->execute([$id]);
        return $query->fetchObject(ProductModel::class);
    }

    public function update($product)
    {
        $query = $this->pdo->prepare("UPDATE product SET sku = ?, name = ?, type = ?, price = ?, quantity = ?, attribute_groups = ? WHERE id = ?");
        return $query->execute([$product->getSKU(), $product->getName(), $product->getType(), $product->getPrice(), $product->getQuantity(), $product->getAttributeGroups(), $product->getID()]);
    }

    public function delete($productIds)
    {
        $query = $this->pdo->prepare("DELETE FROM product WHERE id IN (" . str_repeat("?, ", count($productIds) - 1) . "?)");
        $query->execute($productIds);
        return $query->rowCount();
    }

    public function createAttributes($attributeValues) {
        $query = $this->pdo->prepare("INSERT INTO product_attribute (product, attribute_group_attribute, value) VALUES " . str_repeat("(?, ?, ?), ", (count($attributeValues) - 3) / 3) . "(?, ?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
        return $query->execute($attributeValues);
    }

    public function findAllAttributes($productId, $productTypeId)
    {
        $query = $this->pdo->prepare("SELECT aga.id, attribute.code, attribute.name, attribute.description, attribute.type, attribute.metadata, (SELECT IFNULL((SELECT value FROM product_attribute AS pa WHERE pa.attribute_group_attribute = aga.id AND pa.product = ?), '')) AS value, aga.attribute_group AS attributeGroup FROM product_type_attribute_group AS ptag INNER JOIN attribute_group_attribute AS aga ON (ptag.attribute_group = aga.attribute_group) INNER JOIN attribute ON (aga.attribute = attribute.id) WHERE product_type = ?;");
        $query->execute([$productId, $productTypeId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteAllAttributes($productId)
    {
        $query = $this->pdo->prepare("DELETE FROM product_attribute WHERE product = ?");
        $query->execute([$productId]);
        return $query->rowCount();
    }
}
