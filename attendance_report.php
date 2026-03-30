<?php
// Database connection aur authentication include kar rahe hain
include('db.php');

// URL se filter parameters pakad rahe hain, agar nahi hain toh current date/default set kar rahe hain
$month         = $_GET['month'] ?? date('m');         // Selected Month
$year          = $_GET['year'] ?? date('Y');           // Selected Year
$student_class = $_GET['student_class'] ?? '1st';      // Selected Class (Standard Name)
$section       = $_GET['section'] ?? 'A';              // Selected Section

// PHP ka built-in function use karke mahine ke total din nikal rahe hain
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Database se un bacchon ki list nikal rahe hain jo selected class aur section mein hain
$query = "SELECT scholar_no, student_name FROM newadmissions 
          WHERE student_class='$student_class' AND section='$section' 
          ORDER BY scholar_no ASC";
$students = mysqli_query($conn, $query);

// Dropdown ke liye classes ki array (Nursery se 10th tak)
$all_classes = ['Nursery', 'KG1', 'KG2', '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th','9th','10th'];
// Dropdown ke liye sections ki array
$all_sections = ['A', 'B', 'C', 'D'];
?>