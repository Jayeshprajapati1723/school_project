<?php
$cdate = date('Y-m-y');
$tbf = 3000;
include('db.php');
include('auth.php');
include('header.php');
//scholar no catch kro 
if (isset($_GET['scholar_no'])) {
    $scholar_no = ($_GET['scholar_no']);
    // scholarno ko rkha ek variable m 
    $scholar_no = mysqli_real_escape_string($conn, $_GET['scholar_no']);
    //querry m hmne bola select kro us scholar ko      
    $query = "SELECT * FROM newadmissions WHERE scholar_no = '$scholar_no'";
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

$check_sql = "SELECT remaining FROM bus_payments WHERE scholar_no = '$scholar_no' ORDER BY receipt_no  DESC LIMIT 1";
$check_res = mysqli_query($conn, $check_sql);
if ($row = mysqli_fetch_assoc($check_res)) {
    $due_amt  = $row['remaining']; // Agar purani receipt mili, toh use update kar do
} else {
    $due_amt = $tbf; //3k dikhenge jb tk kn bhroge 
}
$next_installment = 1; // Default
$inst_query = mysqli_query($conn, "SELECT installments FROM bus_payments WHERE scholar_no = '$scholar_no' ORDER BY receipt_no DESC LIMIT 1");
$inst_data = mysqli_fetch_assoc($inst_query);

if ($inst_data) {
    $next_installment = $inst_data['installments'] + 1; // Pichle mein +1 kar diya
}
?>
<link rel="stylesheet" href="fees.css">
<!-- //css whi rkhi h same as fees -->
<div class="container">
    <a href="dash.php" class="btn btn-back"><button>Back to Dashboard</button></a>
    <a href="busfees.php" class='busfees'>🚌Bus Fee</a>

    <h1>RAINBOW KIDS SCHOOL</h1>
    <h2>FEES DETAILS </h2>
    <form action="savebusfees.php" method="post">
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
                <!-- tbf means total bus fees -->
                <div> <label>Total Bus Fee Amount
                    </label>
                    <input type="number" value="<?= $tbf ?>" name="tbf" readonly>
                </div>
                <div> <label> Total Bus Due Amount</label>
                    <input type="number" value="<?= $due_amt ?>" name="due_amt" readonly id="due">
                </div>
            </div>
            <div class="row">
                <div><label> Bus Deposit amount </label>
                    <input type="number" min="1" name="diposite_amt"
                        id="depo"
                        placeholder="enter deposite amount here " required>
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
    <script>
        let depoInput = document.querySelector('#depo')
        let totalp = document.querySelector('#final_p');
        let due = document.querySelector("#due");
        let btn = document.querySelector('#btn');
        depoInput.addEventListener('input', () => {
            // Number() use karna zaruri hai warna 10+10 ko 1010 bana dega
            let tdue = Number(due.value);
            let total = Number(depoInput.value) || 0;
            if (tdue == 0) {
                alert("fees is completed ");
                alert('no due amount');
            }
            if (total <= tdue) {
                totalp.value = total;
            } else {
                totalp.value = 0;
                depoInput.value = "";
                alert('amount is greater than due please check ')
            }
            if (tdue == 0) {
                btn.addEventListener('click', () => {
                    btn.ariaDisabled = true;
                    btn.style.opacity = "0.5"; // User ko dikhane ke liye ki ye band hai
                    btn.style.cursor = "not-allowed";
                })
            } else {
                btn.disabled = false;
                btn.style.opacity = "1";
                btn.style.cursor = "pointer";
            }
        });
        window.addEventListener('pageshow', (event) => {
            // Agar page cache (history) se load ho raha hai
            if (event.persisted) {
                window.location.reload();
                if (window.location.pathname.includes('busfees.php')) {
                    window.location.replace("dash.php");
                }
            }
        });
    </script>
</div>