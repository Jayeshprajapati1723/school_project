<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('auth.php');
include('db.php');
$has_sidebar = true;
include('header.php');
include('sidebar.php');
$sessionopt = ['session', '2026-27']; //ye array h option for session
// $query = "SELECT * FROM fees_master";
// $result = mysqli_query($conn, $query);
$date = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rainbow Kids | Digital Admission</title>
    <!-- <link rel="stylesheet" href="style.css">  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admission.css">
</head>

<body>

    <div class="main-container">
        <form action="saveadmission.php" method="POST" enctype="multipart/form-data">
            <h2 class="form-title">🌈 Rainbow Kids - Student Admission Form</h2>

            <div class="section">
                <div class="row">
                    <div class="col">
                        <label>1. Scholar No <span style="color:red;">*</span></label>
                        <input type="number" name="scholar_no" required>
                    </div>
                    <!-- ADD SESSINON AND ADMISSION DATE  -->
                    <div class="col">
                        <label>2. Session <span style="color:red;">*</span></label>
                        <select name="session" required>
                            <option value="<?= $sessionopt[0]  ?>" disabled><?= $sessionopt[0] ?></option>
                            <option value="<?= $sessionopt[1] ?>"><?= $sessionopt[1] ?></option>


                        </select>
                    </div>
                    <div class="col">
                        <label>2a. Admission date <span style="color:red;">*</span></label>
                        <input type="date" name="admission_date"
                            value="<?= $date ?>"
                            style="text-transform:uppercase;" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>2b. Student Name <span style="color:red;">*</span></label>
                        <input type="text" name="student_name" style="text-transform:uppercase;" required>
                    </div>
                    <div class="col">
                        <label>3. DOB (Figure) <span style="color:red;">*</span></label>
                        <input type="date" name="dob_fig"
                            id="dob_fig"
                            min="01-01-2000" max="01-01-3027"
                            onchange="convertDateToWords()"
                            required>
                    </div>
                    <div class="col">
                        <label>4. DOB (In Words)</label>
                        <input type="text" name="dob_words"
                            id="dob_words"
                            readonly placeholder="Auto-fills in words">
                    </div>
                    <div class="col">
                        <label>5. Gender <span style="color:red;">*</span></label>
                        <div class="radio-group">
                            <select name="gender" required placeholder="--SELECT GENGER--">
                                <option disabled>--SELECT GENGER--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="Transgender">Transgender</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>6. Father's Name <span style="color:red;">*</span></label>
                        <input type="text" name="father_name" required>
                    </div>
                    <div class="col">
                        <label>7. Father. Qualification <span style="color:red;"></span></label>
                        <input type="text" name="f_qualification">
                    </div>
                    <div class="col">
                        <label>8. Father. Occupation <span style="color:red;"></span></label>
                        <input type="text" name="f_occupation">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>9. Mother's Name <span style="color:red;">*</span></label>
                        <input type="text" name="mother_name" required>
                    </div>
                    <div class="col">
                        <label>10. Mother. Qualification <span style="color:red;"></span></label>
                        <input type="text" name="m_qualification">
                    </div>
                    <div class="col">
                        <label>11. Mother. Occupation <span style="color:red;"></span></label>
                        <input type="text" name="m_occupation">
                    </div>
                </div>

                <!-- some changes here mother no merge with father and alter colom -->
                <div class="row">
                    <div class="col">
                        <label>12. Father Mobile <span style="color:red;">*</span></label>
                        <input type="NUMBER" name="father_mobile" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10)" required>
                    </div>
                    <div class="col">
                        <label>13. Mother Mobile <span style="color:red;"></span></label>
                        <input type="NUMBER" name="mother_mobile" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10)">
                    </div>
                    <div class="row">

                        <div class="col">
                            <label>14. Whatsapp No <span style="color:red;"></span></label>
                            <input type="NUMBER" name="whatsapp_no" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10)">
                        </div>
                        <div class="col">
                            <label>15. Emergency No <span style="color:red;">*</span></label>
                            <input type="NUMBER" name="emergency_no" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10)" required>
                        </div>
                    </div>

                    <div class="col">
                        <label>16. Alternative Mobile <span style="color:red;"></span></label>
                        <input type="NUMBER" name="alt_mobile" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10)">
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>17. Guardian Name (If any)</label>
                            <input type="text" name="guardian_name" placeholder="Name of Guardian">
                        </div>
                        <div class="col">
                            <label>18. Relation with Student</label>
                            <select name="guardian_relation" class="modular-select">
                                <option value="">-- Select Relation --</option>
                                <option value="Grandfather">Grandfather</option>
                                <option value="Grandmother">Grandmother</option>
                                <option value="Uncle">Uncle</option>
                                <option value="Aunt">Aunt</option>
                                <option value="Brother">Brother</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>19. Guardian Mobile</label>
                            <input type="number" name="guardian_mobile" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10)" placeholder="guardian Contact">
                        </div>
                        <div class="col">
                            <label>20. Guardian Alternate Mobile</label>
                            <input type="number" name="guardian_alt_mobile" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10)" placeholder="Alternative Contact">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <label>21. Permanent Address <span style="color:red;">*</span></label>
                            <textarea name="permanent_address" id="perm_addr" rows="2" required oninput="syncAddress()"></textarea>
                        </div>

                        <div class="col">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 5px;">
                                <input type="checkbox" id="same_as_perm" onclick="syncAddress()" style="width: 18px; height: 18px; cursor: pointer;">
                                <label for="same_as_perm" style="margin-bottom: 0; cursor: pointer; font-weight: 600; color: #121213;">Same as Permanent Address</label>
                            </div>
                            <label>22. Current Address <span style="color:red;">*</span></label>
                            <textarea name="current_address" id="curr_addr" rows="2" required></textarea>
                        </div>
                    </div>
                    <!-- 
                <div class="col">
                    <label>13e. Permanent Address <span style="color:red;">*</span></label>
                    <textarea name="permanent_address" rows="1" required></textarea>
                </div>
                <div class="col">
                    <label>13f. Current Address <span style="color:red;">*</span></label>
                    <textarea name="current_address" rows="1" required></textarea>
                </div> -->

                    <div class="col">
                        <label>23 Religion <span style="color:red;">*</span></label>
                        <select name="religion" class="modular-select" required>
                            <option value="">-- Select --</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Muslim">Muslim</option>
                            <option value="Sikh">Sikh</option>
                            <option value="Christian">Christian</option>
                            <option value="Jain">Jain</option>
                            <option value="Buddhism">Buddhism</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>24.Student SSSM ID <span style="color:red;">*</span></label>
                        <input type="number" name="sssm_id" oninput="if(this.value.length > 9) this.value = this.value.slice(0, 9)" required>
                    </div>
                    <div class="col">
                        <label>25 Family ID <span style="color:red;">*</span></label>
                        <input type="number" name="family_id" oninput="if(this.value.length > 8) this.value = this.value.slice(0, 8)" required>
                    </div>
                    <div class="col">
                        <label>26. Aadhar Number <span style="color:red;">*</span></label>
                        <input type="number" name="aadhar_no" pattern="\d{12}" oninput="if(this.value.length > 12) this.value = this.value.slice(0, 12)" placeholder="XXXX-XXXX-XXXX">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>27 Category <span style="color:red;">*</span></label>
                        <select name="category" class="modular-select" required>
                            <option value="">-- Select --</option>
                            <option value="GEN">GENERAL</option>
                            <option value="OBC">OBC</option>
                            <option value="SC">SC</option>
                            <option value="ST">ST</option>
                            <option value="EWS">EWS</option>
                            <option value="EWS">DNT</option>

                        </select>
                    </div>
                    <div class="col">
                        <label>28. Caste <span style="color:red;">*</span></label>
                        <input type="text" name="caste" required>
                    </div>
                    <div class="col">
                        <label>29.Caste Certificate No</label>
                        <input type="text" name="caste_certificate_no" placeholder="eg RS/123/123/12313131">
                    </div>
                </div>

                <div class="row">
                    <!-- add now 23march 26 
                 add also add in the db -->
                    <div class="col">
                        <label>30. A/C Holder Name <span style="color:red;"></span></label>
                        <input type="text" name="ac_holdername" style="text-transform:uppercase;">
                    </div>
                    <div class="col">
                        <label>31. Bank Name <span style="color:red;"></span></label>
                        <input type="text" name="bank_name">
                    </div>
                    <div class="col">
                        <label>32. Account No <span style="color:red;"></span></label>
                        <input type="text" name="account_no">
                    </div>
                    <div class="col">
                        <label>33. IFSC Code <span style="color:red;"></span></label>
                        <input type="text" name="ifsc_code">
                    </div>
                </div>


                <div class="fees-container">
                    <h3 class="fees-header"> Fees Details (Auto-Calculated)</h3>
                    <div class="col">
                        <label><b>Admission Category (Quota) <span style="color:red;">*</span></b></label>
                        <select required name="admission_type">
                            <option>--SELECT TYPE OF ADMISSION--</option>
                            <option value="Normal">Normal</option>
                            <option value="RTE">RTE</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>23. Select Class *</label>
                            <select name="student_class" onchange=selectclass()        id="class_picker" class="fees-select" required>
                                <option >-- Choose Class --</option>
                                <?php $selectclass = ['Nursery', 'kg1', 'kg2', "1", '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th'];
                                $i = 0;
                                while ($selectclass[$i]) {
                                    echo  "<option value=$selectclass[$i]> $selectclass[$i]  </option>";
                                    $i++;
                                }


                                ?>

                            </select>

                        </div>
                        <div class="col">
                            <label>22. Section *</label>
                            <select name="section" class="fees-select" required>
                                <option value="A">Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                                <option value="D">Section D</option>
                                <option value="None">None</option>
                            </select>
                        </div>
                        <div class="col">
                                   <label>Standard fees </label>
                    <input readonly type="number"  id="standardfees" name="total_standard_fees">
                    

                        </div>
                    </div>
             
                    

                <!-- foto ko optional kiya h 24 3 26  -->
                <div class="col" style="text-align: center;">
                    <img id="imagePreview" src="#" alt="Preview" class="photo-preview">
                    <button type="submit" class="btn-save">Final Save Admission</button>
                </div>
            </div>
    </div>
    </form>
    </div>

    <script src="admission.js"></script>
</body>

</html>

<!-- /* Purani table structure ko reset karke naye sequence mein lana */
 
                    <div class="row" style="align-items: center;">
                        <div class="col">
                            <label>26. Upload Student Photo <span style="color:red;"></span></label>
                            <input type="file" name="s_photo" id="photoInput" accept="image/*" onchange="previewImage()">
                        </div>
// CREATE TABLE admissions_new (
//     scholar_no INT PRIMARY KEY,
//     admission_type ENUM('Normal', 'RTE') DEFAULT 'Normal',
//     student_name VARCHAR(255),
//     dob_figure DATE,
//     dob_words VARCHAR(255),
//     gender ENUM('Male', 'Female'),
//     father_name VARCHAR(255),
//     f_qualification VARCHAR(255),
//     f_occupation VARCHAR(255),
//     mother_name VARCHAR(255),
//     m_qualification VARCHAR(255),
//     m_occupation VARCHAR(255),
//     mother_mobile VARCHAR(15),
//     father_mobile VARCHAR(15),
//     alt_mobile VARCHAR(15),
//     guardian_name VARCHAR(255),
//     guardian_relation VARCHAR(100),
//     guardian_mobile VARCHAR(15),
//     guardian_alt_mobile VARCHAR(15),
//     permanent_address TEXT,
//     current_address TEXT,
//     religion VARCHAR(50),
//     sssm_id VARCHAR(15),
//     family_id VARCHAR(15),
//     aadhar_no VARCHAR(15),
//     category VARCHAR(20),
//     caste VARCHAR(100),
//     ac holder name also add in 23 3 2 6
//     bank_name VARCHAR(255),
//     account_no VARCHAR(50),
//     ifsc_code VARCHAR(20),
//     student_class VARCHAR(50),
//     section VARCHAR(10),
//     payment_mode VARCHAR(50),
//     total_standard_fees DECIMAL(10,2),
//     discount_amount DECIMAL(10,2),
//     final_payable_fees DECIMAL(10,2),
//     remaining_balance DECIMAL(10,2),
//     photo_path VARCHAR(255)
// );

                            < <div class="col">
                                <label>24. Discount Amount (₹)</label>
                                <input type="number" id="discount_box" name="discount_amount" value="0" oninput="calculateFinal()" readonly>
                            </div> -->
<!-- <div class="col">
                                <label>25. Payment Mode <span style="color:red;">*</span></label>
                                <select name="payment_mode" class="fees-select" required>
                                    <option value="Full">Full Payment</option>
                                    <option value="Installment">Installment</option>
                                    <option value="Cash">Cash</option>
                            <option value="Online">Online</option> -->
<!-- </select>
                            </div> -->