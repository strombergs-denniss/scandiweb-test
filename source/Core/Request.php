<?php

namespace Core;

class Request
{
    public $method;
    public $path;
    public $pathVariables;
    public $query;
    public $body;
    public $bodyJSON;

    public function __construct()
    {
        $uri = parse_url($_SERVER["REQUEST_URI"]);
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->path = $uri["path"];
        $this->query = array_key_exists("query", $uri) ? $uri["query"] : "";
        $this->body = file_get_contents("php://input");
        $this->json = json_decode($this->body, true);
    }

    public function setPathVariables($pathVariables) {
        $this->pathVariables = $pathVariables;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getPathVariables() {
        return $this->pathVariables;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getJSON() {
        return $this->json;
    }
}
