<?php
session_start();
include("includes/config.php");

if (isset($_POST['submit'])) {

    $regno = trim($_POST['regno']);
    $password = trim($_POST['password']);
    $ip = $_SERVER['REMOTE_ADDR'];

    if ($regno == "" || $password == "") {
        $_SESSION['errmsg'] = "All fields are required";
        header("Location: index.php");
        exit();
    }

    // ✅ FIXED QUERY (NO id column)
    $stmt = $con->prepare("SELECT StudentRegno, password FROM students WHERE StudentRegno = ?");
    $stmt->bind_param("s", $regno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {

        $student = $result->fetch_assoc();

        // ✅ PASSWORD CHECK (HASH ONLY)
        if (password_verify($password, $student['password'])) {

            // ✅ SESSION SET
            $_SESSION['student_regno'] = $student['StudentRegno'];
$_SESSION['student_regno'] = $student['StudentRegno'];

// 🔥 ADD THIS (IMPORTANT)
$_SESSION['student_department'] = $student['department'];
$_SESSION['student_semester'] = $student['semester'];
$_SESSION['student_session'] = $student['session'];
$_SESSION['student_name'] = $student['studentName'];
            // ✅ SUCCESS LOG
            mysqli_query($con, "
                INSERT INTO login_logs (student_regno, ip_address, status)
                VALUES ('$regno', '$ip', 'Success')
            ");

            header("Location: dashboard.php");
            exit();

        } else {

            // ❌ FAILED LOG
            mysqli_query($con, "
                INSERT INTO login_logs (student_regno, ip_address, status)
                VALUES ('$regno', '$ip', 'Failed')
            ");

            $_SESSION['errmsg'] = "Invalid Password";
            header("Location: index.php");
            exit();
        }

    } else {

        // ❌ USER NOT FOUND LOG
        mysqli_query($con, "
            INSERT INTO login_logs (student_regno, ip_address, status)
            VALUES ('$regno', '$ip', 'Failed')
        ");

        $_SESSION['errmsg'] = "Invalid Registration Number";
        header("Location: index.php");
        exit();
    }
}
?>