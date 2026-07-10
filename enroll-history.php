<?php
session_start();
require_once('includes/config.php');

/* ✅ ACCESS CONTROL */
if (!isset($_SESSION['student_regno'])) {
    header("Location: index.php");
    exit();
}

$studentRegno = mysqli_real_escape_string($con, $_SESSION['student_regno']);
?>

<?php include('includes/header.php'); ?>

<!-- MENU -->
<section class="menu-section">
    <div class="container">
        <ul class="nav navbar-nav navbar-right">
           
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</section>

<!-- CONTENT -->
<div class="content-wrapper">
<div class="container">

<h1 class="page-head-line">Enroll History</h1>

<div class="panel panel-default">
<div class="panel-heading">Enroll History</div>

<div class="panel-body">

<div class="table-responsive">
<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>#</th>
    <th>Course Name</th>
    <th>Enrollment Date</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php
$sql = mysqli_query($con, "
    SELECT 
        ce.id,
        ce.course,
        c.courseName,
        ce.enrollDate
    FROM courseenrolls ce
    JOIN course c ON c.id = ce.course
    WHERE ce.studentRegno = '$studentRegno'
    ORDER BY ce.enrollDate DESC
");

if (!$sql) {
    die("Query Error: " . mysqli_error($con));
}

$cnt = 1;

while ($row = mysqli_fetch_assoc($sql)) {

   $printId = $row['course']; // ✅ safe assignment
?>

<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo htmlentities($row['courseName']); ?></td>
    <td><?php echo htmlentities($row['enrollDate']); ?></td>
    <td>
        <a href="print.php?id=<?php echo $printId; ?>" target="_blank">
            <button class="btn btn-primary btn-sm">
                <i class="fa fa-print"></i> Print
            </button>
        </a>
    </td>
</tr>

<?php } ?>

</tbody>
</table>
</div>

</div>
</div>

</div>
</div>

<?php include('includes/simple-footer.php'); ?>