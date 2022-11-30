<?php

class control
{
    public function check_numeric(string $str):int
    {
        for($i=0;$i<strlen($str);$i++)
        {
            if(is_numeric($str[$i]))
            {
                return 1;
            }

        }
        return 0;
    }
    public function email_check(string $str):int
    {
        $checkchar=0;
        for($i=0;$i<strlen($str);$i++)
        {
            if($str[$i]=='@')
            {
                $checkchar++;
            }
        }
        if($checkchar==1)
        {
            return $checkchar;
        }
        return 0;
    }

    public function control_form($namesurname,$yas, $cinsiyet, $email, $number, $university, $class_number, $password):int
    {
        $warning_variable = 0;
        if (!$namesurname)
        {
            $warning_variable++;
            echo "<pre>";
            echo "Ad soyad yazilmasi zorunludur.\n";
        }
        if ($this->check_numeric($namesurname)) {
            echo "Ad soyad numara iceremez.\n";
            $warning_variable++;
        }
        if (strlen($namesurname) < 4 || strlen($namesurname) > 30) {
            echo "Ad soyad 4 harften kisa 30 harften uzun olamaz.\n";
            $warning_variable++;
        }
        if ($yas < 15 || $yas > 30) {
            echo "Burs başvurumuz 15 ile 30 yaş arası içindir\n";
            $warning_variable++;
        }

        if (!$cinsiyet) {
            $warning_variable++;
            echo "<pre>";
            echo "Cinsiyet secilmesi zorunludur.\n";
        }
        if(!$email) {
            echo "<pre>";
            echo "Email yazılması zorunludur.\n";
            $warning_variable++;
        }
        if(!$this->email_check($email))
        {
            echo "<pre>";
            echo "Email doğru girilmedi.\n";
            $warning_variable++;
        }
        if(!$number)
        {
            echo "<pre>";
            echo "Ogrenci numarası girilmedi.\n";
            $warning_variable++;
        }
        if(!$university)
        {
            echo "<pre>";
            echo "Universite  girilmedi.\n";
            $warning_variable++;
        }
        if($class_number>6||!$class_number)
        {
            echo "<pre>";
            echo "Sınıfınızı  kontrol edin.\n";
            $warning_variable++;
        }
        if(strlen($password)<6||strlen($password)>20)
        {
            echo "<pre>";
            echo "Şifrenizi 6 ve 20 karakter arasında yazmalısınız.\n";
            $warning_variable++;
        }
        return $warning_variable;
    }
    public function control_ders_girisi($mail,$derskodu,$ders_adi,$not):int
    {
        $wv=0;
        if(!$mail) {
            echo "Mail adresinizi girmeniz gerekmektedir.";
            $wv++;
        }
        if(!$derskodu)
        {
            echo "Ders kodunuzu girmeniz gerekmektedir.";
            $wv++;
        }
        if(!$ders_adi)
        {
            echo "Ders adınızı girmeniz gerekmektedir.";
            $wv++;
        }
        if($not<0 ||$not>100 || !$not)
        {
            echo "Dersinizin notu 0 ile 100 aralığında olabilir, ders notu girilmesi zorunludur.";
        }
        return $wv;
    }

}