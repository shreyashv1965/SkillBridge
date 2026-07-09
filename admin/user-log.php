<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login Logs</title>

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
<div class="container">

<h2 class="page-head-line">User Login Activity Logs</h2>

<div class="table-responsive table-bordered">

<table class="table table-striped">
<thead>
<tr>
    <th>#</th>
    <th>Registration No</th>
    <th>IP Address</th>
    <th>Status</th>
    <th>Login Time</th>
</tr>
</thead>

<tbody>

<?php
$query = mysqli_query($con, "
    SELECT * FROM login_logs 
    ORDER BY login_time DESC
");

$cnt = 1;

if (mysqli_num_rows($query) > 0) {

    while ($row = mysqli_fetch_assoc($query)) {
?>

<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo htmlentities($row['student_regno']); ?></td>
    <td><?php echo htmlentities($row['ip_address']); ?></td>

    <td>
        <?php if ($row['status'] == "Success") { ?>
            <span class="label label-success">Success</span>
        <?php } else { ?>
            <span class="label label-danger">Failed</span>
        <?php } ?>
    </td>

    <td><?php echo htmlentities($row['login_time']); ?></td>
</tr>

<?php
    }

} else {
    echo "<tr><td colspan='5' style='text-align:center;'>No login logs found</td></tr>";
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