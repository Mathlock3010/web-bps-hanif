<?php
require_once 'security.php';
requireLogin();
include 'dbconn.php';
try {
    $no = $_POST['no'] ?? '';
    $judul = $_POST['judul'] ?? '';
    $tanggal_rilis = $_POST['tanggal_rilis'] ?? '';
    $selectCover = $pdo->prepare("SELECT sampul FROM publikasi WHERE no = :no");
    $selectCover->execute(['no' => $no]);
    $sampulLama = $selectCover->fetchColumn();

    if ($sampulLama === false) {
        exit('Data publikasi tidak ditemukan.');
    }
    
    $upload = $_FILES['sampul_baru'] ?? null;
    if ($upload !== null && $upload['error'] !== UPLOAD_ERR_NO_FILE) {
        $namaFile = saveCoverUpload($upload);
        $sql = "UPDATE publikasi SET judul = :judul, tanggal_rilis = :tanggal_rilis, sampul = :sampul WHERE no = :no";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'judul' => $judul,
            'tanggal_rilis' => $tanggal_rilis,
            'sampul' => $namaFile,
            'no' => $no
        ]);
        removeCoverFile($sampulLama);
    } else {
        $sql = "UPDATE publikasi SET judul = :judul, tanggal_rilis = :tanggal_rilis WHERE no = :no";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'judul' => $judul,
            'tanggal_rilis' => $tanggal_rilis,
            'no' => $no
        ]);
    }
    
    echo "<script>
        alert('Data Berhasil Diubah');
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