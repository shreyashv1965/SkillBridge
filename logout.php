<?php
session_start();
include("includes/config.php");

/* Get logged-in user */
if (isset($_SESSION['student_regno']) && $_SESSION['student_regno'] != "") {

    $uid = $_SESSION['student_regno'];

    date_default_timezone_set('Asia/Kolkata');
    $ldate = date('Y-m-d H:i:s');

    /* Update logout time */
    mysqli_query($con,
        "UPDATE userlog 
         SET logout='$ldate' 
         WHERE studentRegno='$uid' 
         ORDER BY id DESC LIMIT 1"
    );
}

/* Destroy session */
session_unset();
session_destroy();

/* Redirect */
header("Location: index.php");
exit();
?>