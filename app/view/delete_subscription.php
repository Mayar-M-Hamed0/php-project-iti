<?php
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// تحقق من وجود معرف الاشتراك في عنوان URL
if (isset($_GET['id'])) {
    // تضمين ملف الاتصال بقاعدة البيانات
    include_once("../classes/Dbconnect.php");
    
    // إنشاء كائن Database
    $db = new Database();
    
    // استخراج معرف الاشتراك من العنوان URL
    $subscription_id = $_GET['id'];
    
    // إعداد الاستعلام لحذف الاشتراك
    $query = "DELETE FROM enrollments WHERE enrollment_id = ?";
    
    // استعداد البيانات للربط مع الاستعلام
    $stmt = $db->conn->prepare($query);
    $stmt->bind_param("i", $subscription_id);
    
    // تنفيذ الاستعلام
    if ($stmt->execute()) {
        // إعادة توجيه المستخدم إلى صفحة الملف الشخصي بعد حذف الاشتراك بنجاح
        header("Location: profile.php");
        exit();
    } else {
        // إعادة توجيه المستخدم إلى صفحة خطأ إذا فشل حذف الاشتراك
        header("Location: error.php");
        exit();
    }
} else {
    // إعادة توجيه المستخدم إلى صفحة خطأ إذا لم يتم تقديم معرف الاشتراك في عنوان URL
    header("Location: error.php");
    exit();
}
?>
