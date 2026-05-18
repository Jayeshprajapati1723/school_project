<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
// include('auth.php');
include('db.php'); // Aapka database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Inputs ko variables mein pakdo
    $scholar_no    = mysqli_real_escape_string($conn, $_POST['scholar_no']);
    $deposit_amt   = (float)$_POST['diposite_amt'];
    $payment_mode  = mysqli_real_escape_string($conn, $_POST['mode']);
    $date          = $_POST['date'];
    $remarks       = mysqli_real_escape_string($conn, $_POST['remarks']);
    $received_by   = mysqli_real_escape_string($conn, $_POST['recieved']);
    $inst_no       = (int)$_POST['installment_no'];
    $tbf_fees = $_POST['tbf'];
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $student_class = mysqli_real_escape_string($conn, $_POST['student_class']);
    $due_amt = (float)$_POST['due_amt'];
    $paid_amt = (float)$_POST['paid_amt'];
    $f_mob = $_POST['f_mob'];
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);

    if ($due_amt != 0) {
        $remaining_balance = $due_amt - ($deposit_amt);
        // 3. Database mein Insert karo
        $sql = "INSERT INTO bus_payments (scholar_no,  student_name ,student_class,father_name, father_mobile, installments,total_bus_fare,
       bus_deposit_amount, total_payable,
        due_amt ,remaining,date, recieved,payment_mode, remark) 
            VALUES ('$scholar_no','$student_name','$student_class', '$f_name','$f_mob','$inst_no','$tbf_fees','$deposit_amt', '$paid_amt', '$due_amt' ,'$remaining_balance', '$date','$received_by','$payment_mode','$remarks')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn); // Receipt Number mil gaya!
            header("Location: print_busreceipt.php?id=" . $last_id);
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
    alert('fees completed congratulations' ) ;
    window.location.href = 'dash.php' ;
    </script>";
    }
}

?>



<!-- mysqli_insert_id($conn) Kya hai?
Ye PHP ka ek inbuilt function hai jo database se kehta hai: "Bhai, abhi-abhi jo naya row (record) insert hua hai, uska Auto-Increment wala number (Primary Key) kya hai, wo mujhe batao." -->