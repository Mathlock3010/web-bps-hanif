<?php
require_once 'security.php';
requireLogin();
include 'dbconn.php';
try {
    $no = $_GET['no'] ?? '';
    $selectCover = $pdo->prepare("SELECT sampul FROM publikasi WHERE no = :no");
    $selectCover->execute(['no' => $no]);
    $namaFile = $selectCover->fetchColumn();

    if ($namaFile !== false) {
        $stmt = $pdo->prepare("DELETE FROM publikasi WHERE no = :no");
        $stmt->execute(['no' => $no]);
        removeCoverFile($namaFile);
    }
    
    echo "<script>
        alert('Data Berhasil Dihapus');
        window.location.href = 'page09A.php';
    </script>";
    
    $pdo = NULL;
} catch (PDOException $e) {
    exit("PDO Error: " . $e->getMessage() . "<br>");
}
?>