<?php
session_start();
include("../includes/config.php");

/* ✅ If already logged in → go to dashboard */
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if (isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = mysqli_query($con, "SELECT * FROM admin WHERE username='$username'");

    if ($query && mysqli_num_rows($query) == 1) {

        $admin = mysqli_fetch_assoc($query);

        // ✅ Support hashed password
        if (
            $admin['password'] === $password ||
            password_verify($password, $admin['password'])
        ) {

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "❌ Invalid Password";
        }

    } else {
        $error = "❌ Admin not found";
    }
}
?>

<?php include('../includes/header.php'); ?>

<section class="menu-section">
    <div class="container">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../student-login.php">Student Login</a></li>
            <li class="active"><a href="index.php">Admin Login</a></li>
        </ul>
    </div>
</section>

<div class="content-wrapper">
<div class="container">

<h4 class="page-head-line">Admin Login</h4>

<?php if ($error != "") { ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<div class="row">
<div class="col-md-6">

<form method="post">

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">
        Login
    </button>

</form>

</div>

<div class="col-md-6">
    <div class="alert alert-info">
        <strong>Admin Panel</strong>
        <ul>
            <li>Manage Students</li>
            <li>Manage Courses</li>
            <li>View Reports</li>
        </ul>
    </div>
</div>

</div>

</div>
</div>

<?php include('../includes/footer.php'); ?>