<?php
include 'dbconn.php';
try {
    $no = $_POST['no'];
    $judul = $_POST['judul'];
    $tanggal_rilis = $_POST['tanggal_rilis'];
    
    // Cek apakah ada file sampul baru yang diunggah
    if (isset($_FILES['sampul_baru']) && $_FILES['sampul_baru']['error'] === 0) {
        $namaFile = $_FILES['sampul_baru']['name'];
        $lokasiSementara = $_FILES['sampul_baru']['tmp_name'];
        $dirUpload = "sampul/";
        
        move_uploaded_file($lokasiSementara, $dirUpload.$namaFile);
        
        // Hapus sampul lama dari direktori agar tidak menumpuk
        $sampulLama = $_POST['sampul_lama_nama'];
        if(file_exists("sampul/" . $sampulLama) && $sampulLama != $namaFile) {
            unlink("sampul/" . $sampulLama);
        }

        $sql = "UPDATE publikasi SET judul='$judul', tanggal_rilis='$tanggal_rilis', sampul='$namaFile' WHERE no='$no'";
    } else {
        $sql = "UPDATE publikasi SET judul='$judul', tanggal_rilis='$tanggal_rilis' WHERE no='$no'";
    }
    
    $pdo->query($sql);
    
    echo "<script>
        alert('Data Berhasil Diubah');
        window.location.href = 'page09A.php';
    </script>";
    
    $pdo = NULL;
} catch (PDOException $e) {
    exit("PDO Error: " . $e->getMessage() . "<br>");
}
?>