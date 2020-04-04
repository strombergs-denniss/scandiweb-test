<?php

namespace Core;

class Route
{
    public $requestMethod;
    public $requestPath;
    public $requestPathVariables;
    public $controllerClass;
    public $controllerMethod;

    public function __construct($requestMethod, $requestPath, $controllerClass, $controllerMethod)
    {
        $this->requestMethod = $requestMethod;
        // escape all slashes
        $this->requestPath = preg_replace("/\//", "\/", $requestPath);
        // replace variables like {variable} with ([a-zA-Z0-9]+) so we can match request later
        $this->requestPath = "/^" . preg_replace("/{[a-zA-Z]+}/", "([a-zA-Z0-9]+)", $this->requestPath) . "$/";

        // find path variables
        $requestPathVariables = [];
        preg_match_all("/{[a-zA-Z]+}/", $requestPath, $requestPathVariables);
        $requestPathVariables = $requestPathVariables[0];

        // remove all curly braces from both sides
        for ($a = 0; $a < count($requestPathVariables); ++$a) {
            $requestPathVariable = $requestPathVariables[$a];
            $requestPathVariables[$a] = substr($requestPathVariable, 1, strlen($requestPathVariable) - 2);
        }

        $this->requestPathVariables = $requestPathVariables;
        $this->controllerClass = $controllerClass;
        $this->controllerMethod = $controllerMethod;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getRequestPath()
    {
        return $this->requestPath;
    }

    public function getRequestPathVariables()
    {
        return $this->requestPathVariables;
    }

    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    public function getControllerMethod()
    {
        return $this->controllerMethod;
    }
}
