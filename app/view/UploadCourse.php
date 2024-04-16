<?php 
$title= 'Mycourse';
session_start();

// التحقق مما إذا كان المستخدم مسجل الدخول أم لا
if (!isset($_SESSION['user_id'])) {
    // إذا لم يكن المستخدم مسجل الدخول، قم بتوجيهه إلى صفحة تسجيل الدخول
    header("Location: login.php");
    exit();
}


include("../../assets/bodyhtmlbootsrtap.php");
include_once("../control/Uploadcourse.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Course</title>
</head>
<body>
    <h1 class='text-center mb-4'>Upload Course</h1>

   















<div class="container">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 mt-5">

        
      
        <form action="../control/Uploadcourse.php" method="POST">
  <div class="mb-3">
    <div class='d-flex justify-content-center'>  <label for="title" class="form-label text-center">title</label> </div>
  
    <input class="form-control"   type="text" id="title" name="title" required>
  </div>
  <div class="mb-3">
  <div class='d-flex justify-content-center'>  <label for="title" class="form-label text-center">description</label> </div>

    <textarea class="form-control"  id="description" name="description" required></textarea>
  </div>







  <div class="mb-3">
  <div class='d-flex justify-content-center'>  <label for="title" class="form-label text-center">duration</label> </div>

    <input type="test" class="form-control"  id="duration" name="duration" required>
  </div>


  <div class="mb-3">
  <div class='d-flex justify-content-center'>  <label for="title" class="form-label text-center">    price</label> </div>

    <input  type="number" class="form-control"  id="price" name="price" required>
 
  </div>

  <div class="mb-3 justify-content-center">
  <div class='d-flex justify-content-center'>   <label for="categories">Select a category:</label> </div>
 <div class="d-flex justify-content-center">
  <select id="categories" class="px-4 mt-2 rounded-2" name="categories">
        <option value="arabic">Arabic</option>
        <option value="english">English</option>
        <option value="french">French</option>
        <option value="math">Math</option>
        <option value="science">Science</option>
    </select>
    </div>
  </div>




  <div class="mb-3 justify-content-center">
  <div class='d-flex justify-content-center'>   <label for="categories">Select a level:</label> </div>
 <div class="d-flex justify-content-center">
  <select id="level" class="px-4 mt-2 rounded-2" name="level">
        <option value="Level 1">Level 1</option>
        <option value="Level 2">Level 2</option>
        <option value="Level 3">Level 3</option>
        <option value="Level 4">Level 4</option>
        <option value="Level 5">Level 5</option>
        <option value="Level 6">Level 6</option>
    </select>
    </div>
  </div>

 <div class="d-flex justify-content-center">
 
  
 </div>





  <div class='d-flex justify-content-center'>
  <button type="submit" value="Upload Course" class="btn btn-primary">Uplaod Now</button>


  </div>

</form>





        
        </div>
        <div class="col-4"></div>
    </div>
</div>



















</body>
</html>
