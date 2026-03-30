<?php
/**
 * Component: Change Password (Logged-in User)
 * Author: JS Coder
 */
include('../auth.php'); // Security check
include('../db.php');   // Database connection

$error_message = "";
$success_message = "";

if (isset($_POST['change_pwd_btn'])) {
    $user_id = $_SESSION['user_id'];
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $conf_pass = $_POST['confirm_password'];

    // 1. Fetch current password from DB
    $query = mysqli_query($conn, "SELECT password FROM users WHERE id='$user_id' LIMIT 1");
    $user_data = mysqli_fetch_assoc($query);

    // 2. Verify Old Password
    if (password_verify($old_pass, $user_data['password'])) {
        if ($new_pass === $conf_pass) {
            $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $update = mysqli_query($conn, "UPDATE users SET password='$hashed_pass' WHERE id='$user_id'");
            
            if ($update) {
                $success_message = "Password updated successfully.";
            }
        } else {
            $error_message = "New passwords do not match.";
        }
    } else {
        $error_message = "Current password is incorrect.";
    }
}

// Layout headers
$has_sidebar = true;
include('../header.php');
include('../sidebar/sidebar.php');
?>

<link rel="stylesheet" href="change_password.css">

<div id="main">
    <div class="settings-container">
        <div class="card">
            <h2>🔐 Change Password</h2>
            <p class="sub-text">Update your account security credentials.</p>

            <?php if($error_message): ?> <div class="alert alert-danger"><?php echo $error_message; ?></div> <?php endif; ?>
            <?php if($success_message): ?> <div class="alert alert-success"><?php echo $success_message; ?></div> <?php endif; ?>

            <form method="POST" onsubmit="return validatePassword()">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="old_password" placeholder="Enter current password" required>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" id="new_pass" placeholder="Enter new password" required>
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" id="conf_pass" placeholder="Confirm new password" required>
                </div>
                <div class="form-group" style="position: relative;">
    <label>New Password</label>
    <input type="password" name="new_password" id="new_pass" placeholder="Enter new password" required>
    <span id="togglePassword" style="position: absolute; right: 15px; top: 38px; cursor: pointer;">👁️</span>
</div>
                <button type="submit" name="change_pwd_btn" class="btn-primary">Update Password</button>
            </form>
        </div>
    </div>
</div>

<script src="change_password.js"></script>
<?php include('../footer.php'); ?>
