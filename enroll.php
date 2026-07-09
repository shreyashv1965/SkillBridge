<?php
session_start();
include('includes/config.php');

/* SESSION CHECK */
if (!isset($_SESSION['student_regno'])) {
    header("Location: index.php");
    exit();
}

$studentRegno = $_SESSION['student_regno'];
$msg = "";

/* ENROLL ACTION */
if (isset($_GET['id'])) {

    $course_id = intval($_GET['id']);

    /* CHECK DUPLICATE */
    $stmt = mysqli_prepare($con,
        "SELECT id FROM courseenrolls 
         WHERE studentRegno=? AND course=?"
    );

    mysqli_stmt_bind_param($stmt, "si", $studentRegno, $course_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        $msg = "❌ Already enrolled";

    } else {

        /* GET SEATS */
        $seatQuery = mysqli_query($con,
            "SELECT noofSeats FROM course WHERE id='$course_id'"
        );

        $seatData = mysqli_fetch_assoc($seatQuery);
        $totalSeats = $seatData['noofSeats'];

        /* COUNT ENROLLMENTS */
        $countQuery = mysqli_query($con,
            "SELECT COUNT(*) as total FROM courseenrolls WHERE course='$course_id'"
        );

        $countData = mysqli_fetch_assoc($countQuery);

        if ($countData['total'] >= $totalSeats) {

            $msg = "❌ Seats Full";

        } else {

            /* INSERT ENROLLMENT */
            $insert = mysqli_query($con,
                "INSERT INTO courseenrolls(studentRegno, course)
                 VALUES('$studentRegno', '$course_id')"
            );

            if ($insert) {
                $msg = "✅ Enrolled Successfully";
            } else {
                $msg = "❌ Error in enrollment";
            }
        }
    }
}
?>

<?php include('includes/header.php'); ?>

<section class="menu-section">
<div class="container">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="enroll-history.php">My Courses</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
</section>

<div class="content-wrapper">
<div class="container">

<h2>Available Courses</h2>

<?php if ($msg != "") { ?>
    <div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<table class="table table-bordered">
<thead>
<tr>
    <th>#</th>
    <th>Course Code</th>
    <th>Course Name</th>
    <th>Seats Left</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php
$sql = mysqli_query($con, "SELECT * FROM course");
$cnt = 1;

while ($row = mysqli_fetch_assoc($sql)) {

    $countQuery = mysqli_query($con,
        "SELECT COUNT(*) as total FROM courseenrolls WHERE course='".$row['id']."'"
    );

    $countData = mysqli_fetch_assoc($countQuery);

    $seatsLeft = $row['noofSeats'] - $countData['total'];
?>

<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo htmlentities($row['courseCode']); ?></td>
    <td><?php echo htmlentities($row['courseName']); ?></td>
    <td><?php echo $seatsLeft; ?></td>

    <td>
        <?php if ($seatsLeft > 0) { ?>
            <a href="enroll.php?id=<?php echo $row['id']; ?>">
                <button class="btn btn-success btn-sm">Enroll</button>
            </a>
        <?php } else { ?>
            <button class="btn btn-danger btn-sm" disabled>Full</button>
        <?php } ?>
    </td>
</tr>

<?php } ?>

</tbody>
</table>

</div>
</div>

<?php include('includes/footer.php'); ?>