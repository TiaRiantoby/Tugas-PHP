<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$todos = $conn->query("SELECT * FROM todos WHERE user_id = $user_id ORDER BY id DESC");

$nama_lengkap = "Lusia Hingi Bolen";
$nim = "235314005";
$foto = "fp.jpg";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>To-Do List: <?= htmlspecialchars($_SESSION['username']); ?></title>
    <link rel="stylesheet" href="style.css?v=6">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #ffe4ec;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff0f5;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        header {
            text-align: center;
            background-color: #f8bbd0;
            padding: 20px;
            border-bottom: 2px solid #ec407a;
        }

        header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 3px solid #ec407a;
        }

        header .info {
            font-size: 16px;
            color: #444;
            margin-bottom: 5px;
        }

        .todo-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .todo-form input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ec407a;
            border-radius: 8px;
        }

        .todo-form button {
            background-color: #ec407a;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .todo-form button:hover {
            background-color: #d81b60;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ec407a;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .completed {
            text-decoration: line-through;
            color: gray;
        }

        .actions a, .actions span.status {
            margin-left: 10px;
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .actions a.done {
            background-color: #4caf50;
            color: white;
        }

        .actions a.delete {
            background-color: #f44336;
            color: white;
        }

        .status {
            background-color: #9e9e9e;
            color: white;
        }

        .link-button {
            display: inline-block;
            background-color: #e91e63;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 20px;
        }

        .link-button:hover {
            background-color: #d81b60;
        }

        .title {
            text-align: center;
            color: #ec407a;
            font-size: 18px;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<header>
  <?php if ($_SESSION['username'] === 'admin'): ?>
    <img src="fp.jpg" alt="Profile Picture">
    <div class="info">235314005</div>
    <div class="info">Lusia Hingi Bolen</div>
  <?php else: ?>
    <h2><?= htmlspecialchars($_SESSION['username']); ?></h2>
  <?php endif; ?>
</header>


    <div class="container">
        <h2 class="title">Daftar Tugas</h2>

        <!-- ✅ FORM TO-DO -->
        <form class="todo-form" action="tambah.php" method="POST">
            <input type="text" name="todo_text" placeholder="<Teks to do>" required>
            <button type="submit">Tambah</button>
        </form>

        <!-- ✅ LIST TUGAS -->
        <ul>
            <?php while ($row = $todos->fetch_assoc()) : ?>
                <li>
                    <span class="<?= $row['is_done'] ? 'completed' : '' ?>">
                        <?= htmlspecialchars($row['todo_text']); ?>
                    </span>
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

        <!-- ✅ LOGOUT -->
        <div style="text-align:center;">
            <a href="logout.php" class="link-button">Logout</a>
        </div>
    </div>

</body>
</html>
