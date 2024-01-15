<?php
include('connection.php');
$mem_id = $_POST['mem_id'];
$pbno = $_POST['pbno'];
$fullname = $_POST['fullname'];
$bday = $_POST['bday'];
$stat = $_POST['stat'];
$membership_date = $_POST['membership_date'];
$branch = $_POST['branch'];
$isregistered = $_POST['isregistered'];
$count = $_POST['count'];

$sql = "INSERT INTO `members` (`mem_id`,`pbno`,`fullname`,`bday`,`stat`,`membership_date`,`branch`,`isregistered`,`count`) values ('$mem_id', '$pbno', '$fullname', '$bday', '$stat', '$membership_date', '$branch', '$isregistered', '$count')";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
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
