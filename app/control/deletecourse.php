<?php
session_start();

include("../classes/Dbconnect.php");
require_once("../classes/query.php");

// التحقق مما إذا كان المستخدم مسجل الدخول أم لا
if (!isset($_SESSION['user_id'])) {
    // إذا لم يكن مسجل الدخول، قم بتوجيهه إلى صفحة تسجيل الدخول
    header("Location: login.php");
    exit();
}

// استقبال معرف الكورس الذي سيتم حذفه من رابط الصفحة
$courseId = $_GET['course_id'];

// إنشاء كائن CourseController
$courseController = new CourseController();

// حذف الكورس باستخدام معرف الكورس
if ($courseController->deleteCourse($courseId)) {
    header("Location:../view/mycourse.php");
    exit();
} else {
    // إذا فشلت عملية الحذف، يمكنك عرض رسالة خطأ للمستخدم أو توجيهه إلى صفحة خطأ
    echo "Failed to delete course.";
}
?>
