<?php
//session verify krna h jisse koi login h ya nhi chexk kr ske 
include('auth.php');
include('db.php');

if(isset($_POST['save_teacher'])) {
    $emp_id = $_POST['employee_id'];
    $name = $_POST['teacher_name'];
    // ... baaki saare fields fetch kar lo $_POST se ...
    
    $sql = "INSERT INTO teachers (employee_id, teacher_name, mobile_no, uan_no, designation, salary) 
            VALUES ('$emp_id', '$name', '{$_POST['mobile_no']}', '{$_POST['uan_no']}', '{$_POST['designation']}', '{$_POST['salary']}')";

    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Teacher Registered Successfully!'); window.location='teacher_list.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
