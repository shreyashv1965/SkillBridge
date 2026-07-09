<?php
session_start();
require_once('includes/config.php');

/* ✅ ADMIN SESSION CHECK (ONLY ONE SYSTEM) */
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enroll History</title>

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>

<body>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
<div class="container">

<h1 class="page-head-line">Enroll History</h1>

<div class="panel panel-default">
<div class="panel-heading">Enroll History</div>

<div class="panel-body">
<div class="table-responsive table-bordered">

<table class="table table-striped">

<thead>
<tr>
    <th>#</th>
    <th>Student Name</th>
    <th>Student Reg No</th>
    <th>Course Name</th>
    <th>Department</th>
    <th>Semester</th>
    <th>Enrollment Date</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php
$sql = mysqli_query($con, "
    SELECT 
        ce.course AS cid,
        c.courseName AS courname,
        d.department AS dept,
        sem.semester AS sem,
        ce.enrollDate AS edate,
        s.studentName AS sname,
        s.StudentRegno AS sregno
    FROM courseenrolls ce
    JOIN course c ON c.id = ce.course
    JOIN department d ON d.id = ce.department
    JOIN semester sem ON sem.id = ce.semester
    JOIN students s ON s.StudentRegno = ce.studentRegno
");

if (!$sql) {
    die("Query Error: " . mysqli_error($con));
}

$cnt = 1;
while ($row = mysqli_fetch_assoc($sql)) {
?>

<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo htmlentities($row['sname']); ?></td>
    <td><?php echo htmlentities($row['sregno']); ?></td>
    <td><?php echo htmlentities($row['courname']); ?></td>
    <td><?php echo htmlentities($row['dept']); ?></td>
    <td><?php echo htmlentities($row['sem']); ?></td>
    <td><?php echo htmlentities($row['edate']); ?></td>
    <td>
        <a href="print.php?id=<?php echo $row['cid']; ?>" target="_blank">
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

<?php include('includes/footer.php'); ?>

<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>

</body>
</html>