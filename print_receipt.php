<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM fees_payments WHERE receipt_no = '$id'";
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);
    if (!$data) {
        die("<h2 style='text-align:center; padding-top:50px;'>Student Not Found!</h2>");
    }
} else {
    header("Location:dash.php");
    exit();
};
?>
<!-- link css file  -->
<link rel="stylesheet" href="print_receipt.css">
<div class="container">
    <div class="rn">Receipt No : <?php echo $data['receipt_no']  ?></div>
    <div class="heading">
        <h2>Rainbow Kids School </h2>
        <h3>Scheme 51 INDORE ,MP</h3>
        <h4>Session 2026-2027</h4>
    </div>
    <div class="frow">
        <div class="name">Date :
            <?php echo $data['date']  ?>
        </div>
        <div class="name">Scholar No : <?php echo $data['scholar_no']  ?></div>
        <div class="name">Student Name :
            <?php echo $data['student_name']  ?>
        </div>
    </div>
    <div class="frow">
        <div class="name">Total fees :
            <?php echo $data['total_fees']  ?>
        </div>
        <div class="name">Due Amt. :
            <?php echo $data['due_amt']  ?>
        </div>
        <div class="name">Diposited Amt. :
            <?php echo $data['deposit_amount']  ?>
        </div>
    </div>
    <div class="frow">
        <div class="name">Discont Amt :
            <?php echo $data['discount']  ?>
        </div>
        <div class="name"> Total Paid Amt.:
            <?php echo $data['paid_amt']  ?>
        </div>

        <div class="name">Remaining Amt :
            <?php echo $data['remaining']  ?>
        </div>
    </div>
<button class="no-print" onclick="window.print()">Print Receipt</button>
</div>