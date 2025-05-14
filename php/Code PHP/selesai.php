<?php
session_start();
include 'db.php';  // Pastikan ini menghubungkan ke database

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');  // Jika belum login, redirect ke halaman login
    exit;
}

// Cek apakah ada parameter 'id' di URL
if (isset($_GET['id'])) {
    $todo_id = $_GET['id'];  // Ambil ID tugas dari URL
    $user_id = $_SESSION['user_id'];  // Ambil ID user dari sesi login

    // Update status tugas menjadi selesai (is_done = 1)
    $query = "UPDATE todos SET is_done = 1 WHERE id = $todo_id AND user_id = $user_id";
    if ($conn->query($query)) {
        // Redirect ke halaman utama setelah berhasil
        header('Location: todo.php');
        exit;
    } else {
        echo "Gagal memperbarui status tugas.";
    }
} else {
    echo "ID tugas tidak ditemukan.";
}
?>
