
<?php
//require_once('../utils/GroupFormValidation.php');

class GroupController
{
    protected $db;

    public function __construct()
    {
        $this->db =  new MySQLHandler("groups");
    }

    // to get all groups
    public function index()
    {
        $groups = $this->db->select('groups', '*')->where('is_deleted', '=', 0)->getALL();
        return $groups;
    }
    // to create group
    public function store()
    {
        $groupName = $_POST['groupName'];
        $groupDesc = $_POST['groupDescription'];
        $groupIcon = $_POST['groupIcon'];

        $validateGroup = new GroupFromValidation(
            $groupName,
            $groupDesc,
            $groupIcon
        );
        $errors =$validateGroup->get_errors();
        if(count($errors) > 0) {
            //var_dump($errors);
        } else {
           
            $groupData = $validateGroup->create_group_data();
            $this->db->save($groupData);
        }

    }

//to edit group
public function update($groupID){

    $groupName = $_POST['groupName'];
    $groupDesc = $_POST['groupDescription'];
    $groupIcon = $_POST['groupIcon'];
    //$groupImg = $_FILES['groupImg'];
   // var_dump($groupName, $groupDesc, $groupIcon);

    $validateGroup = new GroupFromValidation(
        $groupName,
        $groupDesc,
        $groupIcon
    );
    $errors =$validateGroup->get_errors();
    if(count($errors) > 0) {
        //var_dump($errors);
    } else {
        $groupData = $validateGroup->create_group_data();
        $this->db->update($groupData, $groupID);
    }

}

//to show group
public function show($groupID)
{
    $group = $this->db->select("groups", "*") ->where('id', '=', $groupID)->getOne();
    return $group;
}

//to get users of a group by id
public function filterUsersByGroup($groupID) {
   $users = $this->db->select('users', '*')->where('GroupID', '=', $groupID)->getALL(); //->join('groups', 'users.GroupID', '=', $groupID)->having('IsDeleted', '=', 0)->getALL();
   return $users;

}

public function delete($groupID){
    
    $deleted = $this->db->soft_delete('groups', $groupID);
    return $deleted;
}


}
?>