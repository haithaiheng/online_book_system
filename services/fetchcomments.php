<?php
// header('Content-type: application/json');
require_once('../providers/comments.php');
$comm = new Comments();

$start = $_POST['start'];
$limit = $_POST['limit'];
$title = $_POST['title'];
$condition = "com_text like '%".$title."%' and com_status=1";
$query = $comm->fetch($condition, $start, $limit);
$num = $query->num_rows;
$array = [];
if ($num > 0 ){
    while ($row = $query->fetch_array()){
        $array[] = array('com_id'=>$row['com_id'],'com_date'=>$row['com_date']
        ,'com_text'=>$row['com_text'],'user_firstname'=>$row['user_firstname']
        ,'book_title'=>$row['book_title'],'com_status'=>$row['com_status']);
    }
}
$next = $comm->fetch($condition,0,1000000);
$total = $next->num_rows;
$array = array('total'=> $total, 'data'=> $array);
echo json_encode($array);
?>