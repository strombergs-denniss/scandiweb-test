<?php

namespace Application\Controller;

use Application\Model\ProductTypeModel;
use Application\Repository\ProductTypeRepository;

// responsible for handling request associated with product type entity
class ProductTypeController
{
    public $productTypeRepository;

    public function __construct($database)
    {
        $this->productTypeRepository = new ProductTypeRepository($database->pdo);
    }

    public function create($request)
    {
        $productType = ProductTypeModel::fromArray($request->getJSON());
        $attributeGroups = isset($request->getJSON()["attributeGroups"]) ? $request->getJSON()["attributeGroups"] : [];

        if ($this->productTypeRepository->create($productType)) {
            $this->createAttributeGroups($productType, $attributeGroups);
            echo json_encode($productType);
        } else {
            http_response_code(409);
        }
    }

    public function findAll($request)
    {
        echo json_encode($this->productTypeRepository->findAll());
    }

    public function update($request)
    {
        $productType = ProductTypeModel::fromArray($request->getJSON());
        $attributeGroups = isset($request->getJSON()["attributeGroups"]) ? $request->getJSON()["attributeGroups"] : [];

        if ($this->productTypeRepository->update($productType)) {
            $this->createAttributeGroups($productType, $attributeGroups);
            echo json_encode($productType);
        } else {
            http_response_code(409);
        }
    }

    public function delete($request)
    {
        if (!$this->productTypeRepository->delete($request->getJSON())) {
            http_response_code(404);
        }
    }

    public function findAllAttributeGroups($request)
    {
        echo json_encode($this->productTypeRepository->findAllAttributeGroups($request->getPathVariables()["id"]));
    }

    private function createAttributeGroups($productType, $attributeGroups){
        // delete all product types before creating them, not perfect but solves the problem
        $this->productTypeRepository->deleteAllAttributeGroups($productType->getId());
        
        if (!count($attributeGroups)) {
            return null;
        }
        
        $attributeGroupValues = [];

        // put all values into 1d array
        foreach (array_keys($attributeGroups) as $key) {
            array_push($attributeGroupValues, $productType->getId(), $key);
        }

        $this->productTypeRepository->createAttributesGroups($attributeGroupValues);
    }
}
