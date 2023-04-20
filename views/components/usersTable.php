        <?php
        ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^ PHP_OUTPUT_HANDLER_REMOVABLE);
        require_once('../controllers/UserController.php');
        $usersController = new UserController();
        $users = $usersController->index();


        $groupsController = new GroupController();
        $groups = $groupsController->index();


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $users =  $usersController->filter();
        }


        ?>
        <div class="p-3">
            <form method="POST">
                <div class="mb-3">
                    <label for="groupFilter" class="form-label">Filter by Group:</label>
                    <select class="form-select" name="groupFilter" id="groupFilter">
                        <option value="all">All Groups</option>
                        <?php foreach ($groups as $group) { ?>
                            <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="searchFilter" class="form-label">Search by Name:</label>
                    <input type="text" class="form-control" name="searchFilter" id="searchFilter" placeholder="Enter name">
                </div>
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </form>
            <table class=" table ">
                <thead>
                    <tr>
                        <th>#id</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>phone</th>
                        <th>Group</th>
                        <th>Actions</th>


                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    if (empty($users)) {
                        echo "<tr><td colspan='7'>No users found</td></tr>";
                    } else {
                        foreach ($users as $user) {
                            echo "  <tr>";
                            echo "<th scope='row'>" . $user['UserID'] . "</th>";
                            echo "<th >" . $user['Username'] . "</th>";
                            echo "<th >" . $user['Email'] . "</th>";
                            echo "<th >" . $user['FirstName'] . " " .  $user['LastName'] .  "</th>";
                            echo "<th >" . $user['Phone'] . "</th>";
                            echo "<th >" . $user['name'] . "</th>";

                            echo "<th>";
                            echo '<a class="btn" href="">
                        <i class="fa fa-eye text-black"></i>
                    </a>';
                            echo '<a class="btn" href="../views/editUser.php?userid=' . $user['UserID'] . '">
                        <i class="fa fa-edit text-primary"></i>
                    </a>';
                            echo '<a class="btn" href="../views/deleteUser.php?userid=' . $user['UserID'] . '">
                        <i class="fa fa-close text-danger"></i>
                    </a>';

                            echo "</th>";


                            echo "  </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>