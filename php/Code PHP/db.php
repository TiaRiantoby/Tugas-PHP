<?php
$host = 'localhost';
$db = 'todolist_db';
$user = 'root';
$pass = ''; // ganti sesuai config XAMPP atau server Anda

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
