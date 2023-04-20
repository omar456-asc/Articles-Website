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
            ->where('IsDeleted', '=', 0)
            ->getALL();
        return $users;
    }
    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
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
    public function update($userID, $user_data)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateUser'])) {
            require_once('../utils/UserFormValidation.php');
            $userName = $_POST['username'];
            $email = $_POST['useremail'];
            $password = $_POST['password'];
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $phoneNumber = $_POST['phone'];
            $group = $_POST['group'];
            $userImg['name'] =  $user_data['avatar'];
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
    public function filter()
    {
        $groupFilter = $_POST['groupFilter'] ?? 'all';
        $searchFilter = $_POST['searchFilter'] ?? '';

        $sql = "SELECT users.*, groups.name AS `name` FROM users JOIN `groups` ON users.GroupID = groups.id";
        $params = [];
        if ($groupFilter != 'all') {
            $sql .= " WHERE GroupID = ?";
            $params[] = $groupFilter;
        }

        // apply search filter if entered
        if ($searchFilter != '') {
            if (!empty($params)) {
                $sql .= " AND";
            } else {
                $sql .= " WHERE";
            }
            $sql .= " (FirstName LIKE ? OR LastName LIKE ? OR Username LIKE ?)";
            $params = array_merge($params, ["%$searchFilter%", "%$searchFilter%", "%$searchFilter%"]);
        }

        // execute the query and fetch the results
        $users = $this->db->query($sql, $params)->fetchAll();
        return $users;
    }
}
