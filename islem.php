<?php
session_start();
include 'control.php';
$hak=5;
    try{
        $data_base=new PDO("mysql:host=localhost;dbname=burs_; charset=utf8", "root");
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
    if(isset($_POST['kayit'])) {
        $control= new control();
        $mail = $_POST['Mail'];

        if ($_POST['password'] == $_POST['password-again']) {
            $password = $_POST['password'];
            $password=password_hash($password,PASSWORD_ARGON2ID);
        } else {
            echo "<pre>";
            echo "Şifreniz ile şifre tekrarınız aynı olmalıdır.";
        }
        $name = $_POST['Ad'];
        $number = $_POST['Numara'];
        $university = $_POST['Universite'];
        $class_number = $_POST['Sinif'];
        $age = $_POST['Yas'];
        $gender = $_POST['Cinsiyet'];
        if($control->control_form($name,$age,$gender,$mail,$number,$university,$class_number,$password)==0)
        {
            try {
                $sql = "INSERT INTO ogrenci_bilgi (Name,Age,University,Mail,StudentNumber,Gender,Password,Class) values (:namesurname_,:age_,:city_,:mail_,:number_,:gender_,:password_,:class_number_)";
                $sorgu = $data_base->prepare($sql);
                $kayit = $sorgu->execute(array(
                    "namesurname_" => $name,
                    "age_" => $age,
                    "gender_" => $gender,
                    "mail_" => $mail,
                    "city_" => $university,
                    "number_" => $number,
                    "class_number_" => $class_number,
                    "password_" => $password
                ));
                echo "Kayıt başarılı";
                header('Refresh:2; index.php');
            }
            catch (PDOException $e)
            {
                echo "<pre>";
                echo "Kayıt Başarısız Oldu";
            }
    }
    }
    if(isset($_POST['giris']))
    {
    $mail=$_POST['Mail'];
    $password=$_POST['password'];
    if(!$mail)
        echo "Mail adresinizi girmediniz.\n";
    if(!$password)
        echo "Şifrenizi girmediniz.\n";
    else {
        $sql = $data_base->prepare("SELECT * FROM adminler WHERE Mail=:mail_ && Şifre=:pw_");
        $sql->execute(array(
                "mail_" => $mail,
                "pw_" => $password
            )
        );
        $result=$sql->fetchAll();
        $say = $sql->rowCount();
        if ($say == 1) {
            $_SESSION["username"]=$result[0]['Mail'];
            echo "<pre>";
            echo "Giris basarili";
            header('Refresh:2; admin_ekran.php');
        }
        else {
            $sql = $data_base->prepare("SELECT * FROM ogrenci_bilgi WHERE Mail=:mail_");
            $sql->execute(array(
                    "mail_" => $mail,
                )
            );
            $result = $sql->fetchAll();
            if(isset($result[0])) {
                $password_ = $result[0]['Password'];
                $info = password_get_info($password_);
                if (!is_array($info)
                    || $info['algo'] === 0
                    ||$info['algo'] === '0'
                    ||$info['algoName'] === 'unknown')
                {
                    $password_=password_hash($password_,PASSWORD_ARGON2ID);
                    $SQL="UPDATE ogrenci_bilgi SET `Password`=:new_password WHERE Mail=:mail_ ";
                    $yeniden_sifrele=$data_base->prepare($SQL);
                    $yeniden_sifrele->execute(array(
                        "new_password" =>$password_,
                        "mail_"=>$mail
                    ));
                }
                $_SESSION["username"]=$result[0]['Name'];
            }
            else{
                echo "Boyle bir kullanici adresi bulunmamaktadir.";
                header('Location: index.php');
            }
            if (password_verify($password,$password_)) {
                echo "<pre>";
                echo "Giris basarili";
                header('Refresh:2; ders_giris.php');
            } else {
                echo "Hatalı giriş " . $hak . " hakkınız kaldı.";//şansal beye sor
                header('Refresh:2; index.php');
            }

        }
    }


    }
    if(isset($_POST['ders_girisi']))
    {
        $control= new control();
        $mail=$_POST['Mail'];
        $ders_kodu=$_POST['DersKodu'];
        $ders_adi=$_POST['DersAdı'];
        $not=$_POST['Not'];
        $say=0;
        $say2=0;
        if(!$control->control_ders_girisi($mail,$ders_kodu,$ders_adi,$not)) {
            try {
                $sql = $data_base->prepare("SELECT * FROM ders_basarisi WHERE Mail=:mail_ && CourseCode=:ders_kodu_");
                $sql->execute(array(
                        "mail_" => $mail,
                        "ders_kodu_" => $ders_kodu
                    )
                );
                $say = $sql->rowCount();
                $sql = $data_base->prepare("SELECT * FROM ders_basarisi WHERE Mail=:mail_");
                $sql->execute(array(
                        "mail_" => $mail,
                    )
                );
                $say2=$sql->rowCount();
            } catch (PDOException $e) {
                echo "Hatalı giriş.";
                header('Refresh:2; ders_giris.php');
            }
            if($say2==0)
            {
                echo "Hatalı mail girişi yönlendiriliyorsunuz.\n";
                header('Refresh:2; ders_giris.php');
            }
            if ($say == 0) {
                try {
                    $sql = "INSERT INTO ders_basarisi (Mail,CourseName,CourseCode,Exam_Note) values (:mail_,:ders_adi_,:ders_kodu_,:not_)";
                    $sorgu=$data_base->prepare($sql);
                    $sorgu->execute(array(
                            "mail_" => $mail,
                            "ders_kodu_" => $ders_kodu,
                            "ders_adi_" => $ders_adi,
                            "not_" => $not
                        )
                    );
                    echo "Ders girişiniz başarılı, yönlendiriliyorsunuz.";
                    header('Refresh:2; ders_giris.php');
                }
              catch(PDOException $e)
              {
                  echo "Hatalı giriş.Lutfen bilgilerinizi kontrol ediniz.";
                  header('Refresh:2; ders_giris.php');
              }
            }
            else
            {
                echo "Bu ders aktif olarak girilmiş durumda, tekrar yönlendiriliyorsunuz.";
                header('Refresh:2; ders_giris.php');
            }

        }
    }

    if(isset($_POST['ogrencileri_getir']))
    {
        $sql="SELECT ID,Name,StudentNumber,University,Class,Age,Mail FROM ogrenci_bilgi ";
        $islem=$data_base->prepare($sql);
        $sorgu=$islem->execute();
        $results=$islem->fetchAll();
        echo "<pre>".PHP_EOL;
        var_dump($results);
        echo "<pre>".PHP_EOL;
    }
    if(isset($_POST['ders_bilgilerini_getir']))
    {
        $sql="SELECT Mail,CourseName,CourseGrade FROM ders_basarisi";
        $islem=$data_base->prepare($sql);
        $sorgu=$islem->execute();
        $results=$islem->fetchAll();
        echo "<pre>".PHP_EOL;
        var_dump($results);
        echo "<pre>".PHP_EOL;
    }
    if(isset($_POST['ders_filtrele'])) {
        $mail = $_POST['Mail'];
        if (!$mail) {
            echo "Lutfen mail adresini doğru giriniz.";
            header('Refresh:2; admin_ekran.php');
        }
        $sql = "SELECT Mail FROM ogrenci_bilgi WHERE Mail=:mail_";
        $islem = $data_base->prepare($sql);
        $islem->execute(array(
            "mail_" => $mail
        ));
        if ($islem->rowCount() == 0) {
            echo "Aradığınız mail sistemde bulunmamaktadır.";
            header('Refresh:2; admin_ekran.php');
        } else {
            $sql = "SELECT Mail,CourseGrade,CourseName,CourseCode FROM ders_basarisi WHERE Mail=:mail_";
            $islem = $data_base->prepare($sql);
            $islem->execute(array(
                "mail_" => $mail
            ));
            $results = $islem->fetchAll();
            echo "<pre>\n";
            var_dump($results);
            echo "</pre>\n";


        }
    }
    if(isset($_POST["cikis"]))
    {
        echo "Lutfen giris yapiniz.";
        session_unset();
        session_destroy();
        header('Refresh:2; index.php');
    }

?>