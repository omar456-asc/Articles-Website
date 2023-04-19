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



session_unset();
session_destroy();

header("Location: login.php");
exit();
