<?php

require_once('../utils/ArticleFormValidation.php');

class ArticleController{
    protected $db;

    public function __construct()
    {
        $this->db =  new MySQLHandler("articles");
    }
    public function index(){
        $articles = $this->db->select('articles', "*")->getALL();
        return $articles;

    }
    public function store()
    {
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $articleImg = $_FILES['image'];
        $full_article = $_POST['full_article'];
    // $publising_date = $_POST['publising_date'];
        $user_id = $_POST['user_id'];

        $validateArticle = new ArticleFormValidation(
            $title,
            $summary,
            $articleImg,
            $full_article,
            $user_id
        );

        $errors = $validateArticle->get_errors();
        if(count($errors) > 0) {
            var_dump($errors);
        } else {
           
            $ArticleData = $validateArticle->create_article_data();
            $this->db->save($ArticleData);
        }

    }

    public function show($ArticleId)
{
    $articles = $this->db->select("articles", "*") ->where('id', '=', $ArticleId)->getOne();
    return $articles;
}
}


?>