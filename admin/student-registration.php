<?php
session_start();
include('includes/config.php');

// Protect admin page
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Insert Student
if (isset($_POST['submit'])) {

    $studentname  = mysqli_real_escape_string($con, $_POST['studentname']);
    $studentregno = mysqli_real_escape_string($con, $_POST['studentregno']);
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $pincode      = rand(100000, 999999);

    $query = "INSERT INTO students(studentName, StudentRegno, password, pincode) 
              VALUES('$studentname', '$studentregno', '$password', '$pincode')";

    $ret = mysqli_query($con, $query);

    if ($ret) {
        echo "<script>alert('Student Registered Successfully. Pincode: $pincode');</script>";
        echo "<script>window.location='manage-students.php';</script>";
    } else {
        echo "<script>alert('Error: Student not registered');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin | Student Registration</title>

    <!-- ✅ FIXED CSS -->
    <link rel="stylesheet" href="/onlinecourse/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/font-awesome.css">
    <link rel="stylesheet" href="/onlinecourse/assets/css/style.css">
</head>

<body>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Student Registration</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Register New Student</div>

                <div class="panel-body">
                    <form method="post">

                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" name="studentname" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Student Registration No</label>
                            <input type="text" name="studentregno" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-success">
                            Register Student
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<?php include('includes/footer.php'); ?>

<!-- ✅ FIXED JS -->
<script src="/onlinecourse/assets/js/jquery-1.11.1.js"></script>
<script src="/onlinecourse/assets/js/bootstrap.js"></script>

</body>
</html>