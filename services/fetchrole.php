<?php
header('Content-type: application/json');
require_once('../providers/roles.php');
$role = new Roles();

$start = $_POST['start'];
$limit = $_POST['limit'];
$title = $_POST['title'];
$condition = "role_title like '%".$title."%' and role_status=1";
$query = $role->fetch($condition, $start, $limit);
$num = $query->num_rows;
$array = [];
if ($num > 0 ){
    while ($row = $query->fetch_array()){
        $array[] = array('role_id'=>$row['role_id'],'role_title'=>$row['role_title'],'role_status'=>$row['role_status'],'role_createat'=>$row['role_createat']);
    }
}
$next = $role->fetch($condition,0,1000000);
$total = $next->num_rows;
$array = array('total'=> $total, 'data'=> $array);
echo json_encode($array);
?>