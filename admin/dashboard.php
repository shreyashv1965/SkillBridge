<?php
session_start();
require_once("includes/config.php");

/* ✅ ADMIN SESSION CHECK */
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

/* ✅ Safe username */
$adminName = isset($_SESSION['admin_username']) 
    ? htmlspecialchars($_SESSION['admin_username']) 
    : "Admin";
?>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
    <div class="container">

        <h3 class="page-head-line">ADMIN DASHBOARD</h3>

        <div class="alert alert-success">
            Welcome <strong><?php echo $adminName; ?></strong><br>
            You have successfully logged in.
        </div>

        <!-- Dashboard Panels -->
        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Students</div>
                    <div class="panel-body">
                        <p>Manage students and view enrollment logs.</p>
                        <a href="manage-students.php" class="btn btn-primary btn-sm">Manage</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">Courses</div>
                    <div class="panel-body">
                        <p>Manage courses and departments.</p>
                        <a href="course.php" class="btn btn-success btn-sm">Go to Courses</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">Enrollments</div>
                    <div class="panel-body">
                        <p>View student enrollment history.</p>
                        <a href="enroll-history.php" class="btn btn-info btn-sm">View History</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>