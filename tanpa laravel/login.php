<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Amin Elektronik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <?php 
                        if (isset($_GET['error'])) {
                            echo '<div class="alert alert-danger">';
                            switch($_GET['error']) {
                                case '1':
                                    echo "Username atau password salah!";
                                    break;
                                case '2':
                                    echo "Terjadi kesalahan sistem!";
                                    break;
                                default:
                                    echo "Terjadi kesalahan!";
                            }
                            echo '</div>';
                        }
                        ?>
                        <form action="process_login.php" method="POST">
                            <div class="mb-3">
                                <label>Username:</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>