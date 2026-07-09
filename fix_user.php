<?php
include("includes/config.php");

$regno = "2321100398";
$password = "Test@123";

$hash = password_hash($password, PASSWORD_DEFAULT);

mysqli_query($con,
"UPDATE students 
 SET password='$hash' 
 WHERE StudentRegno='$regno'"
);

echo "Password updated successfully";
?>