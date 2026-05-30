<?php
session_start();

// بيانات الدخول الافتراضية لطاقم المطبخ (يمكنكِ تعديلها)
$correct_username = "kitchen";
$correct_password = "kitchen_pwd";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استقبال البيانات بناءً على الـ name في كود الـ HTML الخاص بكِ
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($username === $correct_username && $password === $correct_password) {
        // تفعيل جلسة الأمان للمطبخ وتوجيهه فوراً للوحة التحكم
        $_SESSION['kitchen_logged_in'] = true;
        header("Location: kitchen.php");
        exit();
    } else {
        // إذا كانت البيانات خاطئة، يعرض تنبيه مخصص ويعيده لصفحة الدخول
        echo "<script>
                alert('عذراً! اسم المستخدم أو كلمة المرور غير صحيحة.');
                window.location.href = 'login.html'; 
              </script>";
        exit();
    }
} else {
    // حماية الملف في حال محاولة الدخول إليه بالرابط مباشرة دون الـ Form
    header("Location: login.html");
    exit();
}
?>