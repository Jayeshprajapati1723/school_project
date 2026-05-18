<?php
include('auth.php');
// include('header.php');
$has_sidebar = true;
// include('sidebar.php') ;
include('db.php');

if (isset($_GET['id'])) { //sidha adress bar se catch
    $id = $_GET['id']; //hmne id catch ki feehist se 
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM other_payments WHERE receipt_no = '$id'";
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

    <div class="heading">

        <h2>Rainbow Kids School </h2>
        <h3>Scheme no 51 INDORE ,MP</h3>
        <!-- <h4>Session 2026-2027</h4> -->

    </div>
    <div class="containerslip">
        <div class="heading">
            <h5><b>Other activity fee receipt</b></h5>
        </div>
        <div class="frow">
            <div class="name">Rec/No : <?php echo "rbk/busfees-". $data['receipt_no']  ?></div>
            <div class="name">Date :
                <?php echo date('d-m-Y', strtotime($data['date']))  ?>
            </div>
            <div class="name">Scholar No : <?php echo $data['scholar_no']  ?></div>
        </div>
        <div class="frow">
            <div class="name">
                father name : <?php echo $data['father_name'] ?>
            </div>
            <div class="name">
                mobile no : <?php echo $data['father_mobile'] ?>
            </div>
            <div class="name">
                class : <?php echo $data['student_class'] ?>
            </div>
        </div>


        <div class="frow">
            <div class="name">
                Student Name :<?php echo $data['student_name']  ?>
            </div>
            <div class="name">Bus fees :
                <?php echo $data['total_bus_fare']  ?>
            </div>
            <div class="name">Due Amt. :
                <?php echo $data['due_amt']  ?>
            </div>

        </div>
        <div class="frow">
            <div class="name">Deposited Amt. :
                <?php echo $data['bus_deposit_amount']  ?>
            </div>
            <div class="name"> Total Paid Amt.:
                <?php echo $data['total_payable']  ?>
            </div>

            <div class="name">Remaining Amt :
                <?php echo $data['remaining']  ?>
            </div>

        </div>
        <div class="sign">
            <H6>Authorized signature</H6>
        </div>

    </div>
    <div> <button class="no-print" onclick="window.print()">Print Receipt</button></div>
</div>