<?php
include('auth.php');
include('monthly-save.php'); // Ensure is file mein variables match ho rahe hain
$has_sidebar = true;
include('header.php');
include('sidebar.php'); 

// Fallback values agar logic file se variable na milein
$month         = $month ?? date('m');
$year          = $year ?? date('Y');
$student_class = $student_class ?? '1st';
$section       = $section ?? 'A';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monthly Report | Rainbow Kids</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="monthly_report.css"> 
</head>
<body>

<div class="main-wrapper">
    <div class="sheet-container">
        <h2>📊 Monthly Attendance Register (<?= date('F', mktime(0, 0, 0, $month, 10)) ?> - <?= $year ?>)</h2>
        
        <form class="filter-section" method="GET">
            <select name="month">
                <?php for($m=1; $m<=12; $m++) echo "<option value='$m' ".($month==$m?'selected':'').">".date('F', mktime(0,0,0,$m,10))."</option>"; ?>
            </select>

            <select name="year">
                <?php for($y=2024; $y<=2026; $y++) echo "<option value='$y' ".($year==$y?'selected':'').">$y</option>"; ?>
            </select>

            <select name="student_class">
                <?php foreach($all_classes as $cls) { ?>
                    <option value="<?= $cls ?>" <?= $student_class==$cls?'selected':'' ?>><?= $cls ?></option>
                <?php } ?>
            </select>

            <select name="section">
                <?php foreach($all_sections as $sec) { ?>
                    <option value="<?= $sec ?>" <?= $section==$sec?'selected':'' ?>><?= $sec ?></option>
                <?php } ?>
            </select>

            <button type="submit">Filter Report</button>
            <button type="button" onclick="window.print()" style="background:#28a745; color:white; border:none; padding:8px 15px; border-radius:5px; cursor:pointer; margin-left:10px;">🖨️ Print PDF</button>
        </form>

        <table>
            <thead>
                <tr class="header-bg">
                    <th>ID</th>
                    <th class="name-col" style="background:#1a2a6c; color:white;">Student Name</th>
                    <?php 
                    for($d=1; $d<=$days_in_month; $d++) {
                        $cur_date = "$year-$month-" . sprintf("%02d", $d);
                        $day_name = date('D', strtotime($cur_date));
                        // National holidays check logic file se aayega
                        $isHoliday = is_holiday($d, $month, $year, $national_holidays);
                        $class = $isHoliday ? 'holiday-head' : '';
                        echo "<th class='$class'>$d<span class='day-name'>$day_name</span></th>";
                    } 
                    ?>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(isset($students) && mysqli_num_rows($students) > 0) {
                    while($s = mysqli_fetch_assoc($students)) { 
                        $s_no = $s['scholar_no'];
                        $p_count = 0; 
                ?>
                    <tr>
                        <td><?= $s_no ?></td>
                        <td class="name-col"><?= strtoupper($s['student_name']) ?></td>
                        <?php 
                        for($d=1; $d<=$days_in_month; $d++) {
                            $date_str = "$year-$month-" . sprintf("%02d", $d);
                            $isHoliday = is_holiday($d, $month, $year, $national_holidays);
                            $td_class = $isHoliday ? 'holiday-col' : '';
                            
                            $att_res = mysqli_query($conn, "SELECT status FROM attendance WHERE scholar_no='$s_no' AND att_date='$date_str'");
                            $att = mysqli_fetch_assoc($att_res);
                            
                            $char = '-';
                            if($isHoliday) { $char = '<span class="h-tag">H</span>'; }
                            
                            if($att) {
                                if($att['status'] == 'Present') { $char = 'P'; $td_class .= ' present'; $p_count++; }
                                elseif($att['status'] == 'Absent') { $char = 'A'; $td_class .= ' absent'; }
                                elseif($att['status'] == 'Leave') { $char = 'L'; $td_class .= ' leave'; }
                            }
                            echo "<td class='$td_class'>$char</td>";
                        }
                        $percent = ($p_count / $days_in_month) * 100;
                        ?>
                        <td style="font-weight:bold; background:#f8fafc;"><?= round($percent, 1) ?>%</td>
                    </tr>
                <?php 
                    } 
                } else {
                    echo "<tr><td colspan='".($days_in_month + 3)."' style='padding:20px;'>Bhai, is class mein koi bacha nahi mila!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>
