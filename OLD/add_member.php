<?php
include('connection.php');
$mem_id = $_POST['mem_id'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$sex = $_POST['sex'];
$branch = $_POST['branch'];
$stat = $_POST['stat'];
$forum_date = $_POST['forum_date'];

$sql = "INSERT INTO `members` (`mem_id`,`lname`,`fname`,`mname`,`sex`,`branch`,`stat`,`forum_date`) values ('$mem_id', '$lname', '$fname', '$mname', '$sex', '$branch', '$stat', '$forum_date')";
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
