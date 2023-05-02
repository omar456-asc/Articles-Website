<?php

require_once('../utils/ArticleFormValidation.php');

class ArticleController
{
    protected $db;

    public function __construct()
    {
        $this->db =  new MySQLHandler("articles");
    }
    public function index()
    {
        $articles = $this->db->select('articles', "*")->where('is_deleted', '=', 0)->getALL();
        return $articles;
    }
    public function store()
    {

        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $articleImg = $_FILES['image'];
        $full_article = $_POST['full_article'];
        $user_id = $_POST['user_id'];

        $validateArticle = new ArticleFormValidation(
            $title,
            $summary,
            $articleImg,
            $full_article,
            $user_id
        );

        $errors = $validateArticle->get_errors();
        if (count($errors) > 0) {
        } else {

            $ArticleData = $validateArticle->create_article_data();
            $this->db->save($ArticleData);
        }
    }

    public function show($ArticleId)
    {
        $articles = $this->db->select("articles", "*")->join('users', 'users.UserID', '=', "articles.user_id")->where('id', '=', $ArticleId)->getOne();
        if (!$articles) {
            $result = HelperMethods::alert_massege('danger', 'Article Not Found');
            echo $result;
            die;
        }
        return $articles;
    }

    public function delete($ArticleId)
    {

        $this->db->updateDB('articles', ['is_deleted' => '1'])
            ->where('id', '=', $ArticleId)
            ->execute();
        $page = $_SERVER['PHP_SELF'];
    }
}
