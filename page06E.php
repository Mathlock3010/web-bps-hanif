<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" type="text/css" href="style04B.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kegiatan - Badan Pusat Statistik</title>
    
    <style>
        .galeri-container {
            width: 70%;
            margin: 0 auto; 
            border: 2px solid #ccc;
            padding: 10px;
            background-color: #fff;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .preview-box {
            position: relative;
            width: 100%;
            height: 420px;
            margin-bottom: 10px;
            overflow: hidden;
            border-radius: 8px;
        }

        .preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .preview-box .lihat-btn {
            position: absolute;
            right: 20px;
            bottom: 20px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            padding: 10px 18px;
            background-color: rgba(0, 92, 171, 0.9);
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            z-index: 2;
        }

        .preview-box:hover .lihat-btn {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px 14px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 50%;
        }

        .nav-btn:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .prev-btn {
            left: 10px;
        }

        .next-btn {
            right: 10px;
        }

        .thumbnail-box {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .thumbnail-box img {
            width: calc(33.33% - 6px);
            height: 120px;
            object-fit: cover;
            border: 2px solid transparent;
            cursor: pointer;
            transition: opacity 0.3s ease, border-color 0.3s ease;
        }

        .thumbnail-box img:hover {
            opacity: 0.7;
        }

        .thumbnail-box img.active {
            border-color: #005cab;
            opacity: 1;
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
        <a href="page09C.php">Tambah Publikasi</a>
        <a class="active" href="page06E.php">Galeri Kegiatan</a>
        <a href="page10A.php">Logout</a>
        </nav>
    </header>

    <main>
        <div class="galeri-container">
            
            <div class="preview-box">
                <button class="nav-btn prev-btn" type="button" aria-label="Gambar sebelumnya">&#10094;</button>
                <img id="gambarBesar" src="foto1.jpeg" alt="Preview Gambar">
                <a id="linkLihat" class="lihat-btn" href="foto1.jpeg" target="_blank" rel="noopener noreferrer">Lihat</a>
                <button class="nav-btn next-btn" type="button" aria-label="Gambar berikutnya">&#10095;</button>
            </div>

            <div class="thumbnail-box">
                <img src="foto1.jpeg" alt="Foto 1" class="active">
                <img src="foto2.jpg" alt="Foto 2">
                <img src="foto3.jpg" alt="Foto 3">
                <img src="foto4.jpg" alt="Foto 4">
                <img src="foto5.jpg" alt="Foto 5">
                <img src="foto6.jpeg" alt="Foto 6">
            </div>
            
        </div>
    </main>

    <footer>
        <p><strong>Copyright © 2026 BPS Pusat</strong></p>
        <p>Created by M. Hanif Indriawan <a href="mailto:ahmadhanifindriawan@gmail.com">(ahmadhanifindriawan@gmail.com)</a></p>
    </footer>

    <script>
        const preview = document.getElementById("gambarBesar");
        const thumbnails = document.querySelectorAll(".thumbnail-box img");
        const prevBtn = document.querySelector(".prev-btn");
        const nextBtn = document.querySelector(".next-btn");
        const linkLihat = document.getElementById("linkLihat");
        let indexSaatIni = 0;

        function tampilkanGambar(i) {
            indexSaatIni = (i + thumbnails.length) % thumbnails.length;
            preview.src = thumbnails[indexSaatIni].src;
            linkLihat.href = thumbnails[indexSaatIni].src;

            thumbnails.forEach((img, idx) => {
                img.classList.toggle("active", idx === indexSaatIni);
            });
        }

        thumbnails.forEach((img, idx) => {
            img.addEventListener("click", () => tampilkanGambar(idx));
        });

        prevBtn.addEventListener("click", () => tampilkanGambar(indexSaatIni - 1));
        nextBtn.addEventListener("click", () => tampilkanGambar(indexSaatIni + 1));

        setInterval(() => {
            tampilkanGambar(indexSaatIni + 1);
        }, 3000);
    </script>
</body>
</html>