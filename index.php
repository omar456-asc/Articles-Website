<?php
require_once("vendor/autoload.php");
$db = new MySQLHandler("users");
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'views/home.php';
header("Location: http://$host$uri/$extra");

// Path: index.php