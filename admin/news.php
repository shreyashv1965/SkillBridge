<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Add News
if (isset($_POST['submit'])) {
    $ntitle = mysqli_real_escape_string($con, $_POST['newstitle']);
    $ndescription = mysqli_real_escape_string($con, $_POST['description']);

    $ret = mysqli_query(
        $con,
        "INSERT INTO news(newstitle, newsDescription) VALUES ('$ntitle', '$ndescription')"
    );

    if ($ret) {
        echo "<script>alert('News added successfully');</script>";
        echo "<script>window.location='news.php';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}

// Delete News
if (isset($_GET['del']) && isset($_GET['id'])) {
    $nid = intval($_GET['id']);

    mysqli_query($con, "DELETE FROM news WHERE id='$nid'");
    echo "<script>alert('News deleted successfully');</script>";
    echo "<script>window.location='news.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin | News</title>

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
        <h1 class="page-head-line">News</h1>
    </div>
</div>

<!-- Add News -->
<div class="row">
<div class="col-md-3"></div>

<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">Add News</div>

<div class="panel-body">
<form method="post">

<div class="form-group">
<label>News Title</label>
<input type="text" name="newstitle" class="form-control" required>
</div>

<div class="form-group">
<label>News Description</label>
<textarea name="description" class="form-control" required></textarea>
</div>

<button type="submit" name="submit" class="btn btn-default">Submit</button>

</form>
</div>
</div>
</div>
</div>

<!-- Manage News -->
<div class="row">
<div class="col-md-12">

<div class="panel panel-default">
<div class="panel-heading">Manage News</div>

<div class="panel-body">
<div class="table-responsive table-bordered">

<table class="table">
<thead>
<tr>
    <th>#</th>
    <th>Title</th>
    <th>Description</th>
    <th>Date</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php
$sql = mysqli_query($con, "SELECT * FROM news ORDER BY postingDate DESC");
$cnt = 1;

if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
?>
<tr>
    <td><?php echo $cnt; ?></td>
    <td><?php echo htmlentities($row['newstitle']); ?></td>
    <td><?php echo htmlentities($row['newsDescription']); ?></td>
    <td><?php echo htmlentities($row['postingDate']); ?></td>
    <td>
        <a href="news.php?id=<?php echo $row['id']; ?>&del=1"
           onclick="return confirm('Delete this news?');">
            <button class="btn btn-danger btn-sm">Delete</button>
        </a>
    </td>
</tr>
<?php
        $cnt++;
    }
} else {
    echo "<tr><td colspan='5' align='center'>No news found</td></tr>";
}
?>
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