<html>

<form name="form1" id="form1_" action="form2" method="POST">
    E-Mail:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="email" name="Mail" size="20"><br><br>
    Name :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="Text" name="Name" size="20" ="center"><br><br>
    <input type="submit" value="Giris Yap">
</form>

</html>
<?php
if(!empty($_POST["Mail"])) {
    $Mail = $_POST["Mail"];
    $Name = $_POST["Name"];

    try {
        $data_base = new PDO("mysql:host=localhost;dbname=burs_veri_tabani", "root",);
    } catch (PDOException $hata) {
        die("Hata" . $hata->getMessage());
    }
    $SQL = "SELECT * FROM basvurular WHERE mail=:mail_";
    $prepare = $data_base->prepare($SQL);
    $execute_value = $prepare->execute(array(
        "mail_" => $Mail
    ));
    $results = $prepare->fetchAll();
    echo "<pre>";
    if (!empty($results)) {
        if (strtolower($Name) == strtolower($results[0][1])) {
            echo "İşleminiz başarılı aktarılıyorsunuz.";
            echo "<form name=\"form2\" action='ders_bilgisi.php' method='POST'>
              
              Ders Adı :<input type=\"text\" name=\"Ders_Adi\" size=\"20\"><br><br>
              Ders Ortalaması :<input type=\"text\" name=\"Ders_Ortalaması\" size=\"20\"><br><br>
              Ders Kodu  :<input type=\"text\" name=\"Ders_Kodu\" size=\"20\"><br><br>
              <input type='submit' value='Ders Kaydı Yap'><br><br>
            </form>";
        } else {
            echo "Adınızı veya mail adresinizi kontrol ediniz.\n";
        }
    } else {
        echo $Mail . " daha once kayıt yaptırmadı.Onceki sayfaya butona basarak dönün ve kayıt yaptırın";
        echo "<form action=\"task_.php\">
           <input type='submit' value='Geri dön'>
</form>";
    }
}

