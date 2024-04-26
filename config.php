<?php

$title  = "Warehouse Management";

$styles = <<<EOD
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding-top: 50px;
    }

    .container {
        width: 100%;
        max-width: 1200px; /* or any other value */
        margin: 0 auto; /* centers the container */
        padding: 0 15px; /* optional: some padding on the sides */
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }

    .top-bar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #333;
        overflow: auto;
        white-space: nowrap;
        padding: 10px 0;
    }
    .top-bar a {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    .top-bar a:hover {
        background-color: #ddd;
        color: black;
    }
</style>

EOD;

$menu = <<<EOD
<div class="top-bar">
    <a href="/index.php">Home</a>
    <a href="/kategori.php">Kategori Barang</a>
    <a href="/inventory.php">Inventory</a>
    <a href="/masuk.php">Barang Masuk</a>
    <a href="/keluar.php">Barang Keluar</a>
</div>
EOD;
?>