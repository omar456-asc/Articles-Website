<?php
require_once("vendor/autoload.php");
$db = new MySQLHandler("users");


?>
<!DOCTYPE html>
<html lang="en">

<?php
require_once('views/components/header.php');

require_once("views/users.php");

require_once('views/components/footer.php')
?>