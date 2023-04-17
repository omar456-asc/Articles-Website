<?php 

$groupId= intval($_GET['groupId']);
$controller =  new GroupController();
$group = $controller->show($groupId);
var_dump($group);
$users = $controller->filterUsersByGroup($groupId);

$imgDir = "../assets/img/groups/".$group['icon'];

?>

<div class="p-3">
        <div class="card" style="width: 18rem; margin: 0 auto; margin-bottom: 2rem;">
        
        <?php
           if(strlen($group['icon'])){
                echo"<img  class='card-img-top' src='".$imgDir."'/>";
            }
            echo "<h5 class='card-title m-3'> Group Name :".$group['name']. "</h5>";
            echo "<p class='card-text m-3'> Group Name :".$group['description']. "</p>";
          
            ?>
        </div>
    <table class=" table ">
        <thead>
            <tr>
                <th>#id</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Name</th>
                <th>phone</th>
                <th>Group</th>


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
                echo "<th>".$user['GroupID']."</th>";
         
            }
            ?>
        </tbody>
    </table>