<?php
include('connection.php');

$user_s = $_POST['userS'];


$sql = "SELECT count(*) as kawnt FROM members WHERE user_s='$user_s'";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);

?>