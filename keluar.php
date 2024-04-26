<?php
// Mengambil data dari database untuk ditampilkan
require_once 'conn.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inventory_id = $_POST["inventory_id"];
    $jumlah = $_POST["jumlah"];
    $tanggal = $_POST["tanggal"];
    
    tambahBarangKeluar((int) $inventory_id, $jumlah, $tanggal);
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
        
        <h2>Daftar Barang Keluar</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
            </tr>
            <?php
            $result = getDataBarangKeluar();
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['jumlah'] . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "<td>" . formatDate($row['created_at']) . "</td>";
                echo "<td>" . formatDate($row['updated_at']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>

            
        <!-- Form untuk menambahkan data Barang Keluar -->
        <h2>Tambah Barang Keluar</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="nama">Inventory ID:</label><br>
            <select id="inventory_id" name="inventory_id">

                <option value="">Pilih Inventory Barang</option>
                <?php
                $inventorys = getInventory();
                while ($r = mysqli_fetch_assoc($inventorys)) {
                    echo "<option value='" . $r['id'] . "'>" . $r['nama'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="jumlah">Jumlah:</label><br>
            <input type="number" id="jumlah" name="jumlah"><br><br>
            <label for="tanggal">Tanggal:</label><br>
            <input type="date" id="tanggal" name="tanggal"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
