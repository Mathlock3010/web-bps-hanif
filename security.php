<?php
ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Lax'
    ]);
    session_start();
}

function requireLogin(): void
{
    if (empty($_SESSION['username'])) {
        header('Location: page10A.php');
        exit;
    }
}

function saveCoverUpload(array $file): string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK ||
        empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        throw new RuntimeException('Upload sampul gagal.');
    }

    $extension = strtolower(pathinfo($file['name'] ?? '', PATHINFO_EXTENSION));
    $mimeType = mime_content_type($file['tmp_name']);
    $allowedTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'webp' => 'image/webp'
    ];

    if (!isset($allowedTypes[$extension]) || $mimeType !== $allowedTypes[$extension]) {
        throw new RuntimeException('Sampul harus berupa file JPG, PNG, atau WEBP yang valid.');
    }

    $fileName = bin2hex(random_bytes(16)) . '.' . $extension;
    $destination = __DIR__ . '/sampul/' . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new RuntimeException('File sampul tidak dapat disimpan.');
    }

    return $fileName;
}

function removeCoverFile(?string $fileName): void
{
    if ($fileName === null || $fileName === '' || basename($fileName) !== $fileName) {
        return;
    }

    $path = __DIR__ . '/sampul/' . $fileName;
    if (is_file($path)) {
        unlink($path);
    }
}
