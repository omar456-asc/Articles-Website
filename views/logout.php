<?php
require_once("../vendor/autoload.php");

session_start();
$db =  new MySQLHandler("users", "UserID");
$handler =
    $id = $_SESSION['user_id'];

$db->update([
    'LastVisit' =>
    date('Y-m-d H:i:s')
], $id);

$data = $_COOKIE;

foreach ($data as $k => $v) {
    if (isset($_COOKIE[$k])) :
        setcookie($k, '', time() - 7000000, '/');
    endif;
}


session_unset();
session_destroy();


header("Location: login.php");
exit();
