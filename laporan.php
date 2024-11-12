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
    <title>Laporan - Amin Elektronik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <h2>Laporan Penjualan</h2>
        
        <!-- Filter -->
        <div class="card mt-4">
            <div class="card-body">
                <form method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Dari Tanggal:</label>
                                <input type="date" name="start_date" class="form-control" value="<?php echo $_GET['start_date'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Sampai Tanggal:</label>
                                <input type="date" name="end_date" class="form-control" value="<?php echo $_GET['end_date'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Produk:</label>
                                <select name="produk_id" class="form-control">
                                    <option value="">Semua Produk</option>
                                    <?php
                                    $stmt = $pdo->query("SELECT * FROM produk");
                                    while ($row = $stmt->fetch()) {
                                        $selected = ($_GET['produk_id'] ?? '') == $row['id'] ? 'selected' : '';
                                        echo "<option value='{$row['id']}' $selected>{$row['nama']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label>Metode Pembayaran:</label>
                                <select name="metode" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="tunai" <?php echo ($_GET['metode'] ?? '') == 'tunai' ? 'selected' : ''; ?>>Tunai</option>
                                    <option value="kredit" <?php echo ($_GET['metode'] ?? '') == 'kredit' ? 'selected' : ''; ?>>Kredit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
        
        <!-- Laporan Penjualan -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Laporan Penjualan</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $where = [];
                        $params = [];
                        
                        if (!empty($_GET['start_date'])) {
                            $where[] = "p.waktu >= ?";
                            $params[] = $_GET['start_date'];
                        }
                        
                        if (!empty($_GET['end_date'])) {
                            $where[] = "p.waktu <= ?";
                            $params[] = $_GET['end_date'];
                        }
                        
                        if (!empty($_GET['produk_id'])) {
                            $where[] = "p.produk_id = ?";
                            $params[] = $_GET['produk_id'];
                        }
                        
                        if (!empty($_GET['metode'])) {
                            $where[] = "p.metode_pembayaran = ?";
                            $params[] = $_GET['metode'];
                        }
                        
                        $whereClause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";
                        
                        $sql = "
                            SELECT 
                                p.id,
                                p.waktu,
                                pr.nama as produk,
                                p.jumlah,
                                p.metode_pembayaran,
                                p.total_harga
            FROM penjualan p
            JOIN produk pr ON p.produk_id = pr.id
            $whereClause
            ORDER BY p.waktu DESC
        ";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        while ($row = $stmt->fetch()) {
            echo "<tr>
                <td>{$row['waktu']}</td>
                <td>{$row['produk']}</td>
                <td>{$row['jumlah']}</td>
                <td>{$row['metode_pembayaran']}</td>
                <td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>
                <td>
                    <a href='edit_transaksi.php?id={$row['id']}' class='btn btn-sm btn-primary'>Edit</a>
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
