<?php
require_once('../config/validationConfig.php');
class UserFromValidation
{
    private $errors = [];
    private $userName;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $phoneNumber;
    private $groupID;
    private $userImg;

    public function __construct($userName, $email, $password, $firstName, $lastName, $phoneNumber, $groupID, $userImg)
    {

        $this->userName = $userName ? $userName : "";
        $this->email = $email ? $email : "";
        $this->password = $password ? $password : "";
        $this->firstName = $firstName ? $firstName : "";
        $this->lastName = $lastName ? $lastName : "";
        $this->phoneNumber = $phoneNumber ? $phoneNumber : "";
        $this->groupID = $groupID ? $groupID : "";
        $this->userImg = $userImg ? $userImg : "";
    }

    private function validate_username($userName)
    {
        if (empty($userName)) {
            array_push($this->errors, "User Name Can't Be Empty");
        } elseif (strlen($userName) < MIN_USERNAME_LENGTH) {
            array_push($this->errors, "User Name Should Be More Than " . MIN_USERNAME_LENGTH . " characters");
        }
    }

    private function validate_email($email)
    {
        if (empty($email)) {
            array_push($this->errors, "Email Can't Be Empty");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, "Email Is Invalid ");
        }
    }

    private function validate_password($password)
    {
        if (empty($password)) {
            array_push($this->errors, "Password Can't Be Empty");
        } elseif (strlen($password) < MIN_PASSWORD_LENGTH) {
            array_push($this->errors, "password Cann,t Be Less Than " . MIN_PASSWORD_LENGTH . "Character ");
        }
    }

    private function validate_firstname($firstName)
    {
        if (empty($firstName)) {
            array_push($this->errors, "First Name Can't Be Empty");
        }
    }

    private function validate_lastname($lastName)
    {
        if (empty($lastName)) {
            array_push($this->errors, "Last Name Can't Be Empty");
        }
    }

    private function validate_groupID($groupID)
    {
        if (empty($groupID)) {
            array_push($this->errors, "You Should Select GroupID For The User");
        }
    }
    private function validate_userimage($userImg)
    {

        if (is_uploaded_file(($userImg['name']))) {
            if ($userImg["size"] > 3000000) {
                array_push($this->errors, "File Is Too Big");
            } elseif (!strstr($userImg["type"], 'image')) {
                array_push($this->errors, "File Type Is Not Supported ");
            }
        }
    }
    private function validate_phonenumber($phoneNumber)
    {
        if (empty($phoneNumber)) {
            array_push($this->errors, "Phone Number Cann't Be Empty");
        }
    }
    private function validate_creating_user()
    {
        $this->validate_username($this->userName);
        $this->validate_email($this->email);
        $this->validate_password($this->password);
        $this->validate_firstname($this->firstName);
        $this->validate_phonenumber($this->phoneNumber);

        $this->validate_lastname($this->lastName);
        $this->validate_groupID($this->groupID);
        $this->validate_userimage($this->userImg);
        // return $this->;
    }
    public function get_errors()
    {
        $this->validate_creating_user();
        return $this->errors;
    }

    public function get_create_user_data()
    {
        if (empty($this->get_errors())) {
            return [
                "Username" => $this->userName,
                "Email" => $this->email,
                "password" => $this->password,
                "FirstName" => $this->firstName,
                "Phone" => $this->phoneNumber,
                "LastName" => $this->lastName,
                "groupID" => $this->groupID,
                "avatar" => $this->userImg['name'],
            ];
        }
    }
}
