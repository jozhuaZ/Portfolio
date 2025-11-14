<?php
// config
$dsn = 'mysql:host=localhost;dbname=portfolio;charset=utf8mb4';
$dbUser = 'root';
$dbPass = '';

$email = trim($_GET['email'] ?? '');
$password = $_GET['password'] ?? '';

if (!$email || !$password) {
    die('Email and password are required.');
}

// basic validation (add stronger checks as needed)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email.');
}

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // hash password
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // prepared statement to prevent SQL injection
    $stmt = $pdo->prepare('INSERT INTO admin (email, password) VALUES (:email, :password)');
    $stmt->execute([
        ':email' => $email,
        ':password' => $hashed,
    ]);

    $insertId = $pdo->lastInsertId();
    echo "Inserted successfully. ID: " . htmlspecialchars($insertId);
} catch (PDOException $e) {
    // handle duplicate email error or other DB errors
    if ($e->getCode() === '23000') {
        echo 'Email already exists.';
    } else {
        error_log($e->getMessage());
        echo 'Database error.';
    }
}
