<?php
// bir.php'den gelen cookie'yi kontrol et
if(isset($_COOKIE['giris_deneme'])) {
    $giris_deneme = $_COOKIE['giris_deneme'];
} else {
    $giris_deneme = 0;
}

echo 'Giriş deneme sayısı: ' . $giris_deneme;
?>
