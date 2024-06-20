<?php

namespace App\Kernel\Router;


class Route
{   
    

    public function __construct(
        private string $uri,
        private string $method,
        private $action,
        private $middlewares = []
    ) {
    }

  

    public static function get(string $uri, $action, $middlewares = []){
        return new static ($uri, 'GET', $action, $middlewares);
    }

    public static function post(string $uri, $action, $middlewares = []){
        return new static ($uri, 'POST', $action, $middlewares);
    }

    public function getUri(){
        return $this->uri;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getAction(){
        return $this->action;
    }

    public function hasMiddlewares(){
        return !empty($this->middlewares);
    }

    public function getMiddlewares(){
        return $this->middlewares;
    }

}
