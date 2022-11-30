<?php
session_start();
if(!isset($_SESSION['username']))
{
    echo "Lutfen giris yapiniz.\n";
    header('Refresh:2; index.php');
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staj Çalışması</title>
    <link rel="stylesheet" type="text/css" href="style_3.css">
</head>
<body>
<div class="login">
    <div class="login-screen">
        <div class="app-title">
            <h1>Kontrol Menüsü</h1>
        </div>
        <form action="islem.php" method="POST">
            <div class="login-form">
                <button href="islem.php" name="ogrencileri_getir" class="btn btn-primary btn-large btn-block">Öğrencileri ekrana getir</button>
                <button href="islem.php" name="ders_bilgilerini_getir" class="btn btn-primary btn-large btn-block">Bütün Ders Bilgilerini Gör</button>
                <div class="control-group">
                    <input type="email" name="Mail" class="login-field" placeholder="Mail Adresinizi Giriniz" id="login-coursecode">
                    <label class="login-field-icon fui-user" for="login-coursecode"></label>
                </div>
                <button href="islem.php" name="ders_filtrele" class="btn btn-primary btn-large btn-block">Belirtilen mailin ders bilgilerini ekrana getir</button>
                <button href="islem.php" name="cikis" class="btn btn-primary btn-large btn-block">Çıkış Yap</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php } ?>