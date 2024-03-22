<?php
session_start();

// Sepetin başlangıcı
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Yeni ürün eklenirse
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = array(
        'name' => $_POST['product_name'],
        'quantity' => $_POST['quantity'],
        'price' => $_POST['price']
    );

    array_push($_SESSION['cart'], $product);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet Uygulaması - İlk Sayfa</title>
</head>
<body>

<h1>Ürün Ekle</h1>
<form action="index.php" method="post">
    Ürün Adı: <input type="text" name="product_name" required><br>
    Adet: <input type="number" name="quantity" required><br>
    Fiyat: <input type="number" name="price" step="0.01" required><br>
    <input type="submit" value="Sepete Ekle">
</form>

<a href="cart.php">Hesap</a>

</body>
</html>
