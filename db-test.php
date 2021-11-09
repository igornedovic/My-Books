<?php
class Db {
    private $hostname = "localhost";
    private $dbname = "mybooks";
    private $username = "root";
    private $password = "";
    public $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_errno) {
            exit("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>