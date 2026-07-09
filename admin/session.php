<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Insert Session
if (isset($_POST['submit'])) {
    $sessionname = mysqli_real_escape_string($con, $_POST['session']);

    $query = "INSERT INTO session(session) VALUES ('$sessionname')";
    $ret = mysqli_query($con, $query);

    if ($ret) {
        echo "<script>alert('Session Created Successfully');</script>";
        echo "<script>window.location='session.php';</script>";
    } else {
        echo "<script>alert('Error: Session not created');</script>";
    }
}

// Delete Session
if (isset($_GET['del']) && isset($_GET['id'])) {
    $sid = intval($_GET['id']); // safer

    mysqli_query($con, "DELETE FROM session WHERE id='$sid'");
    echo "<script>alert('Session deleted');</script>";
    echo "<script>window.location='session.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin | Session</title>
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
                <h1 class="page-head-line">Session</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Session</div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Session</label>
                                <input type="text" name="session" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-default">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Manage Session</div>

                    <div class="panel-body">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Session</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM session");
                                $cnt = 1;
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo htmlentities($row['session']); ?></td>
                                        <td><?php echo htmlentities($row['creationDate']); ?></td>
                                        <td>
                                            <a href="session.php?del=1&id=<?php echo $row['id']; ?>" 
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

<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/bootstrap.js"></script>

</body>
</html>