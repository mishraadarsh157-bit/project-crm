<?php


class Router {
    public $routes = [];
    public function addRoute($route, $callback) {
        $this->routes[$route] = $callback;
    }
    
    public function dispatch($request) {
        if (isset($this->routes[$request])) {
            call_user_func($this->routes[$request]);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}


?>