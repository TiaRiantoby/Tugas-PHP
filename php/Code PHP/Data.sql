-- Membuat database (jika belum ada)
CREATE DATABASE IF NOT EXISTS todolist_db;
USE todolist_db;

-- Tabel users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert user: tia_riantoby / 235314005
INSERT INTO users (username, password) VALUES (
    'tia_riantoby',
    '$2y$10$INw5U47A.CGjcLrlKlCpw.qZBWS9sxAPskmgdCRSipDFxOlhqkfiu'
);

-- Tabel todos
CREATE TABLE todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    todo_text TEXT NOT NULL,
    is_done BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
