<?php
/**
 * Component: Forget Password System
 * Location: /features/forget_password/forget_password.php
 */
session_start();
// Ek folder piche jane ke liye ../ use kiya hai
include('../db.php'); 

$error = "";
$success = "";

if(isset($_POST['reset_btn'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $mobile   = mysqli_real_escape_string($conn, $_POST['mobile']);
    $new_pass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM users WHERE username='$username' AND mobile='$mobile' LIMIT 1";
    $result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($result) > 0) {
        $update_query = "UPDATE users SET password='$new_pass' WHERE username='$username'";
        if(mysqli_query($conn, $update_query)) {
            $success = "Success! Password badal gaya.";
        }
    } else {
        $error = "Username ya Mobile galat hai.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Access | JS Coder</title>
    <link rel="stylesheet" href="forget_password.css">
</head>
<body>
    <div class="reset-card">
        <h2>Reset Access</h2>
        <?php if($error) echo "<div class='error-msg'>$error</div>"; ?>
        <?php if($success) echo "<div class='success-msg'>$success</div>"; ?>

        <form method="POST" onsubmit="return validateResetForm()">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="mobile" placeholder="Mobile Number" maxlength="10" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <button type="submit" name="reset_btn" class="btn-reset">Update Password</button>
        </form>
        <p><a href="../login.php">Back to Login</a></p>
    </div>
    <script src="forget_password.js"></script>
</body>
</html>
