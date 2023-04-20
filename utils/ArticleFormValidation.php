<?php
require_once('../config/validationConfig.php');
class ArticleFormValidation{
    private $errors = [];
    private $title;
    private $summary;
    private $image;
    private $full_article;
    private $user_id;

    public function __construct($title, $summary, $image,$full_article,$user_id)
    {
        $this->title = $title ? $title : "";
        $this->summary = $summary ? $summary : "";
        $this->image = $image ? $image : "";
        $this->full_article = $full_article ? $full_article : "";
        $this->user_id = $user_id? $user_id : "";
    }
    public function validate_title($title){
        if(empty($title)){
            array_push($this->errors, "Must Put Title to Article ");
        }elseif(strlen($title)< MIN_ARTICLE_TITLE_LENGTH){
            array_push($this->errors, "Article Title must be more than ".MIN_ARTICLE_TITLE_LENGTH." Characters");
        }
    }

    public function validate_summary($summary){
        if(empty($summary)){
            array_push($this->errors, "Summary can't be empty ");
        }elseif(strlen($summary)< MIN_SUMMARY_LENGTH){
            array_push($this->errors, "Summary must be more than ".MIN_SUMMARY_LENGTH." Characters");
        }elseif(strlen($summary)>MAX_SUMMARY_LENGTH){
            array_push($this->errors,"Summary can't be more than".MAX_SUMMARY_LENGTH." Characters");
        }
    }
    public function validate_image($image){
    //     if (is_uploaded_file(($image['name']))) {
    //         if ($image["size"] > 3000000) {
    //             array_push($this->errors, "File Is Too Big");
    //         } elseif (!strstr($image["type"], 'image')) {
    //             array_push($this->errors, "File Type Is Not Supported ");
    //         }else {
    //                      var_dump($image['name']);
    //                      $dist = "../assets/img/articles/".$this->title.".jpg";
    //                      move_uploaded_file($$image['tmp_name'], $dist);
            
    //                }
    // }

    //var_dump($image);
        if($image['size'] >10000000){
            array_push($this->errors, 'Image is To big');
        }elseif(!strstr($image["type"], 'image')){
            array_push($this->errors, "File Type Is Not Supported ");
        }else {
             $dist = "../assets/img/articles/".$this->title.".jpg";
             move_uploaded_file($image['tmp_name'], $dist);

        }
}

    public function validate_fullArticle($full_article){
        if(empty($full_article)){
            array_push($this->errors, "Article content can't be empty ");
        }elseif(strlen($full_article)< MIN_FULL_ARTICLE_LENGTH){
            array_push($this->errors, "Article content must be more than ".MIN_FULL_ARTICLE_LENGTH." Characters");
        }elseif(strlen($full_article)> MAX_FULL_ARTICLE_LENGTH){
            array_push($this->errors,"Article content can't be more than".MAX_FULL_ARTICLE_LENGTH." Characters");
        }
    }

    public function validate_userID($user_id)
    {
        if (empty($user_id)) {
            array_push($this->errors, "You Should Select Auother");
        }
    }

    public function validate_creating_article(){
        $this->validate_title($this->title);
        $this->validate_summary($this->summary);
        $this->validate_image($this->image);
        $this->validate_fullArticle($this->full_article);
        $this->validate_userID($this->user_id);
    }
    public function get_errors()
    {
        $this->validate_creating_article();
        return $this->errors;
    }

    public function create_article_data()
    {
        if (empty($this->get_errors())) {
            return [
                "title" => $this->title,
                "summary" => $this->summary,
                "image" => $this->title.'.jpg',
                "full_article" => $this->full_article,
                "user_id" => $this->user_id
            ];
        }
    }

}
