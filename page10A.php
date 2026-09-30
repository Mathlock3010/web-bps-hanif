<?php include 'dbconn.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
        <link rel="stylesheet" type="text/css" href="style04B.css">
        <meta charset="UTF-8">
        <title>Publikasi Badan Pusat Statistik</title>
        <style>
            body {
                background: #eef4ff;
            }

            main {
                padding: 40px 20px;
            }

            .login-wrap {
                width: 520px;
                margin: 40px auto;
                background: #ffffff;
                border: 1px solid #d7e2f6;
                border-radius: 14px;
                box-shadow: 0 8px 24px rgba(4, 78, 187, 0.1);
                padding: 30px 25px;
            }

            .login-title {
                text-align: center;
                color: #044ebb;
                font-size: 28px;
                margin-bottom: 20px;
                font-weight: bold;
            }

            form table {
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #d7e2f6;
                border-radius: 10px;
                overflow: hidden;
            }

            form td {
                padding: 8px 0;
                vertical-align: middle;
                border: none;
            }

            form label {
                display: inline-block;
                width: 120px;
                font-weight: bold;
                color: #333;
            }

            form input[type="text"],
            form input[type="password"] {
                width: 100%;
                padding: 12px 10px;
                border: 1px solid #cfd9ea;
                border-radius: 8px;
                font-size: 15px;
                box-sizing: border-box;
            }

            .password-wrapper {
                position: relative;
            }

            .password-wrapper input {
                padding-right: 44px;
            }

            .toggle-password {
                position: absolute;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
                border: 0;
                background: transparent;
                color: #044ebb;
                font-size: 20px;
                cursor: pointer;
                padding: 2px 4px;
            }

            form input[type="submit"] {
                display: block;
                margin: 10px auto 0;
                background: #044ebb;
                color: white;
                border: none;
                padding: 12px 28px;
                border-radius: 8px;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
            }

            form input[type="submit"]:hover {
                background: #033b96;
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
        <a href="page09C.php">Tambah Publikasi</a>
        <a href="page06E.php">Galeri Kegiatan</a>
        <a class="active" href="page10A.php">Login</a>
        </nav>
    </header>
    <main>
        <div class="login-wrap">
            <div class="login-title">Login</div>
            <form action="page10A_action.php" method="post">
                <table>
                    <tr>
                        <td><label>Username:</label></td>
                        <td><input type="text" name="username" required></td>
                    </tr>
                    <tr>
                        <td><label>Password:</label></td>
                        <td>
                            <div class="password-wrapper">
                                <input type="password" id="password" name="password" required>
                                <button type="button" class="toggle-password" id="togglePassword" aria-label="Tampilkan password" title="Tampilkan password">&#128065;</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Login"></td>
                    </tr>
                </table>
            </form>
        </div>
    </main>
    <footer>
        <p><strong>Copyright © 2026 BPS Pusat</strong></p>
        <p>Created by M. Hanif Indriawan <a href="mailto:ahmadhanifindriawan@gmail.com">(ahmadhanifindriawan@gmail.com)</a></p>
    </footer>
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {
            const passwordVisible = passwordInput.type === 'text';
            passwordInput.type = passwordVisible ? 'password' : 'text';
            togglePassword.innerHTML = passwordVisible ? '&#128065;' : '&#128584;';
            togglePassword.setAttribute('aria-label', passwordVisible ? 'Tampilkan password' : 'Sembunyikan password');
            togglePassword.setAttribute('title', passwordVisible ? 'Tampilkan password' : 'Sembunyikan password');
        });
    </script>
</body>
</html>