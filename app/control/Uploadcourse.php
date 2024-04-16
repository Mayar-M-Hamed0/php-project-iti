<?php
require_once '../view/UploadCourse.php';
require_once '../classes/query.php';

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Check if user is a teacher
if ($_SESSION['role'] !== 'teacher') {
    // Redirect to unauthorized page if user is not a teacher
    header("Location:../view/index.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $category=$_POST['categories'];
    $level=$_POST['level'];

    // Create a new CourseController object
    $courseController = new CourseController();

    // Call the addCourse method and pass the form data as parameters
    $courseController->addCourse($title, $description, $duration, $price,$category,$level);
}


?>
.





