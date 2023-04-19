<?php
require_once('../controllers/UserController.php');

// if (isset($_GET['userid'])) {
$db = new MySQLHandler("groups");
$userid = intval($_GET['userid']);

$controller = new UserController();
$user_data = $controller->show($userid);
$id = $user_data['UserID'];
$groups = $db->select("groups", "id,name")->getAll();
// }
// var_dump($user_data);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateUser'])) {
    $controller->update($userid);
    HelperMethods::alert_massege('success', "User Updated successfully");
}


?>
<form method="POST" action="<?= $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']; ?>">
    <div class="form-group">
        <label for="userid-input">User ID</label>
        <input type="text" class="form-control" id="userid-input" name="UserID" value="<?= $user_data['UserID'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="username-input">User Name</label>
        <input type="text" class="form-control" id="username-input" name="username" value="<?= $user_data['Username'] ?>">
    </div>
    <div class="row">

        <div class="form-group col-6">
            <label for="username-input">First Name</label>
            <input type="text" class="form-control" id="username-input" name="firstname" value="<?= $user_data['FirstName'] ?>">
        </div>
        <div class="form-group col-6">
            <label for="username-input">Last Name</label>
            <input type="text" class="form-control" id="username-input" name="lastname" value="<?= $user_data['LastName'] ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="password-input">Password</label>
        <input type="password" class="form-control" id="password-input" name="password" value="<?= $user_data['Password'] ?>">
    </div>
    <div class="form-group">
        <label for="email-input">Email</label>
        <input type="email" class="form-control" id="email-input" name="useremail" value="<?= $user_data['Email'] ?>">
    </div>
    <div class="form-group">
        <label for="email-input">Phone</label>
        <input type="text" class="form-control" id="email-input" name="phone" value="<?= $user_data['Phone'] ?>">
    </div>
    <div class="form-group">
        <label for="group" class="m-auto col-md-3 ">Group : </label>
        <select name="group" id="id" class="form-control">
            <?php
            echo " <option value='" . $user_data["GroupID"] . " '> " . $user_data["name"] . " </option>";

            foreach ($groups as $group) {
                if ($user_data["GroupID"] != $group["id"])
                    echo " <option value='" . $group["id"] . " '> " . $group["name"] . " </option>";
            }
            ?>
        </select>
    </div>
    <!-- Add more input fields for other attributes -->
    <button type="submit" name="updateUser" class="btn btn-primary my-3">Save changes</button>
</form>