<?php
require_once 'security.php';
requireLogin();
include 'dbconn.php';

$no = $_GET['no'] ?? '';
$stmt = $pdo->prepare('SELECT no, judul, tanggal_rilis, sampul FROM publikasi WHERE no = :no');
$stmt->execute(['no' => $no]);
$publikasi = $stmt->fetch();

if (!$publikasi) {
    http_response_code(404);
    exit('Data publikasi tidak ditemukan.');
}

$escape = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" type="text/css" href="style04B.css">
    <meta charset="UTF-8">
    <title>Edit Publikasi - BPS</title>
    <style>
        label { display: inline-block; width: 110px; padding: 5px 0; }
    </style>
</head>
<body>
<main>
    <h2>Formulir Ubah Data Publikasi</h2>
    
    <form name="formEditPublikasi" action="page09E_action.php" method="post" enctype="multipart/form-data">
        <label for="no">Nomor:</label>
        <input type="number" id="no" name="no" value="<?= $escape($publikasi['no']); ?>" readonly style="background-color: #e9ecef; padding: 3px;">
        <br>

        <label for="judul">Judul:</label>
        <input type="text" id="judul" name="judul" value="<?= $escape($publikasi['judul']); ?>" style="padding: 3px;" required>
        <br>

        <label for="tanggal_rilis">Tanggal Rilis:</label>
        <input type="date" id="tanggal_rilis" name="tanggal_rilis" value="<?= $escape($publikasi['tanggal_rilis']); ?>" required>
        <br><br>

        <label for="sampul_lama">Sampul Lama: </label>
        <img src="sampul/<?= rawurlencode((string) $publikasi['sampul']); ?>" alt="No Image" width="70px">
        <br><br>

        <label for="sampul_baru">Sampul Baru:</label>
        <input type="file" id="sampul_baru" name="sampul_baru" style="padding: 3px;">
        <br><br>

        <input type="submit" value="Ubah Data" id="Submit">
    </form>
</main>
</body>
</html>