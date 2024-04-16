<?php

require_once '../classes/Dbconnect.php';
require_once '../classes/query.php';
// تحقق من أن البيانات تم إرسالها بطريقة POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات من النموذج
    $courseId = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    // إنشاء كائن من الكنترولر
    $courseController = new CourseController();

    // تحديث الكورس في قاعدة البيانات
    $courseController->updateCourse($courseId, $title, $description, $duration, $price);

    // إعادة التوجيه إلى صفحة أخرى بعد التحديث
    header("Location:../view/mycourse.php");
    exit();
}
?>
