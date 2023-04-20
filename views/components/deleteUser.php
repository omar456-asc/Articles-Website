<?php
$userId = intval($_GET['userid']);
$controller = new UserController();
$deleted = $controller->delete($userId);



echo "<div style='text-align:center; margin: 30px'>";
echo "<h1 style='color: green;'> User Deleted Successfully</h1>";
echo "<button class='btn btn-primary'> <a style='text-decoration: none; margin:5px; color:white' href='./users.php'> GO BACK USERS PAGE</a> </button>";
echo "</div>";
