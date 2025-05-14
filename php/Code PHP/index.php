<?php
session_start();
include 'db.php';  // Menghubungkan ke database

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');  // Jika belum login, redirect ke halaman login
    exit;
}

// Ambil daftar tugas milik user yang sedang login
$user_id = $_SESSION['user_id'];
$todos = $conn->query("SELECT * FROM todos WHERE user_id = $user_id ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List: <?= htmlspecialchars($_SESSION['username']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>To-Do List: <?= htmlspecialchars($_SESSION['username']); ?></h2>
        <form action="tambah.php" method="POST">
            <input type="text" name="todo_text" placeholder="Tambahkan tugas..." required>
            <button type="submit">Tambah</button>
        </form>
        <ul>
            <?php while ($row = $todos->fetch_assoc()) : ?>
                <li class="<?= $row['is_done'] ? 'completed' : '' ?>">
                    <span><?= htmlspecialchars($row['todo_text']); ?></span>
                    <div class="actions">
                        <?php if (!$row['is_done']) : ?>
                            <a class="done" href="selesai.php?id=<?= $row['id'] ?>">Selesai</a>
                        <?php else : ?>
                            <span class="status">Selesai</span>
                        <?php endif; ?>
                        <a class="delete" href="hapus.php?id=<?= $row['id'] ?>">Hapus</a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
        <div style="text-align:center; margin-top:20px;">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
