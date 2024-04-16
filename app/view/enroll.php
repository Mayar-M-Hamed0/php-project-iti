<?php
// استدعاء ملف الاتصال بقاعدة البيانات
include_once("../classes/Dbconnect.php");

// إنشاء كائن من الكلاس Database
$db = new Database();

// التحقق من الجلسة

session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// استخراج معرف المستخدم من الجلسة
$user_id = $_SESSION['user_id'];

// التحقق من وجود معرف الدورة في عنوان URL
if (isset($_GET['course_id'])) {
    // استخراج معرف الدورة من عنوان URL
    $course_id = $_GET['course_id'];

    // تحقق من عدم وجود اشتراك مسبق للمستخدم في هذه الدورة
    include_once("../classes/Dbconnect.php");
    $db = new Database();
    $query = "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?";
    $stmt = $db->conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // إذا كان هناك اشتراك مسبق، قم بإعادة التوجيه إلى صفحة خطأ أو إظهار رسالة للمستخدم بأنه مشترك بالفعل
        header("Location:corse.php");
        exit();
    } else {
        // تنفيذ استعلام INSERT لإضافة اشتراك جديد
        $sql = "INSERT INTO enrollments (user_id, course_id, enrollment_date) VALUES (?, ?, CURRENT_TIMESTAMP)";
        $stmt = $db->conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $course_id);
        if ($stmt->execute()) {
            // إعادة توجيه المستخدم إلى صفحة الملف الشخصي بعد الاشتراك بنجاح
            header("Location: profile.php");
            exit();
        } else {
            // إعادة توجيه المستخدم إلى صفحة خطأ إذا فشلت عملية الاشتراك
            header("Location:corse.php");
            exit();
        }
    }
} else {
    // إعادة توجيه المستخدم إلى صفحة خطأ إذا لم يتم تقديم معرف الدورة في عنوان URL
    header("Location:corse.php");
    exit();
}
?>
