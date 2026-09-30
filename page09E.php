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
        <input type="number" id="no" name="no" value="<?= $_GET['no']; ?>" readonly style="background-color: #e9ecef; padding: 3px;">
        <br>

        <label for="judul">Judul:</label>
        <input type="text" id="judul" name="judul" value="<?= $_GET['judul']; ?>" style="padding: 3px;" required>
        <br>

        <label for="tanggal_rilis">Tanggal Rilis:</label>
        <input type="date" id="tanggal_rilis" name="tanggal_rilis" value="<?= $_GET['tanggal_rilis']; ?>" required>
        <br><br>

        <label for="sampul_lama">Sampul Lama: </label>
        <img src="sampul/<?= $_GET['sampul']; ?>" alt="No Image" width="70px">
        <input type="hidden" name="sampul_lama_nama" value="<?= $_GET['sampul']; ?>">
        <br><br>

        <label for="sampul_baru">Sampul Baru:</label>
        <input type="file" id="sampul_baru" name="sampul_baru" style="padding: 3px;">
        <br><br>

        <input type="submit" value="Ubah Data" id="Submit">
    </form>
</main>
</body>
</html>