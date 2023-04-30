<?php
require_once('../controllers/ArticleController.php');
$ArticleId= intval($_GET['ArticleId']);
$controller = new ArticleController();
$deleted = $controller->delete($ArticleId);



    echo "<div style='text-align:center; margin: 30px'>";
    echo "<h1 style='color: green;'> Articles Deleted Successfully</h1>";
    echo"<button class='btn btn-primary'> <a style='text-decoration: none; margin:5px; color:white' href='./articles.php'> GO BACK HOME</a> </button>";
    echo "</div>";