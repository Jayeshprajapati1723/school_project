<?php
//session verify krna h jisse koi login h ya nhi chexk kr ske 
include('auth.php');
include('db.php');
include('sidebar.php'); 


// 1. Filter Inputs (Default aaj ki date rakhi hai)
$f_date    = $_GET['f_date'] ?? date('Y-m-d');
$f_class   = $_GET['f_class'] ?? '';
$f_section = $_GET['f_section'] ?? '';

// 2. Query building
$sql = "SELECT a.*, s.student_name 
        FROM attendance a 
        JOIN admissions s ON a.scholar_no = s.scholar_no 
        WHERE a.att_date = '$f_date'";

if(!empty($f_class))   { $sql .= " AND a.student_class = '$f_class'"; }
if(!empty($f_section)) { $sql .= " AND a.section = '$f_section'"; }

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report | JS Coder</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f0f4f8; padding: 30px; }
        .report-card { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .filter-bar { display: flex; gap: 15px; margin-bottom: 25px; background: #f8fafc; padding: 15px; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        .status-present { color: #10b981; font-weight: bold; }
        .status-absent { color: #ef4444; font-weight: bold; }
    </style>
</head>
<body>

<div class="report-card">
    <h2>📋 Attendance Report</h2>
    
    <form method="GET" class="filter-bar">
        <input type="date" name="f_date" value="<?= $f_date ?>" style="padding:8px; border-radius:5px; border:1px solid #ddd;">
        
        <select name="f_class" style="padding:8px; border-radius:5px; border:1px solid #ddd;">
            <option value="">All Classes</option>
            <option value="1st" <?= ($f_class=='1st'?'selected':'') ?>>1st</option>
            <option value="2nd" <?= ($f_class=='2nd'?'selected':'') ?>>2nd</option>
            </select>

        <select name="f_section" style="padding:8px; border-radius:5px; border:1px solid #ddd;">
            <option value="">All Sections</option>
            <option value="A" <?= ($f_section=='A'?'selected':'') ?>>A</option>
            <option value="B" <?= ($f_section=='B'?'selected':'') ?>>B</option>
        </select>

        <button type="submit" style="background:#1a2a6c; color:white; border:none; padding:8px 20px; border-radius:5px; cursor:pointer;">Filter Report</button>
        <a href="attendance_report.php" style="text-decoration:none; padding:8px; color:#666; font-size:13px;">Reset</a>
    </form>

    <table>
        <thead>
            <tr style="background:#f1f5f9;">
                <th>Scholar ID</th>
                <th>Student Name</th>
                <th>Class-Sec</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['scholar_no'] ?></td>
                    <td><?= strtoupper($row['student_name']) ?></td>
                    <td><?= $row['student_class'] ?> - <?= $row['section'] ?></td>
                    <td class="<?= ($row['status']=='Present'?'status-present':'status-absent') ?>">
                        <?= $row['status'] ?>
                    </td>
                </tr>
            <?php } 
            } else { echo "<tr><td colspan='4' style='text-align:center;'>Bhai, is date ki koi attendance nahi mili!</td></tr>"; } ?>
        </tbody>
    </table>
</div>

</body>
</html>