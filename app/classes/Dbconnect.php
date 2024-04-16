<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "phpfinal";
    public $conn;

    // Constructor to establish database connection
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to execute SQL queries
    public function executeQuery($sql) {
        return $this->conn->query($sql);
    }

    // Method to close database connection
    public function closeConnection() {
        $this->conn->close();
    }
}
?>
