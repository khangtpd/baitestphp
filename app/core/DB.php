<?php

class DB
{
    public $con;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "todolist";

    function __construct()
    {
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
        $this->con->set_charset("utf8");
    }
}
