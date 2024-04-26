<?php
// Mengambil data dari database untuk ditampilkan
require_once 'conn.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $kategori_id = $_POST["kategori_id"];
    $harga = $_POST["harga"];
    $stock = $_POST["stock"];
    
    tambahInventory($nama, $kategori_id, $harga, $stock);
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
        <h1>Warehouse Management</h1>
        
        <h2>Daftar Inventory Barang</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
            </tr>
            <?php
            $result = getInventory();
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['kategori'] . "</td>";
                echo "<td>" . $row['harga'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>" . formatDate($row['created_at']) . "</td>";
                echo "<td>" . formatDate($row['updated_at']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>

            
        <!-- Form untuk menambahkan data Barang Masuk -->
        <h2>Tambah Inventory</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nama">Nama:</label><br>
            <input type="text" id="nama" name="nama"><br><br>
            <label for="kategori_id">Kategori:</label><br>
            <select id="kategori_id" name="kategori_id">
                <option value="">Pilih Kategori Barang</option>
                <?php
                $result = getDataKategori();
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="harga">Harga:</label><br>
            <input type="text" id="harga" name="harga"><br><br>
            <label for="stock">Stock:</label><br>
            <input type="text" id="stock" name="stock"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
