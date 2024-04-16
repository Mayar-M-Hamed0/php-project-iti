<?php
require_once('Dbconnect.php');

class UserRegistration {
    private $db;

    // Constructor to initialize Database object
    public function __construct() {
        $this->db = new Database();
    }

    // Method to register new user
    public function registerUser($username, $email, $password, $role) {
        $username = $this->db->conn->real_escape_string($username);
        $email = $this->db->conn->real_escape_string($email);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $role = $this->db->conn->real_escape_string($role);

        $sql = "INSERT INTO Users (username, email, password, role) VALUES ('$username', '$email', '$password_hash', '$role')";

        if ($this->db->executeQuery($sql)) {
            return true;
        } else {
            return $this->db->conn->error;
        }
    }

    public function emailExists($email) {
        $email = $this->db->conn->real_escape_string($email);
        $sql = "SELECT * FROM Users WHERE email='$email'";
        $result = $this->db->executeQuery($sql);
        return ($result->num_rows > 0);
    }

    public function getuserid($email)
    {
        $mysql = "SELECT user_id FROM users WHERE email ='$email'";
        $stmt = $this->db->conn->query($mysql);
    
        $result = $stmt->fetch_assoc();
        return $result;
    }
}
?>
