<?php
session_start();

// Yeni öğrenci ekleme işlemi
if(isset($_POST['submit'])) {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];

    // Yeni öğrenciyi oturum değişkenine ekle
    if(!isset($_SESSION['ogrenciler'])) {
        $_SESSION['ogrenciler'] = array();
    }

    $_SESSION['ogrenciler'][] = array('ad' => $ad, 'soyad' => $soyad);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Ekleme Formu</title>
</head>
<body>

    <h2>Öğrenci Ekleme Formu</h2>

    <form method="post" action="ekle.php">
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad" required><br>

        <label for="soyad">Soyad:</label>
        <input type="text" id="soyad" name="soyad" required><br>

        <input type="submit" name="submit" value="Öğrenci Ekle">
    </form>

    <h2>Eklenen Öğrenciler</h2>

    <?php
    // Daha önce eklenen öğrencileri listeleyin
    if(isset($_SESSION['ogrenciler']) && count($_SESSION['ogrenciler']) > 0) {
        echo '<ul>';
        foreach ($_SESSION['ogrenciler'] as $ogrenci) {
            echo '<li>' . $ogrenci['ad'] . ' ' . $ogrenci['soyad'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Henüz öğrenci eklenmedi.';
    }
    ?>

</body>
</html>
