<?php include('connection.php');

$output= array();
$sql = "SELECT * FROM members ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE fullname like '%".$search_value."%'";
	$sql .= " OR pbno like '%".$search_value."%'";
	$sql .= " OR mem_id like '%".$search_value."%'";
	$sql .= " OR stat like '%".$search_value."%'";
	$sql .= " OR branch like '%".$search_value."%'";
	$sql .= " OR isregistered like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$column_name." ".$order."";
}
else
{
	$sql .= " ORDER BY id asc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['mem_id'];
// 	$sub_array[] = $row['pbno'];
	$sub_array[] = $row['fullname'];
	$sub_array[] = $row['bday'];
	$sub_array[] = $row['stat'];
	$sub_array[] = $row['membership_date'];
	$sub_array[] = $row['branch'];
	$sub_array[] = $row['incentive'];
	$sub_array[] = $row['isregistered'];
	$sub_array[] = $row['forum_date'];
	$sub_array[] = $row['forum_attended'];

	$btnFun = $row['isregistered'] == "YES" ? 'Update' : 'Register';

	// $sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$sub_array[] = '<button data-id="'.$row['id'].'" class="btn btn-success btn-sm editbtn" onclick="sync()"> ' . $btnFun . '</button>';
	// id="page-button" data-toggle="modal" data-target="#updateModal"

	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
