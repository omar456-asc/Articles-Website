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
        $errors = $validateGroup->get_errors();
        if (count($errors) > 0) {
        } else {

            $groupData = $validateGroup->create_group_data();
            $this->db->save($groupData);
        }
    }

    //to edit group
    public function update($groupID)
    {

        $groupName = $_POST['groupName'];
        $groupDesc = $_POST['groupDescription'];
        $groupIcon = $_POST['groupIcon'];
        $validateGroup = new GroupFromValidation(
            $groupName,
            $groupDesc,
            $groupIcon
        );
        $errors = $validateGroup->get_errors();
        if (count($errors) > 0) {
        } else {
            $groupData = $validateGroup->create_group_data();
            $this->db->update($groupData, $groupID);
        }
    }

    //to show group
    public function show($groupID)
    {
        $group = $this->db->select("groups", "*")->where('id', '=', $groupID)->getOne();
        if (!$group) {
            $result = HelperMethods::alert_massege('danger', 'Group Not Found');
            echo $result;
            die;
        }
        return $group;
    }

    //to get users of a group by id
    public function filterUsersByGroup($groupID)
    {
        $users = $this->db->select('users', '*')->where('GroupID', '=', $groupID)->getALL(); //->join('groups', 'users.GroupID', '=', $groupID)->having('IsDeleted', '=', 0)->getALL();
        return $users;
    }

    public function delete($groupID)
    {

        $deleted = $this->db->soft_delete('groups', $groupID);
        return $deleted;
    }

    public function filter($name, $desc)
    {
        if ($name != '' && $desc == '') {
            return  $this->filterByGroupName($name);
        }
        if ($name == '' && $desc != '') {
            return  $this->filterByGroupDesc($desc);
        }
        if ($name != '' && $desc != '') {
            return $this->filterByNameAndDesc($name, $desc);
        }
    }

    public function filterByGroupName($name)
    {
        $qry = "SELECT * FROM `groups` WHERE LOWER(name) = LOWER('$name')";
        $group = $this->db->filter_groups($qry);
        return $group;
    }
    public function filterByGroupDesc($desc)
    {
        $qry = "SELECT * FROM `groups` WHERE LOWER(description) = LOWER('$desc')";
        $group = $this->db->filter_groups($qry);
        return $group;
    }
    public function filterByNameAndDesc($name, $desc)
    {
        $qry = "SELECT * FROM `groups` WHERE LOWER(name) = LOWER('$name') AND LOWER(description) = LOWER('$desc')";
        $group = $this->db->filter_groups($qry);
        return $group;
    }
}
