<?php
include('db.php');

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

if (isset($_GET['scholar_no'])) {
    $scholar = mysqli_real_escape_string($conn, $_GET['scholar_no']);
    // Table name correctly matched: newadmission
    $query = "SELECT * FROM newadmissions WHERE scholar_no = '$scholar'";
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);

    if (!$data) {
        die("<h2 style='text-align:center; padding-top:50px;'>Student Not Found!</h2>");
    }
} else {
    header("Location:dash.php");
    exit();
}

$due_amt = $data['total_standard_fees']; // By default full fees

// 2. Ab check karo agar koi pichli payment hai
$check_sql = "SELECT remaining FROM fees_payments WHERE scholar_no = '$scholar_no' ORDER BY receipt_no  DESC LIMIT 1";
$check_res = mysqli_query($conn, $check_sql);
if ($row = mysqli_fetch_assoc($check_res)) {
    $due_amt  = $row['remaining']; // Agar purani receipt mili, toh use update kar do
}
?>

<link rel="stylesheet" href="fees.css">

<div class="container">
    <h1>RAINBOW KIDS SCHOOL</h1>
    <h2>FEES DETAILS </h2>
    <form action="acc.php" method="post">

        <label>Scholar No </label>
        <input type="number" value="<?= $scholar_no ?>"
            name="scholar_no" placeholder="auto generated" readonly required>
        <label>Student Name</label>
        <input value="<?= $data['student_name'] ?>" readonly required  name="student_name">
                <label>Father Name</label>
        <input value="<?= $data['father_name'] ?>" readonly required  name="father_name">
        <label>Class</label>
        <input value="<?= $data['student_class'] ?>" name="student_class" readonly>
        <label>Installment No </label>
        <input type="number" name="installment_no" placeholder="enter installment no 1,2 etc "
            min='1'
            required>
        <label>Date</label>
        <input type="date" name="date" placeholder="dd-mm-yyyy" required>
        <label>Total Fee Amount</label>
        <input type="number" value="<?= $data['total_standard_fees'] ?>" name="total_standard_fees" readonly>
                <label> Total Due Amount</label>
        <input type="number" value="<?= $due_amt ?>" name="due_amt" readonly>
        <label>Diposit amount </label>
        <input type="number" min="1" name="diposite_amt" placeholder="enter diposite amount here " required>
        <label>Discount </label>
        <input type="number" min='0' name="discount_amt" placeholder="enter diposite amount here "
            onchange="if(this.value < 0) this.value = 0;">
        <label>Recieved by </label>
        <input type="text" name="recieved" placeholder="teacher/faculty " required>
        <label>Mode of payment </label>
        <!-- <input type="text" name="mode" placeholder="online/cash "required -->
        <select class="select"  name="mode">
            <option>Cash</option>
            <option>Online</option>
        </select>

        <label>Remarks</label>
        <input type="text" name="remarks" placeholder="remarks etc ">
        <p>***NOTE***<br>
            1 : All feilds are filled carefully and recheck again <br>
            2 : Check correctly STUDENT NAME and its SCHOLAR NO and reconfirmed before generate reciept
        </p>

        <button class="btn">Generate reciept </button>
    </form>




</div>
<script src="fees.js">
    //        <label>Reciept No </label>
    // <input type="number" value="auto gnerated" name="reciept_no" readonly style="background: #eee;">