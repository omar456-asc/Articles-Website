<?php
require_once("filter_interface.php");
class ContainFilter implements filter_interface
{
    private $_column, $_search;
    public function __construct($_column,  $_search)
    {
        $this->_column = $_column;
        $this->_search =  $_search;
    }
    public function get_sql()
    {
        return "'" . $this->_column . "' like '" . $this->_search . "'";
    }
}
