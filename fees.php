<?php
include('db.php');
include('auth.php');
include('header.php');
$cdate = date('Y-m-d');

// include('feeshist.php');//fees history .php

// 1. Pehle ye decide kar lo ki 'Due' kya dikhana hai


// URL se scholar_no uthao (agar hai toh)
// or mene html m input m value - scholarno variable jo abhi bnaya h 

// <? get variable adress 

$scholar_no = "";
if (isset($_GET['scholar_no'])) {
    $scholar_no = $_GET['scholar_no'];
}

$student_name = "";
if (isset($_GET['student_name'])) {
    $student_name = $_GET['student_name'];
}


$optsession = ["--SESSION--", "2026-27"];
// option for session from promotion records and dynamically chages 
$curr_session_q = "select new_session from promotion_records order by id desc";
$current_session_r = mysqli_query($conn, $curr_session_q);
//ab option m jao 
$scholar = 0;
if (isset($_GET['scholar_no'])) {
    $scholar = mysqli_real_escape_string($conn, $_GET['scholar_no']);
}
$session = "2026-27";
if (isset($_GET['session'])) {
    $session = isset($_GET['session']) ? mysqli_real_escape_string($conn, $_GET['session']) : "";
}

// Table name correctly matched: newadmissions AND session = '$session' 
if ($session && $scholar) {
    $query = "SELECT * FROM newadmissions WHERE scholar_no = '$scholar'and session ='$session'";
    echo $query;
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);

    if (!$data) {
        die("<h2 style='text-align:center; padding-top:50px;'>Student Not Found!</h2>");
    }
} else {
    header("Location:dash.php");
    exit;
}


$due_amt = $data['total_standard_fees']; // By default full fees

// 2. Ab check karo agar koi pichli payment hai
$check_sql = "SELECT remaining FROM fees_payments WHERE scholar_no = '$scholar_no' ORDER BY receipt_no  DESC LIMIT 1";
$check_res = mysqli_query($conn, $check_sql);
if ($row = mysqli_fetch_assoc($check_res)) {
    $due_amt  = $row['remaining']; // Agar purani receipt mili, toh use update kar do
}
$next_installment = 1; // Default
$inst_query = mysqli_query($conn, "SELECT installments FROM fees_payments WHERE scholar_no = '$scholar_no' ORDER BY receipt_no DESC LIMIT 1");
$inst_data = mysqli_fetch_assoc($inst_query);

if ($inst_data) {
    $next_installment = $inst_data['installments'] + 1; // Pichle mein +1 kar diya
}

?>

<link rel="stylesheet" href="fees.css">
<div class="links">
    <a href="dash.php" class=""><button>Back to Dashboard</button></a>
    <!-- ye link h bus fees ki isme scholar_no bhej rhe h  -->
    <a href="busfees.php?scholar_no=<?= $data['scholar_no'] ?>" class=''><button>🚌Bus Fee </button></a>
    <a href="otherfees.php?scholar_no=<?= $data['scholar_no'] ?>" class=''><button>Activity/OTHER Fee</button></a>
</div>
<div class="links">
    <form method="get">
        <input type="hidden" name="scholar_no" value="<?= $scholar ?>">
        <label>Session</label>
        <select name="session" type="text">

            <option value=""> <?= $optsession[0] ?></option>
            <option value="2026-27">2026-27</option>

            <?php
            while ($current_session_list = mysqli_fetch_assoc($current_session_r)) {
                $optsession  = $current_session_list['new_session'];
                $selected = (isset($_GET['session']) && $_GET['session'] == $optsession) ? 'selected' : '';
                echo "<option value='$optsession' $selected>$optsession</option>";
            }
            ?>
        </select>
        <div class="form-actions">
            <button type="submit" class="btn-apply">Apply</button>
            <!-- //filechanges -->
            <a href="fees.php" class="btn-reset">Reset</a>
        </div>
    </form>
</div>
<div class="container">

    <h1>RAINBOW KIDS SCHOOL</h1>
    <h2>FEES DETAILS </h2>

    <form action="savefees.php" method="post"
        class="form">
        <div class="prow">
            <div class="row">

                <div class="col"> <label>Scholar No </label>
                    <input type="number" value="<?= $scholar_no ?>"
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
                <div class="col"> <label>Installment No </label>
                    <input type="number" name="installment_no" placeholder="enter installment no 1,2 etc "
                        min='1' value="<?= $next_installment ?>" readonly
                        required>
                </div>
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
                <div style="color: red;"> <label> Old class/session balance </label>
                    <input type="number" value="<?= $due_amt ?>" name="due_amt" readonly id="due">
                </div>
                <div> <label>Total Fee Amount
                    </label>
                    <input type="number" value="<?= $data['total_standard_fees'] ?>" name="total_standard_fees" readonly>
                </div>

            </div>
            <div class="row">
                <div> <label> Total Due Amount</label>
                    <input type="number" value="<?= $due_amt ?>" name="due_amt" readonly id="due">
                </div>
                <div><label>Deposit amount </label>
                    <input type="number" min="1" name="diposite_amt"
                        id="depo"
                        placeholder="enter deposite amount here " required>
                </div>
                <div> <label>Discount </label>
                    <input type="number" min='0' name="discount_amt" placeholder="enter diposite amount here "
                        id="disc"
                        onchange="if(this.value < 0) this.value = 0;">
                </div>
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

<script src="fees.js"></script>
<!-- //        <label>Reciept No </label>
    // <input type="number" value="auto gnerated" name="reciept_no" readonly style="background: #eee;"> -->