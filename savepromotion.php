<?php
include('db.php');
include('auth.php');
$newclasses = "";
$new_total_standard_fees = 0;
$old_session = $_POST['oldsession'];
$new_session = $_POST['newsession'];
$date = $_POST['date'];
$teacher_name = mysqli_real_escape_string($conn, $_POST['teacher_name']);

// hme syntax k case sensitive ni dekhna h 
$insert_querry = "insert into    promotion_records (old_session,new_session,date_of_promotion,teacher_name) 
values('$old_session','$new_session','$date','$teacher_name') ";
//   INSERT INTO target_table (column1, column2, ...)
// SELECT column1, column2, ...
// FROM source_table
// [WHERE condition];   
// yha pr mene new or old class k array bna liya h phle old class se loop chalaya h or usse index nikala h or index m store kra liya or fir usse new class set kr rha hu me 
if (mysqli_query($conn, $insert_querry)) {

    // $oldclasses = ["Nursery","kg1","kg2","1st","2nd","3rd","4th","5th",'6th','7th','8th','9th'] ;
    
    $oldclasses = ["Nursery", "kg1", "kg2", "1st", "2nd", "3rd", "4th", "5th", '6th', '7th', '8th', '9th', '10th'];
    $newclass = 0;
$i = 0 ;
    for ($i = 11; $i >= 0; $i--) {
        $index  = $i + 1;
        $newclass = $oldclasses[$index];
        $fees_querry = "select standard_fees from fees_master where class_name = '$newclass' ";
        $fees_result = mysqli_query($conn, $fees_querry);
        $total_standard_fees = mysqli_fetch_assoc($fees_result);
$new_total_standard_fees = $total_standard_fees['standard_fees'] ;

        $new_q = "insert into newadmissions (scholar_no, session ,admission_date,admission_type, student_name, dob_figure, dob_words, gender, 
        father_name, f_qualification, f_occupation, mother_name, m_qualification, m_occupation, 
        mother_mobile, father_mobile, alt_mobile, guardian_name, guardian_relation, 
        guardian_mobile, guardian_alt_mobile, permanent_address, current_address, 
        religion, sssm_id, family_id, aadhar_no, category, caste, ac_holdername, 
        bank_name, account_no, ifsc_code, student_class, section, payment_mode, 
        total_standard_fees, discount_amount, final_payable_fees, remaining_balance, photo_path
    ) select
      scholar_no, '$new_session' ,admission_date,admission_type, student_name, dob_figure, dob_words, gender, 
        father_name, f_qualification, f_occupation, mother_name, m_qualification, m_occupation, 
        mother_mobile, father_mobile, alt_mobile, guardian_name, guardian_relation, 
        guardian_mobile, guardian_alt_mobile, permanent_address, current_address, 
        religion, sssm_id, family_id, aadhar_no, category, caste, ac_holdername, 
        bank_name, account_no, ifsc_code, '$newclass', section, payment_mode, 
        '$new_total_standard_fees', discount_amount, final_payable_fees, remaining_balance, photo_path
        from newadmissions where student_class= '$oldclasses[$i]' AND session= '$old_session' AND STATUS = 'active'";
  
        // if (mysqli_query($conn, $new_q)) {
        // } else {
        //     mysqli_error($conn);
        // }

    }
            $old_session = $new_session ;
        echo $old_session ;
    echo "<script>
    alert('sucessfully promoted now ::) ');
    window.location.href = 'dash.php';
    </script>";
} else {

    echo "<script>
    alert('ERROR OCCURED ');
    </script>";
    mysqli_error($conn);
}

?>