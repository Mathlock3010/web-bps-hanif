<?php
include 'dbconn.php';

$nomorBerikutnya = $pdo->query("SELECT COALESCE(MAX(no), 0) + 1 AS nomor_baru FROM publikasi")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <link rel="stylesheet" type="text/css" href="style04B.css">  
        <meta charset="UTF-8">
        <title>Form Publikasi Badan Pusat Statistik</title>
        <style>
            label {
                display: inline-block;
                width: 110px;          
                padding: 5px 0;
            }

            form#FormPublikasi {
                width: 700px;
                margin: 20px auto;
                padding: 25px 20px;
                background: #f2f2f2;
                border: 1px solid #ccc;
                border-radius: 8px;
                text-align: center;
            }

            form#FormPublikasi label,
            form#FormPublikasi input {
                display: inline-block;
                vertical-align: middle;
            }

            form#FormPublikasi label {
                width: 150px;
                text-align: left;
            }

            form#FormPublikasi input[type="text"],
            form#FormPublikasi input[type="number"],
            form#FormPublikasi input[type="date"],
            form#FormPublikasi input[type="file"] {
                width: 420px;
                padding: 8px 10px;
                box-sizing: border-box;
            }

            hr {
                border: 0;
                border-top: 1px solid #000;
                margin: 20px 0 10px 0;
            }

            address {
                font-style: italic;
            }
        </style>
    </head>

    <body>
    <header>
        
        <img src="logoBPS.png" alt="Logo Web" width="80" height="80">
        
        <div class="judulweb">BADAN PUSAT STATISTIK</div>
        <nav>
        <a href="page09B.php">Home</a>
        <a href="page09A.php">Daftar Publikasi</a>
        <a class="active" href="page09C.php">Tambah Publikasi</a>
        <a href="page06E.php">Galeri Kegiatan</a>
        <a href="page10A.php">Logout</a>
        </nav>
    </header>

    <main>
        <h2 style="text-align: center;">Form Menambahkan Publikasi Baru</h2>
        
        <form id="FormPublikasi" name="formTambahPublikasi" action="page09C_action.php" method="post" enctype="multipart/form-data">
            <label for="Nomor">Nomor:</label>
            <input type="number" id="Nomor" name="no" value="<?= htmlspecialchars($nomorBerikutnya, ENT_QUOTES, 'UTF-8'); ?>" readonly required>
            <br><br>

            <label for="Judul">Judul:</label>
            <input type="text" id="Judul" name="judul" required>
            <br><br>

            <label for="tanggal_rilis">Tanggal Rilis:</label>
            <input type="date" id="tanggal_rilis" name="tanggal_rilis" required>
            <br><br>

            <label for="Sampul">Sampul:</label>
            <input type="file" id="Sampul" name="sampul" required>
            <br><br>

            <input type="submit" value="Tambah Data" id="Submit">
        </form>
    </main>
    <footer>
        <p><strong>Copyright © 2026 BPS Pusat</strong></p>
        <p>Created by M. Hanif Indriawan <a href="mailto:ahmadhanifindriawan@gmail.com">(ahmadhanifindriawan@gmail.com)</a></p>
    </footer>
    </body>
</html>