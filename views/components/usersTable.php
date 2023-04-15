<?php
ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^ PHP_OUTPUT_HANDLER_REMOVABLE);

require_once('../controllers/UserController.php');
?>
<div class="p-3">
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


                <!-- <?php
                        foreach (array_keys($users[0]) as $user)
                            echo "<th scope='col'>$user </th>";
                        ?> -->
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($users as $user) {
                echo "  <tr>";
                echo "<th scope='row'>" . $user['UserID'] . "</th>";
                echo "<th >" . $user['Username'] . "</th>";
                echo "<th >" . $user['Email'] . "</th>";
                echo "<th >" . $user['FirstName'] . " " .  $user['LastName'] .  "</th>";
                echo "<th >" . $user['Phone'] . "</th>";
                echo "<th >" . $user['name'] . "</th>";

                echo "<th>";
                echo '<a class="btn" href="../views/editUser.php?userid=' . $user['UserID'] . '" title="Edit  user ' . $user['Username'] . '">
                        <i class="fa fa-edit text-primary"></i>
                    </a>';
                echo '<a class="btn" href="../views/users.php?action=delete&userid=' . $user['UserID'] . '" title="Delete user ' . $user['Username'] . '">
                        <i class="fa fa-close text-danger"></i>
                    </a>';

                echo "</th>";


                echo " </tr>";
            }
            ?>
        </tbody>
    </table>

</div>