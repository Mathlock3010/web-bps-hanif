<?php
include 'dbconn.php';

$kataKunci = trim($_GET['q'] ?? '');

if ($kataKunci !== '') {
    $result = $pdo->prepare("SELECT * FROM publikasi WHERE judul LIKE :kata_kunci ORDER BY no ASC");
    $result->execute(['kata_kunci' => '%' . $kataKunci . '%']);
} else {
    $result = $pdo->query("SELECT * FROM publikasi ORDER BY no ASC");
}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <link rel="stylesheet" type="text/css" href="style04B.css">
        <meta charset="UTF-8">
        <title>Publikasi Badan Pusat Statistik</title>
        <style>
            hr {
                border: 0;
                border-top: 1px solid #000;
                margin: 20px 0 10px 0;
            }

            address {
                font-style: italic;
            }

            .aksi-ikon {
                font-size: 20px;
                text-decoration: none;
                margin: 0 5px;
            }

            .aksi-ikon.edit {
                color: #044ebb;
            }

            .aksi-ikon.hapus {
                color: #c62828;
            }

            .page-title {
                text-align: center;
                margin-bottom: 24px;
            }

            .search-panel {
                max-width: 720px;
                margin: 0 auto 24px;
                padding: 20px 24px;
                background: #f7faff;
                border: 1px solid #d7e2f6;
                border-radius: 12px;
                box-shadow: 0 5px 16px rgba(4, 78, 187, 0.08);
            }

            .search-label {
                display: block;
                margin-bottom: 8px;
                color: #1e3150;
                font-weight: bold;
            }

            .search-input {
                width: 100%;
                padding: 12px 14px;
                border: 1px solid #b9c9e2;
                border-radius: 8px;
                color: #24344d;
                font-size: 15px;
                outline: none;
                transition: border-color 0.2s, box-shadow 0.2s;
            }

            .search-input:focus {
                border-color: #044ebb;
                box-shadow: 0 0 0 3px rgba(4, 78, 187, 0.14);
            }

            .suggestion-line {
                margin-top: 12px;
                color: #52627a;
                font-size: 14px;
            }

            #txtHint {
                color: #044ebb;
                font-weight: bold;
            }

            .table-wrap {
                overflow-x: auto;
                border: 1px solid #d7e2f6;
                border-radius: 10px;
                box-shadow: 0 5px 16px rgba(4, 78, 187, 0.06);
            }

            #tabelPublikasi {
                min-width: 720px;
                margin-bottom: 0;
            }

            #tabelPublikasi th {
                white-space: nowrap;
            }
        </style>
    </head>

    <body>
    <header>
        
        <img src="logoBPS.png" alt="Logo Web" width="80" height="80">
        
        <div class="judulweb">BADAN PUSAT STATISTIK</div>
        <nav>
        <a href="page09B.php">Home</a>
        <a class="active" href="page09A.php">Daftar Publikasi</a>
        <a href="page09C.php">Tambah Publikasi</a>
        <a href="page06E.php">Galeri Kegiatan</a>
        <a href="page10A.php">Logout</a>
        </nav>
    </header>
    <main>  
        <h2 class="page-title">Daftar Publikasi BPS Pusat</h2>
        <form class="search-panel" action="" onsubmit="return false;">
            <label class="search-label" for="txt1">Cari Judul Publikasi</label>
            <input class="search-input" type="text" id="txt1" placeholder="Ketik judul publikasi..." autocomplete="off" onkeyup="showHint(this.value)">
            <p class="suggestion-line">Suggestion: <span id="txtHint" role="status" aria-live="polite"></span></p>
        </form>

    <div class="table-wrap">
    <table id="tabelPublikasi">
        <tr id="Header">
            <th>No</th>
            <th>Judul</th>
            <th>Tanggal Rilis</th>
            <th>Sampul</th>
            <th>Aksi</th>
        </tr>
        <?php
            $jumlahHasil = 0;
            foreach ($result as $row) {
                $jumlahHasil++;
                echo "<tr>";
                echo "<td>". $row["no"]. "</td>";
                echo "<td>". $row["judul"]. "</td>";
                echo "<td>". $row["tanggal_rilis"]. "</td>";
                echo "<td><img src='sampul/". $row["sampul"]. "' alt='No Image' width='70px'></td>";
                // Menambahkan tombol edit dan hapus
                echo "<td>
                    <a class='aksi-ikon edit' href='page09E.php?no=". $row["no"]. "&judul=". urlencode($row["judul"]). "&tanggal_rilis=". $row["tanggal_rilis"]. "&sampul=". $row["sampul"]. "' title='Edit publikasi' aria-label='Edit publikasi'>&#9998;</a>
                    <a class='aksi-ikon hapus' href='page09F.php?no=". $row["no"]. "&sampul=". $row["sampul"]. "' title='Hapus publikasi' aria-label='Hapus publikasi' onclick=\"return confirm('Yakin ingin menghapus?');\">&#128465;</a>
                </td>";
                echo "</tr>";
            }
            if ($jumlahHasil === 0) {
                echo "<tr><td colspan='5'>Tidak ada publikasi yang sesuai dengan pencarian.</td></tr>";
            }
        ?>
    </table>
    </div>
    </main>
    <footer>
        <p><strong>Copyright © 2026 BPS Pusat</strong></p>
        <p>Created by M. Hanif Indriawan <a href="mailto:ahmadhanifindriawan@gmail.com">(ahmadhanifindriawan@gmail.com)</a></p>
    </footer>
    <script src="page11A_suggestion.js"></script>   
    </body>
</html>

