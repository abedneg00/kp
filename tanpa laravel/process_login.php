<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'global.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch();
        
        if ($user) {
            // Login berhasil
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Redirect ke index.php
            header("Location: index.php");
            exit();
        } else {
            // Login gagal
            header("Location: login.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: login.php?error=2");
        exit();
    }
}
?>