<?php
session_start();

// Check for feedback messages
$feedback_message = isset($_SESSION['register_error']) ? $_SESSION['register_error'] : null;
$feedback_type = 'error';
$form_data = isset($_SESSION['register_form_data']) ? $_SESSION['register_form_data'] : [];

unset($_SESSION['register_error']);
unset($_SESSION['register_form_data']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f4f4; padding: 20px 0;}
        .register-container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 400px; max-width: 95%;}
        .register-container h2 { text-align: center; margin-bottom: 20px; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #555; font-weight: bold;}
        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group input[type="tel"],
        .form-group select,
        .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .form-group textarea { min-height: 60px; }
        .form-group button { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .form-group button:hover { background-color: #218838; }
        .error-message { color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 0.9em;}
        .login-link { text-align: center; margin-top: 15px; font-size: 0.9em; }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Patient Registration</h2>
        <p style="text-align:center; color:#6c757d; margin-top:-10px; margin-bottom:20px;">Please fill in all fields.</p>

        <?php if ($feedback_message): ?>
            <div class="error-message">
                <?php
                    if (is_array($feedback_message)) {
                        echo implode("<br>", array_map('htmlspecialchars', $feedback_message));
                    } else {
                        echo htmlspecialchars($feedback_message);
                    }
                ?>
            </div>
        <?php endif; ?>

        <form action="process_registration.php" method="post" id="registration-form">
            <div class="form-group">
                <label for="tc_kimlik_no">TC Kimlik No (Patient ID):</label>
                <input type="number" id="tc_kimlik_no" name="patient_id_tc" required pattern="\d{11}" title="Please enter exactly 11 digits" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo htmlspecialchars($form_data['patient_id_tc'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required value="<?php echo htmlspecialchars($form_data['first_name'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required value="<?php echo htmlspecialchars($form_data['last_name'] ?? ''); ?>">
            </div>
             <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required placeholder="e.g., 5xxxxxxxxx" value="<?php echo htmlspecialchars($form_data['phone'] ?? ''); ?>">
            </div>
             <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required> <option value="" disabled selected>-- Select Gender --</option>
                    <option value="Male" <?php echo (($form_data['gender'] ?? '') === 'Male') ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo (($form_data['gender'] ?? '') === 'Female') ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo (($form_data['gender'] ?? '') === 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
             <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required max="<?php echo date('Y-m-d'); ?>" value="<?php echo htmlspecialchars($form_data['dob'] ?? ''); ?>"> </div>
             <div class="form-group">
                <label for="blood_type">Blood Type:</label>
                 <select id="blood_type" name="blood_type" required> <option value="" disabled selected>-- Select Blood Type --</option>
                    <option value="A +" <?php echo (($form_data['blood_type'] ?? '') === 'A +') ? 'selected' : ''; ?>>A +</option>
                    <option value="A -" <?php echo (($form_data['blood_type'] ?? '') === 'A -') ? 'selected' : ''; ?>>A -</option>
                    <option value="B +" <?php echo (($form_data['blood_type'] ?? '') === 'B +') ? 'selected' : ''; ?>>B +</option>
                    <option value="B -" <?php echo (($form_data['blood_type'] ?? '') === 'B -') ? 'selected' : ''; ?>>B -</option>
                    <option value="AB +" <?php echo (($form_data['blood_type'] ?? '') === 'AB +') ? 'selected' : ''; ?>>AB +</option>
                    <option value="AB -" <?php echo (($form_data['blood_type'] ?? '') === 'AB -') ? 'selected' : ''; ?>>AB -</option>
                    <option value="O +" <?php echo (($form_data['blood_type'] ?? '') === 'O +') ? 'selected' : ''; ?>>O +</option>
                    <option value="O -" <?php echo (($form_data['blood_type'] ?? '') === 'O -') ? 'selected' : ''; ?>>O -</option>
                    </select>
            </div>
             <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required><?php echo htmlspecialchars($form_data['address'] ?? ''); ?></textarea> </div>

            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
         <div class="login-link">
            Already have an account? <a href="index.php">Login here</a>
        </div>
    </div>
    <script>
        const form = document.getElementById('registration-form');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        if(form && password && confirmPassword) {
            form.addEventListener('submit', function(event) {
                if (password.value !== confirmPassword.value) {
                    alert("Passwords do not match!");
                    event.preventDefault();
                }
            });
        }
    </script>
</body>
</html>