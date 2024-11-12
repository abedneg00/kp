<?php
require_once 'global.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $produk_id = $_POST['produk_id'];
        $jumlah = $_POST['jumlah'];
        $metode = $_POST['metode'];
        
        // Ambil harga produk
        $stmt = $pdo->prepare("SELECT harga FROM produk WHERE id = ?");
        $stmt->execute([$produk_id]);
        $harga = $stmt->fetch()['harga'];
        
        // Hitung total
        $total = $harga * $jumlah;
        
        // Insert transaksi
        $stmt = $pdo->prepare("INSERT INTO penjualan (produk_id, jumlah, metode_pembayaran, total_harga) VALUES (?, ?, ?, ?)");
        $stmt->execute([$produk_id, $jumlah, $metode, $total]);
        
        // Update stok
        $stmt = $pdo->prepare("UPDATE produk SET stok = stok - ? WHERE id = ?");
        $stmt->execute([$jumlah, $produk_id]);
        
        header("Location: transaksi.php?success=1");
    } catch(PDOException $e) {
        header("Location: transaksi.php?error=1");
    }
}
?>