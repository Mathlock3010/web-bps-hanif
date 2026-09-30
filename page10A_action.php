<?php
require_once 'security.php';
include 'dbconn.php';

try {
    $action = $_POST['action'] ?? 'login';
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        exit('Username dan password wajib diisi.');
    }

    if ($action === 'register') {
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (strlen($password) < 6) {
            exit('Password minimal 6 karakter.');
        }

        if ($password !== $confirmPassword) {
            exit('Konfirmasi password tidak cocok.');
        }

        $checkUser = $pdo->prepare("SELECT 1 FROM user WHERE username = :username LIMIT 1");
        $checkUser->execute([':username' => $username]);

        if ($checkUser->fetchColumn()) {
            exit('Username sudah terdaftar. Silakan gunakan username lain.');
        }

        $insertUser = $pdo->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
        $insertUser->execute([
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        header('Location: page10A.php?registered=1');
        exit();
    }

    $selectUser = $pdo->prepare("SELECT username, password FROM user WHERE username = :username LIMIT 1");
    $selectUser->execute([':username' => $username]);
    $user = $selectUser->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['username'] = $user['username'];
        header("Location: page09B.php");
        exit();
    }

    if (!$user) {
        header('Location: page10A.php?error=unregistered');
        exit();
    }

    header('Location: page10A.php?error=login');
    exit();
} catch(PDOException $e) {
    echo "Proses akun gagal: ".htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
?>