<?php
// koneksi.php - koneksi ke database MySQL/MariaDB menggunakan PDO
$host     = "localhost";
$nama_db  = "db_katalog";
$username = "root";
$password = "";          // sesuaikan dengan password MySQL di komputer masing-masing

$dsn = "mysql:host=" . $host . ";dbname=" . $nama_db . ";charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Koneksi gagal: " . htmlspecialchars($e->getMessage()));
}
