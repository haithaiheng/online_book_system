<?php
header('Content-type: application/json');
require_once('../providers/booktypes.php');
$type = new Booktypes();

$start = $_POST['start'];
$limit = $_POST['limit'];
$title = $_POST['title'];
$condition = "type_title like '%".$title."%' and type_status=1";
$query = $type->fetch($condition, $start, $limit);
$num = $query->num_rows;
$array = [];
if ($num > 0 ){
    while ($row = $query->fetch_array()){
        $array[] = array('type_id'=>$row['type_id'],'type_title'=>$row['type_title'],'type_status'=>$row['type_status']);
    }
}
$next = $type->fetch($condition,0,1000000);
$total = $next->num_rows;
$array = array('total'=> $total, 'data'=> $array);
echo json_encode($array);
?>