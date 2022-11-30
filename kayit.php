<?php
session_start();
unset($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staj Çalışması</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="login">
    <div class="login-screen">
        <div class="app-title">
            <h1>Kayıt Ol</h1>
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
                <div class="control-group">
                    <input type="password" name="password-again" class="login-field" placeholder="Tekrar Şifre" id="login-pass">
                    <label class="login-field-icon fui-user" for="login-pass"></label>
                </div>
                <div class="control-group">
                    <input type="text" name="Ad" class="login-field" placeholder="Adınızı giriniz" id="login-rname">
                    <label class="login-field-icon fui-user" for="login-rname"></label>
                </div>
                <div class="control-group">
                    <input type="number" name="Numara" class="login-field" placeholder="Öğrenci numaranızı giriniz" id="login-number">
                    <label class="login-field-icon fui-user" for="login-number"></label>
                </div>
                <div class="control-group">
                    <input type="text" name="Universite" class="login-field" placeholder="Universitenizi giriniz" id="login-universite">
                    <label class="login-field-icon fui-user" for="login-universite"></label>
                </div>
                <div class="control-group">
                    <input type="number" name="Sinif" class="login-field" placeholder="Sınıfınızı giriniz" id="login-sinif">
                    <label class="login-field-icon fui-user" for="login-sinif"></label>
                </div>
                <div class="control-group">
                    <input type="number" name="Yas" class="login-field" placeholder="Yaşınızı giriniz" id="login-yas">
                    <label class="login-field-icon fui-user" for="login-yas"></label>
                </div>

                <div class="control-group">
                    <input type="text" name="Cinsiyet" class="login-field" placeholder="Cinsiyetinizi giriniz" id="login-cinsiyet">
                    <label class="login-field-icon fui-user" for="login-cinsiyet"></label>
                </div>
                <button href="kayit.php" name="kayit" class="btn btn-primary btn-large btn-block">Kayıt Ol</button>
            </div>
        </form>
        <a href="index.php"><button class="btn btn-primary btn-large btn-block">Giriş Yap</button></a>
    </div>
</div>
</body>
</html>