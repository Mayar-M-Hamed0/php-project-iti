<?php
require_once('../classes/register.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userReg = new UserRegistration();
 

    // Collect form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match.";
        exit();
    }
    

    
    // Check if email already exists
    if ($userReg->emailExists($email)) {
        echo "Error: Email already exists.";
        exit();
    }
    
    // Register user
    $result = $userReg->registerUser($username, $email, $password, $role);
    if ($result === true) {
        $id=$userReg->getuserid($email);
        $id= ($id["user_id"]) ;
        include_once("profile-info-contr.php");
        include_once("../classes/profile-info.php");
        $profile=new ProfileInfoContr();
        $profile->getinfo($id);
        $profile->defaultcreation();
        header("Location:../view/login.php");
    }
    } else {
        echo "Error: Unable to register user. " . $result;
    }

?>
