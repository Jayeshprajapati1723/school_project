<?php 
//session verify krna h jisse koi login h ya nhi chexk kr ske 
include('auth.php');
// 1. Database aur Layout Files include (Sahi Order)
include('db.php'); 
$has_sidebar = true; // Menu button dikhane ke liye
include('header.php'); 
include('sidebar.php'); 
?>

<style>
    .form-container { 
        background: white; 
        max-width: 900px; 
        margin: 20px auto; 
        padding: 30px; 
        border-radius: 15px; 
        box-shadow: 0 5px 25px rgba(0,0,0,0.1); 
    }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .form-group { display: flex; flex-direction: column; }
    label { font-weight: 600; margin-bottom: 5px; color: #333; }
    input, select, textarea { padding: 10px; border: 1px solid #ddd; border-radius: 6px; }
    .full-width { grid-column: span 2; }
    .btn-submit { 
        background: #1a237e; 
        color: white; 
        padding: 15px; 
        border: none; 
        border-radius: 8px; 
        cursor: pointer; 
        font-size: 16px; 
        margin-top: 20px; 
        transition: 0.3s;
    }
    .btn-submit:hover { background: #b21f1f; }
    h2 { color: #1a237e; border-bottom: 2px solid #1a237e; padding-bottom: 10px; margin-bottom: 20px; }

    @media screen and (max-width: 600px) {
        .form-grid { grid-template-columns: 1fr; }
        .full-width { grid-column: span 1; }
    }
</style>

<div id="main">
    <div class="form-container">
        <h2>👨‍🏫 Teacher Registration Form</h2>
        <form action="save_teacher.php" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Employee ID / Code</label>
                    <input type="text" name="employee_id" placeholder="TCH-2026-01" required>
                </div>
                <div class="form-group">
                    <label>Serial No.</label>
                    <input type="number" name="serial_no" placeholder="101">
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="teacher_name" required>
                </div>
                <div class="form-group">
                    <label>Father's Name</label>
                    <input type="text" name="father_name">
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile_no" required>
                </div>
                <div class="form-group">
                    <label>Email ID</label>
                    <input type="email" name="email">
                </div>
                <div class="form-group">
                    <label>Qualification</label>
                    <input type="text" name="qualification" placeholder="B.Ed, M.Sc, etc.">
                </div>
                <div class="form-group">
                    <label>Designation</label>
                    <select name="designation">
                        <option value="PRT">PRT (Primary)</option>
                        <option value="TGT">TGT (Secondary)</option>
                        <option value="PGT">PGT (Higher Secondary)</option>
                        <option value="Principal">Principal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date of Joining</label>
                    <input type="date" name="date_of_joining">
                </div>
                <div class="form-group">
                    <label>Monthly Salary</label>
                    <input type="number" name="salary">
                </div>
                <div class="form-group full-width">
                    <label>Residential Address</label>
                    <textarea name="address" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" name="save_teacher" class="btn-submit">Add Teacher to System</button>
        </form>
    </div>
</div>

<?php 
// 4. Footer include (Isme JS toggle function hai)
include('footer.php'); 
?>