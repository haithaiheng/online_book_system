<?php
if (!isset($_GET['id'])){
    echo json_encode(array('code'=>404));
    exit;
}
if (!isset($_GET['page'])){
    $_GET['page'] = 1;
}
header('Content-type: application/json');
require_once('../providers/api.php');
$api = new Api();

$page = $_GET['page'];
$limit = 10;
$start = 0;
if ($page > 1){
    $start = $start + $limit;
}
$condition = "category_id =".$_GET['id']." and book_status=1";
$arr = [];
$bookdata = $api->bookbycate($condition, $start, $limit);
if ($bookdata != false){
    while($val = $bookdata->fetch_assoc()){
        $arr[] = array('book_id'=>$val['book_id'],'book_title'=>$val['book_title']
        ,'book_file'=>$val['book_file'],'book_genre'=>$val['book_genre']
    ,'book_thumbnail'=>$val['book_thumbnail']);
    }
}
$next = $api->bookbycate($condition,0,1000000);
$total = round($next->num_rows / $limit);
$code = $arr == [] ?204:200;
$array = array('total_page'=> $total,'code'=>$code, 'data'=> $arr);
echo json_encode($array);
?>