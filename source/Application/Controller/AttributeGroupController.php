<?php

namespace Application\Controller;

use Application\Model\AttributeGroupModel;
use Application\Repository\AttributeGroupRepository;

// responsible for handling request associated with attribute group entity
class AttributeGroupController
{
    public $attributeGroupRepository;

    public function __construct($database)
    {
        $this->attributeGroupRepository = new AttributeGroupRepository($database->pdo);
    }

    public function create($request)
    {
        $attributeGroup = AttributeGroupModel::fromArray($request->getJSON());
        $attributes = isset($request->getJSON()["attributes"]) ? $request->getJSON()["attributes"] : [];

        if ($this->attributeGroupRepository->create($attributeGroup)) {
            $this->createAttributes($attributeGroup, $attributes);
            echo json_encode($attributeGroup);
        } else {
            http_response_code(409);
        }
    }

    public function findAll($request)
    {
        echo json_encode($this->attributeGroupRepository->findAll());
    }

    public function update($request)
    {
        $attributeGroup = AttributeGroupModel::fromArray($request->getJSON());
        $attributes = isset($request->getJSON()["attributes"]) ? $request->getJSON()["attributes"] : [];

        if ($this->attributeGroupRepository->update($attributeGroup)) {
            $this->createAttributes($attributeGroup, $attributes);
            echo json_encode($attributeGroup);
        } else {
            http_response_code(409);
        }
    }

    public function delete($request)
    {
        if (!$this->attributeGroupRepository->delete($request->getJSON())) {
            http_response_code(404);
        }
    }

    public function findAllAttributes($request)
    {
        echo json_encode($this->attributeGroupRepository->findAllAttributes($request->getPathVariables()["id"]));
    }

    private function createAttributes($attributeGroup, $attributes)
    {
        // delete all attributes before creating them, not perfect but solves the problem
        $this->attributeGroupRepository->deleteAllAttributes($attributeGroup->getId());

        if (!count($attributes)) {
            return null;
        }

        $attributeValues = [];

        foreach (array_keys($attributes) as $key) {
            array_push($attributeValues, $attributeGroup->getId(), $key);
        }

        $this->attributeGroupRepository->createAttributes($attributeValues);
    }
}
