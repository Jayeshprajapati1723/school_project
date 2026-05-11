<?php
/* DATE: 2026-03-23
   REASON: Fixed "Undefined Array Key" by matching $_POST keys with admission.php input names.
   CHANGE: Corrected ac_holdername and mobile variable mapping.
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

// echo "<h1>Testing Save.php...</h1>"; 
// print_r($_POST); // Isse pata chalega ki form se data aa bhi raha hai ya nahi
// die(); // Yahan code ruk jayega
include('db.php');
include('auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Basic Info
    $scholar_no     = mysqli_real_escape_string($conn, $_POST['scholar_no']);
    $session    = mysqli_real_escape_string($conn, $_POST['session']);
    $admission_date = $_POST['admission_date'];
    $admission_type = mysqli_real_escape_string($conn, $_POST['admission_type']);
    $student_name   = strtoupper(mysqli_real_escape_string($conn, $_POST['student_name']));
    $dob_figure  = $_POST['dob_fig'];
    $dob_words  = mysqli_real_escape_string($conn, $_POST['dob_words']);
    $gender = $_POST['gender'];

    // Parents
    $father_name  = mysqli_real_escape_string($conn, $_POST['father_name']);
    $f_qual  = mysqli_real_escape_string($conn, $_POST['f_qualification']);
    $f_occ  = mysqli_real_escape_string($conn, $_POST['f_occupation']);
    $mother_name   = mysqli_real_escape_string($conn, $_POST['mother_name']);
    $m_qual  = mysqli_real_escape_string($conn, $_POST['m_qualification']);
    $m_occ   = mysqli_real_escape_string($conn, $_POST['m_occupation']);

    // Contact Numbers
    $mother_mobile  = mysqli_real_escape_string($conn, $_POST['mother_mobile']);
    $father_mobile  = mysqli_real_escape_string($conn, $_POST['father_mobile']);
    $alt_mobile     = mysqli_real_escape_string($conn, $_POST['alt_mobile']);

    // Guardian
    $g_name         = mysqli_real_escape_string($conn, $_POST['guardian_name']);
    $g_relation     = mysqli_real_escape_string($conn, $_POST['guardian_relation']);
    $g_mobile       = mysqli_real_escape_string($conn, $_POST['guardian_mobile']);
    $g_alt_mobile   = mysqli_real_escape_string($conn, $_POST['guardian_alt_mobile']);

    // Addresses
    $perm_address   = mysqli_real_escape_string($conn, $_POST['permanent_address']);
    $curr_address   = mysqli_real_escape_string($conn, $_POST['current_address']);

    // IDs & Social fix
    $religion  = mysqli_real_escape_string($conn, $_POST['religion']);
    $sssm_id   = mysqli_real_escape_string($conn, $_POST['sssm_id']);
    $family_id = mysqli_real_escape_string($conn, $_POST['family_id']);
    $aadhar_no = mysqli_real_escape_string($conn, $_POST['aadhar_no']);
    $category  = mysqli_real_escape_string($conn, $_POST['category']);
    $caste          = mysqli_real_escape_string($conn, $_POST['caste']);

    // Bank Details fix
    $ac_holdername  = mysqli_real_escape_string($conn, $_POST['ac_holdername']);
    $bank_name  = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $account_no = mysqli_real_escape_string($conn, $_POST['account_no']);
    $ifsc_code  = mysqli_real_escape_string($conn, $_POST['ifsc_code']);



    // Academic & Finance
    $student_class  = mysqli_real_escape_string($conn, $_POST['student_class']);
    $section        = mysqli_real_escape_string($conn, $_POST['section']);
    $payment_mode   = mysqli_real_escape_string($conn, $_POST['payment_mode']);
    $std_fees       = (float)$_POST['total_standard_fees'];
    $discount       = (float)$_POST['discount_amount'];
    $final_fees     = (float)$_POST['final_payable_fees'];
    $remaining      = $final_fees;

    // Photo
    $photo_path = "default.png";
    if (isset($_FILES['s_photo']) && $_FILES['s_photo']['error'] == 0) {
        $dir = "uploads/students/";
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $file_name = "STU_" . $scholar_no . "_" . time() . "." . pathinfo($_FILES['s_photo']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['s_photo']['tmp_name'], $dir . $file_name);
        $photo_path = $file_name;
    }

    $sql = "INSERT INTO newadmissions (
        scholar_no, session ,admission_date,admission_type, student_name, dob_figure, dob_words, gender, 
        father_name, f_qualification, f_occupation, mother_name, m_qualification, m_occupation, 
        mother_mobile, father_mobile, alt_mobile, guardian_name, guardian_relation, 
        guardian_mobile, guardian_alt_mobile, permanent_address, current_address, 
        religion, sssm_id, family_id, aadhar_no, category, caste, ac_holdername, 
        bank_name, account_no, ifsc_code, student_class, section, payment_mode, 
        total_standard_fees, discount_amount, final_payable_fees, remaining_balance, photo_path
    ) VALUES (
        '$scholar_no','$session' ,'$admission_date',
         '$admission_type', '$student_name', '$dob_figure', '$dob_words', '$gender', 
        '$father_name', '$f_qual', '$f_occ', '$mother_name', '$m_qual', '$m_occ', 
        '$mother_mobile', '$father_mobile', '$alt_mobile', '$g_name', '$g_relation', 
        '$g_mobile', '$g_alt_mobile', '$perm_address', '$curr_address', 
        '$religion', '$sssm_id', '$family_id', '$aadhar_no', '$category', '$caste', '$ac_holdername', 
        '$bank_name', '$account_no', '$ifsc_code', '$student_class', '$section', '$payment_mode', 
        '$std_fees', '$discount', '$final_fees', '$remaining', '$photo_path'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Success!'); window.location.href='dash.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
