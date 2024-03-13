<?php
require_once './config.php';

class connect {
    public $con;
    function __construct()
    {
        $this->con = mysqli_connect(HOST, USERNAME, PASSWORD);
        mysqli_select_db($this->con, DATABASE);
        mysqli_query($this->con, "SET NAMES 'utf8'");
    }
}
