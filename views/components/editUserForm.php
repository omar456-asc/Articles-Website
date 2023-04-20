<?php
$groupsController = new GroupController();
$groups = $groupsController->index();

$userscontroller = new UserController();
$userid = intval($_GET['userid']);
$id = $user_data['UserID'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateUser'])) {
    $msg =   $userscontroller->update($userid, $user_data);
    var_dump($msg);
    if (is_array($msg)) {
        foreach ($msg as $error) {
            HelperMethods::alert_massege('danger', $error);
        }
    } else {
        HelperMethods::alert_massege('success ', $msg);
    }
}


$user_data = $userscontroller->show($userid);



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