<?php include('connection.php');
$id = $_POST['id'];
$sql = "SELECT * FROM members WHERE id='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
$result = array();
foreach($row as $key => $data){
    if($key == "fullname"){
        $result[$key] = utf8_encode($data);
    }else{
        $result[$key] = $data;
    }
}
echo json_encode($result);
?>
