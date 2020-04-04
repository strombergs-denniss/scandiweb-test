<?php

namespace Core;

// responsible for receiving request and searching for appropriate controller to handle request
class Dispatcher
{
    public $database;
    public $router;

    public function __construct($database, $router)
    {
        $this->database = $database;
        $this->router = $router;
    }

    public function handleRequest($request)
    {
        $data = $this->router->matchRequestToRoute($request);

        if (!$data) {
            return null;
        }

        $route = $data["route"];
        $fullControllerClass = "Application\Controller\\" . $route->getControllerClass();

        if (!class_exists($fullControllerClass)) {
            return null;
        }

        $controller = new $fullControllerClass($this->database);

        if (method_exists($controller, $route->getControllerMethod())) {
            $controller->{$route->getControllerMethod()}($data["request"]);
        }
    }
}
