<?php

namespace Core;

use Exception;

class Router
{
    public $routes;

    public function __construct()
    {
        $this->routes = [
            RequestMethod::GET => [],
            RequestMethod::POST => [],
            RequestMethod::PUT => [],
            RequestMethod::DELETE => []
        ];
    }

    public function addRoute($route)
    {
        $requestMethod = $route->getRequestMethod();
        $requestPath = $route->getRequestPath();

        if (!array_key_exists($requestMethod, $this->routes)) {
            throw new Exception("Request method: " . $requestMethod . ", does not exist!");
        }

        if (array_key_exists($requestPath, $this->routes[$requestMethod])) {
            throw new Exception("Request path: " . $requestPath . ", already exists!");
        }

        $this->routes[$requestMethod][$requestPath] = $route;
    }

    public function matchRequestToRoute($request)
    {
        if (!array_key_exists($request->getMethod(), $this->routes)) {
            return null;
        }

        foreach ($this->routes[$request->getMethod()] as $route) {
            $requestPathVariables = [];
            $matches = preg_match_all($route->getRequestPath(), $request->getPath(), $requestPathVariables);

            if ($matches) {
                $arguments = [];

                // assign values to path variables from request
                if (array_key_exists(1, $requestPathVariables)) {
                    for ($a = 0; $a < count($route->getRequestPathVariables()); $a++) {
                        $arguments[$route->getRequestPathVariables()[$a]] = $requestPathVariables[1 + $a][0];
                    }
                }

                $request->setPathVariables($arguments);
                return ["route" => $route, "request" => $request];
            }
        }
    }
}
