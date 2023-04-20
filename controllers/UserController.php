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
            // var_dump(count($errors));
            if (count($errors) <= 0) {
                $UserData = $validateUser->get_create_user_data();
                //var_dump($UserData);
                //var_dump($UserData['Phone']);
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/Articles-Website/storage/Images/' . $UserData['avatar'];
                //var_dump($imagePath);

                $result = HelperMethods::upload_file($userImg, $imagePath);
                //echo $result;
                if (move_uploaded_file($UserData['avatar'], $imagePath)) {
                    // File was successfully uploaded, save user data to database
                    $this->db->save($UserData);
                } else {
                    // Error uploading file
                    array_push($errors, "Error uploading file");
                }
                $UserData['password'] = password_hash($UserData['password'], PASSWORD_DEFAULT);
                $this->db->save($UserData);
                return "User Created Successfully";
            } else {
                return $errors;
            }
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
            if (count($errors) <= 0) {
                $userData = $validateUser->get_create_user_data();
                $this->db->updateDB("users", $userData)
                    ->where('UserID', '=', $userID)
                    ->execute();

                return "User Edited Successfully";
            } else {
                return $errors;
            }
        }
    }
    public function delete($userID)
    {


        $this->db->updateDB('users', ['IsDeleted' => '1'])
            ->where('UserID', '=', $userID)
            ->execute();
        $page = $_SERVER['PHP_SELF'];

        // echo '<script type="text/javascript">';
        // echo 'window.location.href = "../views/users.php";';
        // echo '</script>';
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
