<?php

require_once('../utils/ArticleFormValidation.php');

class ArticleController{
    protected $db;

    public function __construct()
    {
        $this->db =  new MySQLHandler("articles");
    }
    public function index(){
        $articles = $this->db->select('articles', "*")->where('is_deleted','=',0)->getALL();
        return $articles;

    }
    public function store()
    {
        //$timestamp = strtotime(date('Y-m-d H:i:s'));
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $articleImg = $_FILES['image'];
        $full_article = $_POST['full_article'];
        //$publising_date = strtotime($_POST[date('Y-m-d H:i:s')]);
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
    $articles = $this->db->select("articles", "*") ->join('users', 'users.UserID', '=', "articles.user_id")->where('id', '=', $ArticleId)->getOne();
    return $articles;
}

public function delete($ArticleId){
    
    $this->db->updateDB('articles', ['is_deleted' => '1'])
    ->where('id', '=', $ArticleId)
    ->execute();
    $page = $_SERVER['PHP_SELF'];


}
}


?>