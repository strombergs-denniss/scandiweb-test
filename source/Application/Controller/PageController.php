<?php

namespace Application\Controller;

use Application\Repository\AttributeGroupRepository;
use Application\Repository\AttributeRepository;
use Application\Repository\ProductRepository;
use Application\Repository\ProductTypeRepository;
use Core\View;

// responsible for handling request associated with pages
class PageController
{
    public $productRepository;
    public $productTypeRepository;
    public $attributeRepository;
    public $attributeGroupRepository;

    public function __construct($database)
    {
        $this->attributeRepository = new AttributeRepository($database->pdo);
        $this->attributeGroupRepository = new AttributeGroupRepository($database->pdo);
        $this->productRepository = new ProductRepository($database->pdo);
        $this->productTypeRepository = new ProductTypeRepository($database->pdo);
    }

    public function index($request)
    {
        header("Location: /product");
        exit();
    }

    public function addProduct($request)
    {
        View::render("pages/product", [
            "productTypes" => $this->productTypeRepository->findAll()
        ]);
    }

    public function viewProduct($request)
    {
        $product = $this->productRepository->findById($request->getPathVariables()["id"]);

        if ($product) {
            View::render("pages/product", [
                "product" => $product->toArray(),
                "productTypes" => $this->productTypeRepository->findAll($request->getPathVariables()["id"])
            ]);
        } else {
            View::render("pages/error", [
                "errorCode" => "404",
                "errorDetails" => "Product not found!"
            ]);
        }
    }

    public function viewAllProducts($request)
    {
        View::render("pages/products", [
            "products" => $this->productRepository->findAll()
        ]);
    }

    public function viewAllProductTypes($request)
    {
        View::render("pages/product-types", [
            "productTypes" => $this->productTypeRepository->findAll(),
            "attributeGroups" => $this->attributeGroupRepository->findAll(),
            "attributes" => $this->attributeRepository->findAll()
        ]);
    }
}
