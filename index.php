<!DOCTYPE html>
<?php
session_start();
unset($_SESSION['username']);
?>
<html>
<head>
    <title>Staj Çalışması</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login">
        <div class="login-screen">
            <div class="app-title">
                <h1>Burs Başvurusu</h1>
            </div>
            <form action="islem.php" method="POST">
                <div class="login-form">
                    <div class="control-group">
                        <input type="email" name="Mail" class="login-field" placeholder="Mail giriniz" id="login-mail">
                        <label class="login-field-icon fui-user" for="login-mail"></label>
                    </div>
                    <div class="control-group">
                        <input type="password" name="password" class="login-field" placeholder="Şifre" id="login-pass">
                        <label class="login-field-icon fui-user" for="login-pass"></label>
                    </div>
                    <button href="islem.php" name="giris" class="btn btn-primary btn-large btn-block">Giris Yap</button>
                </div>
            </form>
            <a href="kayit.php "><button class="btn btn-primary btn-large btn-block">Kayıt Ol</button></a>
        </div>
    </div>
</body>
</html>