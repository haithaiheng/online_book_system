<?php
header('Content-type: application/json');
require_once('../providers/plans.php');
$plan = new Plans();

$start = $_POST['start'];
$limit = $_POST['limit'];
$title = $_POST['title'];
$condition = "plan_title like '%".$title."%' and plan_status=1";
$query = $plan->fetch($condition, $start, $limit);
$num = $query->num_rows;
$array = [];
if ($num > 0 ){
    while ($row = $query->fetch_array()){
        $array[] = array('plan_id'=>$row['plan_id']
        ,'plan_title'=>$row['plan_title']
        ,'plan_desc'=>$row['plan_desc']
        ,'plan_days'=>$row['plan_days']
        ,'plan_status'=>$row['plan_status']);
    }
}
$next = $plan->fetch($condition,0,1000000);
$total = $next->num_rows;
$array = array('total'=> $total, 'data'=> $array);
echo json_encode($array);
?>