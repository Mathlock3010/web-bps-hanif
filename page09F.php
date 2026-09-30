<?php
include 'dbconn.php';
try {
    $no = $_GET['no'];
    $namaFile = $_GET['sampul'];
    
    
    if (file_exists("sampul/" . $namaFile) && !empty($namaFile)) {
        unlink("sampul/" . $namaFile);
    }
    
    
    $sql = "DELETE FROM publikasi WHERE no='$no'";
    $pdo->query($sql);
    
    echo "<script>
        alert('Data Berhasil Dihapus');
        window.location.href = 'page09A.php';
    </script>";
    
    $pdo = NULL;
} catch (PDOException $e) {
    exit("PDO Error: " . $e->getMessage() . "<br>");
}
?>