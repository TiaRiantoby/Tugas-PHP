<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $todo_text = trim($_POST['todo_text']);
    $user_id = $_SESSION['user_id'];

    if (!empty($todo_text)) {
        $stmt = $conn->prepare("INSERT INTO todos (user_id, todo_text) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $todo_text);
        $stmt->execute();
    }
}

header('Location: todo.php');
exit;
