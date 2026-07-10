<?php
session_start();
include("includes/config.php");

/* If already logged in */
if (isset($_SESSION['student_regno'])) {
    header("Location: " . $base_url . "dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SkillBridge - Online Course Registration</title>

    <!-- ✅ FIXED: Always use base_url from config -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/student.css">

</head>

<body>
<?php include('includes/header.php'); ?>

<hr>

<div class="container">

    <h3>Student Login</h3>

    <?php if (!empty($_SESSION['errmsg'])) { ?>
        <div class="alert alert-danger">
            <?php echo htmlentities($_SESSION['errmsg']); ?>
        </div>
    <?php unset($_SESSION['errmsg']); } ?>

    <form method="post" action="<?php echo $base_url; ?>login.php">

        <div class="form-group">
            <label>Registration Number</label>
            <input type="text" name="regno" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>

            <div style="position:relative;">
                <input type="password" name="password" id="password" class="form-control" required>

                
            </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">
            Login
        </button>

    </form>

</div>

<hr>

<div class="container">

    <h3>Latest News</h3>

    <?php
    $news = mysqli_query($con, "SELECT * FROM news ORDER BY postingDate DESC");

    if ($news && mysqli_num_rows($news) > 0) {
        while ($row = mysqli_fetch_assoc($news)) {
    ?>

        <div class="alert alert-info">
            <h4><?php echo htmlentities($row['newstitle']); ?></h4>
            <p><?php echo htmlentities($row['newsDescription']); ?></p>
            <small><?php echo htmlentities($row['postingDate']); ?></small>
        </div>

    <?php
        }
    } else {
        echo "<p>No news available</p>";
    }
    ?>

</div>

<div class="text-center" style="margin-top:30px; padding:15px; background:#222; color:#fff;">
    <footer>
        <p>© SkillBridge- Online Course Registration System</p>
    </footer>
</div>


</script>

</body>
</html>