<?php
$cdate = date('d-m-Y');
include('db.php');
include('auth.php') ;
include('header.php');
//scholar no catch kro 
if (isset($_GET['scholar_no'])) {
    $scholar = ($_GET['scholar_no']);
    // scholarno ko rkha ek variable m 
    $scholar = mysqli_real_escape_string($conn, $_GET['scholar_no']);
    //querry m hmne bola select kro us scholar ko      
    $query = "SELECT * FROM newadmissions WHERE scholar_no = '$scholar'";
    //res ek array jesa h store kr rha h fir 
    $res = mysqli_query($conn, $query);
    //data ko hmne rkha h sari values nikalne k liye res yha fetch ho rha h 
    //data ek m sbko fetch kra rhe h ek ek krke 
    $data = mysqli_fetch_assoc($res);
    if (!$data) {
        die("<h2 style='text-align:center; padding-top:50px;'>Student Not Found!</h2>");
    }
} else {
    header("Location:dash.php");
    exit();
}
?>
<link rel="stylesheet" href="fees.css">
<!-- //css whi rkhi h same as fees -->
<div class="container">
    <a href="dash.php" class="btn btn-back"><button>Back to Dashboard</button></a>
    <a href="busfees.php" class='busfees'>🚌Bus Fee</a>

    <h1>RAINBOW KIDS SCHOOL</h1>
    <h2>FEES DETAILS </h2>
    <form action="acc.php" method="post">
        <div class="prow">
            <div class="row">
                <div class="col"> <label>Scholar No </label>
                    <input type="number" value="<?= $scholar ?>"
                        name="scholar_no" placeholder="auto generated" readonly required>
                </div>
                <div class="col"> <label>Student Name</label>
                    <input value="<?= $data['student_name'] ?>" readonly required name="student_name">
                </div>
                <div class="col"> <label>Father Name</label>
                    <input value="<?= $data['father_name'] ?>" readonly required name="f_name">
                </div>
            </div>
            <div class="row">
                <div class="col"> <label>Class</label>

                    <input value="<?= $data['student_class'] ?>" name="student_class" readonly>
                </div>
                <!-- <div class="col"> <label>Installment No </label>
                    <input type="number" name="installment_no" placeholder="enter installment no 1,2 etc "
                        min='1' value="<?= $next_installment ?>" readonly
                        required>
                </div> -->
                <div class="col"> <label>Date</label>
                    <input type="date"
                        value="<?= $cdate ?>"
                        name="date" required>
                </div>
            </div>
            <div class="row">
                <div class="col"> <label>Contact</label>

                    <input value="<?= $data['father_mobile'] ?>" name="f_mob" readonly>
                </div>
                <!-- <div> <label>Total Fee Amount
                    </label>
                    <input type="number" value="<?= $data['total_standard_fees'] ?>" name="total_standard_fees" readonly>
                </div> -->
                <!-- <div> <label> Total Due Amount</label>
                    <input type="number" value="<?= $due_amt ?>" name="due_amt" readonly>
                </div>
            </div> -->
            <div class="row">
                <div><label> Bus Deposit amount </label>
                    <input type="number" min="1" name="diposite_amt"
                        id="depo"
                        placeholder="enter deposite amount here " required>
                </div>
                <!-- <div> <label>Discount </label>
                    <input type="number" min='0' name="discount_amt" placeholder="enter diposite amount here "
                        id="disc"
                        onchange="if(this.value < 0) this.value = 0;">
                </div> -->
            </div>
            <div class="row">
                <div><label>Total Payable Amount</label>
                    <input type="tel" name="paid_amt" placeholder="Enter Diposite Amount + Discount Amount for confirmation "
                        id="final_p"
                        required readonly>
                </div>
                <div> <label>Recieved by </label>
                    <input type="text" name="recieved" placeholder="teacher/faculty " required>
                </div>

                <div> <label>Mode of payment </label>
                    <!-- <input type="text" name="mode" placeholder="online/cash "required -->
                    <select class="select" name="mode">
                        <option>Cash</option>
                        <option>Online</option>
                    </select>
                </div>
                <div>
                    <label>Remarks</label>
                    <input type="text" name="remarks" placeholder="remarks etc ">
                </div>
            </div>
            <div class="row">

                <div>
                    <p>***NOTE***<br>
                        1 : All feilds are filled carefully and recheck again <br>
                        2 : Check correctly STUDENT NAME and its SCHOLAR NO and reconfirmed before generate reciept
                    </p>
                </div>
                <div> <button class="btn">Generate reciept </button></div>
            </div>

    </form>
</div>