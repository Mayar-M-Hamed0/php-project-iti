<?php
// بدء الجلسة
session_start();

// إزالة جميع البيانات من الجلسة
$_SESSION = array();

// إنهاء الجلسة
session_destroy();

// توجيه المستخدم إلى صفحة تسجيل الدخول
header("Location:../view/login.php");
exit();
?>
