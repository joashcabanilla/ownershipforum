<?php
include('connection.php');
$id = $_POST['id'];
$mem_id = $_POST['mem_id'];
$fullname = $_POST['fullname'];
$bday = $_POST['bday'];
$stat = $_POST['stat'];
$membership_date = $_POST['membership_date'];
$branch = $_POST['branch'];
$isregistered = $_POST['isregistered'];
$forum_date = $_POST['forum_date'];
$updated_count = $_POST['updated_count'];
$user_s = $_POST['user_s'];
$incentive = $_POST['incentive'];
$forum_attended = $_POST['forum_attended'];

$dateTime = new DateTime();
$dateTime->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));
$forum_day = $dateTime->format("Y-m-d H:i:s");

$sql = "UPDATE `members` SET  `mem_id`='$mem_id',`fullname`= '$fullname',`bday`='$bday',`stat`='$stat',`membership_date`='$membership_date',`branch`='$branch',`isregistered`='$isregistered',`forum_date`='$forum_date',`updated_count`='$updated_count',`forum_day`='$forum_day', `user_s`='$user_s',`incentive`='$incentive',`forum_attended`='$forum_attended' WHERE id='$id' ";
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
