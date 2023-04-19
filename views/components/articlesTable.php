<?php

$db = new MySQLHandler("articles");
$articles = $db->select('articles', "*")->getALL();
?>
<div class="p-3">
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
          
             <?php foreach ($articles as $article): ?>
                <tr>
                <th scope='row'><?= $article['id'] ?> </th>
                <th ><?= $article['title'] ?> </th>
                <th style="width: 20em; max-width: 20em; overflow: hidden; text-overflow: ellipsis;"> <?= $article['summary'] ?></th>
                <th ><?= $article['image'] ?></th>
                <th style="width: 20em; max-width: 20em; overflow: hidden; text-overflow: ellipsis;"><?= $article['full_article'] ?></th>
                <th ><?= $article['publishing_date']?></th>

                <th>
                <a class="btn" <?="href='../views/Showarticle.php?ArticleId={$article['id']}' ";?>>
                        <i class="fa fa-eye text-black"></i>
                    </a>
                <a class="btn" href="">
                        <i class="fa fa-close text-danger"></i>
                    </a>

                </th>


              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>