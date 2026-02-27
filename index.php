<?php
require '../project/routes/routes.php';


$router = new Router();
$router->get('/project/', function() {
    require 'pages/login.php';
});   ///>>>
$router->post('/project/loginAPI/', function() {
    require 'controllers/loginAPI.php';
});   ///>>>
$router->get('/project/home/', function() {
    require 'pages/home.php';    
});
$router->get('/project/usermaster/', function() {
    require 'pages/user_master.php';
});
$router->get('/project/clientmaster/', function() {
    require 'pages/client_master.php';
});
$router->get('/project/itemmaster/', function() {
    require 'pages/item_master.php';
});

$router->post('/project/usercontroller/', function() {
    require 'controllers/user_controller.php';
    
    
});
$router->post('/project/userlogics/', function() {
    require 'database/userlogics.php';
});

$router->get('/project/clientcontroller/', function() {
    require 'controllers/client_controller.php';
    
    
});
$router->post('/project/clientcontroller/', function() {
    require 'controllers/client_controller.php';
    
    
});




$request =parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($request);
