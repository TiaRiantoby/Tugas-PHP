<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        header("Location: login.php");
        exit;
    } else {
        $error = "Gagal mendaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <style>
        body {
            background-color: #ffe4ec;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .register-container {
            max-width: 400px;
            margin: 80px auto;
            background-color: #fff0f5;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #ec407a;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"], input[type="password"] {
            padding: 12px;
            border: 1px solid #ec407a;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            background-color: #ec407a;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #d81b60;
        }

        .link {
            text-align: center;
            margin-top: 10px;
        }

        .link a {
            color: #e91e63;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Daftar Akun</h2>

    <?php if (!empty($error)) : ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>

        <button type="submit">Submit</button>
    </form>


    <div class="link">
        Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
</div>

</body>
</html>
