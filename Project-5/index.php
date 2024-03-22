<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Listesi</title>
</head>
<body>

    <?php
    // Veritabanı bağlantı bilgileri
    $host = '192.168.1.1';
    $username = 'root';
    $password = '1234';
    $database = 'test';

    // Veritabanına bağlan
    $mysqli = new mysqli($host, $username, $password, $database);

    // Bağlantı hatası kontrolü
    if ($mysqli->connect_error) {
        die('Veritabanı bağlantı hatası: ' . $mysqli->connect_error);
    }

    // SQL sorgusu
    $sql = 'SELECT LinkID, hrefText, contextText FROM LINKLER';

    // Sorguyu çalıştır
    $result = $mysqli->query($sql);

    // Sorgu sonuçlarını kontrol et
    if ($result->num_rows > 0) {
        // Sonuçları döngü ile al
        while ($row = $result->fetch_assoc()) {
            $linkID = $row['LinkID'];
            $hrefText = $row['hrefText'];
            $contextText = $row['contextText'];

            // Linkleri ekrana yazdır
            echo '<div>';
            echo '<a href="' . $hrefText . '">' . $contextText . '</a>';
            echo '</div>';
        }
    } else {
        echo 'Link bulunamadı.';
    }

    // Veritabanı bağlantısını kapat
    $mysqli->close();
    ?>

</body>
</html>
