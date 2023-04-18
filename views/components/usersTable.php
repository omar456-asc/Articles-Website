        <?php
        require_once('../controllers/UserController.php');


        $users = $db->select('users', "*")->join('groups', 'users.GroupID', '=', "groups.id")->getALL();
        $groups = $db->select('groups', '*')->getALL();

        $groupFilter = $_POST['groupFilter'] ?? 'all';
        $searchFilter = $_POST['searchFilter'] ?? '';

        $sql = "SELECT users.*, groups.name AS `name` FROM users JOIN `groups` ON users.GroupID = groups.id";
        $params = [];

        // apply group filter if selected
        if ($groupFilter != 'all') {
            $sql .= " WHERE GroupID = ?";
            $params[] = $groupFilter;
        }

        // apply search filter if entered
        if ($searchFilter != '') {
            if (!empty($params)) {
                $sql .= " AND";
            } else {
                $sql .= " WHERE";
            }
            $sql .= " (FirstName LIKE ? OR LastName LIKE ? OR Username LIKE ?)";
            $params = array_merge($params, ["%$searchFilter%", "%$searchFilter%", "%$searchFilter%"]);
        }

        // execute the query and fetch the results
        $users = $db->execute($sql, $params)->fetchAll();


        ?>
        <div class="p-3">
            <button class="btn btn-success"> <a style="text-decoration: none; color:white" href="../views/createUser.php">
                    Create New User</a></button>

            <form method="POST ">
                <div class="row">
                    <div class="mb-3 col-4">
                        <label for="groupFilter" class="form-label">Filter by Group:</label>
                        <select class="form-select" name="groupFilter" id="groupFilter">
                            <option value="all">All Groups</option>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="searchFilter" class="form-label">Search by Name:</label>
                        <input type="text" class="form-control" name="searchFilter" id="searchFilter" placeholder="Enter name">
                    </div>
                    <div class="col-3 offset-md-1 align-self-end">
                        <button type="submit" class="btn  btn-outline-primary ">
                            Apply Filters
                            <i class="fas fa-search  "></i>
                        </button>
                    </div>
                </div>
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
                            echo '<a class="btn" href="">
                        <i class="fa fa-edit text-primary"></i>
                    </a>';
                            echo '<a class="btn" href="">
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