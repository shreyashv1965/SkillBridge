<?php
require_once("includes/config.php");

if (!empty($_POST["regno"])) {

    $regno = trim($_POST["regno"]);

    // ✅ Prepared statement (SAFE)
    $stmt = mysqli_prepare($con, "SELECT StudentRegno FROM students WHERE StudentRegno = ?");
    mysqli_stmt_bind_param($stmt, "s", $regno);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $count = mysqli_stmt_num_rows($stmt);

    if ($count > 0) {

        echo "<span style='color:red'> Student with this Regno already registered.</span>";
        echo "<script>document.getElementById('submit').disabled = true;</script>";

    } else {

        echo "<span style='color:green'> Registration number available.</span>";
        echo "<script>document.getElementById('submit').disabled = false;</script>";
    }

    mysqli_stmt_close($stmt);
}
?>