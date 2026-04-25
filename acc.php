<?php
include('db.php'); // Aapka database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Inputs ko variables mein pakdo
    $scholar_no    = mysqli_real_escape_string($conn, $_POST['scholar_no']);
    $deposit_amt   = (float)$_POST['diposite_amt'];
    $discount      = (float)$_POST['discount_amt'];
    $payment_mode  = mysqli_real_escape_string($conn, $_POST['mode']);
    $date          = $_POST['date'];
    $remarks       = mysqli_real_escape_string($conn, $_POST['remarks']);
    $received_by   = mysqli_real_escape_string($conn, $_POST['recieved']);
    $inst_no       = (int)$_POST['installment_no'];
 $total_fees = $_POST['total_standard_fees'];


$remaining_balance = $total_fees ;
$remaining_balance = $remaining_balance - $deposit_amt+ $discount ;
    // 3. Database mein Insert karo
    $sql = "INSERT INTO fees_payments (scholar_no, installments,total_fees, date, deposit_amount, discount, remaining, payment_mode, teacher_name, remarks) 
            VALUES ('$scholar_no', '$inst_no',
            '$total_fees',
            '$date', '$deposit_amt', '$discount', '$remaining_balance', '$payment_mode', '$received_by', '$remarks')";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn); // Receipt Number mil gaya!
        echo "<script>
                alert('Receipt Generated Successfully! No: $last_id');
                window.location.href = 'print_receipt.php?id=$last_id';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


?>