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
    header('location:manage-students.php');
    exit();
}

$regid = intval($_GET['id']);
$msg = "";

/* ✅ UPDATE STUDENT */
if (isset($_POST['submit'])) {

    $studentname = trim($_POST['studentname']);
    $cgpa = trim($_POST['cgpa']);

    // ✅ Handle photo upload
    $photoName = "";

    if (!empty($_FILES["photo"]["name"])) {

        $ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        $photoName = time() . "." . $ext;

        move_uploaded_file(
            $_FILES["photo"]["tmp_name"],
            "../studentphoto/" . $photoName
        );
    }

    if ($photoName != "") {
        $stmt = mysqli_prepare($con,
            "UPDATE students SET studentName=?, studentPhoto=?, cgpa=? WHERE StudentRegno=?"
        );
        mysqli_stmt_bind_param($stmt, "sssi", $studentname, $photoName, $cgpa, $regid);
    } else {
        $stmt = mysqli_prepare($con,
            "UPDATE students SET studentName=?, cgpa=? WHERE StudentRegno=?"
        );
        mysqli_stmt_bind_param($stmt, "ssi", $studentname, $cgpa, $regid);
    }

    if (mysqli_stmt_execute($stmt)) {
        $msg = "Student updated successfully!";
    } else {
        $msg = "Error updating student!";
    }

    mysqli_stmt_close($stmt);
}

/* ✅ FETCH STUDENT */
$stmt = mysqli_prepare($con, "SELECT * FROM students WHERE StudentRegno=?");
mysqli_stmt_bind_param($stmt, "i", $regid);
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
        <h1 class="page-head-line">Edit Student</h1>
    </div>
</div>

<!-- MESSAGE -->
<?php if ($msg != "") { ?>
<div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<?php if ($row) { ?>

<div class="panel panel-default">
<div class="panel-heading">Student Profile</div>

<div class="panel-body">

<form method="post" enctype="multipart/form-data">

<div class="form-group">
    <label>Student Name</label>
    <input type="text" name="studentname" class="form-control"
           value="<?php echo htmlentities($row['studentName']); ?>" required>
</div>

<div class="form-group">
    <label>Student Reg No</label>
    <input type="text" class="form-control"
           value="<?php echo htmlentities($row['StudentRegno']); ?>" readonly>
</div>

<div class="form-group">
    <label>Pincode</label>
    <input type="text" class="form-control"
           value="<?php echo htmlentities($row['pincode']); ?>" readonly>
</div>

<div class="form-group">
    <label>CGPA</label>
    <input type="number" step="0.01" name="cgpa" class="form-control"
           value="<?php echo htmlentities($row['cgpa']); ?>" required>
</div>

<div class="form-group">
    <label>Current Photo</label><br>
    <?php if ($row['studentPhoto'] == "") { ?>
        <img src="../studentphoto/noimage.png" width="150">
    <?php } else { ?>
        <img src="../studentphoto/<?php echo htmlentities($row['studentPhoto']); ?>" width="150">
    <?php } ?>
</div>

<div class="form-group">
    <label>Upload New Photo</label>
    <input type="file" name="photo" class="form-control">
</div>

<button type="submit" name="submit" class="btn btn-primary">
    Update Student
</button>

<a href="manage-students.php" class="btn btn-default">Back</a>

</form>

</div>
</div>

<?php } else { ?>

<div class="alert alert-danger">Student not found</div>

<?php } ?>

</div>
</div>

<?php include('includes/footer.php'); ?>