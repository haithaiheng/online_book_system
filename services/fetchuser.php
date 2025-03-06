<?php
header('Content-type: application/json');
require_once('../providers/users.php');
$user = new Users();

$start = $_POST['start'];
$limit = $_POST['limit'];
$user_email = $_POST['search'];
$condition = "u.user_email like '%".$user_email."%' and u.user_status=1";
$query = $user->fetchuser($condition, $start, $limit);
$num = $query->num_rows;
$array = [];
if ($num > 0 ){
    while ($row = $query->fetch_array()){
        $array[] = array('user_id'=>$row['user_id'],'user_no'=>$row['user_no'],'user_email'=>$row['user_email'],'role_id'=>$row['role_id'],'role_title'=>$row['role_title'],'user_createat'=>$row['user_createat'],'user_status'=>$row['user_status']);
    }
}
$next = $user->fetchuser($condition,0,1000000);
$total = $next->num_rows;
$array = array('total'=> $total, 'data'=> $array);
echo json_encode($array);
?>