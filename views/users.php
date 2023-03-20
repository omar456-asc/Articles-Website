<?php
$users =
    $db->get_all_records_paginated(array(), 0);
var_dump($users);
?>
<div class="p-3">
    <table class=" table ">
        <thead>
            <tr>
                <?php
                foreach (array_keys($users[0]) as $user)

                    echo "<th scope='col'>$user </th>";

                ?>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($users as $user) {
                echo "  <tr>";
                echo "<th scope='row'>" . $user['userid'] . "</th>";
                echo "<th >" . $user['username'] . "</th>";
                echo "<th >" . $user['password'] . "</th>";
                echo "<th >" . $user['email'] . "</th>";
                echo "<th >" . $user['firstname'] . "</th>";
                echo "<th >" . $user['lastname'] . "</th>";
                echo "<th >" . $user['phone'] . "</th>";
                echo "<th >" . $user['groupid'] . "</th>";
                echo "<th >" . $user['isdeleted'] . "</th>";
                echo "<th >" . $user['creationtime'] . "</th>";
                echo "<th >" . $user['lastvisit'] . "</th>";
                echo "<th >" . $user['avatar'] . "</th>";








                echo "  </tr>";
            }
            ?>
        </tbody>
    </table>

</div>