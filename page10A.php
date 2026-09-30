<?php
require_once 'security.php';

if (isset($_GET['logout'])) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $cookieParams = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
    }
    session_destroy();
    header('Location: page10A.php');
    exit;
}

include 'dbconn.php';
?>
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

            .account-switch,
            .status-message {
                text-align: center;
                margin-top: 18px;
            }

            .account-switch button {
                border: 0;
                background: transparent;
                color: #044ebb;
                font-weight: bold;
                text-decoration: underline;
                cursor: pointer;
                font: inherit;
            }

            .status-message {
                color: #176b37;
            }

            .login-error {
                color: #c62828;
                text-align: center;
                margin-top: 18px;
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
            <?php if (isset($_GET['registered'])): ?>
                <p class="status-message">Akun berhasil dibuat. Silakan login.</p>
            <?php endif; ?>
            <?php if (($_GET['error'] ?? '') === 'login'): ?>
                <p class="login-error" role="alert">Username atau password salah</p>
            <?php elseif (($_GET['error'] ?? '') === 'unregistered'): ?>
                <p class="login-error" role="alert">Username belum terdaftar. Silakan buat akun terlebih dahulu.</p>
            <?php endif; ?>
            <form id="loginForm" action="page10A_action.php" method="post">
                <input type="hidden" name="action" value="login">
                <table>
                    <tr>
                        <td><label for="loginUsername">Username:</label></td>
                        <td><input type="text" id="loginUsername" name="username" autocomplete="username" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td>
                            <div class="password-wrapper">
                                <input type="password" id="password" name="password" autocomplete="current-password" required>
                                <button type="button" class="toggle-password" id="togglePassword" aria-label="Tampilkan password" title="Tampilkan password">&#128065;</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Login"></td>
                    </tr>
                </table>
            </form>
            <form id="registerForm" action="page10A_action.php" method="post" hidden>
                <input type="hidden" name="action" value="register">
                <table>
                    <tr>
                        <td><label for="registerUsername">Username:</label></td>
                        <td><input type="text" id="registerUsername" name="username" autocomplete="username" required></td>
                    </tr>
                    <tr>
                        <td><label for="registerPassword">Password:</label></td>
                        <td><input type="password" id="registerPassword" name="password" autocomplete="new-password" minlength="6" required></td>
                    </tr>
                    <tr>
                        <td><label for="confirmPassword">Ulangi password:</label></td>
                        <td><input type="password" id="confirmPassword" name="confirm_password" autocomplete="new-password" minlength="6" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Daftar"></td>
                    </tr>
                </table>
            </form>
            <p class="account-switch">
                <span id="switchPrompt">Belum punya akun?</span>
                <button type="button" id="switchForm">Daftar akun</button>
            </p>
        </div>
    </main>
    <footer>
        <p><strong>Copyright © 2026 BPS Pusat</strong></p>
        <p>Created by M. Hanif Indriawan <a href="mailto:ahmadhanifindriawan@gmail.com">(ahmadhanifindriawan@gmail.com)</a></p>
    </footer>
    <script>
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const loginTitle = document.querySelector('.login-title');
        const switchPrompt = document.getElementById('switchPrompt');
        const switchForm = document.getElementById('switchForm');

        switchForm.addEventListener('click', function () {
            const showRegisterForm = registerForm.hidden;
            registerForm.hidden = !showRegisterForm;
            loginForm.hidden = showRegisterForm;
            loginTitle.textContent = showRegisterForm ? 'Daftar Akun' : 'Login';
            switchPrompt.textContent = showRegisterForm ? 'Sudah punya akun?' : 'Belum punya akun?';
            switchForm.textContent = showRegisterForm ? 'Login' : 'Daftar akun';
        });

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