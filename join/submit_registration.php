<?php
// ملف لمعالجة تسجيل الانضمام وحفظ البيانات في ملف CSV

// تحديد مسار ملف CSV لتخزين البيانات
$csv_file = 'registrations.csv';

// التحقق من إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // الحصول على البيانات من النموذج مع فلترة بسيطة
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $username = htmlspecialchars(trim($_POST['username']));
    $interest = htmlspecialchars(trim($_POST['interest']));

    // التحقق من وجود جميع الحقول
    if (!empty($full_name) && !empty($email) && !empty($username) && !empty($interest)) {

        // فتح الملف للكتابة (إنشائه إذا لم يكن موجود)
        $file_exists = file_exists($csv_file);
        $file = fopen($csv_file, 'a');

        // إذا الملف جديد، إضافة رأس الأعمدة
        if (!$file_exists) {
            fputcsv($file, ['الاسم الكامل', 'البريد الإلكتروني', 'اسم المستخدم', 'مجال الاهتمام', 'تاريخ التسجيل']);
        }

        // إضافة البيانات مع تاريخ التسجيل
        fputcsv($file, [$full_name, $email, $username, $interest, date('Y-m-d H:i:s')]);

        fclose($file);

        // إعادة توجيه المستخدم مع رسالة نجاح
        header("Location: index.html?success=1");
        exit();
    } else {
        // إعادة توجيه المستخدم مع رسالة خطأ
        header("Location: index.html?error=1");
        exit();
    }
} else {
    // منع الوصول المباشر للملف
    header("HTTP/1.1 403 Forbidden");
    echo "غير مسموح بالوصول المباشر.";
    exit();
}
?>
