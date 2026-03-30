<?php
/**
 * Project: School Management System
 * Author: JS Coder
 * Description: Secure Authentication System with Session Management
 */
session_start();
include('db.php');

// 1. Initial Captcha Generate (Sirf pehli baar ke liye)
if (!isset($_SESSION['captcha_num1'])) {
    $_SESSION['captcha_num1'] = rand(1, 9);
    $_SESSION['captcha_num2'] = rand(1, 9);
}

// Redirect user to dashboard if already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: dash.php");
    exit();
} 

if(isset($_POST['login_btn'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $user_captcha = $_POST['captcha_input']; // User se answer lena

    // Captcha Logic Check
    if($user_captcha != ($_SESSION['captcha_num1'] + $_SESSION['captcha_num2'])) {
        $error = "Wrong Captcha.";
    } else {
        // SQL Query (Wahi purani wali)
        $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if(password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['username'] = $user_data['username'];
                $_SESSION['full_name'] = $user_data['full_name'];

                header("Location: dash.php");
                exit();
            } else {
                $error = "Invalid Password. Please try again.";
            }
        } else {
            $error = "User not found. Please check your username.";
        }
    }
    // Form submit ke baad naya captcha numbers
    $_SESSION['captcha_num1'] = rand(1, 9);
    $_SESSION['captcha_num2'] = rand(1, 9);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | JS Coder System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* AAPKI ORIGINAL CSS (BILKUL BHI CHANGE NAHI KI) */
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #1a2a6c, #b21f1f); height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; }
        .login-card { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); width: 100%; max-width: 380px; }
        h2 { color: #1a2a6c; text-align: center; margin-bottom: 5px; }
        p.sub-text { color: #888; font-size: 13px; text-align: center; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { font-size: 11px; font-weight: 600; color: #555; display: block; margin-bottom: 8px; text-transform: uppercase; }
        input { width: 100%; padding: 14px; border: 1px solid #ddd; border-radius: 10px; outline: none; transition: 0.3s; font-size: 14px; box-sizing: border-box; }
        input:focus { border-color: #1a2a6c; box-shadow: 0 0 8px rgba(26,42,108,0.1); }
        button { width: 100%; padding: 14px; background: #1a2a6c; color: white; border: none; border-radius: 10px; font-weight: bold; cursor: pointer; font-size: 16px; transition: 0.3s; margin-top: 10px; }
        button:hover { background: #b21f1f; transform: translateY(-2px); }
        .error-msg { background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; font-size: 12px; margin-bottom: 20px; text-align: center; border: 1px solid #fecaca; }
        
        /* Chota sa addition sirf numbers display ke liye */
        .captcha-label { background: #f0f0f0; padding: 5px 10px; border-radius: 5px; font-weight: bold; margin-bottom: 5px; display: inline-block; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Login</h2>
        <p class="sub-text">Login using your credentials</p>

        <?php if(isset($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter Username" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>

            <div class="form-group">
                <label>Solve: <span class="captcha-label"><?php echo $_SESSION['captcha_num1'] . " + " . $_SESSION['captcha_num2']; ?></span></label>
                <input type="number" name="captcha_input" placeholder="Enter Answer" required>
            </div>

            <button type="submit" name="login_btn">Sign In</button>
        </form>

        <p style="text-align:center; margin-top:20px; font-size: 13px; color: #555555;">
            Home page  <a href="index.php" style="color:#1a2a6c; font-weight:bold; text-decoration:none;">Click here</a>
        </p>
                <p style="text-align:center; margin-top:20px; font-size: 13px; color: #555555;">
            forget password   <a href="forget_password/forget_password.php" style="color:#1a2a6c; font-weight:bold; text-decoration:none;">click here</a>
    </div>
</body>
</html>
