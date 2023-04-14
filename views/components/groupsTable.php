<?php
$groups = $db->select('groups', '*')->getALL();

?>
<div class="p-3">
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