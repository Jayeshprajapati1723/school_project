<!-- signup page h ye signup.php
 use rainbow_kids_db  ;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mobile VARCHAR(15) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-->
<!--  -->
<?php
// PHP Session start for captcha validation
session_start();
include('db.php');
include('auth.php');
$has_sidebar = true ;
include('header.php') ;
include('sidebar.php') ;
// 1. Captcha Generate karna (Naye Numbers generate honge har bar)
if (!isset($_POST['signup_btn'])) {
    $_SESSION['captcha_num1'] = rand(1, 9);
    $_SESSION['captcha_num2'] = rand(1, 9);
}

if(isset($_POST['signup_btn'])) {
    // Input Sanitization (SQL Injection se bachne ke liye)
    $fullname = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile   = mysqli_real_escape_string($conn, $_POST['mobile']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass     = $_POST['password'];
    $c_pass   = $_POST['confirm_password'];
    $user_captcha = $_POST['captcha_ans'];

    // 2. Password Strength Validation (Standard Coding)
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number    = preg_match('@[0-9]@', $pass);
    $specialChars = preg_match('@[^\w]@', $pass);

    // Error Checking Logic
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
        $error = "Password consist atleast or more than 8 characters 
        *CAPITAL LETTERS
        *small lettes
        * numeric values 
        *special characters @/%^";
        
    } 
    elseif($pass !== $c_pass) {
        $error = "Password Not Match with confirm password.";
    } 
    // 3. Captcha Validation
    elseif($user_captcha != ($_SESSION['captcha_num1'] + $_SESSION['captcha_num2'])) {
        $error = "Wrong Captcha.";
    }
    else {
        // 4. Password Hashing (Data encryption)
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // 5. Unique Check (Email & Username validation)
        $check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' OR email='$email'");
        if(mysqli_num_rows($check) > 0) {
            $error = "This username ,email or phone number alreardy exist ";
        } else {
            // 6. Data Insertion into Database
            $sql = "INSERT INTO users (full_name, email, mobile, username, password) 
                    VALUES ('$fullname', '$email', '$mobile', '$username', '$hashed_pass')";
            
            if(mysqli_query($conn, $sql)) {
                // Success message and redirection
                echo "<script>alert('Congratulations Registration Successful.'); window.location='login.php';</script>";
            } else {
                $error = "System Error: " . mysqli_error($conn);
            }
        }
    }
    // Form submit hone ke baad naya captcha generate karein
    $_SESSION['captcha_num1'] = rand(1, 9);
    $_SESSION['captcha_num2'] = rand(1, 9);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Sign Up | JS Coder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Modern UI Design */
        body { font-family: 'Poppins', sans-serif; background: #f0f2f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 35px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h2 { color: #1a2a6c; margin: 0; text-align: center; }
        p.sub { color: #777; font-size: 13px; text-align: center; margin-bottom: 25px; }
        
        /* Grid Layout for Forms */
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 10px; outline: none; transition: 0.3s; font-size: 13px; }
        input:focus { border-color: #1a2a6c; box-shadow: 0 0 5px rgba(26,42,108,0.2); }
        .full { grid-column: span 2; }
        
        /* Captcha Styling */
        .captcha-box { background: #f8fafc; padding: 10px; border-radius: 8px; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; border: 1px dashed #cbd5e1; }
        .captcha-box b { color: #1a2a6c; font-size: 16px; }
        
        button { width: 100%; padding: 14px; background: #1a2a6c; color: white; border: none; border-radius: 10px; font-weight: bold; cursor: pointer; font-size: 16px; margin-top: 10px; transition: 0.3s; }
        button:hover { background: #b21f1f; }
        
        .error { background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; font-size: 12px; margin-bottom: 20px; text-align: left; line-height: 1.5; border-left: 4px solid #b91c1c; }
    </style>
</head>
<body>
    <div class="card">
    <h2>Registration</h2>
        <!-- <p class="sub">Standard Secure System by JS Coder</p> -->

        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="POST">
            <label style="font-size: 11px; font-weight: 600;">FULL NAME</label>
            <input type="text" name="full_name" placeholder="Enter Full Name" class="full" required>
            
            <div class="grid">
                <div>
                    <label style="font-size: 11px; font-weight: 600;">EMAIL</label>
                    <input type="email" name="email" placeholder="example@mail.com" required>
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 600;">MOBILE NO</label>
                    <input type="text" name="mobile" placeholder="10 Digit Number" required>
                </div>
            </div>

            <label style="font-size: 11px; font-weight: 600;">CHOOSE USERNAME</label>
            <input type="text" name="username" placeholder="Username" class="full" required>
            
            <div class="grid">
                <div>
                    <label style="font-size: 11px; font-weight: 600;">PASSWORD</label>
                    <input type="password" name="password" placeholder="8+ Characters" required>
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 600;">CONFIRM</label>
                    <input type="password" name="confirm_password" placeholder="Repeat Password" required>
                </div>
            </div>

            <div class="captcha-box">
                <span>Please solve: <b><?php echo $_SESSION['captcha_num1'] . " + " . $_SESSION['captcha_num2']; ?> = ?</b></span>
                <input type="number" name="captcha_ans" style="width: 80px; margin-bottom: 0;" placeholder="Ans" required>
            </div>

            <button type="submit" name="signup_btn">Complete Registration</button>
        </form>

        <p style="text-align:center; margin-top:20px; font-size: 13px; color: #555;">
            Already have an account? <a href="login.php" style="color:#1a2a6c; font-weight:bold; text-decoration:none;">Login here</a>
        </p>
                <p style="text-align:center; margin-top:20px; font-size: 13px; color: #555555;">
            Home page  <a href="index.php" style="color:#1a2a6c; font-weight:bold; text-decoration:none;">Click here</a>
        </p>
    </div>
</body>
<?php include('footer.php') ; ?>
</html>
