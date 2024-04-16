<?php
session_start();
$title = "Profile page";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

include_once("../../assets/bodyhtmlbootsrtap.php");
include_once("../classes/profile-info.php");
include_once("../control/profile-info-contr.php");

$profile = new ProfileInfo();
$id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$profileinf = $profile->getProfileInfo($id);


require_once '../classes/query.php';

// Create a new CourseController object
$courseController = new CourseController();

// Get instructor ID from session
$instructorId = $_SESSION['user_id'];

// Get courses owned by the instructor
$courses = $courseController->getCoursesByInstructor($instructorId);

// Check if the user is a teacher
$isTeacher = ($_SESSION['role'] == 'teacher');



include_once("../classes/Dbconnect.php");






//         enrooooooooooooooooooooooooool
$db = new Database();




$query = "select c.*,e.*, username
from courses c , enrollments e ,users u
where c.course_id=e.course_id and c.instructor_id=u.user_id  and e.user_id=$id ";
$result = $db->executeQuery($query);

// تحقق من وجود نتائج
if ($result->num_rows > 0) {
    $enrollments = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $enrollments = [];
}



//         enrooooooooooooooooooooooooool




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/profile.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-4 ">
                <div class="card  bg-black text-white">
                    <img src="../../assets/<?php echo $profileinf['profile_img']; ?> " height="350px" class="card-img-top h-100 " alt="...">
                    <div class="card-body lh-lg ">
                        <b>About</b>
                        <p class="card-text"><?php echo $profileinf['profile_about']; ?> </p>
                        <button class="btn btn-primary mx-auto"> <a href="profileedit.php" class="text-white" style="text-decoration:none;"> edit my information</a> </button>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="col  mb-3 bg-black text-white rounded-1">
                    <div class="ps-4 py-3">
                        <b>HI I'm <?php echo $username ?></b>
                        <p><?php echo $profileinf['profile_introtext']; ?> </p>
                    </div>
                </div>
                <div class="col bg-white rounded-2 p-4">
                    <h2>posts</h2>
                    <div class="posts">
                        <?php if ($isTeacher) : ?>
                            <div class="container mt-3">
                                <div class="row">
                                    <?php foreach ($courses as $course) : ?>


                                        
                                            <div class="col-12">
                                                <div class="container">
                                                    <div class="card my-2 w-75">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                                <img src="../../assets/Free-Online-Course-1.jpg" class="img-fluid rounded-start h-100" alt="...">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $course['title']; ?> </h5>
                                                                    <p class="card-text"> Description : <?php echo $course['description']; ?></p>
                                                                    <p class="card-text"> Duration: <?php echo $course['duration']; ?> days</p>
                                                                    <p class="card-text">
                                                                    <p>Price: $<?php echo $course['price']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                      print

                                    <?php endforeach; ?>
                                </div>

                            </div>
                        <?php endif; ?>




                        
                    </div>
                    <div class="container mt-4">
        <div class="row">
       <!-- //         enrooooooooooooooooooooooooool
 -->
            <div class="col-12">
           
                <h3>Your Subscriptions:</h3>
                <ul>
                    <?php foreach ($enrollments as $enrollment) : ?>
                       
                        <div class="card my-5">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../../assets/Online-Learning.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "title: ".$enrollment['title'] ?></h5>
                        Instructor: <a href="profile-for-forign.php?id=<?php echo $enrollment['instructor_id']; ?>"><?php echo($enrollment['username']); ?></a>
                        <p class="card-text"> <?php echo "Description: ".$enrollment['description'] ?> </p>
                         <li>
                            Enrollment Date: <?php echo $enrollment['enrollment_date']; ?>
                            
                        </li> <br>
                        <p class="card-text"> <?php echo "duration for the course: " .$enrollment['duration'] . " weeks" ?></p>
                        <p class="card-text"> <?php echo "price of the course: " . $enrollment['price'] . "$" ?></p>
                        <p class="card-text"> <?php echo    '<span class="fw-bold">categories </span>' . $enrollment['categories']  ?></p>
                        <a href="delete_subscription.php?id=<?php echo $enrollment['enrollment_id']; ?>" class="btn btn-danger">حذف الاشتراك</a>

                    </div>
                </div>
            </div>
        </div>
                    <?php endforeach; ?>
                           <!-- //         enrooooooooooooooooooooooooool
 -->
                </ul>
            </div>
        </div>
    </div>

                </div>
            </div>
        </div>

        <script href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
        <script href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>