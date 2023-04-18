
<?php
require_once('../utils/GroupFormValidation.php');

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
        $groups = $this->db->select('groups', '*')->getALL();
        return $groups;
    }
    // to create group
    public function store()
    {
        $groupName = $_POST['groupName'];
        $groupDesc = $_POST['groupDescription'];
        $groupImg = $_FILES['groupImg'];
        //var_dump($groupName, $groupDesc, $groupImg);

        $validateGroup = new GroupFromValidation(
            $groupName,
            $groupDesc,
            $groupImg
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
    $groupImg = $_FILES['groupImg'];
    //var_dump($groupName, $groupDesc, $groupImg);

    $validateGroup = new GroupFromValidation(
        $groupName,
        $groupDesc,
        $groupImg
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


}
?>