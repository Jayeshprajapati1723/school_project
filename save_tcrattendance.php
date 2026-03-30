<?php
//session verify krna h jisse koi login h ya nhi chexk kr ske 
include('auth.php');

// 1. Database connection file ko include karein
include('db.php');

// 2. Aaj ki date nikalye (format: YYYY-MM-DD)
$today = date('d-m-Y');

// 3. Check karein ki kya "Save" button dabaya gaya hai
if (isset($_POST['submit_attendance'])) {
    
    // 4. Form se aayi hui attendance array ko loop karein
    // $_POST['status'] mein Employee ID key hai aur Present/Absent value
    foreach ($_POST['status'] as $emp_id => $attendance_val) {
        
        // 5. Pehle check karein ki aaj ki attendance pehle se toh nahi bhari
        $check_sql = "SELECT id FROM teacher_attendance 
                      WHERE employee_id = '$emp_id' AND att_date = '$today'";
        $result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($result) > 0) {
            // 6. Agar pehle se entry hai, toh use UPDATE karein
            $update_sql = "UPDATE teacher_attendance 
                           SET status = '$attendance_val' 
                           WHERE employee_id = '$emp_id' AND att_date = '$today'";
            mysqli_query($conn, $update_sql);
        } else {
            // 7. Agar nayi entry hai, toh INSERT karein
            $insert_sql = "INSERT INTO teacher_attendance (employee_id, status, att_date) 
                           VALUES ('$emp_id', '$attendance_val', '$today')";
            mysqli_query($conn, $insert_sql);
        }
    }
    
    // 8. Kaam hone ke baad user ko message dikhayein
    echo "<script>alert('Attendance successfully saved!'); window.location='attendance_view.php';</script>";
}
?>
