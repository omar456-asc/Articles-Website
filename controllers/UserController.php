<?php

class UserController
{
    protected $db;
    public function __construct()
    {
        $this->db =  new MySQLHandler("users");
    }
    public function index()
    {
        $users = $this->db->select('users', '*')
            ->join('groups', 'users.GroupID', '=', "groups.id")
            ->having('IsDeleted', '=', 0)
            ->getALL();
        return $users;
    }
    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            require_once('../utils/UserFormValidation.php');
            $userName = $_POST['username'];
            $email = $_POST['useremail'];
            $password = $_POST['password'];
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $phoneNumber = $_POST['phone'];
            $group = $_POST['group'];
            $userImg = $_FILES['userimg'];
            $validateUser = new UserFromValidation(
                $userName,
                $email,
                $password,
                $firstName,
                $lastName,
                $phoneNumber,
                $group,
                $userImg
            );
            $errors = $validateUser->get_errors();
            $UserDate = $validateUser->get_create_user_data();
            $this->db->save($UserDate);
        }
    }
    public function update($userID)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            require_once('../utils/UserFormValidation.php');
            $userName = $_POST['username'];
            $email = $_POST['useremail'];
            $password = $_POST['password'];
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $phoneNumber = $_POST['phone'];
            $group = $_POST['group'];
            $userImg = $_FILES['userimg'];
            $validateUser = new UserFromValidation(
                $userName,
                $email,
                $password,
                $firstName,
                $lastName,
                $phoneNumber,
                $group,
                $userImg
            );
            $errors = $validateUser->get_errors();
            $UserDate = $validateUser->get_create_user_data();
            $this->db->updateDB('users', $UserDate)->where('UserID', '=', $userID)->execute();
        }
    }
    public function delete($userID)
    {
        $this->db->updateDB('users', ['IsDeleted' => '1'])->where('UserID', '=', $userID)->execute();
        $page = $_SERVER['PHP_SELF'];

        echo '<script type="text/javascript">';
        echo 'window.location.href = "../views/users.php";';
        echo '</script>';
    }
    public function show($userID)
    {
        $user = $this->db->select('users', '*')
            ->join('groups', 'users.GroupID', '=', "groups.id")
            ->where('UserID', '=', $userID)
            ->getOne();
        return $user;
    }
}
