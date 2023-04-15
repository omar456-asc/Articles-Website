<?php
$users = $db->select('users', "*")->join('groups', 'users.GroupID', '=', "groups.id")->getALL();
$groups = $db->select('groups', '*')->getALL();

// check if group filter is selected
if (isset($_POST['groupFilter'])) {
    var_dump($_POST['groupFilter']);
    $groupFilter = $_POST['groupFilter'];
    if ($groupFilter != 'all') {
        //$users = $db->select('users', "users.*, groups.name")->where('GroupID', '=', $groupFilter)->join('groups', 'users.GroupID', '=', "groups.id")->getAll();
        $users = $db->prepare("(SELECT users.*, groups.name FROM `users` JOIN `groups` ON users.GroupID = groups.id WHERE users.GroupID = ?)")
            ->bind_param(
                'i',
                $groupFilter
            )
            ->execute()
            ->getAll();
        var_dump($users);
    }
}

// check if search filter is selected
if (isset($_POST['searchFilter'])) {
    if ($_POST['searchFilter'] == "") {
    } else {
        $searchFilter = $_POST['searchFilter'];
        $users = $db->whereLike('FirstName', "%$searchFilter%") // filter users by first name
            ->orWhereLike('LastName', "%$searchFilter%") // filter users by last name
            ->orWhereLike('Username', "%$searchFilter%")->getAll(); // filter users by username
    }
}

//$users = $db->select('users', "*", "JOIN groups ON users.GroupID = groups.id WHERE $groupFilter AND $nameFilter")->getALL();
//var_dump($users);
//$users = $users->getAll(); // get all filtered users



// $db->get_all_records_paginated(array(), 0);
// var_dump($users);
//var_dump($groups);
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
            ?>
        </tbody>
    </table>

</div>