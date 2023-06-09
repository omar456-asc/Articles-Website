<?php
require_once('../controllers/ArticleController.php');
$Artcontroller = new ArticleController();
$articles = $Artcontroller->index();
?>
<div class="p-3">
    <button class="btn btn-primary"> <a style="text-decoration: none; color:white" href="../views/addArticle.php"> Add Article</a></button>
    <table class=" table ">
        <thead>
            <tr>
                <th>#id</th>
                <th>Title</th>
                <th>Summary</th>
                <th>Image</th>
                <th>Full_article</th>
                <th>Publising_date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            <?php foreach ($articles as $article) : ?>
                <tr>
                    <th scope='row'><?= $article['id'] ?> </th>
                    <th><?= $article['title'] ?> </th>
                    <th style="width: 10em; max-width: 10em; overflow: hidden; text-overflow: ellipsis;"> <?= $article['summary'] ?></th>
                    <th><?= $article['image'] ?></th>
                    <th style="width: 10em; max-width: 10em; overflow: hidden; text-overflow: ellipsis;"><?= $article['full_article'] ?></th>
                    <th style="width: 10em; max-width: 10em; overflow: hidden; text-overflow: ellipsis;"><?= date('F j, Y, g:i a', strtotime($article['publishing_date'])) ?></th>

                    <th>
                        <a class="btn" <?= "href='../views/Showarticle.php?ArticleId={$article['id']}' "; ?>>
                            <i class="fa fa-eye text-black"></i>
                        </a>
                        <?php
                        if ($_SESSION['group_name'] == 'Admins') {
                        ?>
                            <a class="btn" <?= "href='../views/deleteArticle.php?ArticleId={$article['id']}' "; ?>>
                                <i class="fa fa-close text-danger"></i>
                            </a>
                        <?php } ?>
                    </th>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>