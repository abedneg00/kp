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
    <title>Manajemen Produk - Amin Elektronik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <h2>Manajemen Produk</h2>
        
        <!-- Form Tambah Produk -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Tambah Produk Baru</h5>
                <form action="process_produk.php" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Nama Produk:</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Harga:</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Stok:</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Deskripsi:</label>
                                <textarea name="deskripsi" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        
        <!-- Tabel Produk -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Daftar Produk</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM produk ORDER BY nama");
                        while ($row = $stmt->fetch()) {
                            echo "<tr>
                                <td>{$row['nama']}</td>
                                <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                                <td>{$row['stok']}</td>
                                <td>{$row['deskripsi']}</td>
                                <td>
                                    <a href='edit_produk.php?id={$row['id']}' class='btn btn-sm btn-primary'>Edit</a>
                                </td>
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