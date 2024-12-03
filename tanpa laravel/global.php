

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $host = 'localhost';
    $dbname = 'amin_elektronik'; // Ganti dengan nama database Anda
    $username = 'root'; // Ganti dengan username database Anda
    $password = ''; // Ganti dengan password database Anda
    
    echo "Trying to connect to database...<br>";
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Database connection successful!<br>";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "<br>";
    die();
}
?>