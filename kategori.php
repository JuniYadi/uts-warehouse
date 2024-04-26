<?php
// Mengambil data dari database untuk ditampilkan
require_once 'conn.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    
    tambahKategori($nama);
    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
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
        
        <h2>Daftar Kategori Barang</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Dibuat</th>
            </tr>
            <?php
            $result = getDataKategori();
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . formatDate($row['created_at']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>

            
        <!-- Form untuk menambahkan data Barang Masuk -->
        <h2>Tambah Kategori</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nama">Nama Kategori:</label><br>
            <input type="text" id="nama" name="nama"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
