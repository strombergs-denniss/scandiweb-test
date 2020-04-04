<?php

namespace Application\Controller;

use Application\Model\ProductModel;
use Application\Repository\ProductTypeRepository;
use Application\Repository\ProductRepository;

// responsible for handling request associated with product entity
class ProductController
{
    public $productRepository;
    public $productTypeRepository;

    public function __construct($database)
    {
        $this->productRepository = new ProductRepository($database->pdo);
        $this->productTypeRepository = new ProductTypeRepository($database->pdo);
    }

    public function create($request)
    {
        $product = ProductModel::fromArray($request->getJSON());
        $attributeValues = $request->getJSON()["attributes"];
        $attributes = $this->productTypeRepository->findAllAttributes($product->getType());
       
        if (!$this->validateAttributes($attributes, $attributeValues) || !$product->validate()) {
            http_response_code(406);
            return null;
        }
        
        $this->generateAttributeGroups($product, $attributeValues, $attributes);

        if ($this->productRepository->create($product)) {
            $this->createAttributes($product, $attributeValues);
            echo json_encode($product);
        }
    }

    private function validateAttributes($attributes, $attributeValues) {
        $isValid = true;

        foreach ($attributes as $key => $value) {
            $attributeValue = $attributeValues[$value["id"]];

            if ($value["type"] == "number") {
                if (!is_numeric($attributeValue)) {
                    $isValid =  false;
                    break;
                }
            }
        }

        return $isValid;
    }

    public function update($request)
    {
        $product = ProductModel::fromArray($request->getJSON());
        $attributeValues = $request->getJSON()["attributes"];
        $attributes = $this->productTypeRepository->findAllAttributes($product->getType());
        
        if (!$this->validateAttributes($attributes, $attributeValues) || !$product->validate()) {
            http_response_code(406);
            return null;
        }

        $this->generateAttributeGroups($product, $attributeValues, $attributes);

        if ($this->productRepository->update($product)) {
            $this->createAttributes($product, $attributeValues);
            echo json_encode($product);
        }
    }

    public function delete($request)
    {
        if (!$this->productRepository->delete($request->getJSON())) {
            http_response_code(404);
        }
    }

    private function createAttributes($product, $attributes) {
        $this->productRepository->deleteAllAttributes($product->getId());
        $attributeValues = [];

        // put all values into 1d array
        foreach ($attributes as $key => $value) {
            array_push($attributeValues, $product->getId(), $key, $value);
        }

        $this->productRepository->createAttributes($attributeValues);
    }

    public function findAllAttributeGroups($request)
    {
        $productType = $this->productTypeRepository->findById($request->getPathVariables()["productTypeId"])->toArray();
        $attributeGroups = $this->productTypeRepository->findAllAttributeGroups($request->getPathVariables()["productTypeId"]);
        $attributes = $this->productRepository->findAllAttributes($request->getPathVariables()["productId"], $productType["id"]);

        // assign attributes to attribute groups
        for ($a = 0; $a < count($attributeGroups); ++$a) {
            $attributeGroups[$a]["attributes"] = [];

            foreach ($attributes as $attribute) {
                if ($attribute["attributeGroup"] == $attributeGroups[$a]["id"]) {
                    unset($attribute["attributeGroup"]);
                    array_push($attributeGroups[$a]["attributes"], $attribute);
                }
            }
        }

        $productType["attributeGroups"] = $attributeGroups;
        echo json_encode($productType);
    }

    // generates attribute groups json so we don't have to query them when we load product list
    public function generateAttributeGroups($product, $attributeValues, $attributes) {
        $attributeGroups = $this->productTypeRepository->findAllAttributeGroups($product->getType());

        foreach ($attributes as $key => $value) {
            $attributes[$key]["value"] = $attributeValues[$value["id"]];
        }

        for ($a = 0; $a < count($attributeGroups); ++$a) {
            $attributeGroups[$a]["attributes"] = [];

            foreach ($attributes as $attribute) {
                if ($attribute["attributeGroup"] == $attributeGroups[$a]["id"]) {
                    unset($attribute["attributeGroup"]);
                    array_push($attributeGroups[$a]["attributes"], $attribute);
                }
            }
        }

        $product->setAttributeGroups(json_encode($attributeGroups));
    }
}
