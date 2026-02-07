<?php
// معالجة النموذج وحفظ البيانات في CSV
$success = false;
$error = false;
$csv_file = 'registrations.csv';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $username = htmlspecialchars(trim($_POST['username']));
    $interest = htmlspecialchars(trim($_POST['interest']));

    if (!empty($full_name) && !empty($email) && !empty($username) && !empty($interest)) {
        $file_exists = file_exists($csv_file);
        $file = fopen($csv_file, 'a');

        if (!$file_exists) {
            fputcsv($file, ['الاسم الكامل', 'البريد الإلكتروني', 'اسم المستخدم', 'مجال الاهتمام', 'تاريخ التسجيل']);
        }

        fputcsv($file, [$full_name, $email, $username, $interest, date('Y-m-d H:i:s')]);
        fclose($file);
        $success = true;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>انضم إلى المجتمع - Nawah Hub</title>
<link rel="stylesheet" href="../styles.css">
<style>
body { font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height:1.6; color:#333; background-color:#fcfcfc; padding:0 20px; }
header { text-align:center; padding:50px 20px; background-color:#fff3f3; color:#d32f2f; }
section { margin:40px 0; max-width:600px; margin-left:auto; margin-right:auto; }
h2 { color:#d32f2f; margin-bottom:15px; text-align:center; }
form { display:flex; flex-direction:column; gap:15px; }
input, select { padding:10px; border:1px solid #ccc; border-radius:5px; font-size:16px; }
button { padding:10px 20px; background-color:#d32f2f; color:#fff; border:none; border-radius:5px; cursor:pointer; font-size:16px; }
button:hover { background-color:#9a0000; }
.message { text-align:center; padding:15px; border-radius:5px; margin-bottom:20px; font-weight:bold; }
.success { background-color:#c8e6c9; color:#2e7d32; }
.error { background-color:#ffcdd2; color:#c62828; }
</style>
</head>
<body>

<header>
  <h1>انضم الآن لمجتمع Nawah Hub</h1>
  <p>كن جزءًا من مجتمعنا الرقمي التعليمي والثقافي والتجريبي.</p>
</header>

<section>
  <h2>نموذج التسجيل</h2>

  <?php if ($success): ?>
    <div class="message success">تم التسجيل بنجاح! مرحبًا بك في مجتمعنا.</div>
  <?php elseif ($error): ?>
    <div class="message error">هناك خطأ! يرجى ملء جميع الحقول بشكل صحيح.</div>
  <?php endif; ?>

  <form method="POST" action="">
    <input type="text" name="full_name" placeholder="الاسم الكامل" required>
    <input type="email" name="email" placeholder="البريد الإلكتروني" required>
    <input type="text" name="username" placeholder="اسم المستخدم" required>
    <select name="interest" required>
      <option value="">اختر مجال اهتمامك</option>
      <option value="crypto">العملات الرقمية</option>
      <option value="nfts">NFTs وثقافة الرموز</option>
      <option value="education">تعلم وتطوير المهارات</option>
      <option value="experiments">تجارب ومشاريع</option>
      <option value="puzzles">ألغاز وتحديات</option>
    </select>
    <button type="submit">انضم الآن</button>
  </form>
</section>

<!-- Footer -->
<footer style="background-color:#f9f9f9; padding:40px 20px; text-align:center; border-top:1px solid #ddd; margin-top:50px;">
  <h3 style="color:#6a1b9a; margin-bottom:20px;">جهات داعمة (تعريفي)</h3>
  <div class="logo-carousel" style="display:flex; flex-wrap:wrap; justify-content:center; gap:30px; align-items:center; overflow-x:auto; scroll-behavior:smooth;">
    <img src="../assets/logos/bitcoin.png" alt="Bitcoin" style="height:50px;">
    <img src="../assets/logos/ethereum.png" alt="Ethereum" style="height:50px;">
    <img src="../assets/logos/cardano.png" alt="Cardano" style="height:50px;">
    <img src="../assets/logos/polygon.png" alt="Polygon" style="height:50px;">
    <img src="../assets/logos/binance.png" alt="Binance" style="height:50px;">
    <img src="../assets/logos/coinmarketcap.png" alt="CoinMarketCap" style="height:50px;">
    <img src="../assets/logos/coingecko.png" alt="CoinGecko" style="height:50px;">
  </div>
  <p style="margin-top:30px; color:#555;">© 2026 Nawah Hub - كل الحقوق محفوظة</p>
</footer>

</body>
</html>
