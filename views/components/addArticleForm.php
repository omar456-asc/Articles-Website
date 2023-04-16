<main class="main-content ">
    <section>
        <div class="page-header min-vh-80 ">
            <div class="container mt-0">


                <div class=" col-lg-8 m-auto">
                    <div class="card card-plain">
                        <div class="card-header">
                            <h4 class="font-weight-bolder">Add new Article</h4>
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

                                if (!empty($errors)) {
                                    foreach ($errors as $error) {
                                        HelperMethods::alert_massege('danger', $error);
                                    }
                                } else {
                                    HelperMethods::alert_massege('success ', "Article Added Successfully");
                                }
                            }
                            ?>
                        </div>
                        <div class="card-body">
                        <form role="form" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype='multipart/form-data'>
                        <div class="input-group input-group-outline mb-3 row">
                                    <label for="title" class="m-auto col-md-3">Title: </label>
                                    <input type="text" class="form-control m-2" name="title" id="title" >
                                </div>
                                <div class="input-group input-group-outline mb-3 row">
                                    <label for="author" class="m-auto col-md-3">Author: </label>
                                    <input type="text" class="form-control m-2" name="author" id="author">
                                </div>
                                <div class="input-group input-group-outline mb-3 row">
                                <label for="content" class="m-auto col-md-12">Content:</label>
                                <textarea id="content" name="content" rows="10" class="form-control" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name='submit' class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Create Article</button>
                                </div>
                      </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
