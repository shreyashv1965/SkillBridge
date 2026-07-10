<?php
session_start();
include("includes/config.php");

/* PROTECT PAGE */
if (!isset($_SESSION['student_regno']) || $_SESSION['student_regno'] == "") {
    header("Location: index.php");
    exit();
}

$regno = $_SESSION['student_regno'];


$lastLoginQuery = mysqli_query($con, "
    SELECT login_time, ip_address 
    FROM login_logs 
    WHERE student_regno='$regno' AND status='Success'
    ORDER BY login_time DESC 
    LIMIT 1
");

$lastLogin = mysqli_fetch_assoc($lastLoginQuery);
/* GET STUDENT */
$queryStudent = mysqli_query($con,
    "SELECT * FROM students WHERE StudentRegno='$regno'"
);

$student = mysqli_fetch_assoc($queryStudent);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- CSS (correct path) -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include('includes/header.php'); ?>

<section class="menu-section">
<div class="container">
<ul class="nav navbar-nav navbar-right">

<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="enroll.php">Enroll</a></li>
<li><a href="enroll-history.php">My Courses</a></li>

<li><a href="logout.php">Logout</a></li>

</ul>
</div>
</section>

<div class="container">

<h2>Welcome, <?php echo $student['studentName']; ?></h2>



<div class="alert alert-info">

<div class="alert alert-success">
    <h4>Last Login Details</h4>

    <?php if ($lastLogin) { ?>
        <p><b>Last Login Time:</b> <?php echo $lastLogin['login_time']; ?></p>
        <p><b>IP Address:</b> <?php echo $lastLogin['ip_address']; ?></p>
    <?php } else { ?>
        <p>No login history found.</p>
    <?php } ?>
</div>
    <p><b>Reg No:</b> <?php echo $student['StudentRegno']; ?></p>
    <p><b>Session:</b> <?php echo $student['session']; ?></p>
    <p><b>Department:</b> <?php echo $student['department']; ?></p>
    <p><b>Semester:</b> <?php echo $student['semester']; ?></p>

</div>

<hr>

<h3>Enrolled Courses</h3>

<table class="table table-bordered">
<thead>
<tr>
    <th>#</th>
    <th>Course Code</th>
    <th>Course Name</th>
    <th>Unit</th>
    <th>Enroll Date</th>
</tr>
</thead>

<tbody>

<?php
$query = mysqli_query($con,"
    SELECT c.courseCode, c.courseName, c.courseUnit, e.enrollDate
    FROM courseenrolls e
    JOIN course c ON e.course = c.id
    WHERE e.studentRegno='$regno'
");

if (!$query) {
    echo "<tr><td colspan='5'>Query Error: " . mysqli_error($con) . "</td></tr>";
} else {

    $cnt = 1;

    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo $row['courseCode']; ?></td>
    <td><?php echo $row['courseName']; ?></td>
    <td><?php echo $row['courseUnit']; ?></td>
    <td><?php echo $row['enrollDate']; ?></td>
</tr>

<?php
        }

    } else {
        echo "<tr><td colspan='5'>No courses enrolled</td></tr>";
    }
}
?>

</tbody>
</table>

</div>

</body>
</html>

<?php include('includes/simple-footer.php'); ?>