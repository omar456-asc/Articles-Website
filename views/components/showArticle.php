<?php
require_once('../controllers/ArticleController.php');
$articleId= intval($_GET['ArticleId']);
$Artcontroller = new ArticleController();
$article = $Artcontroller->show($articleId);

?>

<!-- Main content -->
<section class="content" style="font-family: 'DejaVu Math TeX Gyre'">
        <div class="container d-flex flex-column">
            <div class="card text-bg-light mb-3">
                <h2 class="col-12 fw-bold text-center card-header"><strong><?= $article['title'] ?></strong></h2>
                <div class="card-body">
                    <div class="text-center">
                        <img  width="80%" height="80%" src="<?= $article['image'] ?>" class="img-fluid my-3">
                    </div>
                </div>
            </div>
            <div class="card text-bg-light mb-3">
                <h4 class="col-12 fw-bold card-header"><strong>Content</strong></h4>
                <div class="card-body">
                    <div>
                        <p class="fs-5"><?= $article['full_article'] ?></p>
                    </div>
                </div>
            </div>
            <div class="card text-bg-light mb-3">
                <h4 class="col-12 fw-bold card-header"><strong>Summary</strong></h4>
                <div class="card-body">
                    <div>
                        <p class="lead"><?= $article['summary'] ?></p>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>