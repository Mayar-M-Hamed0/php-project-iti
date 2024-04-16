<?php

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
?>



