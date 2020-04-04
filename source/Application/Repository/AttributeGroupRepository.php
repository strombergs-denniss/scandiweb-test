<?php

namespace Application\Repository;

use Application\Model\AttributeGroupModel;
use PDO;

// collection of functions responsible for attribute group table manipulations
class AttributeGroupRepository
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($attributeGroup)
    {
        $query = $this->pdo->prepare("INSERT INTO attribute_group (code, name, description, display) VALUES (?, ?, ?, ?)");
        $result = $query->execute([$attributeGroup->getCode(), $attributeGroup->getName(), $attributeGroup->getDescription(), $attributeGroup->getDisplay()]);
        $attributeGroup->setId($this->pdo->lastInsertId());
        return $result;
    }

    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM attribute_group");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, AttributeGroupModel::class);
    }

    public function update($attributeGroup)
    {
        $query = $this->pdo->prepare("UPDATE attribute_group SET code = ?, name = ?, description = ?, display = ? WHERE id = ?");
        return $query->execute([$attributeGroup->getCode(), $attributeGroup->getName(), $attributeGroup->getDescription(), $attributeGroup->getDisplay(), $attributeGroup->getID()]);
    }

    public function delete($attributeGroupIds)
    {
        $query = $this->pdo->prepare("DELETE FROM attribute_group WHERE id IN (" . str_repeat("?, ", count($attributeGroupIds) - 1) . "?)");
        $query->execute($attributeGroupIds);
        return $query->rowCount();
    }

    // attribute
    public function createAttributes($attributeValues)
    {
        $query = $this->pdo->prepare("INSERT INTO attribute_group_attribute (attribute_group, attribute) VALUES " . str_repeat("(?, ?), ", count($attributeValues) / 2 - 1) . "(?, ?)");
        $query->execute($attributeValues);
    }

    public function findAllAttributes($attributeGroupId) {
        $query = $this->pdo->prepare("SELECT attribute.* FROM attribute_group_attribute AS aga INNER JOIN attribute ON (aga.attribute = attribute.id) WHERE aga.attribute_group = ?");
        $query->execute([$attributeGroupId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteAllAttributes($attributeGroupIds)
    {
        $query = $this->pdo->prepare("DELETE FROM attribute_group_attribute WHERE attribute_group = ?");
        $query->execute([$attributeGroupIds]);
        return $query->rowCount();
    }
}
