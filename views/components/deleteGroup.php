<?php
$groupId= intval($_GET['groupId']);
$controller = new GroupController();
$deleted = $controller->delete($groupId);



    echo "<div style='text-align:center; margin: 30px'>";
    echo "<h1 style='color: green;'> Group Deleted Successfully</h1>";
    echo"<button class='btn btn-primary'> <a style='text-decoration: none; margin:5px; color:white' href='./home.php'> GO BACK HOME</a> </button>";
    echo "</div>";
