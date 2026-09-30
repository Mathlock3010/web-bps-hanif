<?php
include 'dbconn.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" type="text/css" href="style04B.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Badan Pusat Statistik</title>
    <style>
        .home-wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .card h3 {
            color: #044ebb;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .clock {
            font-size: 36px;
            font-weight: bold;
            color: #1d1d1d;
            margin-bottom: 10px;
        }

        .date-text {
            font-size: 16px;
            color: #555;
        }

        .weather-temp {
            font-size: 40px;
            font-weight: bold;
            color: #044ebb;
        }

        .weather-desc {
            margin-top: 8px;
            font-size: 16px;
            color: #444;
        }

        .stat-number {
            font-size: 52px;
            font-weight: bold;
            color: #044ebb;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        .recent-list {
            margin-top: 30px;
        }

        .recent-list h2 {
            margin-bottom: 15px;
            color: #333;
        }

        .publikasi-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(180px, 1fr));
            gap: 20px;
        }

        .publikasi-item {
            border: 1px solid #ddd;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .publikasi-item img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            display: block;
        }

        .publikasi-item .text {
            padding: 12px;
        }

        .publikasi-item h4 {
            font-size: 16px;
            margin-bottom: 8px;
            color: #333;
        }

        .publikasi-item p {
            font-size: 13px;
            color: #666;
        }

        @media (max-width: 900px) {
            .home-wrapper,
            .publikasi-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .home-wrapper,
            .publikasi-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="logoBPS.png" alt="Logo Web" width="80" height="80">
        <div class="judulweb">BADAN PUSAT STATISTIK</div>
        <nav>
            <a class="active" href="page09B.php">Home</a>
            <a href="page09A.php">Daftar Publikasi</a>
            <a href="page09C.php">Tambah Publikasi</a>
            <a href="page06E.php">Galeri Kegiatan</a>
            <a href="page10A.php">Logout</a>
        </nav>
    </header>

    <main>
        <div class="home-wrapper">
            <div class="card">
                <h3>Jam</h3>
                <div id="jam" class="clock">--:--:--</div>
                <div id="tanggal" class="date-text">Memuat tanggal...</div>
            </div>

            <div class="card">
                <h3>Cuaca</h3>
                <div class="weather-temp"><span id="suhu">--</span>&deg;C</div>
                <div id="cuaca" class="weather-desc">Memuat cuaca...</div>
            </div>

            <div class="card">
                <h3>Statistik Publikasi</h3>
                <div class="stat-number">
                    <?php
                        $total = $pdo->query("SELECT COUNT(*) AS total FROM publikasi")->fetch();
                        echo $total['total'];
                    ?>
                </div>
                <div class="stat-label">Total publikasi</div>
                <?php
                    $terbaru = $pdo->query("SELECT judul, tanggal_rilis FROM publikasi ORDER BY tanggal_rilis DESC LIMIT 1")->fetch();
                    if ($terbaru) {
                        echo "<p style='margin-top: 12px; color: #444;'><strong>Terbaru:</strong> " . $terbaru['judul'] . "<br>" . $terbaru['tanggal_rilis'] . "</p>";
                    } else {
                        echo "<p style='margin-top: 12px; color: #444;'>Belum ada data publikasi.</p>";
                    }
                ?>
            </div>
        </div>

        <div class="recent-list">
            <h2>Publikasi Terbaru</h2>
            <div class="publikasi-grid">
                <?php
                    $result = $pdo->query("SELECT * FROM publikasi ORDER BY no DESC LIMIT 4");
                    while ($row = $result->fetch()) {
                        echo "
                            <div class='publikasi-item'>
                                <img src='sampul/" . htmlspecialchars($row['sampul'], ENT_QUOTES, 'UTF-8') . "' alt='Sampul'>
                                <div class='text'>
                                    <h4>" . htmlspecialchars($row['judul'], ENT_QUOTES, 'UTF-8') . "</h4>
                                    <p>" . htmlspecialchars($row['tanggal_rilis'], ENT_QUOTES, 'UTF-8') . "</p>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </main>

    <footer>
        <p><strong>Copyright © 2026 BPS Pusat</strong></p>
        <p>Created by M. Hanif Indriawan <a href="mailto:ahmadhanifindriawan@gmail.com">(ahmadhanifindriawan@gmail.com)</a></p>
    </footer>

    <script>
        const jamEl = document.getElementById('jam');
        const tanggalEl = document.getElementById('tanggal');

        function updateClock() {
            const now = new Date();

            const jam = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            });

            const tanggal = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            jamEl.textContent = jam;
            tanggalEl.textContent = tanggal;
        }

        setInterval(updateClock, 1000);
        updateClock();

        async function updateWeather() {
            const suhuEl = document.getElementById('suhu');
            const cuacaEl = document.getElementById('cuaca');

            try {
                const response = await fetch('https://api.open-meteo.com/v1/forecast?latitude=-6.2088&longitude=106.8456&current=temperature_2m,weather_code&timezone=auto');
                if (!response.ok) {
                    throw new Error('Gagal mengambil data cuaca');
                }

                const data = await response.json();
                const suhu = Number(data.current.temperature_2m).toFixed(1);
                const kodeCuaca = data.current.weather_code;

                const namaCuaca = {
                    0: 'Cerah',
                    1: 'Cerah berawan',
                    2: 'Cerah berawan',
                    3: 'Berawan',
                    45: 'Berkabut',
                    48: 'Berkabut tebal',
                    51: 'Gerimis ringan',
                    53: 'Gerimis',
                    55: 'Gerimis lebat',
                    56: 'Gerimis dingin',
                    57: 'Gerimis dingin',
                    61: 'Hujan ringan',
                    63: 'Hujan',
                    65: 'Hujan lebat',
                    66: 'Hujan dingin',
                    67: 'Hujan deras',
                    71: 'Salju ringan',
                    73: 'Salju',
                    75: 'Salju lebat',
                    80: 'Hujan lokal',
                    81: 'Hujan lebat',
                    82: 'Hujan sangat lebat',
                    95: 'Badai',
                    96: 'Badai dengan hujan es',
                    99: 'Badai sangat parah'
                };

                suhuEl.textContent = suhu;
                cuacaEl.textContent = 'Jakarta: ' + (namaCuaca[kodeCuaca] || 'Cuaca sedang');
            } catch (error) {
                suhuEl.textContent = '--';
                cuacaEl.textContent = 'Cuaca tidak tersedia saat ini';
            }
        }

        updateWeather();
    </script>
</body>
</html>
