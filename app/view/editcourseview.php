<?php
session_start();
include("../classes/Dbconnect.php");
include("../classes/query.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$courseId = $_GET['course_id'];
$courseController = new CourseController;
$course = $courseController->getCourseById($courseId);

include("../../assets/bodyhtmlbootsrtap.php");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
</head>
<body>
    <h1>Edit Course</h1>
    <form action="../control/editcourse.php" method="POST">
        <input type="hidden" name="course_id" value="<?php echo $courseId; ?>">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $course['title']; ?>"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $course['description']; ?></textarea><br>
        <label for="duration">Duration:</label><br>
        <input type="number" id="duration" name="duration" value="<?php echo $course['duration']; ?>"><br>
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" value="<?php echo $course['price']; ?>"><br><br>
        <input type="submit" value="Update Course">
    </form>
</body>
</html>
