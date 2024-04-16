<?php

require_once 'Dbconnect.php';


class CourseController {
    // Method to add a new course to the database
      // Method to add a new course to the database
      public function addCourse($title, $description, $duration, $price,$category,$level) {
        // Create a new Database object
        $db = new Database();

        // Get the user id from the session
        $instructorId = $_SESSION['user_id'];

        // SQL query to insert course data into the database
        $sql = "INSERT INTO courses (title, description, instructor_id, duration, price,categories,levels) 
                VALUES ('$title', '$description', '$instructorId', '$duration', '$price','$category','$level')";

        // Execute the query
        if ($db->executeQuery($sql) === TRUE) {
            echo "Course uploaded successfully.";
        } else {
            echo "Error uploading course: " . $db->conn->error;
        }

        // Close the database connection
        $db->closeConnection();
    }



    public function getCoursesWithInstructors($category="%",$level="%") {
        // Create a new Database object
        $db = new Database();

        // SQL query to select courses with instructors' names
        $sql = "SELECT c.*, u.username AS instructor_name
                FROM courses c
                INNER JOIN users u ON c.instructor_id = u.user_id
                WHERE c.categories like '$category' AND c.levels Like '$level'";

        // Execute the query
        $result = $db->executeQuery($sql);

        // Fetch all rows from the result as an associative array
        $courses = $result->fetch_all(MYSQLI_ASSOC);

        // Close the database connection
        $db->closeConnection();

        return $courses;
    }



    

    public function getCoursesByInstructor($instructorId) {
        // Create a new Database object
        $db = new Database();

        // SQL query to select courses owned by the instructor
        $sql = "SELECT * FROM courses WHERE instructor_id = '$instructorId'";

        // Execute the query
        $result = $db->executeQuery($sql);

        // Fetch all rows from the result as an associative array
        $courses = $result->fetch_all(MYSQLI_ASSOC);

        // Close the database connection
        $db->closeConnection();

        return $courses;
    }
    

     public function getinstactor($id){
        $db = new Database();
        $sql = "SELECT  u.username AS instructor_name
                FROM courses c INNER JOIN users u ON c.instructor_id = u.user_id
                 WHERE c.course_id=$id ";

        // Execute the query
        $result = $db->executeQuery($sql);

        // Fetch all rows from the result as an associative array
        $courses = $result->fetch_all(MYSQLI_ASSOC);

        // Close the database connection
        $db->closeConnection();

        return $courses;
     }



    public function updateCourse($courseId, $title, $description, $duration, $price) {
        // إنشاء كائن من قاعدة البيانات
        $db = new Database();

        // إعداد الاستعلام SQL لتحديث الكورس
        $sql = "UPDATE courses SET title = '$title', description = '$description', duration = '$duration', price = '$price' WHERE course_id = '$courseId'";

        // تنفيذ الاستعلام
        $db->executeQuery($sql);

        // إغلاق الاتصال بقاعدة البيانات
        $db->closeConnection();
    }
    
    public function getCourseById($courseId) {
        // Create a new Database object
        $db = new Database();

        // تنفيذ الاستعلام SQL لاسترجاع بيانات الكورس المحدد
        $sql = "SELECT * FROM courses WHERE course_id = '$courseId'";

        // تنفيذ الاستعلام
        $result = $db->executeQuery($sql);

        // استرجاع البيانات كمصفوفة متجانسة
        $course = $result->fetch_assoc();

        // إغلاق اتصال قاعدة البيانات
        $db->closeConnection();

        return $course;
    }






    public function deleteCourse($courseId) {
        // إنشاء كائن Database
        $db = new Database();

        // تنفيذ الاستعلام SQL لحذف الكورس
        $sql = "DELETE FROM courses WHERE course_id = '$courseId'";

        // تنفيذ الاستعلام
        if ($db->executeQuery($sql) === TRUE) {
            // إذا تمت العملية بنجاح، أرجع قيمة true
            return true;
        } else {
            // إذا فشلت العملية، أرجع قيمة false
            return false;
        }

 
    }
}
















?>
