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
    <link rel="stylesheet" type="text/css" href="style_2.css">
</head>
<body>
<div class="login">
    <div class="login-screen">
        <div class="app-title">
            <h1>Ders Girişi</h1>
        </div>
        <form action="islem.php" method="POST">
            <div class="login-form">
                <div class="control-group">
                    <input type="email" name="Mail" class="login-field" placeholder="Mail Adresinizi Giriniz" id="login-coursecode">
                    <label class="login-field-icon fui-user" for="login-coursecode"></label>
                </div>
                <div class="control-group">
                    <input type="text" name="DersKodu" class="login-field" placeholder="Ders Kodu Giriniz" id="login-coursecode">
                    <label class="login-field-icon fui-user" for="login-coursecode"></label>
                </div>
                <div class="control-group">
                    <input type="text" name="DersAdı" class="login-field" placeholder="Ders Adı Giriniz" id="login-dersadı">
                    <label class="login-field-icon fui-user" for="login-dersadı"></label>
                </div>
                <div class="control-group">
                    <input type="number" name="Not" class="login-field" placeholder="Notunuzu giriniz" id="login-not">
                    <label class="login-field-icon fui-user" for="login-not"></label>
                </div>

                <button href="islem.php" name="ders_girisi" class="btn btn-primary btn-large btn-block">Ders Girişi Yap</button>
                <button href="islem.php" class="btn btn-primary btn-large btn-block" name="cikis" >Çıkış Yap</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php } ?>
