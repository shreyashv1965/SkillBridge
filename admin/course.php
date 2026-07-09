<?php
session_start();
require_once('includes/config.php');

/* ✅ ADMIN SESSION CHECK */
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

/* MESSAGE */
$msg = "";

/* ADD COURSE */
if (isset($_POST['submit'])) {

    $coursecode = trim($_POST['coursecode']);
    $coursename = trim($_POST['coursename']);
    $courseunit = intval($_POST['courseunit']);
    $seatlimit  = intval($_POST['seatlimit']);

    if ($seatlimit <= 0) {
        $msg = "Seat limit must be greater than 0";
    } else {

        $stmt = mysqli_prepare(
            $con,
            "INSERT INTO course(courseCode, courseName, courseUnit, noofSeats)
             VALUES (?, ?, ?, ?)"
        );

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssii",
                $coursecode, $coursename, $courseunit, $seatlimit
            );

            if (mysqli_stmt_execute($stmt)) {
                $msg = "Course added successfully!";
            } else {
                $msg = "Error adding course!";
            }

            mysqli_stmt_close($stmt);
        } else {
            $msg = "Database error!";
        }
    }
}

/* DELETE COURSE */
if (isset($_GET['del'])) {

    $id = intval($_GET['del']);

    // ✅ Check if students enrolled
    $check = mysqli_query($con,
        "SELECT * FROM courseenrolls WHERE course='$id'"
    );

    if (mysqli_num_rows($check) > 0) {
        $msg = "Cannot delete: Students are enrolled!";
    } else {

        mysqli_query($con, "DELETE FROM course WHERE id='$id'");
        $msg = "Course deleted successfully!";
    }
}

/* FETCH COURSES */
$result = mysqli_query($con, "SELECT * FROM course");
?>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
<div class="container">

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Course Management</h1>
    </div>
</div>

<!-- MESSAGE -->
<?php if ($msg != "") { ?>
<div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<!-- ADD COURSE -->
<div class="row">
<div class="col-md-12">

<div class="panel panel-primary">
<div class="panel-heading">Add New Course</div>

<div class="panel-body">
<form method="post" class="row">

    <div class="col-md-3">
        <input type="text" name="coursecode" class="form-control" placeholder="Course Code" required>
    </div>

    <div class="col-md-3">
        <input type="text" name="coursename" class="form-control" placeholder="Course Name" required>
    </div>

    <div class="col-md-2">
        <input type="number" name="courseunit" class="form-control" placeholder="Units" required>
    </div>

    <div class="col-md-2">
        <input type="number" name="seatlimit" class="form-control" placeholder="Seats" required>
    </div>

    <div class="col-md-2">
        <button type="submit" name="submit" class="btn btn-success btn-block">
            Add Course
        </button>
    </div>

</form>
</div>
</div>

</div>
</div>

<!-- COURSE LIST -->
<div class="row">
<div class="col-md-12">

<div class="panel panel-default">
<div class="panel-heading">Course List</div>

<div class="panel-body table-responsive">
<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>ID</th>
    <th>Code</th>
    <th>Name</th>
    <th>Unit</th>
    <th>Seats</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlentities($row['courseCode']); ?></td>
    <td><?php echo htmlentities($row['courseName']); ?></td>
    <td><?php echo $row['courseUnit']; ?></td>
    <td><?php echo $row['noofSeats']; ?></td>
    <td>
        <a href="course.php?del=<?php echo $row['id']; ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete this course?');">
           Delete
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
</div>

<?php include('includes/footer.php'); ?>