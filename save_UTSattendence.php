<?php
// session verify
include('auth.php');
include('db.php');

// URL se Class aur Section pakdo (GET method se aayenge)
$f_class = mysqli_real_escape_string($conn, $_GET['class'] ?? '');
$f_section = mysqli_real_escape_string($conn, $_GET['section'] ?? '');
$date = date('Y-m-d');

// --- 1. STUDENT FETCH LOGIC (Ye missing tha) ---
$students = mysqli_query($conn, "SELECT scholar_no, student_name FROM newadmissions WHERE student_class='$f_class' AND section='$f_section' ORDER BY scholar_no ASC");

// --- 2. SAVE ATTENDANCE LOGIC (POST method) ---
if(isset($_POST['save_attendance'])) {
    foreach($_POST['status'] as $scholar_no => $status) {
        $scholar_no = mysqli_real_escape_string($conn, $scholar_no);
        $status = mysqli_real_escape_string($conn, $status);

        $check_res = mysqli_query($conn, "SELECT id FROM attendance WHERE scholar_no = '$scholar_no' AND att_date = '$date'");

        if(mysqli_num_rows($check_res) > 0) {
            $query = "UPDATE attendance SET status = '$status' WHERE scholar_no = '$scholar_no' AND att_date = '$date'";
        } else {
            $query = "INSERT INTO attendance (scholar_no, att_date, status, student_class, section) 
                      VALUES ('$scholar_no', '$date', '$status', '$f_class', '$f_section')";
        }
        mysqli_query($conn, $query);
    }

    echo "<script>
            alert('Today's attendance saved successfully !');
            window.location.href = 'admin_dashboard.php';
          </script>";
}
?>
