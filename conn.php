<?php
$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "warehouse";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function formatDate($date) {
    return date("d/M/Y H:i:s", strtotime($date));
}

function getDataKategori() {
    global $conn;

    $query = "SELECT * FROM Kategori";
    $result = mysqli_query($conn, $query);
    return $result;
}

function tambahKategori($nama) {
    global $conn;
    
    $query = "INSERT INTO Kategori (nama) VALUES ('$nama')";
    mysqli_query($conn, $query);
}

function getDataBarangMasuk() {
    global $conn;
    
    $query = <<<EOD
    SELECT
        BarangMasuk.id,
        Inventory.nama,
        BarangMasuk.jumlah,
        BarangMasuk.tanggal,
        BarangMasuk.created_at,
        BarangMasuk.updated_at
    FROM BarangMasuk
    LEFT JOIN Inventory
        ON BarangMasuk.inventory_id = Inventory.id
EOD;
    $result = mysqli_query($conn, $query);
    return $result;
}

function tambahBarangMasuk($inventory_id, $jumlah, $tanggal) {
    global $conn;

    $query = "INSERT INTO BarangMasuk (inventory_id, jumlah, tanggal) VALUES ('$inventory_id', '$jumlah', '$tanggal')";
    mysqli_query($conn, $query);

    // update inventory stock after barang masuk
    updateInventoryStock($inventory_id, $jumlah);
}

function getDataBarangKeluar() {
    global $conn;
    
    $query = <<<EOD
    SELECT
        Inventory.nama,
        BarangKeluar.id,
        BarangKeluar.jumlah,
        BarangKeluar.tanggal,
        BarangKeluar.created_at,
        BarangKeluar.updated_at
    FROM BarangKeluar
    LEFT JOIN Inventory
        ON BarangKeluar.inventory_id = Inventory.id
EOD;
    $result = mysqli_query($conn, $query);
    return $result;
}

function tambahBarangKeluar($inventory_id, $jumlah, $tanggal) {
    global $conn;

    $query = "INSERT INTO BarangKeluar (inventory_id, jumlah, tanggal) VALUES ('$inventory_id', '$jumlah', '$tanggal')";
    mysqli_query($conn, $query);

    // update inventory stock after barang masuk
    $jumlahNegative = $jumlah * -1;
    updateInventoryStock($inventory_id, $jumlahNegative);
}

function getInventory() {
    global $conn;
    
    $query = <<<EOD
    SELECT
        Inventory.id,
        Inventory.nama,
        Kategori.nama as kategori,
        Inventory.harga,
        Inventory.stock,
        Inventory.created_at,
        Inventory.updated_at
    FROM Inventory
    LEFT JOIN Kategori
        ON Inventory.kategori_id = Kategori.id
EOD;
    $result = mysqli_query($conn, $query);
    return $result;
}

function getInventoryById($id) {
    global $conn;
    
    $query = "SELECT * FROM Inventory WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function tambahInventory($nama, $kategori_id, $harga, $stock) {
    global $conn;
    
    $query = "INSERT INTO Inventory (nama, kategori_id, harga, stock) VALUES ('$nama', '$kategori_id', '$harga', '$stock')";
    mysqli_query($conn, $query);
}

function updateInventoryStock($id, $stock) {
    global $conn;
    
    // tambahkan stock ke inventory yang sudah ada
    $data = getInventoryById($id);
    $newStock = $data['stock'] + $stock;

    $query = "UPDATE Inventory SET stock = '$newStock' WHERE id = '$id'";
    mysqli_query($conn, $query);
}

function getTotalBarangMasuk() {
    global $conn;
    
    $query = "SELECT SUM(jumlah) as total FROM BarangMasuk";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}

function getTotalBarangKeluar() {
    global $conn;
    
    $query = "SELECT SUM(jumlah) as total FROM BarangKeluar";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}

function getTotalInventory() {
    global $conn;
    
    $query = "SELECT SUM(stock) as total FROM Inventory";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}
?>