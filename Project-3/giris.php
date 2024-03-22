<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Formu</title>
</head>
<body>

    <?php
    // giris.php'den gelen cookie'yi kontrol et
    if(isset($_COOKIE['giris_deneme'])) {
        $giris_deneme = $_COOKIE['giris_deneme'];
    } else {
        $giris_deneme = 0;
    }

    // eğer kullanıcı adı ve şifre doğru ise
    if(isset($_COOKIE['giris_durumu']) && $_COOKIE['giris_durumu'] == 'basarili') {
        echo 'Giriş başarılı!';
    } else {
        // eğer kullanıcı adı ve şifre yanlış ise
        if(isset($_POST['submit'])) {
            $kullanici_adi = $_POST['kullanici_adi'];
            $sifre = $_POST['sifre'];

            // Örnek kullanıcı adı ve şifre
            $dogru_kullanici_adi = 'parafin';
            $dogru_sifre = '12345';

            if($kullanici_adi == $dogru_kullanici_adi && $sifre == $dogru_sifre) {
                // Giriş başarılı ise
                setcookie('giris_durumu', 'basarili', time() + 3600, '/');
                $giris_deneme = 0; // Giriş başarılı, deneme sayısını sıfırla
            } else {
                // Giriş başarısız ise
                $giris_deneme++;
                setcookie('giris_deneme', $giris_deneme, time() + 3600, '/');
                
                if($giris_deneme >= 3) {
                    // 3 defa yanlış girilirse
                    echo 'Giriş reddedildi! 3 defa yanlış giriş yapıldı.';
                } else {
                    // Yanlış giriş, ancak 3 defa değilse
                    echo 'Kullanıcı adı veya şifre yanlış. Kalan deneme hakkınız: ' . (3 - $giris_deneme);
                }
            }
        }

        // Giriş formunu göster
        ?>
        <form method="post" action="giris.php">
            <label for="kullanici_adi">Kullanıcı Adı:</label>
            <input type="text" id="kullanici_adi" name="kullanici_adi" required><br>

            <label for="sifre">Şifre:</label>
            <input type="password" id="sifre" name="sifre" required><br>

            <input type="submit" name="submit" value="Giriş Yap">
        </form>
        <?php
    }

    ?>

</body>
</html>
