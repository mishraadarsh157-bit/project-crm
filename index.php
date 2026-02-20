<?php
require '../project/routes/routes.php';


$router = new Router();
$router->addRoute('/project/', function() {
    require 'pages/login.php';
});
$router->addRoute('http://localhost/project/pages/home.php', function() {
    require 'pages/home.php';
});
$router->addRoute('http://localhost/project/pages/user_master.php', function() {
    require 'http://localhost/project/controllers/user_usermaster.php';
});

$router->addRoute('http://localhost/project/pages/clint_master.php', function() {
    require 'http://localhost/project/controllers/clint_usermaster.php';
});
$router->addRoute('http://localhost/project/pages/item_master.php', function() {
    require 'http://localhost/project/controllers/item_usermaster.php';
});

$request =parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($request);
