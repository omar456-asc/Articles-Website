<?php 

//require_once('../controllers/GroupController.php')
$controller = new GroupController();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $controller->store();
}
?>
<main class="main-content ">
    <section>
        <div class="page-header min-vh-100 ">
            <div class="container mt-3">

                <div class="card-body">
                    <form role="form" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype='multipart/form-data'>
                        <div class="input-group input-group-outline mb-3 row">
                            <label for="groupName" class="m-auto col-md-3">Group Name: </label>
                            <input type="text" class="form-control m-2" name="groupName" id="groupName">
                        </div>
                        <div class=" input-group input-group-outline mb-3 row">
                            <label for="groupDescription" class="m-auto col-md-3">Description : </label>
                            <input type="text" class="form-control m-2" name="groupDescription" id="groupDescription">
                        </div>

                        <!-- <div class=" input-group input-group-outline mb-3 row">
                                    <label for="groupImg" class="m-auto col-md-3 "> Group Image : </label>
                                    <input type="file" class="form-control m-3 " name="groupImg" id="groupImg">
                                </div> -->
                        <div class=" input-group input-group-outline mb-3 row">
                            <label for="groupIcon" class="m-auto col-md-3 "> Group Icon Class: </label>
                            <input type="text" class="form-control m-3 " name="groupIcon" id="groupIcon">
                        </div>

                        <button class="btn bg-gradient-primary" name="submit" type="submit">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</main>