<?php
require_once 'global.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi - Amin Elektronik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <h2>Transaksi Penjualan</h2>
        
        <!-- Form Tambah Transaksi -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Tambah Transaksi</h5>
                <form action="process_transaksi.php" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Produk:</label>
                                <select name="produk_id" class="form-control" required>
                                    <?php
                                    $stmt = $pdo->query("SELECT * FROM produk");
                                    while ($row = $stmt->fetch()) {
                                        echo "<option value='{$row['id']}'>{$row['nama']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Jumlah:</label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Total Harga:</label>
                                <input type="number" name="total_harga" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Metode Pembayaran:</label>
                                <select name="metode" class="form-control" required>
                                    <option value="tunai">Tunai</option>
                                    <option value="kredit">Kredit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Tabel Riwayat Transaksi -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Riwayat Transaksi</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("
                            SELECT 
                                p.waktu,
                                pr.nama as produk,
                                p.jumlah,
                                p.metode_pembayaran,
                                p.total_harga
                            FROM penjualan p
                            JOIN produk pr ON p.produk_id = pr.id
                            ORDER BY p.waktu DESC
                        ");
                        while ($row = $stmt->fetch()) {
                            echo "<tr>
                                <td>{$row['waktu']}</td>
                                <td>{$row['produk']}</td>
                                <td>{$row['jumlah']}</td>
                                <td>{$row['metode_pembayaran']}</td>
                                <td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>