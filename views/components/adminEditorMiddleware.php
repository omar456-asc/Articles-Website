<?php
// var_dump($_SESSION['group_name']);
// var_dump($_SESSION['group_name'] !== "Admins");

if (!isset($_SESSION['group_name'])) {
    // header('location:login.php');
    exit();
} else if ($_SESSION['group_name'] !== "Admins" || $_SESSION['group_name'] !== "Editors") {
} else {

    header('location:home.php');
    exit();
}
