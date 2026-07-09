<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

/* =========================
   DELETE STUDENT
========================= */
if (isset($_GET['del']) && isset($_GET['id'])) {
    $regno = mysqli_real_escape_string($con, $_GET['id']);

    mysqli_query($con, "DELETE FROM students WHERE StudentRegno='$regno'");
    echo "<script>alert('Student Deleted Successfully');</script>";
    echo "<script>window.location='manage-students.php';</script>";
}

/* =========================
   RESET PASSWORD
========================= */
if (isset($_GET['pass']) && isset($_GET['id'])) {
    $regno = mysqli_real_escape_string($con, $_GET['id']);
    $newPassword = password_hash("Test@123", PASSWORD_DEFAULT);

    mysqli_query($con, "UPDATE students SET password='$newPassword' WHERE StudentRegno='$regno'");
    echo "<script>alert('Password Reset to Test@123');</script>";
    echo "<script>window.location='manage-students.php';</script>";
}

/* =========================
   SEARCH
========================= */
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($con, $_GET['search']);
}

$query = "SELECT * FROM students 
          WHERE StudentRegno LIKE '%$search%' 
          OR studentName LIKE '%$search%' 
          ORDER BY creationdate DESC";

$sql = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin | Manage Students</title>

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
<div class="container">

<h2 class="page-head-line">Manage Students</h2>

<!-- SEARCH BOX -->
<form method="get" class="form-inline" style="margin-bottom:15px;">
    <input type="text" name="search" class="form-control"
           placeholder="Search by Reg No or Name"
           value="<?php echo htmlentities($search); ?>">

    <button class="btn btn-primary">Search</button>

    <a href="manage-students.php" class="btn btn-default">Reset</a>
</form>

<!-- TABLE -->
<div class="table-responsive table-bordered">

<table class="table">
<thead>
<tr>
    <th>#</th>
    <th>Reg No</th>
    <th>Name</th>
    <th>Pincode</th>
    <th>Reg Date</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php
$cnt = 1;

if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
?>

<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo htmlentities($row['StudentRegno']); ?></td>
    <td><?php echo htmlentities($row['studentName']); ?></td>
    <td><?php echo htmlentities($row['pincode']); ?></td>
    <td><?php echo htmlentities($row['creationdate']); ?></td>
    <td>

        <a href="edit-student-profile.php?id=<?php echo $row['StudentRegno']; ?>">
            <button class="btn btn-primary btn-sm">Edit</button>
        </a>

        <a href="manage-students.php?id=<?php echo $row['StudentRegno']; ?>&del=1"
           onclick="return confirm('Delete this student?');">
            <button class="btn btn-danger btn-sm">Delete</button>
        </a>

        <a href="manage-students.php?id=<?php echo $row['StudentRegno']; ?>&pass=1"
           onclick="return confirm('Reset password to Test@123?');">
            <button class="btn btn-warning btn-sm">Reset</button>
        </a>

    </td>
</tr>

<?php
    }
} else {
    echo "<tr><td colspan='6' style='text-align:center;'>No students found</td></tr>";
}
?>

</tbody>
</table>

</div>

</div>
</div>

<?php include('includes/footer.php'); ?>

<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>

</body>
</html>