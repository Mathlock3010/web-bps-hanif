<?php
require_once 'security.php';
requireLogin();
include 'dbconn.php';
try {
    $judul = $_POST['judul'] ?? '';
    $tanggal_rilis = $_POST['tanggal_rilis'] ?? '';

    $nomorBerikutnya = $pdo->query("SELECT COALESCE(MAX(no), 0) + 1 AS nomor_baru FROM publikasi")->fetchColumn();

    $namaFile = saveCoverUpload($_FILES['sampul'] ?? []);

    $sql = "INSERT INTO publikasi (no, judul, tanggal_rilis, sampul) VALUES (:no, :judul, :tanggal_rilis, :sampul)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'no' => $nomorBerikutnya,
        'judul' => $judul,
        'tanggal_rilis' => $tanggal_rilis,
        'sampul' => $namaFile
    ]);

    echo "<script>
        alert('Data Berhasil Ditambahkan');
        window.location.href = 'page09A.php';
    </script>";
    
    $pdo = NULL;
} catch (PDOException $e) {
    exit("PDO Error: " . $e->getMessage() . "<br>");
} catch (RuntimeException $e) {
    http_response_code(400);
    exit(htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}
?>