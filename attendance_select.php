<?php
//session verify krna h jisse koi login h ya nhi chexk kr ske 
include('auth.php');
include('db.php');
$has_sidebar = true;
include('header.php');
include('sidebar.php'); 

// 1. Filter Inputs
$f_month = $_GET['f_month'] ?? date('m');
$f_year  = $_GET['f_year'] ?? date('Y');
$f_class = $_GET['f_class'] ?? '1st';
$f_section = $_GET['f_section'] ?? 'A';

// Mahine mein kitne din hain?
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $f_month, $f_year);

// 2. Bachon ki list fetch karo
$students = mysqli_query($conn, "SELECT scholar_no, student_name FROM admissions WHERE student_class='$f_class' AND section='$f_section' ORDER BY scholar_no ASC");

// Classes List for Dropdown
$all_classes = ['Nursery', 'KG1', 'KG2', '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th','9th','10th'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Sheet | JS Coder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f4f7f6; font-size: 12px; }

        /* --- STRUCTURE FIX --- */
        .main-wrapper {
            margin-left: 0px; /* Sidebar space */
            margin-top: 80px;   /* Header space */
            padding: 25px;
            transition: 0.3s;
        }

        .card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 25px; }
        
        h2 { color: #1a2a6c; margin-bottom: 20px; font-size: 18px; display: flex; align-items: center; gap: 10px; }

        /* Filter Section Styles */
        .filter-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; align-items: end; }
        .form-group { display: flex; flex-direction: column; gap: 5px; }
        label { font-weight: 600; color: #555; font-size: 11px; text-transform: uppercase; }
        select, button { padding: 10px; border: 1px solid #ddd; border-radius: 8px; outline: none; font-family: inherit; }
        button { background: #1a2a6c; color: white; border: none; font-weight: 600; cursor: pointer; transition: 0.3s; }
        button:hover { background: #b21f1f; }

        /* Table Styles */
        .table-responsive { overflow-x: auto; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        th, td { border: 1px solid #eee; padding: 8px; text-align: center; }
        .header-bg { background: #1a2a6c; color: white; }
        .name-col { text-align: left; min-width: 150px; position: sticky; left: 0; background: #f8fafc; font-weight: 500; }
        
        .present { background: #dcfce7 !important; color: #166534; font-weight: bold; }
        .absent { background: #fee2e2 !important; color: #991b1b; font-weight: bold; }

        @media (max-width: 768px) {
            .main-wrapper { margin-left: 0; margin-top: 60px; padding: 15px; }
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    
    <div class="card">
        <h2>📝 Mark New Attendance</h2>
        <form action="take_attendance.php" method="GET" class="filter-grid">
            <div class="form-group">
                <label>Select Class</label>
                <select name="class" required>
                    <?php foreach($all_classes as $cls) echo "<option value='$cls'>$cls</option>"; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Section</label>
                <select name="section" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
            <button type="submit">Open Register</button>
        </form>
    </div>

    <div class="card">
        <h2>📊 Attendance Report (<?= date('F', mktime(0, 0, 0, $f_month, 10)) ?> - <?= $f_year ?>)</h2>
        
        <form class="filter-grid" method="GET" style="margin-bottom: 25px;">
            <div class="form-group">
                <label>Month</label>
                <select name="f_month">
                    <?php for($m=1; $m<=12; $m++) echo "<option value='$m' ".($f_month==$m?'selected':'').">".date('F', mktime(0,0,0,$m,10))."</option>"; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Year</label>
                <select name="f_year">
                    <?php for($y=2024; $y<=2026; $y++) echo "<option value='$y' ".($f_year==$y?'selected':'').">$y</option>"; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Class</label>
                <select name="f_class">
                    <?php foreach($all_classes as $cls) echo "<option value='$cls' ".($f_class==$cls?'selected':'').">$cls</option>"; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Section</label>
                <select name="f_section">
                    <option value="A" <?= $f_section=='A'?'selected':'' ?>>A</option>
                    <option value="B" <?= $f_section=='B'?'selected':'' ?>>B</option>
                </select>
            </div>
            <button type="submit">View Sheet</button>
        </form>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr class="header-bg">
                        <th>ID</th>
                        <th class="name-col" style="background: #1a2a6c;">Student Name</th>
                        <?php for($d=1; $d<=$days_in_month; $d++) echo "<th>$d</th>"; ?>
                        <th>%</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($s = mysqli_fetch_assoc($students)) { 
                        $s_no = $s['scholar_no'];
                        $p_count = 0; 
                    ?>
                        <tr>
                            <td><?= $s_no ?></td>
                            <td class="name-col"><?= strtoupper($s['student_name']) ?></td>
                            <?php 
                            for($d=1; $d<=$days_in_month; $d++) {
                                $date_str = "$f_year-$f_month-" . sprintf("%02d", $d);
                                $att_res = mysqli_query($conn, "SELECT status FROM attendance WHERE scholar_no='$s_no' AND att_date='$date_str'");
                                $att = mysqli_fetch_assoc($att_res);
                                
                                $char = '-';
                                $class = '';
                                if($att) {
                                    if($att['status'] == 'Present') { $char = 'P'; $class = 'present'; $p_count++; }
                                    elseif($att['status'] == 'Absent') { $char = 'A'; $class = 'absent'; }
                                }
                                echo "<td class='$class'>$char</td>";
                            }
                            $percent = ($p_count / $days_in_month) * 100;
                            ?>
                            <td style="font-weight:bold; background: #f8fafc;"><?= round($percent, 1) ?>%</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <p style="text-align:center; color:#888; margin-top:20px;">System Developed by <b>JS Coder</b></p>
</div>

<?php include('footer.php'); ?>
</body>
</html>
