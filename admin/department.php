<?php
session_start();
require_once('includes/config.php');

/* ✅ ADMIN SESSION CHECK */
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

$msg = "";

/* ADD DEPARTMENT */
if (isset($_POST['submit'])) {

    $department = trim($_POST['department']);

    $stmt = mysqli_prepare($con, "INSERT INTO department(department) VALUES (?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $department);

        if (mysqli_stmt_execute($stmt)) {
            $msg = "Department added successfully!";
        } else {
            $msg = "Error adding department!";
        }

        mysqli_stmt_close($stmt);
    }
}

/* DELETE DEPARTMENT */
if (isset($_GET['del'])) {

    $deptid = intval($_GET['del']);

    // ✅ Check dependency (courses using this department)
    $check = mysqli_query($con, "SELECT * FROM course WHERE department='$deptid'");

    if (mysqli_num_rows($check) > 0) {
        $msg = "Cannot delete: Department is used in courses!";
    } else {

        mysqli_query($con, "DELETE FROM department WHERE id='$deptid'");
        $msg = "Department deleted successfully!";
    }
}

/* FETCH DATA */
$sql = mysqli_query($con, "SELECT * FROM department");
?>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
<div class="container">

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Department</h1>
    </div>
</div>

<!-- MESSAGE -->
<?php if ($msg != "") { ?>
<div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<!-- ADD DEPARTMENT -->
<div class="row">
<div class="col-md-3"></div>

<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">Add Department</div>

<div class="panel-body">
<form method="post">

    <div class="form-group">
        <label>Department Name</label>
        <input type="text" name="department" class="form-control" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">
        Submit
    </button>

</form>
</div>
</div>
</div>

</div>

<!-- LIST -->
<div class="row">
<div class="col-md-12">

<div class="panel panel-default">
<div class="panel-heading">Manage Department</div>

<div class="panel-body table-responsive">

<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>#</th>
    <th>Department</th>
    <th>Creation Date</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php
$cnt = 1;
while ($row = mysqli_fetch_assoc($sql)) {
?>

<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo htmlentities($row['department']); ?></td>
    <td><?php echo htmlentities($row['creationDate']); ?></td>
    <td>
        <a href="department.php?del=<?php echo $row['id']; ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete this department?');">
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