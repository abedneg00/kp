<?php
require_once 'global.php'; 
session_start();

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Amin Elektronik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <h2>Dashboard</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Penjualan</h5>
                        <?php
                        $stmt = $pdo->query("SELECT SUM(total_harga) as total FROM penjualan");
                        $total = $stmt->fetch()['total'];
                        ?>
                        <!-- <h3>Rp <?php echo number_format($total, 0, ',', '.'); ?></h3> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <?php
                        $stmt = $pdo->query("SELECT COUNT(*) as total FROM produk");
                        $total = $stmt->fetch()['total'];
                        ?>
                        <h3><?php echo $total; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stok Menipis</h5>
                        <?php
                        $stmt = $pdo->query("SELECT COUNT(*) as total FROM produk WHERE stok < 5");
                        $total = $stmt->fetch()['total'];
                        ?>
                        <h3><?php echo $total; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Produk</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query("SELECT * FROM produk ORDER BY stok ASC LIMIT 5");
                                while ($row = $stmt->fetch()) {
                                    echo "<tr>
                                        <td>{$row['nama']}</td>
                                        <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                                        <td>{$row['stok']}</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>