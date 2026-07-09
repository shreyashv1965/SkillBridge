<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

/* Insert Semester */
if (isset($_POST['submit'])) {
    $semester = mysqli_real_escape_string($con, $_POST['semester']);

    $ret = mysqli_query($con, "INSERT INTO semester(semester) VALUES('$semester')");
    if ($ret) {
        echo '<script>alert("Semester Created Successfully !!");</script>';
        echo '<script>window.location.href="semester.php";</script>';
    } else {
        echo '<script>alert("Error : Semester not created");</script>';
        echo '<script>window.location.href="semester.php";</script>';
    }
}

/* Delete Semester */
if (isset($_GET['del']) && isset($_GET['id'])) {
    $semid = intval($_GET['id']);

    mysqli_query($con, "DELETE FROM semester WHERE id='$semid'");
    echo '<script>alert("Semester deleted !!");</script>';
    echo '<script>window.location.href="semester.php";</script>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin | Semester</title>

    <!-- FIXED CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<div class="content-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Semester</h1>
            </div>
        </div>

        <!-- Add Semester -->
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Semester</div>

                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Semester</label>
                                <input type="text" name="semester" class="form-control" required />
                            </div>
                            <button type="submit" name="submit" class="btn btn-default">
                                Submit
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Manage Semester -->
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Manage Semester</div>

                    <div class="panel-body">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Semester</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM semester");
                                $cnt = 1;
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo htmlentities($row['semester']); ?></td>
                                        <td><?php echo htmlentities($row['creationDate']); ?></td>
                                        <td>
                                            <a href="semester.php?id=<?php echo $row['id']; ?>&del=1"
                                               onclick="return confirm('Are you sure you want to delete?');">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php $cnt++; } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>

<!-- FIXED JS -->
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>

</body>
</html>