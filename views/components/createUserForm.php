<?php
// Get List Of Groups
$groupsController = new GroupController();
$groups = $groupsController->index();
$useresController = new UserController();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $msg = $useresController
        ->store();
}
$db = new MySQLHandler("users");
$groups = $db->select("groups", "id,name")->where("is_deleted", "=", "0")->getAll();
require_once('../controllers/UserController.php')

?>

<main class="main-content ">
    <section>
        <div class="page-header min-vh-100 ">
            <div class="container mt-3">


                <div class=" col-lg-8 m-auto">
                    <div class="card card-plain">
                        <div class="card-header">
                            <h4 class="font-weight-bolder">Create New User</h4>
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

                                if (is_array($msg)) {
                                    foreach ($msg as $error) {
                                        HelperMethods::alert_massege('danger', $error);
                                    }
                                } else {
                                    HelperMethods::alert_massege('success ', "User Created Successfully");
                                }
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <form role="form" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype='multipart/form-data'>
                                <div class="input-group input-group-outline mb-3 row">
                                    <label for="username" class="m-auto col-md-3">User Name : </label>
                                    <input type="text" class="form-control m-2" name="username" id="username" value="<?= HelperMethods::remember_input("username") ?>">
                                </div>
                                <div class=" input-group input-group-outline mb-3 row">
                                    <label for="useremail" class="m-auto col-md-3">Email : </label>
                                    <input type="email" class="form-control m-2" name="useremail" id="useremail" value="<?= HelperMethods::remember_input("useremail") ?>">
                                </div>
                                <div for=" password" class="input-group input-group-outline mb-3 row">
                                    <label class="m-auto col-md-3">Password : </label>
                                    <input type="password" class="form-control m-2" name="password" id="password">
                                </div>
                                <div class="input-group input-group-outline mb-3 row">
                                    <label for="firstname" class="m-auto col-md-3">First Name : </label>
                                    <input type="text" class="form-control m-2" name="firstname" id="firstname" value="<?= HelperMethods::remember_input("firstname") ?>">
                                </div>
                                <div class=" input-group input-group-outline mb-3 row">
                                    <label for="lastname" class="m-auto col-md-3">Last Name : </label>
                                    <input type="text" class="form-control m-2" name="lastname" id="lastname" value="<?= HelperMethods::remember_input("lastname") ?>">
                                </div>
                                <div class=" input-group input-group-outline mb-3 row">
                                    <label for="phone" class="m-auto col-md-3">Phone Number : </label>
                                    <input type="text" class="form-control m-2" name="phone" id="phone" value="<?= HelperMethods::remember_input("phone") ?>">
                                </div>
                                <div class=" input-group input-group-outline mb-3 row">
                                    <label for="group" class="m-auto col-md-3 ">Group : </label>
                                    <select name="group" id="id" class="form-control">
                                        <?php
                                        foreach ($groups as $group) {

                                            echo " <option value='" . $group["id"] . " '> " . $group["name"] . " </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class=" input-group input-group-outline mb-3 row">
                                    <label for="userimg" class="m-auto col-md-3 ">User Image : </label>
                                    <input type="file" class="form-control m-3 " name="userimg" id="userimg">
                                </div>

                                <div class="text-center">
                                    <button type="submit" name='submit' class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Create
                                        User</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>