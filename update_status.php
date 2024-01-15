<?php
include('connection.php');
$id = $_POST['id'];
$status = $_POST['status'];
$updated_count = $_POST['updated_count'];
// $fullname = $_POST['memName'];

$sql = "UPDATE `members` SET `stat`='$status', `updated_count`='$updated_count' WHERE id='$id' ";
$query= mysqli_query($con,$sql);

if($query ==true)
{
    $data = array(
        'status'=>'true',
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
    );

    echo json_encode($data);
}
?>
