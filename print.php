<?php
session_start();
include('includes/config.php');

/* ✅ FIXED SESSION CHECK */
if (!isset($_SESSION['student_regno'])) {
    header("Location: index.php");
    exit();
}

$studentRegno = $_SESSION['student_regno'];
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Course Enrollment Print</title>

    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:20px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0,0,0,.15);
        font-size:16px;
        font-family:Arial;
    }
    table{
        width:100%;
    }
    td{
        padding:8px;
    }
    .heading{
        background:#eee;
        font-weight:bold;
    }

    @media print {
        button {
            display:none;
        }
    }
    </style>
</head>

<body>

<div class="invoice-box">

    <!-- LOGO ADDED -->
    <div style="text-align:center; margin-bottom:20px;">

        <img src="assets/img/logo.png"
             alt="SkillBridge Logo"
             width="100">

        <h2>SkillBridge</h2>

        <p>Online Course Registration System</p>

        <hr>

    </div>

<?php
$cid = intval($_GET['id']);

/* ✅ FIXED QUERY (course instead of courseId) */
$sql = mysqli_query($con, "
SELECT 
    c.courseName,
    c.courseCode,
    c.courseUnit,
    ce.enrollDate,
    s.studentName,
    s.studentPhoto,
    s.cgpa
FROM courseenrolls ce
JOIN course c ON c.id = ce.course
JOIN students s ON s.StudentRegno = ce.studentRegno
WHERE ce.studentRegno='$studentRegno' AND ce.course='$cid'
");

if (!$sql || mysqli_num_rows($sql) == 0) {
    echo "<h3>No data found</h3>";
    exit();
}

$row = mysqli_fetch_assoc($sql);
?>

<h2>Enrollment Details</h2>

<hr>

<p><b>Student:</b> <?php echo $row['studentName']; ?></p>
<p><b>Reg No:</b> <?php echo $studentRegno; ?></p>
<p><b>Enroll Date:</b> <?php echo $row['enrollDate']; ?></p>

<hr>

<h3>Course Details</h3>

<p><b>Course Code:</b> <?php echo $row['courseCode']; ?></p>
<p><b>Course Name:</b> <?php echo $row['courseName']; ?></p>
<p><b>Units:</b> <?php echo $row['courseUnit']; ?></p>

<hr>

<button onclick="window.print()" style="padding:10px 20px;">
    Print
</button>

</div>

</body>
</html>