<?php
class Database {
    public $conn;

    function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "recycling_centre");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>
















