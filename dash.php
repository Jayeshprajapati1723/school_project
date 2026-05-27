<?php
// 1. Config, DB aur Auth ko include karne ka SAHI tarika
include('db.php');
include('auth.php');

// 2. Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 3. Layout Components (Headers aur Sidebar)
$has_sidebar = true;
include('header.php');
include('sidebar.php');

// ... baki aapka logic (search, filters, table) ...

// Sanitize and handle all 7 filters
$search    = mysqli_real_escape_string($conn, $_GET['search'] ?? '');
$f_class   = mysqli_real_escape_string($conn, $_GET['f_class'] ?? '');
$f_section = mysqli_real_escape_string($conn, $_GET['f_section'] ?? '');
$f_gender  = mysqli_real_escape_string($conn, $_GET['f_gender'] ?? '');
$f_cat     = mysqli_real_escape_string($conn, $_GET['f_cat'] ?? '');
$f_relig   = mysqli_real_escape_string($conn, $_GET['f_relig'] ?? '');
$f_pay     = mysqli_real_escape_string($conn, $_GET['f_pay'] ?? '');

// Construct Dynamic SQL Where Clause
$where = " WHERE 1=1";
if (!empty($search)) {
    $where .= " AND (student_name LIKE '%$search%' OR scholar_no LIKE '%$search%' OR aadhar_no LIKE '%$search%')";
}
if (!empty($f_class)) {
    $where .= " AND student_class = '$f_class'";
}
if (!empty($f_section)) {
    $where .= " AND section = '$f_section'";
}
if (!empty($f_gender)) {
    $where .= " AND gender = '$f_gender'";
}
if (!empty($f_cat)) {
    $where .= " AND category = '$f_cat'";
}
if (!empty($f_relig)) {
    $where .= " AND religion = '$f_relig'";
}
if (!empty($f_pay)) {
    $where .= " AND payment_mode = '$f_pay'";
}
$curr_session = mysqli_real_escape_string($conn, $_GET['curr_session'] ?? '');
if (!empty($curr_session)) {
    $where .= " AND session = '$curr_session'";
}

$status = mysqli_real_escape_string($conn, $_GET['STATUS'] ??'');
if ($status) {
    $where .= " AND STATUS = '$status'";
}
// Execute Final Data Query
// new admissionn table 

$sql = "SELECT * FROM newadmissions $where ORDER BY scholar_no DESC";

$result = mysqli_query($conn, $sql);

// Calculate Dashboard Statistics
$total_count = mysqli_num_rows($result);

// New Non-Confidential Stat: Total Active Classes
$class_query = mysqli_query($conn, "SELECT COUNT(DISTINCT class_name) as total_classes FROM fees_master");
$class_data = mysqli_fetch_assoc($class_query);
$total_classes = $class_data['total_classes'] ?? 0;
?>

<link rel="stylesheet" href="dash.css">

<div id="main">
    <div class="dashboard-content">

        <div class="dash-header">
            <h1>📊 Dashboard Overview</h1>
            <div class="header-actions">
                <a href="backup/full_backup_modular.php" class="btn-backup">
                    <i class="fa fa-database"></i> Backup Data
                </a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card blue-border">
                <h3>Total Students (Filtered)</h3>
                <p><?= $total_count ?></p>
            </div>
            <div class="stat-card green-border">
                <h3>Active Classes</h3>
                <p><?= $total_classes ?></p>
            </div>
        </div>

        <div class="filter-section">
            <h3>🔍 Filter Records</h3>
            <form method="GET" class="filter-form">
                <select id="curr_session"
                    name="curr_session" >
                    <option value="">--SESSION--</option>
                    <option value="2026-27">2026-27</option>
                    <option value="2027-28">2027-28</option>
                    <option value="2028-29">2028-29</option>
                </select>

                <select name="STATUS">
                    <option value="">--Status--</option>
                    <option value="Active">Active</option>
                    <option value="Inactive"> Inactive</option>
                    <option value="TC">TC</option>
                </select>

                <input type="text" name="search" placeholder="Name/ID/Aadhar" value="<?= htmlspecialchars($search) ?>">

                <select name="f_class">
                    <option value="">-- Select Class --</option>
                    <?php
                    $student_class = isset($data['student_class']) ? $data['student_class'] : '';

                    $all_classes = ['Nursery', 'KG-1', 'KG-2', '1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th'];

                    foreach ($all_classes as $cls) {
                        // Yahan maine variable sahi kar diya hai ($student_class)
                        $selected = ($student_class == $cls) ? 'selected' : '';
                        echo "<option value='$cls' $selected>$cls</option>";
                    }
                    ?>
                </select>

                <select name="f_section">
                    <option value="">Section</option>
                    <option value="A" <?= ($f_section == 'A' ? 'selected' : '') ?>>A</option>
                    <option value="B" <?= ($f_section == 'B' ? 'selected' : '') ?>>B</option>
                    <option value="C" <?= ($f_section == 'C' ? 'selected' : '') ?>>C</option>
                    <option value="D" <?= ($f_section == 'D' ? 'selected' : '') ?>>D</option>
                </select>

                <select name="f_gender">
                    <option value="">Gender</option>
                    <option value="Male" <?= ($f_gender == 'Male' ? 'selected' : '') ?>>Male</option>
                    <option value="Female" <?= ($f_gender == 'Female' ? 'selected' : '') ?>>Female</option>
                </select>

                <select name="f_cat">
                    <option value="">Category</option>
                    <option value="GEN" <?= ($f_cat == 'GEN' ? 'selected' : '') ?>>GEN</option>
                    <option value="OBC" <?= ($f_cat == 'OBC' ? 'selected' : '') ?>>OBC</option>
                    <option value="SC" <?= ($f_cat == 'SC' ? 'selected' : '') ?>>SC</option>
                    <option value="ST" <?= ($f_cat == 'ST' ? 'selected' : '') ?>>ST</option>
                </select>

                <select name="f_relig">
                    <option value="">Religion</option>
                    <option value="Hindu" <?= ($f_relig == 'Hindu' ? 'selected' : '') ?>>Hindu</option>
                    <option value="Muslim" <?= ($f_relig == 'Muslim' ? 'selected' : '') ?>>Muslim</option>
                </select>

                <select name="f_pay">
                    <option value="">Payment</option>
                    <option value="Cash" <?= ($f_pay == 'Cash' ? 'selected' : '') ?>>Cash</option>
                    <option value="Online" <?= ($f_pay == 'Online' ? 'selected' : '') ?>>Online</option>
                </select>


                <div class="form-actions">
                    <button type="submit" class="btn-apply">Apply</button>
                    <!-- //filechanges -->
                    <a href="dash.php" class="btn-reset">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th><input id="allcheckbox" type="checkbox"></th>
                        <th>SESSION</th>
                        <TH>STATUS</TH>
                        <th>Scholar ID</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Profile</th>
                        <th>Payments</th>
                        <th>Fess History</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <!-- yha dataselector mtlb h ki indiviucla box  -->
                                <td><input class="dataselector" type="checkbox"> </td>
                              <td> <?= $row['session'] ?> </td>
                              <td> <?= $row['STATUS'] ?></td>
                                <td class="bold-text"><?= $row['scholar_no'] ?></td>
                                <td><?= strtoupper($row['student_name']) ?></td>
                                <td><span class="class-badge"><?= $row['student_class'] ?></span></td>
                                <td><span
                                        class="section"><?= $row['section'] ?></span></td>
                                <td><a href="view_student.php?scholar_no=<?= $row['scholar_no'] ?>" class="view-link">View</a></td>
                                <td><a href="fees.php?scholar_no=<?= $row['scholar_no'] ?>" class="view-link">fees</a></td>
                                <td><a href="feeshist.php?scholar_no=<?= $row['scholar_no'] ?>" class="view-link">History</a></td>
                            </tr>

                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <div>
                                <td colspan="4" class="not">No matching records found.</td>
                            </div>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        

        <!-- <p class="footer-credit">Developed by **JS Coder**</p> -->
        <script src="dash.js"></script>
    </div>
</div>

<?php 
echo $sql ;
exit ;
include('footer.php'); ?>