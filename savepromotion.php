<?php
include('db.php');
include('auth.php');


$old_session = $_POST['oldsession'];
$new_session = $_POST['newsession'];
$date = $_POST['date'];
$teacher_name = mysqli_real_escape_string($conn, $_POST['teacher_name']);

// hme syntax k case sensitive ni dekhna h 
$insert_querry = "insert into    promotion_records (old_session,new_session,date_of_promotion,teacher_name) 
values('$old_session','$new_session','$date','$teacher_name') ";


if (mysqli_query($conn, $insert_querry)) {
   echo "<script>
    alert('sucessfully promoted');
        window.location.href = 'dash.php';
    </script>";

    
} else {

    echo "<script>
    alert('ERROR OCCURED ');
    Window.location.href = 'dash.php';
    </script>";
    mysqli_error($conn);
}


?>
