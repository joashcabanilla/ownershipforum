<?php
include 'config/db-config.php';
global $connection;

if($_REQUEST['action'] == 'fetch_members'){

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = $_REQUEST['initial_date'];
    $final_date = $_REQUEST['final_date'];
    $user_s = $_REQUEST['user_s'];

    if(!empty($initial_date) && !empty($final_date)){
        $date_range = " AND forum_day BETWEEN '".$initial_date."' AND '".$final_date."' ";
    }else{
        $date_range = "";
    }

    if($user_s != ''){
        $user_s = " AND user_s = '$user_s' ";
    }

    $columns = ' id, fullname, stat, membership_date, branch, isregistered, incentive, forum_day, user_s ';
    $table = ' members ';
    $where = " WHERE user_s!='' ".$date_range.$user_s;

    $columns_order = array(
        0 => 'id',
        1 => 'fullname',
        2 => 'stat',
        3 => 'membership_date',
        4 => 'branch',
        5 => 'isregistered',
        6 => 'incentive',
        7 => 'forum_day',
        8 => 'user_s'
    );

    $sql = "SELECT ".$columns." FROM ".$table." ".$where;

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if( !empty($requestData['search']['value']) ) {
      $sql.=" AND ( fullname LIKE '%".$requestData['search']['value']."%' ";
      $sql.=" OR stat LIKE '%".$requestData['search']['value']."%'";
      $sql.=" OR membership_date LIKE '%".$requestData['search']['value']."%'";
      $sql.=" OR branch LIKE '%".$requestData['search']['value']."%'";
      $sql.=" OR isregistered LIKE '%".$requestData['search']['value']."%'";
      $sql.=" OR incentive LIKE '%".$requestData['search']['value']."%'";
      $sql.=" OR forum_day LIKE '%".$requestData['search']['value']."%'";
      $sql.=" OR user_s LIKE '%".$requestData['search']['value']."%' )";
    }

    $result = mysqli_query($connection, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY ". $columns_order[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'];

    if($requestData['length'] != "-1"){
        $sql .= " LIMIT ".$requestData['start']." ,".$requestData['length'];
    }

    $result = mysqli_query($connection, $sql);
    $data = array();
    $counter = $start;

    $count = $start;
    while($row = mysqli_fetch_array($result)){
        $count++;
        $nestedData = array();

        $nestedData['counter'] = $count;
        $nestedData['fullname'] = $row["fullname"];
        $nestedData['stat'] = $row["stat"];
        $nestedData['membership_date'] = $row["membership_date"];
        $nestedData['branch'] = $row["branch"];
        $nestedData['isregistered'] = $row["isregistered"];
        $nestedData['incentive'] = $row["incentive"];
        $time = strtotime($row["forum_day"]);
        $nestedData['forum_day'] = date('d M, Y - h:i:s', $time);
        $nestedData['user_s'] = $row["user_s"];
        // $nestedData['email'] = '<a href="mailto:'.strtolower($row["email"]).'">'.strtolower($row["email"]).'</a>';
        $data[] = $nestedData;
    }

    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),
        "recordsTotal"    => intval( $totalData),
        "recordsFiltered" => intval( $totalFiltered ),
        "records"         => $data
    );

    echo json_encode($json_data);
}

?>
