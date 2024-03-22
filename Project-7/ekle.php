<?php
class OgrenciKayit {
    private $ogrenciler = array();

    public function __construct() {
        // Eğer daha önce çerez varsa, öğrenci bilgilerini çerezden al
        if(isset($_COOKIE['ogrenciler'])) {
            $this->ogrenciler = json_decode($_COOKIE['ogrenciler'], true);
        }

        // Eğer form gönderilmişse yeni öğrenciyi ekleyerek çerez güncelle
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ekleOgrenci($_POST['ad'], $_POST['soyad']);
            $this->guncelleCerez();
        }
    }

    private function ekleOgrenci($ad, $soyad) {
        $this->ogrenciler[] = array('ad' => $ad, 'soyad' => $soyad);
    }

    private function guncelleCerez() {
        // Öğrenci bilgilerini çerezde sakla (bir gün boyunca)
        setcookie('ogrenciler', json_encode($this->ogrenciler), time() + (86400 * 1), "/");
    }

    public function listeleOgrenciler() {
        echo "<ul>";
        foreach ($this->ogrenciler as $ogrenci) {
            echo "<li>{$ogrenci['ad']} {$ogrenci['soyad']}</li>";
        }
        echo "</ul>";
    }
}

// OgrenciKayit sınıfını kullanarak işlemleri gerçekleştir
$ogrenciKayit = new OgrenciKayit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Ekleme</title>
</head>
<body>
    <h2>Öğrenci Ekleme Formu</h2>
    <form method="post" action="">
        <label for="ad">Ad:</label>
        <input type="text" name="ad" required>

        <label for="soyad">Soyad:</label>
        <input type="text" name="soyad" required>

        <button type="submit">Ekle</button>
    </form>

    <h2>Eklenen Öğrenciler</h2>
    <?php
    // Eklenen öğrencileri listeleyerek göster
    $ogrenciKayit->listeleOgrenciler();
    ?>
</body>
</html>
