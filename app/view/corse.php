<?php
$title= 'corse';

session_start();
$username = $_SESSION['username'];

// التحقق مما إذا كان المستخدم مسجل الدخول أم لا


// استقبال اسم المستخدم من الجلسة
// $username = $_SESSION['username'];
include("../../assets/bodyhtmlbootsrtap.php");
require_once '../classes/query.php';




// استقبال اسم المستخدم من الجلسة

// Create a new CourseController object
$courseController = new CourseController();
if (isset($_POST['Submit'])) {
  if(empty($_POST['category'])&& !empty($_POST['level'])){
    $level=$_POST['level'];
    $courses = $courseController->getCoursesWithInstructors("%",$level);
  }
  elseif(empty($_POST['level'])&& !empty($_POST['category'])){
    $category=$_POST['category'];
    $courses = $courseController->getCoursesWithInstructors($category);
  }
  elseif(empty($_POST['level'])&&empty($_POST['category'])){
    $courses = $courseController->getCoursesWithInstructors();

  }
  else{
    $category=$_POST['category'];
    $level=$_POST['level'];
    $courses = $courseController->getCoursesWithInstructors($category,$level);
  }
  
  
  
}
if (!isset($_POST['Submit'])){

  $courses = $courseController->getCoursesWithInstructors();
}
// Get courses from the database
// $courses = $courseController->getCoursesWithInstructors($category,$level);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
</head>
<body>


    <h1 class='text-center'>Course</h1>




<div class="row">
  <div class="col-3">
  <form class="ps-4" method="post">
    <label>Select categories:</label><br>

    
    <input type="radio" id="all" name="category" value="%">
    <label for="all">All</label> <br>

    <input type="radio" id="arabic" name="category" value="arabic">
    <label for="arabic">Arabic</label> <br>

    <input type="radio" id="english" name="category" value="english">
    <label for="english">English</label> <br>

    <input type="radio" id="french" name="category" value="french">
    <label for="french">French</label> <br>

    <input type="radio" id="math" name="category" value="math">
    <label for="math">Math</label> <br>

    <input type="radio" id="science" name="category" value="science">
    <label for="science">Science</label>
    <br> <br>

    <label>Select Level:</label><br>

    
    <input type="radio" id="alllevel" name="level" value="%">
    <label for="alllevel">All</label> <br>

    <input type="radio" id="Level 1" name="level" value="Level 1">
    <label for="Level 1">Level 1</label> <br>

    <input type="radio" id="Level 2" name="level" value="Level 2">
    <label for="Level 2">Level 2</label> <br>

    <input type="radio" id="Level 3" name="level" value="Level 3">
    <label for="Level 3">Level 3</label> <br>

    <input type="radio" id="Level 4" name="level" value="Level 4">
    <label for="Level 4">Level 4</label> <br>

    <input type="radio" id="Level 5" name="level" value="Level 5">
    <label for="Level 5">Level 5</label>
    <br>
    <input type="radio" id="Level 6" name="level" value="Level 6">
    <label for="Level 6">Level 6</label>
    <br>
    <br>

    <input type="submit" class="btn btn-secondary" value="Filter" name="Submit">
</form>
  </div>

<div class="col-9">
    <div class="row">
    <?php foreach ($courses as $course): ?>
    <div class="col-lg-3 col-sm-4">
  <div class="col">
    <div class="card h-100">
      <img src="../../assets/Free-Online-Course-1.jpg" class="card-img-top"

        alt="Hollywood Sign on The Hill" />


      <div class="card-body text-center">
        <h5 class="card-title">Course : <span class='fw-bold'>  <?php echo $course['title']; ?></span></h5>
        <p class="card-text">
        <?php echo $course['description']; ?>
        </p>
        <p>  <span class='fw-bold'>Instructor</span>  : <a href="profile-for-forign.php?id=<?php echo $course['instructor_id']; ?>"><?php echo $course['instructor_name']; ?></a>  </p>
        <p>Duration: <?php echo $course['duration']; ?> days</p>
        <p>Price:  <span class='fw-bold' ><?php echo $course['price']; ?>ج </span>  </p>

            <p>categories:  <span class='fw-bold' ><?php echo $course['categories']; ?></span>  </p>
        

            <?php if ($_SESSION['role'] != 'teacher'): ?>
    <button class="btn btn-success mx-auto">
        <a href="enroll.php?course_id=<?php echo $course['course_id']; ?>" class="text-white" style="text-decoration:none;">اشتراك</a>
    </button>
<?php endif; ?>

            <a href="course-detailes.php?id=<?php echo $course['course_id'] ?>"><p class='btn btn-info text-white'>  تفاصيل الكورس</p> </a>
      </div>
    </div>
  </div>

</div>
<?php endforeach; ?>

    </div>
</div>
</div>

</body>
</html>
