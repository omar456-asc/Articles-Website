<?php
require_once('../config/validationConfig.php');
//$assets_dir = "../assets/img/groups"
class GroupFromValidation
{
    private $errors = [];
    private $groupName;
    private $groupDescription;
    private $groupIcon;

    private $generatedImgName;
   

    public function __construct($groupName, $groupDescription, $groupIcon)
    {

        $this->groupName = $groupName ? $groupName : "";
        $this->groupDescription = $groupDescription ? $groupDescription : "";
        $this->groupIcon = $groupIcon ? $groupIcon : "";
       
    }

    private function validate_groupName($groupName)
    {
        if (empty($groupName)) {
            array_push($this->errors, "Group Name Can't Be Empty");
        } elseif (strlen($groupName) < MIN_GROUP_NAME_LENGTH) {
            array_push($this->errors, "Group Name Should Be More Than " . MIN_GROUP_NAME_LENGTH . " characters");
        }
    }
    private function validate_groupDescription($groupDescription)
    {
        if (empty($groupDescription)) {
            array_push($this->errors, "Group DescriptionCan't Be Empty");
        }
        elseif (strlen($groupDescription) > MAX_GROUP_DESCRIPTION_LENGTH) {
            array_push($this->errors, "Group Description Should Be Less than " . MAX_GROUP_DESCRIPTION_LENGTH . " characters");
        }
        elseif(strlen($groupDescription) < MIN_GROUP_DESCRIPTION_LENGTH)
        {
            array_push($this->errors, "Group Description Should Be More Than " . MIN_GROUP_DESCRIPTION_LENGTH . " characters");
        }
      
    }
 
    
 
    private function validate_creating_group()
    {
        $this->validate_groupName($this->groupName);
        $this->validate_groupDescription($this->groupDescription);
    
        //$this->validate_groupImage($this->groupIcon);
        // return $this->;
    }
    public function get_errors()
    {
        $this->validate_creating_group();
        return $this->errors;
    }

    public function create_group_data()
    {
        if (empty($this->get_errors())) {
            return [
                "name" => $this->groupName,
                "description" => $this->groupDescription,
                "icon" => $this->groupIcon
            ];
        }
    }
}
