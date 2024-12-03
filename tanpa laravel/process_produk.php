<?php
require_once 'global.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $deskripsi = $_POST['deskripsi'];
        
        $stmt = $pdo->prepare("INSERT INTO produk (nama, harga, stok, deskripsi) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nama, $harga, $stok, $deskripsi]);
        
        header("Location: produk.php?success=1");
    } catch(PDOException $e) {
        header("Location: produk.php?error=1");
    }
}
?>