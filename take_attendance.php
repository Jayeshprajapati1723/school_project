<!-- yha se bs student ko select krne k page khulega or a/p/l -->

<?php
include('auth.php');
include('db.php');
include('save_UTSattendence.php'); // Logic aur Student Fetching yahan se aayegi
include('header.php');
include('sidebar.php'); 

/* Logic Check: Agar register button se aa rahe ho toh $_GET use hoga, 
   agar form submit ho raha hai toh $_POST. 
*/
$display_class = $f_class ?? 'N/A'; 
$display_section = $f_section ?? 'N/A';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Take Attendance | JS Coder</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="take_attendence.css"> 
</head>
<body>
<div class="main-wrapper">
    <div class="att-card">
        <h2>📅 Attendance: <?php echo htmlspecialchars($display_class) . " - " . htmlspecialchars($display_section); ?></h2>
        <span class="date-label">Date: <b><?php echo date('d-M-Y'); ?></b></span>

        <form method="POST">
            <input type="hidden" name="student_class" value="<?php echo $display_class; ?>">
            <input type="hidden" name="section" value="<?php echo $display_section; ?>">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Status (P / A / L)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($students) && mysqli_num_rows($students) > 0) {
                        while($row = mysqli_fetch_assoc($students)) { ?>
                        <tr>
                            <td><b><?php echo $row['scholar_no']; ?></b></td>
                            <td><?php echo strtoupper($row['student_name']); ?></td>
                            <td>
                                <div class="radio-group">
                                    <label><input type="radio" name="status[<?php echo $row['scholar_no']; ?>]" value="Present" checked> P</label>
                                    <label><input type="radio" name="status[<?php echo $row['scholar_no']; ?>]" value="Absent"> A</label>
                                    <label><input type="radio" name="status[<?php echo $row['scholar_no']; ?>]" value="Leave"> L</label>
                                </div>
                            </td>
                        </tr>
                        <?php }
                    } else {
                        echo "<tr><td colspan='3' style='text-align:center; padding:20px;'>Student's not found !</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            
            <?php if(isset($students) && mysqli_num_rows($students) > 0) { ?>
                <button type="submit" name="save_attendance" class="btn-save">Submit Today's Attendance</button>
            <?php } ?>
        </form>
    </div>
    
    <p style="text-align:center; color:#888; margin-top:20px;">System by <b>JS Coder</b></p>
</div>

<?php include('footer.php'); ?>
</body>
</html>
