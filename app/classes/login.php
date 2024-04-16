<?php
require_once('Dbconnect.php');

class Authentication {
    private $db;

    // Constructor to initialize Database object
    public function __construct() {
        $this->db = new Database();
    }

    // Method to authenticate user
    public function authenticateUser($email, $password) {
        $email = $this->db->conn->real_escape_string($email);
        $sql = "SELECT * FROM Users WHERE email='$email'";
        $result = $this->db->executeQuery($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                return true;
            } else {
                return "Invalid email or password.";
            }
        } else {
            return "User not found.";
        }
    }
}
?>
