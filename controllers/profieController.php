<?php
class ProfileController
{
    protected $db;
    protected $user_id;
    public function __construct($user_id)
    {
        $this->user_id =  $user_id;

        $this->db =  new MySQLHandler("users");
    }

    public function getUserInfo()
    {
        $user =
            $users = $this->db->select('users', '*')
            ->join('groups', 'users.GroupID', '=', "groups.id")
            ->where('UserID', '=', $this->user_id)
            ->getOne();
        if (!$user) {
            $result = HelperMethods::alert_massege('danger', 'User Not Found');
            echo $result;
            die;
        }
        return $user;
    }
    public function getUserArticles()
    {
        $articles = $this->db->select('articles', '*')
            ->where('user_id', '=', $this->user_id)
            ->getAll();
        return $articles;
    }
}
