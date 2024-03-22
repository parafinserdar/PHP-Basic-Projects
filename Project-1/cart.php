<?php
session_start();

// Sepetin toplam fiyatını hesapla
$totalPrice = 0;
foreach ($_SESSION['cart'] as $product) {
    $totalPrice += $product['quantity'] * $product['price'];
}

// Sepetin temizlenmesi (tamamla butonu)
if (isset($_POST['complete'])) {
    $_SESSION['cart'] = array();
    header('Location: index.php');
    exit();
}

if(isset($_POST['back'])){
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet Uygulaması - İkinci Sayfa</title>
</head>
<body>

<h1>Sepet İçeriği</h1>

<ul>
    <?php foreach ($_SESSION['cart'] as $product): ?>
        <li><?php echo $product['name']; ?> - <?php echo $product['quantity']; ?> adet - <?php echo $product['price']; ?> TL</li>
    <?php endforeach; ?>
</ul>

<p>Toplam Fiyat: <?php echo $totalPrice; ?> TL</p>

<form action="cart.php" method="post">
    <input type="submit" name="back" value="Geri Dön">
    <input type="submit" name="complete" value="Tamamla">
</form>

</body>
</html>
