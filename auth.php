<!-- authanticate page h ise wha include krna h jaha hme login k bad sare kam krne ho  -->
<?php
// Project Security: Session Validation
// session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>