<?php
include('db.php');

// Standard Mappings (Matching your save.php/admission.php)
$student_class = $_GET['student_class'] ?? '1st';
$section       = $_GET['section'] ?? 'A';
$month         = $_GET['month'] ?? date('m');
$year          = $_GET['year'] ?? date('Y');

// Holidays List
$national_holidays = ['01-26', '08-15', '10-02'];

// Total days calculation
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Database Query with Standard Names
$students = mysqli_query($conn, "SELECT scholar_no, student_name FROM newadmissions WHERE student_class='$student_class' AND section='$section' ORDER BY scholar_no ASC");

// Standard dropdown arrays
$all_classes = ['Nursery', 'KG1', 'KG2', '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th'];
$all_sections = ['A', 'B', 'C', 'D'];

function is_holiday($d, $m, $y, $national_holidays) {
    $date_str = "$y-$m-" . sprintf("%02d", $d);
    $date_key = sprintf("%02d-%02d", $m, $d);
    $day_name = date('D', strtotime($date_str));
    return ($day_name == 'Sun' || in_array($date_key, $national_holidays));
}
?>
