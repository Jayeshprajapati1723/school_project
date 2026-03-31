
<?php
/* EDITED: 24-03-2026 - Modular Structure with All Database Fields */
include('auth.php');
include('db.php');

if(isset($_GET['scholar_no'])) {
    $scholar = mysqli_real_escape_string($conn, $_GET['scholar_no']);
    // Table name correctly matched: newadmission
    $query = "SELECT * FROM newadmissions WHERE scholar_no = '$scholar'";
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);

    if(!$data) { die("<h2 style='text-align:center; padding-top:50px;'>Student Not Found!</h2>"); }
} else {
    header("Location:dash.php"); 
    exit();
}
$has_sidebar = true ; // menu button lane k liye
include('header.php');
include('sidebar.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile | <?php echo $data['student_name']; ?></title>
    <link rel="stylesheet" href="view_student.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="main-wrapper">
    <div class="container">
        <div class="btn-row">
            <a href="../dashboard/dash.php" class="btn btn-back">← Back to Dashboard</a>
            <div>
                <button onclick="window.print()" class="btn btn-print">🖨️ Print Profile</button>
            </div>
        </div>

        <div class="profile-card">
            <div class="p-header">
                <img src="../uploads/students/<?php echo $data['photo_path']; ?>" class="p-image" onerror="this.src='../uploads/students/default.png'">
                <div class="p-title">
                    <h1><?php echo $data['student_name']; ?></h1>
                    <p>Scholar No: <b><?php echo $data['scholar_no']; ?></b> | Admission Quota: <b><?php echo $data['admission_type']; ?></b></p>
                    <div class="header-badges">
                        <span class="badge">Class: <?php echo $data['student_class']; ?></span>
                        <span class="badge">Section: <?php echo $data['section']; ?></span>
                    </div>
                </div>
            </div>

            <div class="p-body">
                <div class="details-grid">
                    
                    <div class="section-title">👤 Personal Details</div>
                    <div class="detail-item"><label>Date of Birth (Fig)</label><span><?php echo $data['dob_figure']; ?></span></div>
                    <div class="detail-item" style="grid-column: span 2;"><label>Date of Birth (Words)</label><span><?php echo $data['dob_words']; ?></span></div>
                    <div class="detail-item"><label>Gender</label><span><?php echo $data['gender']; ?></span></div>
                    <div class="detail-item"><label>Religion</label><span><?php echo $data['religion']; ?></span></div>
                    <div class="detail-item"><label>Category</label><span><?php echo $data['category']; ?></span></div>
                    <div class="detail-item"><label>Caste</label><span><?php echo $data['caste']; ?></span></div>
                    <div class="detail-item"><label>Aadhar Number</label><span><?php echo $data['aadhar_no']; ?></span></div>
                    <div class="detail-item"><label>SSSM ID</label><span><?php echo $data['sssm_id']; ?></span></div>
                    <div class="detail-item"><label>Family ID</label><span><?php echo $data['family_id']; ?></span></div>

                    <div class="section-title">👨‍👩‍👦 Parents Information</div>
                    <div class="detail-item"><label>Father's Name</label><span>Mr. <?php echo $data['father_name']; ?></span></div>
                    <div class="detail-item"><label>Father Qualification</label><span><?php echo $data['f_qualification']; ?></span></div>
                    <div class="detail-item"><label>Father Occupation</label><span><?php echo $data['f_occupation']; ?></span></div>
                    <div class="detail-item"><label>Mother's Name</label><span>Mrs. <?php echo $data['mother_name']; ?></span></div>
                    <div class="detail-item"><label>Mother Qualification</label><span><?php echo $data['m_qualification']; ?></span></div>
                    <div class="detail-item"><label>Mother Occupation</label><span><?php echo $data['m_occupation']; ?></span></div>

                    <div class="section-title">📞 Contact & Address</div>
                       <div class="detail-item"><label>Father Mobile</label><span><?php echo $data['father_mobile']; ?></span></div>
                    <div class="detail-item"><label>Mother Mobile</label><span><?php echo $data['mother_mobile']; ?></span></div>
                    <div class="detail-item"><label>Alternative Mobile</label><span><?php echo $data['alt_mobile']; ?></span></div>
                    <div class="detail-item" style="grid-column: span 3;"><label>Permanent Address</label><span><?php echo $data['permanent_address']; ?></span></div>
                    <div class="detail-item" style="grid-column: span 3;"><label>Current Address</label><span><?php echo $data['current_address']; ?></span></div>

                    <div class="section-title">🛡️ Guardian Information</div>
                    <div class="detail-item"><label>Guardian Name</label><span><?php echo !empty($data['guardian_name']) ? $data['guardian_name'] : 'N/A'; ?></span></div>
                    <div class="detail-item"><label>Relation</label><span><?php echo !empty($data['guardian_relation']) ? $data['guardian_relation'] : 'N/A'; ?></span></div>
                    <div class="detail-item"><label>Guardian Mobile</label><span><?php echo !empty($data['guardian_mobile']) ? $data['guardian_mobile'] : 'N/A'; ?></span></div>
                    <div class="detail-item"><label>Guardian Alt Mobile</label><span><?php echo !empty($data['guardian_alt_mobile']) ? $data['guardian_alt_mobile'] : 'N/A'; ?></span></div>

                    <div class="section-title">🏦 Bank Account Information</div>
                    <div class="detail-item"><label>A/C Holder Name</label><span><?php echo $data['ac_holdername']; ?></span></div>
                    <div class="detail-item"><label>Bank Name</label><span><?php echo $data['bank_name']; ?></span></div>
                    <div class="detail-item"><label>Account Number</label><span><?php echo $data['account_no']; ?></span></div>
                    <div class="detail-item"><label>IFSC Code</label><span><?php echo $data['ifsc_code']; ?></span></div>

                    <div class="section-title">💰 Fees & Payment Details</div>
                    <div class="detail-item"><label>Standard Fees</label><span>₹<?php echo number_format($data['total_standard_fees'], 2); ?></span></div>
                    <div class="detail-item"><label>Discount Amount</label><span style="color: #e53e3e;">₹<?php echo number_format($data['discount_amount'], 2); ?></span></div>
                    <div class="detail-item"><label>Final Payable</label><span style="font-weight: 600;">₹<?php echo number_format($data['final_payable_fees'], 2); ?></span></div>
                    <div class="detail-item"><label>Remaining Balance</label><span class="status-red">₹<?php echo number_format($data['remaining_balance'], 2); ?></span></div>
                    <div class="detail-item"><label>Payment Mode</label><span><?php echo $data['payment_mode']; ?></span></div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="view_student.js"></script>
</body>
</html>