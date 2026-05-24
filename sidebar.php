<?php 
// 1. Config file ko include kiya taaki BASE_URL mil sake
include('db.php');
include('auth.php');
// Note: auth.php ko main pages (admission.php) par hi rehne dena sahi hai
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<link rel="stylesheet" href="sidebar.css">

<div id="mySidebar" class="sidebar">
    <div class="sidebar-header">
        <br><br>
        <h2>🌈 WORKPLACE</h2>
    </div>
    
    <ul class="nav-list">
        <li><a href="dash.php"><i class="fa fa-chart-line"></i> Dashboard</a></li>
        <li><a href="index.php"><i class="fa fa-home"></i>
        Home Page</a></li>

        <li class="dropdown">
            <button class="dropdown-btn">
                <i class="fa fa-graduation-cap"></i> Students 
                <i class="fa fa-caret-down icon-right"></i>
            </button>
            <div class="dropdown-container">
                <a href="admission.php"><i class="fa fa-plus-circle"></i> New Admission</a>
                <a href="attendance_select.php"><i class="fa fa-calendar-check"></i> Take Attendance</a>
                <a href="monthly_report.php"><i class="fa fa-file-invoice"></i> Monthly Sheet</a>
                <a href="view_student.php"><i class="fa fa-users"></i> View Students</a>
                <a href="promotion.php"> Promotion page </a>
            </div>
        </li>

        <li class="dropdown">
            <button class="dropdown-btn">
                <i class="fa fa-chalkboard-teacher"></i> Teachers 
                <i class="fa fa-caret-down icon-right"></i>
            </button>
            <div class="dropdown-container">
                <a href="add_teacher.php"><i class="fa fa-user-plus"></i> Add Teacher</a>
                <a href="view_teachers.php"><i class="fa fa-id-card"></i> Teacher List</a>
                <a href="teacher_attendance.php"><i class="fa fa-clock"></i> Attendance</a>
            </div>
        </li>

        <li class="dropdown">
            <button class="dropdown-btn">
                <i class="fa fa-user-shield"></i> Administration 
                <i class="fa fa-caret-down icon-right"></i>
            </button>
            <div class="dropdown-container">
                <a href="signup.php"><i class="fa fa-plus"></i> Add New Member</a>
                <a href="view_enquiry.php"><i class="fa fa-phone"></i> Enquiries</a>
                <a href="change_password.php"><i class="fa fa-key"></i> Change Password</a>
            </div>
        </li>
    </ul>
</div>

<script src="sidebar.js"></script>
