<?php
include('connection.php');
$mem_id = $_POST['mem_id'];
$pbno = $_POST['pbno'];
$fullname = isset($_POST['fullname']) && !empty($_POST['fullname']) ? strtoupper($_POST['fullname']) : "";
$bday = $_POST['bday'];
$stat = $_POST['stat'];
$membership_date = $_POST['membership_date'];
$branch = $_POST['branch'];
$isregistered = $_POST['isregistered'];
$count = $_POST['count'];

$dateTime = new DateTime();
$dateTime->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));
$forum_day = $dateTime->format("Y-m-d H:i:s");

$sql = "INSERT INTO `members` (`mem_id`,`pbno`,`fullname`,`bday`,`stat`,`membership_date`,`branch`,`isregistered`,`count`,`incentive`,`forum_attended`,`forum_date`,`forum_day`,`user_s`,`updated_count`) values ('$mem_id', '$pbno', '$fullname', '$bday', '$stat', '$membership_date', '$branch', '$isregistered', '$count', '.', '.', '.', '$forum_day', '.', ' ')";
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
