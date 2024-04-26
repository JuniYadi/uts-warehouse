<?php

require_once 'conn.php';
require_once 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <?php echo $styles; ?>
</head>
<body>

<?php echo $menu; ?>

<div class="container">
    <h1><?php echo $title; ?></h1>

    <div>
        <h2>Total Inventory Barang</h2>
        <p><?php echo getTotalInventory(); ?></p>

        <h2>Total Barang Masuk</h2>
        <p><?php echo getTotalBarangMasuk(); ?></p>

        <h2>Total Barang Keluar</h2>
        <p><?php echo getTotalBarangKeluar(); ?></p>
    </div>


    
</div>
    
</body>
</html>