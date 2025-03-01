<?php
header('Content-type: application/json');
require_once('../providers/categories.php');
$cate = new Categories();

$start = $_POST['start'];
$limit = $_POST['limit'];
$title = $_POST['title'];
$condition = "cate_title like '%".$title."%' and cate_status=1";
$query = $cate->fetch($condition, $start, $limit);
$num = $query->num_rows;
$array = [];
if ($num > 0 ){
    while ($row = $query->fetch_array()){
        $array[] = array('cate_id'=>$row['cate_id'],'cate_title'=>$row['cate_title'],'cate_status'=>$row['cate_status'],'count'=>$row['count']);
    }
}
$next = $cate->fetch($condition,0,1000000);
$total = $next->num_rows;
$array = array('total'=> $total, 'data'=> $array);
echo json_encode($array);
?>