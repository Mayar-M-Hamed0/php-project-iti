<?php
require_once('../classes/login.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auth = new Authentication();

    // Collect form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Authenticate user
    $result = $auth->authenticateUser($email, $password);
    if ($result === true) {
 
        header("Location:../view/index.php");
        exit();
    } else {
        echo "Error: " . $result;
    }
}
?>
