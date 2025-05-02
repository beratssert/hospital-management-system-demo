<?php
session_start();

// *** YENİ: Kayıt başarı mesajını kontrol et ***
$register_success_message = null;
if (isset($_SESSION['login_success_message'])) {
    $register_success_message = $_SESSION['login_success_message'];
    unset($_SESSION['login_success_message']); // Mesajı gösterdikten sonra sil
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System - Login</title>
    <style>
        /* Login stilleri aynı kalır */
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f4f4; }
        .login-container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 300px; }
        .login-container h2 { text-align: center; margin-bottom: 20px; color: #333; }
        .login-container label { display: block; margin-bottom: 5px; color: #555; }
        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .login-container button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .login-container button:hover { background-color: #0056b3; }
        .error-message { color: red; text-align: center; margin-bottom: 15px; font-size: 0.9em;}
        /* *** YENİ: Başarı mesajı stili *** */
        .success-message { color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 0.9em; text-align:center;}
        .register-link { text-align: center; margin-top: 20px; font-size: 0.9em;}
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

         <?php if ($register_success_message): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($register_success_message); ?>
            </div>
         <?php endif; ?>

        <?php
        // Mevcut giriş hata mesajı gösterme alanı
        if (isset($_SESSION['login_error'])) {
            echo '<p class="error-message">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>

        <form action="login_process.php" method="post">
            <div>
                <label for="identifier">User ID / Email:</label>
                <input type="text" id="identifier" name="identifier" placeholder="Enter Patient ID or Doctor/Admin Email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div>
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="patient">Patient</option>
                    <option value="doctor">Doctor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit">Login</button>
        </form>
         <p class="register-link">
            Don't have an account? <a href="register.php">Register here</a>
        </p>
    </div>
</body>
</html>