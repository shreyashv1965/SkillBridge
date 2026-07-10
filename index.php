<?php
session_start();
include("includes/config.php");

if(isset($_SESSION['student_regno'])){
    header("Location: ".$base_url."dashboard.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SkillBridge | Online Course Registration System</title>

<link rel="stylesheet" href="<?php echo $base_url;?>assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo $base_url;?>assets/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo $base_url;?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/homepage.css">

<style>

body{
    background:#f4f7fb;
    font-family:Arial, Helvetica, sans-serif;
}

.hero{
    background:linear-gradient(rgba(0,87,183,.85),rgba(0,87,183,.85)),
    url('assets/img/banner.jpg');
    background-size:cover;
    background-position:center;
    color:#fff;
    padding:90px 20px;
    text-align:center;
}

.hero h1{
    font-size:48px;
    font-weight:bold;
}

.hero p{
    font-size:20px;
    margin-top:15px;
}

.btn-main{
    margin:10px;
    padding:12px 28px;
    font-size:18px;
    border-radius:30px;
}

.section-title{
    text-align:center;
    margin:60px 0 30px;
    font-weight:bold;
}

.feature-box{
    background:#fff;
    border-radius:10px;
    padding:25px;
    margin-bottom:25px;
    text-align:center;
    box-shadow:0 3px 10px rgba(0,0,0,.1);
    transition:.3s;
}

.feature-box:hover{
    transform:translateY(-5px);
}

.feature-box i{
    font-size:45px;
    color:#0057b7;
    margin-bottom:15px;
}

.tech{
    display:inline-block;
    background:#0057b7;
    color:#fff;
    padding:10px 18px;
    border-radius:25px;
    margin:8px;
    font-weight:bold;
}

.news-card{
    background:#fff;
    padding:20px;
    border-left:5px solid #0057b7;
    margin-bottom:20px;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

footer{
    margin-top:60px;
    background:#222;
    color:#fff;
    padding:25px;
    text-align:center;
}

</style>

</head>

<body>

<?php include("includes/header.php"); ?>
<?php include("includes/home-menubar.php"); ?>


<div class="hero">

    <h1>Welcome to SkillBridge</h1>

    <p>
        A Modern Online Course Registration System
        designed to simplify academic course enrollment
        and student management.
    </p>

    <br>

    <a href="<?php echo $base_url;?>student-login.php"
       class="btn btn-success btn-lg btn-main">

        <i class="fa fa-user"></i>
        Student Login

    </a>

    <a href="<?php echo $base_url;?>admin/"
       class="btn btn-warning btn-lg btn-main">

        <i class="fa fa-lock"></i>
        Admin Login

    </a>

</div>


<div class="container">

<h2 class="section-title">
About SkillBridge
</h2>

<div class="row">

<div class="col-md-12">

<p style="font-size:17px; line-height:30px; text-align:center;">

SkillBridge is an Online Course Registration System
developed using PHP, MySQL, HTML, CSS, JavaScript
and Bootstrap.

The system enables students to securely log in,
register for courses, view enrollment history,
manage their profiles and receive important academic
updates.

Administrators can efficiently manage students,
courses, departments, sessions and announcements
through a dedicated dashboard.

</p>

</div>

</div>

<hr>

<!-- ================= FEATURES ================= -->

<h2 class="section-title">
    Why Choose SkillBridge?
</h2>

<div class="row">

    <div class="col-md-4">
        <div class="feature-box">
            <i class="fa fa-lock"></i>
            <h4>Secure Login</h4>
            <p>Safe authentication for both students and administrators.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-box">
            <i class="fa fa-book"></i>
            <h4>Course Registration</h4>
            <p>Enroll in available courses with an easy registration process.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-box">
            <i class="fa fa-dashboard"></i>
            <h4>Student Dashboard</h4>
            <p>Access enrolled courses, profile details and academic information.</p>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-4">
        <div class="feature-box">
            <i class="fa fa-users"></i>
            <h4>Admin Management</h4>
            <p>Manage students, departments, semesters and courses efficiently.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-box">
            <i class="fa fa-history"></i>
            <h4>Enrollment History</h4>
            <p>Students can view and print their enrollment history anytime.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="feature-box">
            <i class="fa fa-bullhorn"></i>
            <h4>Latest Announcements</h4>
            <p>Stay updated with academic notices and important announcements.</p>
        </div>
    </div>

</div>

<hr>

<!-- ================= TECHNOLOGY ================= -->

<h2 class="section-title">
Technology Stack
</h2>

<div class="text-center">

<span class="tech">PHP</span>
<span class="tech">MySQL</span>
<span class="tech">HTML5</span>
<span class="tech">CSS3</span>
<span class="tech">Bootstrap</span>
<span class="tech">JavaScript</span>

</div>

<hr>

<!-- ================= NEWS ================= -->

<h2 class="section-title">
Latest News
</h2>

<?php

$news=mysqli_query($con,"SELECT * FROM news ORDER BY postingDate DESC LIMIT 3");

if(mysqli_num_rows($news)>0){

while($row=mysqli_fetch_assoc($news)){

?>

<div class="news-card">

<h4><?php echo htmlentities($row['newstitle']); ?></h4>

<p><?php echo htmlentities($row['newsDescription']); ?></p>

<small>
<i class="fa fa-calendar"></i>
<?php echo htmlentities($row['postingDate']); ?>
</small>

</div>

<?php
}
}
else{

echo "<div class='alert alert-info'>No latest news available.</div>";

}
?>

<hr>

<!-- ================= CTA ================= -->


<footer>

<h4>SkillBridge</h4>

<p>
Online Course Registration System
</p>

<p>

© <?php echo date("Y"); ?>

SkillBridge. All Rights Reserved.

</p>

</footer>

<script src="<?php echo $base_url;?>assets/js/jquery-1.11.1.js"></script>
<script src="<?php echo $base_url;?>assets/js/bootstrap.js"></script>

</body>
</html>