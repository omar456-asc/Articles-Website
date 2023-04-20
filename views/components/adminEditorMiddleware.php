<?php 


if(!isset($_SESSION['group_name']))
{
    header('location:login.php');
    exit();
}
else if($_SESSION['group_name']!=="Admins"||$_SESSION['group_name']!=="Editors")
{
    header('location:home.php');
    exit();
}



?>
