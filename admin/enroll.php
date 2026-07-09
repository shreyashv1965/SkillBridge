<?php
session_start();
require_once("../includes/config.php");

/* ✅ SESSION CHECK */
if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

$regno = $_SESSION['student_regno'];
$msg = "";

/* ✅ HANDLE ENROLL */
if (isset($_GET['courseid'])) {

    $courseid = intval($_GET['courseid']);

    // ✅ Check already enrolled
    $stmt = mysqli_prepare($con,
        "SELECT 1 FROM courseenrolls WHERE studentRegno=? AND courseId=?"
    );
    mysqli_stmt_bind_param($stmt, "si", $regno, $courseid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $msg = "You are already enrolled in this course.";
    } else {

        // ✅ Check seat availability
        $stmt2 = mysqli_prepare($con, "
            SELECT c.noofSeats, COUNT(e.courseId) as enrolled
            FROM course c
            LEFT JOIN courseenrolls e ON c.id = e.courseId
            WHERE c.id=?
            GROUP BY c.id
        ");

        mysqli_stmt_bind_param($stmt2, "i", $courseid);
        mysqli_stmt_execute($stmt2);
        $res = mysqli_stmt_get_result($stmt2);
        $data = mysqli_fetch_assoc($res);

        if ($data['enrolled'] >= $data['noofSeats']) {
            $msg = "Course is FULL. No seats available.";
        } else {

            // ✅ Insert enrollment
            $stmt3 = mysqli_prepare($con,
                "INSERT INTO courseenrolls(studentRegno, courseId) VALUES (?, ?)"
            );
            mysqli_stmt_bind_param($stmt3, "si", $regno, $courseid);

            if (mysqli_stmt_execute($stmt3)) {
                header("Location: enroll-history.php");
                exit();
            } else {
                $msg = "Something went wrong!";
            }
        }
    }
}

/* ✅ FETCH COURSES WITH ENROLL COUNT (OPTIMIZED) */
$sql = mysqli_query($con, "
    SELECT c.*, COUNT(e.courseId) as enrolled
    FROM course c
    LEFT JOIN courseenrolls e ON c.id = e.courseId
    GROUP BY c.id
");
?>

<?php include('../includes/header.php'); ?>

<section class="menu-section">
    <div class="container">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="enroll-history.php">Enroll History</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</section>

<div class="content-wrapper">
<div class="container">

<h2>Available Courses</h2>

<!-- MESSAGE -->
<?php if ($msg != "") { ?>
<div class="alert alert-info"><?php echo $msg; ?></div>
<?php } ?>

<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>#</th>
    <th>Course Code</th>
    <th>Name</th>
    <th>Unit</th>
    <th>Seats Left</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php
$cnt = 1;
while ($row = mysqli_fetch_assoc($sql)) {

    $remaining = $row['noofSeats'] - $row['enrolled'];
?>

<tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo htmlentities($row['courseCode']); ?></td>
    <td><?php echo htmlentities($row['courseName']); ?></td>
    <td><?php echo htmlentities($row['courseUnit']); ?></td>
    <td><?php echo $remaining; ?></td>
    <td>

<?php if ($remaining > 0) { ?>

    <a href="enroll.php?courseid=<?php echo $row['id']; ?>"
       class="btn btn-success btn-sm"
       onclick="return confirm('Enroll in this course?');">
       Enroll
    </a>

<?php } else { ?>

    <button class="btn btn-danger btn-sm" disabled>Full</button>

<?php } ?>

    </td>
</tr>

<?php } ?>

</tbody>
</table>

<a href="dashboard.php" class="btn btn-primary">Back</a>

</div>
</div>

<?php include('../includes/footer.php'); ?>