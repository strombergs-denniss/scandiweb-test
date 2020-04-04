<?php

require "../vendor/autoload.php";

use Application\Database;
use Core\Router;
use Core\Route;
use Core\RequestMethod;
use Core\Dispatcher;
use Core\Request;

$database = new Database();
$router = new Router();

// Pages
$router->addRoute(new Route(RequestMethod::GET, "/", "PageController", "index"));
$router->addRoute(new Route(RequestMethod::GET, "/product", "PageController", "addProduct"));
$router->addRoute(new Route(RequestMethod::GET, "/product/{id}", "PageController", "viewProduct"));
$router->addRoute(new Route(RequestMethod::GET, "/products", "PageController", "viewAllProducts"));
$router->addRoute(new Route(RequestMethod::GET, "/product-types", "PageController", "viewAllProductTypes"));

// Product
$router->addRoute(new Route(RequestMethod::POST, "/api/product", "ProductController", "create"));
$router->addRoute(new Route(RequestMethod::PUT, "/api/product", "ProductController", "update"));
$router->addRoute(new Route(RequestMethod::DELETE, "/api/product", "ProductController", "delete"));
$router->addRoute(new Route(RequestMethod::GET, "/api/product/attribute-group/{productId}/{productTypeId}", "ProductController", "findAllAttributeGroups"));

// Product type
$router->addRoute(new Route(RequestMethod::POST, "/api/product-type", "ProductTypeController", "create"));
$router->addRoute(new Route(RequestMethod::GET, "/api/product-type", "ProductTypeController", "findAll"));
$router->addRoute(new Route(RequestMethod::PUT, "/api/product-type", "ProductTypeController", "update"));
$router->addRoute(new Route(RequestMethod::DELETE, "/api/product-type", "ProductTypeController", "delete"));
$router->addRoute(new Route(RequestMethod::GET, "/api/product-type/{id}/attribute-group", "ProductTypeController", "findAllAttributeGroups"));

// Attribute group
$router->addRoute(new Route(RequestMethod::POST, "/api/attribute-group", "AttributeGroupController", "create"));
$router->addRoute(new Route(RequestMethod::GET, "/api/attribute-group", "AttributeGroupController", "findAll"));
$router->addRoute(new Route(RequestMethod::PUT, "/api/attribute-group", "AttributeGroupController", "update"));
$router->addRoute(new Route(RequestMethod::DELETE, "/api/attribute-group", "AttributeGroupController", "delete"));
$router->addRoute(new Route(RequestMethod::GET, "/api/attribute-group/{id}/attribute", "AttributeGroupController", "findAllAttributes"));

// Attribute
$router->addRoute(new Route(RequestMethod::POST, "/api/attribute", "AttributeController", "create"));
$router->addRoute(new Route(RequestMethod::GET, "/api/attribute", "AttributeController", "findAll"));
$router->addRoute(new Route(RequestMethod::PUT, "/api/attribute", "AttributeController", "update"));
$router->addRoute(new Route(RequestMethod::DELETE, "/api/attribute", "AttributeController", "delete"));

$dispatcher = new Dispatcher($database, $router);
$dispatcher->handleRequest(new Request());
