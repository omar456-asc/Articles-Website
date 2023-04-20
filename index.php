<?php
require_once("vendor/autoload.php");
$db = new MySQLHandler("users");
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'views/home.php';
header("Location: http://$host$uri/$extra");


session_start();



if (!isset($_SESSION['loggedin'])) {
    if (isset($_COOKIE['loggedin'])) {

        $data = $_COOKIE;

        $_SESSION['loggedin'] = 'true';

        foreach ($data as $k => $v) {
            $_SESSION[$k] = $v;
        }
        var_dump($data);
        header("Location: views/home.php");
    } else {
        header("Location: views/login.php");
    }
} else {
    header("Location: views/home.php");
}
// Path: index.php
