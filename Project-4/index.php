<?php
$servername = "192.168.1.100";
$username = "root";
$password = "123";
$dbname = "Test";

// Bağlantı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// GET parametresi üzerinden alınan SQL sorgusunu kullan
if(isset($_GET['sql'])) {
    $sql = $_GET['sql'];

    // Parametreleştirilmiş sorgu kullanımı
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    // Sorgu sonuçlarını HTML tablosu olarak göster
    if ($result->num_rows > 0) {
        echo "<table border='1'><tr>";
        while($fieldinfo = $result->fetch_field()) {
            echo "<th>{$fieldinfo->name}</th>";
        }
        echo "</tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach($row as $value) {
                echo "<td>{$value}</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Sorgu sonuç döndürmedi.";
    }

    // Bağlantıyı kapat
    $stmt->close();
}

// Bağlantıyı kapat
$conn->close();
?>
