    <?php
    ?>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="#" target="_blank">
                <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo" />
                <span class="ms-1 font-weight-bold text-white">Articals Website</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2" />
        <div class=" w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <div class="user-panel mt-1  mb-1   text-center">
                    <div style="width: 120px;" class=" image  d-flex m-auto ">
                        <img w src=" ../assets/img/bruce-mars.jpg" class="rounded-circle img-fluid   shadow-4" alt="User Image">
                    </div>
                    <div class="info">
                        <h5 href="#" class="d-block text-white">Hello , <?= ucwords($_SESSION['user_name']) ?></h5>
                        <small class=" text-white"> Group : <?= $_SESSION['group_name'] ?></small>
                    </div>
                </div>
                <hr class="horizontal light mt-0 mb-2" />
                <li class="nav-item">
                    <a class="nav-link text-white <?= HelperMethods::isActiveLink($title, "Home") ?> " href="../views/home.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?= HelperMethods::isActiveLink($title, "Groups") ?> " href="../views/groups.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">view_in_ar</i>
                        </div>
                        <span class="nav-link-text ms-1">Groups</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white<?= HelperMethods::isActiveLink($title, "Users") ?> " href="../views/users.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
                <?php if ($_SESSION['group_name'] == "Admins" || $_SESSION['group_name'] == "Editors") {
                ?>

                    <li class="nav-item">
                        <a class="nav-link text-white <?= HelperMethods::isActiveLink($title, "Articles") ?> " href="../views/articles.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                            </div>
                            <span class="nav-link-text ms-1">Articles</span>
                        </a>
                    </li>
                <?php } ?>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                        Account pages
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?= HelperMethods::isActiveLink($title, "Profile") ?>" href="../views/profile.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10 ">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <!-- login link  -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="../views/logout.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">login</i>
                        </div>
                        <span class="nav-link-text ms-1"> Log out</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">