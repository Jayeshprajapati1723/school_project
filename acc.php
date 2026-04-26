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
    $student_name = mysqli_real_escape_string($conn,$_POST['student_name']);
    $student_class =mysqli_real_escape_string($conn, $_POST['student_class']);
$due_amt = (float)$_POST['due_amt'] ;

if($due_amt!=0) {
    $remaining_balance = $due_amt - ($deposit_amt+  $discount) ;
        // 3. Database mein Insert karo
    $sql = "INSERT INTO fees_payments (
    scholar_no,   
    student_name ,
    student_class,
      installments,
      total_fees,
      due_amt ,
       date, 
       deposit_amount,
        discount, 
        remaining, 
        payment_mode, 
        teacher_name, 
        remarks) 
            VALUES ('$scholar_no',
            '$student_name',
            '$student_class',
             '$inst_no',
            '$total_fees','$due_amt' ,
            '$date',
             '$deposit_amt', '
             $discount', 
             '$remaining_balance', 
             '$payment_mode', 
             '$received_by', 
             '$remarks')";

                 if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn); // Receipt Number mil gaya!
        echo "<script>
                alert('Receipt Generated Successfully! No: $last_id');
                window.location.href = 'print_receipt.php?id=$last_id';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}else{
    echo "<script>
    alert('fees completed congratulations' )
    </script>" ;
}




}
?>