<?php

$users = $db->select('users', "*")
    ->join('groups', 'users.GroupID', '=', "groups.id")
    ->having('IsDeleted', '=', 0)
    ->getALL();

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

    $db->save($UserDate);
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {

    $userid = intval($_GET['userid']);

    $db->updateDB('users', ['IsDeleted' => '1'])->where('UserID', '=', $userid)->execute();

    $page = $_SERVER['PHP_SELF'];
?>
    <script type="text/javascript">
        window.location.href = '../views/users.php';
    </script>
<?php
}
