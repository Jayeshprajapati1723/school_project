<?php
/**
 * Component: Automated Modular Database Backup
 * Author: JS Coder
 * Description: Exports every table into individual CSV files organized by date.
 */

include('../db.php');
include('../auth.php');
// this is add for the india time ist
date_default_timezone_set('Asia/Kolkata');
// 1. Create a unique directory for today's backup
$backup_dir = 'backup/' . date('d-m-Y_H-i-s') . '/';// utc time zone jo ki ist se 5 hrs piche h 

if (!is_dir($backup_dir)) {
    mkdir($backup_dir, 0777, true);
}

// 2. Fetch all table names from the current database
$tables = array();
$result = mysqli_query($conn, "SHOW TABLES");

while($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// 3. Loop through each table and generate a CSV file
foreach($tables as $table) {
    $file_path = $backup_dir . $table . ".csv";
    $file = fopen($file_path, 'w');

    // Fetch column headers for the current table
    $columns = mysqli_query($conn, "SHOW COLUMNS FROM $table");
    $header = array();
    while($col = mysqli_fetch_assoc($columns)) {
        $header[] = $col['Field'];
    }
    fputcsv($file, $header);

    // Fetch all data rows for the current table
    $data = mysqli_query($conn, "SELECT * FROM $table");
    while($row = mysqli_fetch_assoc($data)) {
        fputcsv($file, $row);
    }

    fclose($file);
}

// 4. Redirect back to dashboard with a success status
header("Location: ../dash.php?backup=success&path=" . urlencode($backup_dir));
exit();
?>
