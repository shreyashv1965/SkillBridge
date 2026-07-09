<?php
session_start();
require_once('includes/config.php');

/* ✅ SESSION CHECK */
if (!isset($_SESSION['admin_id'])) {
    header('location:index.php');
    exit();
}

/* ✅ VALIDATE ID */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('location:course.php');
    exit();
}

$id = intval($_GET['id']);
$msg = "";

date_default_timezone_set('Asia/Kolkata');
$currentTime = date('Y-m-d H:i:s');

/* ✅ UPDATE COURSE */
if (isset($_POST['submit'])) {

    $coursecode = trim($_POST['coursecode']);
    $coursename = trim($_POST['coursename']);
    $courseunit = intval($_POST['courseunit']);
    $seatlimit  = intval($_POST['seatlimit']);

    if ($seatlimit <= 0) {
        $msg = "Seat limit must be greater than 0";
    } else {

        $stmt = mysqli_prepare($con, "
            UPDATE course 
            SET courseCode=?, courseName=?, courseUnit=?, noofSeats=?, updationDate=? 
            WHERE id=?
        ");

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssiisi", 
                $coursecode, $coursename, $courseunit, $seatlimit, $currentTime, $id
            );

            if (mysqli_stmt_execute($stmt)) {
                $msg = "Course updated successfully!";
            } else {
                $msg = "Error updating course!";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

/* ✅ FETCH COURSE */
$stmt = mysqli_prepare($con, "SELECT * FROM course WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
?>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
<div class="container">

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Edit Course</h1>
    </div>
</div>

<!-- MESSAGE -->
<?php if ($msg != "") { ?>
<div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<?php if ($row) { ?>

<div class="panel panel-default">
<div class="panel-heading">Update Course</div>

<div class="panel-body">

<p><b>Last Updated:</b> <?php echo htmlentities($row['updationDate']); ?></p>

<form method="post">

<div class="form-group">
    <label>Course Code</label>
    <input type="text" name="coursecode" class="form-control"
           value="<?php echo htmlentities($row['courseCode']); ?>" required>
</div>

<div class="form-group">
    <label>Course Name</label>
    <input type="text" name="coursename" class="form-control"
           value="<?php echo htmlentities($row['courseName']); ?>" required>
</div>

<div class="form-group">
    <label>Course Unit</label>
    <input type="number" name="courseunit" class="form-control"
           value="<?php echo htmlentities($row['courseUnit']); ?>" required>
</div>

<div class="form-group">
    <label>Seat Limit</label>
    <input type="number" name="seatlimit" class="form-control"
           value="<?php echo htmlentities($row['noofSeats']); ?>" required>
</div>

<button type="submit" name="submit" class="btn btn-primary">
    Update Course
</button>

<a href="course.php" class="btn btn-default">Back</a>

</form>

</div>
</div>

<?php } else { ?>

<div class="alert alert-danger">Course not found</div>

<?php } ?>

</div>
</div>

<?php include('includes/footer.php'); ?>