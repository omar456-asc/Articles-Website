<?php
$user_id = isset($_GET['userid']) ? intval($_GET['userid']) : $_SESSION['user_id'];

$profileController = new ProfileController($user_id);

$user = $profileController->getUserInfo();
$articles = $profileController->getUserArticles();

?>

<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
    <span class="mask  bg-gradient-primary  opacity-6"></span>
</div>
<div class="card card-body mx-3 mx-md-4 mt-n6">
    <div class="row gx-4 mb-2">
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-1">
                    <?= $user['FirstName'] . " " . $user['LastName'] ?> </h5>
                <p class="mb-0 font-weight-normal text-sm">
                    Group : <strong> <?= $user['name'] ?></strong> </p>
            </div>
        </div>

    </div>

    <div class="row my-4">
        <div class="row ">
            <div class="col-12 col-xl-6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="">User Information</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-3">

                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                    Name:</strong> &nbsp; <?= $user['FirstName'] . " " . $user['LastName'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">User
                                    Name:</strong>
                                &nbsp; <?= $user['Username'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                                &nbsp; <?= $user['Phone'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                &nbsp; <?= $user['Email'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Creation
                                    Date:</strong>
                                &nbsp; <?= $user['CreationTime'] ?></li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Last
                                    Vist:</strong>
                                &nbsp; <?= $user['LastVisit'] ?></li>
                            <li class="list-group-item border-0 ps-0 pb-0">
                                <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                    <i class="fab fa-facebook fa-lg"></i>
                                </a>
                                <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                                <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="">Group Information</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-3">
                        <p class="text-sm">
                            <?= $user['description']; ?>
                        </p>
                        <hr class="horizontal gray-light my-4">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Group
                                    Name:</strong> &nbsp;
                                <?= $user['name'] ?>
                            </li>

                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Group
                                    Icon:</strong> &nbsp;
                            </li>
                            <i style="font-size:50px" class="text-center <?= $user['icon'] ?>"></i>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="">Articles </h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <?php
                        if (empty($articles))
                            echo "<h4 class='text-center'> No Articles yet</h4>";
                        foreach ($articles as $article) { ?>
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">Title: <strong> <?= $article['title'] ?> </strong> </h6>
                                    <h5 class="mb-2 text-xs">Article Summary: <span class="text-dark font-weight-bold ms-sm-2"><?= $article['summary'] ?></span>
                                    </h5>
                                    <h5 class=" mb-2 text-xs w-75">Full Article : <div class="text-dark ms-sm-2 font-weight-bold"><?= $article['full_article'] ?></div>
                                    </h5>
                                    <h5 class="text-xs">Created At: <span class="text-dark ms-sm-2 font-weight-bold"><?= $article['created_at'] ?></span>
                                    </h5>
                                </div>
                                <div class="m-auto text-end  w-100">
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>