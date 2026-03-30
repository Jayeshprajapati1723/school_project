<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('header.php') ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rainbow Kids | Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS BHI ISI MEIN HAI - LIFETIME NO CONFUSION */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #f8f9fa; color: #333; }
        nav { background: #fff; padding: 15px 8%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .logo { font-size: 26px; font-weight: 700; color: #2575fc; }
        .nav-links { display: flex; gap: 30px; list-style: none; }
        .nav-links a { text-decoration: none; color: #444; font-weight: 500; }
        .hero { height: 60vh; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1350&auto=format&fit=crop'); background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white; text-align: center; }
        .btn-primary { background: #2575fc; color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 20px; }
        .features { padding: 50px 8%; display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        .feat-card { background: white; padding: 30px; border-radius: 15px; width: 300px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); text-align: center; transition: 0.3s; }
        .feat-card:hover { transform: translateY(-10px); }
        footer { background: #1a2a6c; color: white; padding: 20px; text-align: center; }
    </style>
</head>
<body>

<!-- <nav>
    <div class="logo">🌈 RAINBOW KIDS</div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="admission.php">Admissions</a></li>
        add dashboard feature in home page -->
    <!-- <li><a href="admin_dashboard.php">Dashboard</a></li>
    </ul>
</nav> -->



<section class="hero">
    <div>
        <h1>Welcome to Rainbow Kids</h1>
        <p>Shaping the Future of Indore's Little Stars.</p>
        <a href="admissionenquiry.php" class="btn-primary">Admission Enquiry Online</a>
        <!-- <a href="admission.php" class="btn-primary">Apply Online 2026-27</a> -->
    </div>
</section>

<section class="features">
    <div class="feat-card"><h3>Smart Classes 🎓</h3><p>Learning with Fun.</p></div>
    <div class="feat-card"><h3>Safe Campus 🛡️</h3><p>CCTV Monitored.</p></div>
    <div class="feat-card"><h3>Play Area 🏫</h3><p>Best in Indore.</p></div>
</section>
</body>
</html>
<?php include('footer.php') ; ?>


