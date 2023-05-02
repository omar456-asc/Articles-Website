<?php

$controller = new GroupController();
$groups = $controller->index();


$nameFilter = $_POST['nameFilter'] ?? '';
$descriptionFilter = $_POST['descriptionFilter'] ?? '';
$noMatchedRecords = false;

if ($nameFilter != '' || $descriptionFilter != '') {
    $filteredGroups =  $controller->filter($nameFilter, $descriptionFilter);
    if (count($filteredGroups) == 0) {
        $noMatchedRecords = true;
    }

    $groups = $filteredGroups;
}


?>
<div class="p-3">

    <!-- filters -->
    <form class="d-flex align-items-end" method="POST" enctype='multipart/form-data'>
        <div class="m-3">
            <label for="nameFilter" class="form-label">Search by Group Name: </label>
            <input type="text" class="form-control" name="nameFilter" id="nameFilter" placeholder="Enter Name">
        </div>

        <div class="m-3">
            <label for="descriptionFilter" class="form-label">Search by Group Description:</label>
            <input type="text" class="form-control" name="descriptionFilter" id="descriptionFilter" placeholder="Enter Description">
        </div>
        <button style="height: 50%;" type="submit" class="btn btn-primary">Apply Filters</button>
    </form>
    <?php
    if ($noMatchedRecords) {
        echo "<div class='alert alert-warning' role='alert'>There's no Matched Records</div>";
    }
    ?>

    <!-- create group        -->
    <button class="btn btn-primary"> <a style="text-decoration: none; color:white" href="../views/createGroup.php"> Create New Group</a></button>

    <!-- table of all groups -->
    <table class=" table ">
        <thead>
            <tr>
                <th>#id</th>
                <th>Group Name</th>
                <th>Description</th>
                <th>Actions</th>


                <!-- <?php
                        foreach (array_keys($groups[0]) as $group)
                            echo "<th scope='col'>$group</th>";
                        ?> -->
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($groups as $group) {
                echo "  <tr>";
                echo "<th scope='row'>" . $group['id'] . "</th>";
                echo "<th >" . $group['name'] . "</th>";
                echo "<th >" . $group['description'] . "</th>";

                echo "<th>";
                echo '<a class="btn" href="../views/usersOfAGroup.php?groupId=' . $group['id'] . '">
                        <i class="fa fa-eye text-black"></i>
                    </a>';
                if ($_SESSION['group_name'] == 'Admins') {
                    echo '<a class="btn" href="../views/editGroup.php?groupId=' . $group['id'] . '">
                        <i class="fa fa-edit text-primary"></i>
                    </a>';
                    echo '<a class="btn" href="../views/deleteGroup.php?groupId=' . $group['id'] . '">
                        <i class="fa fa-close text-danger"></i>
                    </a>';
                }

                echo "</th>";


                echo "  </tr>";
            }
            ?>
        </tbody>
    </table>

</div>