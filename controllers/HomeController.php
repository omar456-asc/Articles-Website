<?php
class HomeController
{
    protected $db;

    public function __construct()
    {
        $this->db =  new MySQLHandler("users");
    }


    public function getUsersCount()
    {
        $usersCount = $this->db->select('users', 'count(*) as count')
            ->where('IsDeleted', "=", "0")
            ->getOne();
        return $usersCount;
    }

    public function getGroupsCount()
    {
        $groupsCount = $this->db->select('groups', 'count(*) as count')
            ->where('is_deleted', "=", "0")
            ->getOne();
        return $groupsCount;
    }
    public function getArticlesCount()
    {
        $articlesCount = $this->db->select('articles', 'count(*) as count')
            ->where('is_deleted', "=", "0")
            ->getOne();
        return $articlesCount;
    }

    private function getGroupsUserCount()
    {
        return  $this->db->select('users', "name , count(*) as count")
            ->join('groups', 'users.GroupID', '=', "groups.id")
            ->where('IsDeleted', '=', 0)
            ->groupBy('GroupID')->getALL();
    }

    public function getGroupsName()
    {
        $data = $this->getGroupsUserCount();
        $groupName = array();

        foreach ($data as $sub_array) {
            $groupName[] = $sub_array["name"];
        }
        $groups = implode(",", $groupName);
        return $groups;
    }
    public function getGroupUsersCount()
    {
        $data = $this->getGroupsUserCount();
        $groupUsersCount = array();

        foreach ($data as $sub_array) {
            $groupUsersCount[] = $sub_array["count"];
        }

        $groupUsersCount = implode(",", $groupUsersCount);
        return  $groupUsersCount;
    }
}
