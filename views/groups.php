<?php
require_once("../vendor/autoload.php");
$db = new MySQLHandler("groups");

require_once('components/header.php');

require_once('components/authmiddleware.php');

require_once('components/sidenav.php');
require_once('components/navbar.php');
require_once('components/groupsTable.php');
require_once('components/footer.php');