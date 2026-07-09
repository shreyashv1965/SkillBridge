<?php
session_start();
require_once('includes/config.php');

/* ✅ ADMIN SESSION CHECK */
if (!isset($_SESSION['admin_id'])) {
    header('location:index.php');
    exit();
}

date_default_timezone_set('Asia/Kolkata');
$currentTime = date('Y-m-d H:i:s');

if (isset($_POST['submit'])) {

    $admin_id = $_SESSION['admin_id'];
    $current  = $_POST['cpass'];
    $new      = $_POST['newpass'];
    $confirm  = $_POST['cnfpass'];

    // ✅ Check new password match
    if ($new !== $confirm) {
        $_SESSION['msg'] = "New password and confirm password do not match!";
        header("location:change-password.php");
        exit();
    }

    // ✅ Fetch current password
    $query = mysqli_query($con, "SELECT password FROM admin WHERE id='$admin_id'");
    $row   = mysqli_fetch_assoc($query);

    if ($row && password_verify($current, $row['password'])) {

        $newHash = password_hash($new, PASSWORD_DEFAULT);

        mysqli_query($con,
            "UPDATE admin SET password='$newHash', updationDate='$currentTime' WHERE id='$admin_id'"
        );

        $_SESSION['msg'] = "Password changed successfully!";

    } else {
        $_SESSION['msg'] = "Current password is incorrect!";
    }

    header("location:change-password.php");
    exit();
}
?>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
  <div class="container">

    <h1 class="page-head-line">Change Password</h1>

    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] != "") { ?>
      <div class="alert alert-info text-center">
        <?php echo htmlentities($_SESSION['msg']); ?>
      </div>
    <?php $_SESSION['msg'] = ""; } ?>

    <form method="post">
      <div class="form-group">
        <label>Current Password</label>
        <input type="password" name="cpass" class="form-control" required>
      </div>

      <div class="form-group">
        <label>New Password</label>
        <input type="password" name="newpass" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="cnfpass" class="form-control" required>
      </div>

      <button type="submit" name="submit" class="btn btn-primary">
        Update Password
      </button>
    </form>

  </div>
</div>

<?php include('includes/footer.php'); ?>