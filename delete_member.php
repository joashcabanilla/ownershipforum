<?php
	include('connection.php');

	$member_id = $_POST['id'];
	$sql = "DELETE FROM members WHERE id='$member_id'";
	$delQuery =mysqli_query($con,$sql);
	if($delQuery==true)
	{
		 $data = array(
	        'status'=>'success',
	    );
	    echo json_encode($data);
	}
	else
	{
	     $data = array(
	        'status'=>'failed',
	    );
	    echo json_encode($data);
	}
?>
