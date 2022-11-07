<?php

namespace core\application;

class Track
{
    private string $controller = "";
    private string $action = "";
    private array|string $params;
    private $method;

    public function __construct($controller, $action, $params)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getParams(): array|string
    {
        return $this->params;
    }

    public function getMethod()
    {
        return$this->method;
    }

    public function getAllProperties(): array
    {
        return array(
            'controller' => $this->controller,
            'action' => $this->action,
            'params' => $this->params
        );
    }
}