<?php 
$title= 'Mycourse';
session_start();

// التحقق مما إذا كان المستخدم مسجل الدخول أم لا
if (!isset($_SESSION['user_id'])) {
    // إذا لم يكن المستخدم مسجل الدخول، قم بتوجيهه إلى صفحة تسجيل الدخول
    header("Location: login.php");
    exit();
}

// استقبال اسم المستخدم من الجلسة
$username = $_SESSION['username'];
include("../../assets/bodyhtmlbootsrtap.php");



require_once '../classes/query.php';

// Create a new CourseController object
$courseController = new CourseController();

// Get instructor ID from session
$instructorId = $_SESSION['user_id'];

// Get courses owned by the instructor
$courses = $courseController->getCoursesByInstructor($instructorId);

// Check if the user is a teacher
$isTeacher = ($_SESSION['role'] == 'teacher');










?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
</head>
<body>
    <h1 class='text-center mb-5'>My Courses </h1>














<div class="container">
    <div class="row">
    <?php foreach ($courses as $course): ?>


    <div class="col-lg-3 col-sm-4">
  <div class="col">
    <div class="card h-100">
      <img src="../../assets/Free-Online-Course-1.jpg" class="card-img-top"

        alt="Hollywood Sign on The Hill" />


      <div class="card-body text-center">
        <h5 class="card-title">Course:<span class='fw-bold'><?php echo $course['title']; ?> </span></h5>
        <p class="card-text">
        Description :  <?php echo $course['description']; ?>
        </p>
     
        <p>Duration: <?php echo $course['duration']; ?> days</p>
        <p>Price: $<?php echo $course['price']; ?></p>

        <?php if ($isTeacher): ?>
                    <!-- Display edit and delete options for the teacher -->
                    <a class="btn btn-secondary" href="editcourseview.php?course_id=<?php echo $course['course_id']; ?>">Edit</a>
                    <a  class="btn btn-danger"  href="../control/deletecourse.php?course_id=<?php echo $course['course_id']; ?>">Delete</a>
                <?php endif; ?>


  
      </div>
    </div>
  </div>

       </div>

       <?php endforeach; ?>
   
    </div>

 





















</body>
</html>

