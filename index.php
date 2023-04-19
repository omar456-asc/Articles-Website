<?php
require_once("vendor/autoload.php");
$db = new MySQLHandler("users");

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'views/home.php';
header("Location: http://$host$uri/$extra");

// This is the router class


// $router = new \config\Router();
// $routes = require('routes.php');

// $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
// $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// $router->route($uri, $method);

// If the team understand uncomment and start working on the router class !!!