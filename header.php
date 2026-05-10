<?php
/* DATE: 24-03-2026 
   REASON: Final Modular PHP Header. No CSS/JS inside.
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rainbow Kids Portal</title>

    <link rel="stylesheet" href="header.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <nav>
        <div class="logo-area">
            <?php if (isset($has_sidebar) && $has_sidebar === true): ?>
                <button class="openbtn" onclick="toggleNav()">☰ Menu</button>
            <?php endif; ?>
            <a href="index.php" class="logo">🌈 RAINBOW KIDS</a>
        </div>

        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li style="color: #15a2fa; font-size: 13px; font-weight: bold;">Welcome, <?php echo $_SESSION['full_name']; ?></li>
                <li><a href="dash.php">Dashboard</a></li>
                <li><a href="logout.php"style="color: #ff4d59;">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" style="background: #1a237e; color: white; padding: 7px 15px; border-radius: 5px;">Login</a></li>
            <?php endif; ?>
            <button class="thbtn">Theme</button>
        </ul>
    </nav>

    <div id="main">
        <script src="theme.js"></script>
        <script src="header.js"></script>