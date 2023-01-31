<?php

use App\Models\CategoryModel;

    require_once('Configuration.php');
    require_once('vendor/autoload.php');    

    $databaseConfiguration = new App\Core\DatabaseConfiguration(
            Configuration::DATABASE_HOST,
            Configuration::DATABASE_USER,
            Configuration::DATABASE_PASS,
            Configuration::DATABASE_NAME
    );

    $databaseConnection = new App\Core\DatabaseConnection($databaseConfiguration);


    $url = filter_input(INPUT_GET, 'URL');
    $httpmethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

    $router = new \App\Core\Router();
    $routes = require_once('Routes.php');
    foreach($routes as $route)
    {
        $router->add($route);
    }
    $route = $router->find($httpmethod, $url);
    print_r($route);
    die();

    $controller  = new \App\Controllers\MainController($databaseConnection);
    $controller->home();
    $data = $controller->getData();
    
    foreach ($data as $name => $value)
    {
        $$name = $value;
    }

    require_once 'views/Main/home.php';
?>