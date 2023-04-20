<?php
require_once("../vendor/autoload.php");

require_once('components/header.php');




$error = "";
if (!empty($_POST)) {
    $error = validate_form();
}





function validate_form()
{

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    foreach ($_POST as $key => $value) {
        if (empty($value) && $key != 'submit' && $key != 'rememberMe')
            return "$key can not be empty ";
    }
    if (strlen($password) <= MIN_PASSWORD_LENGTH) {
        return "the password should not be less than 5 characters";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "the email is not valid";
    }
    else
    {
        $user_id="";
        $db = new MySQLHandler("users");

       
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
       
       
       $user=$db->select("users"," * ")-> join('groups', 'users.GroupID', '=', "groups.id")->where(" Email "," = ",$email)->andWhere(" Password "," = ",$password)->getOne();
       if($user)
       {
        $_SESSION["user_id"]=$user["UserID"];
        $_SESSION["group_name"]=$user["name"];
        header("Location: home.php");

        // echo "<pre>";
        // var_dump($user);
        // echo "</pre>";

       }
       else
       {
        return "incorrect email or password!";
       }
     
     
      

        $user = $db->select("users", " * ")
            ->join('groups', 'users.GroupID', '=', "groups.id")
            ->where(" Email ", " = ", $email)
            ->andWhere(" Password ", " = ", $password)
            ->getOne();
        if ($user) {

            $data_arr = [
                'loggedin' => true,
                'user_id' => $user["UserID"],
                'group_id' => $user["name"],
                "user_name" => $user["Username"],
                "last_visit" => HelperMethods::formatDate($user['LastVisit'])
            ];
            foreach ($data_arr as $k => $v) {
                $_SESSION[$k] = $v;
                if (isset($_POST['rememberMe'])) {
                    setcookie($k, $v, time() + 30 * 24 * 60 * 60, '/');
                }
            }
            header("Location: home.php");
        } else {
            return "incorrect email or password!";
        }
    }
}

//! logout logic
// {
//     session_start();
//     session_unset();
//     session_destroy();
    
//     header("Location: login.php");
 //      exit();    

// }







require_once("components/navbar.php");

require_once("components/loginForm.php");

require_once('components/footer.php');
