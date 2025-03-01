<?php
if (!isset($_GET['s'])){
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
$title = $_GET['s'];
$limit = 10;
$start = 0;
if ($page > 1){
    $start = $start + $limit;
}
$condition = "(book_title like '%".$title."%' or cate_title like '%".$title."%' or type_title like '%".$title."%') and book_status=1";
$query = $api->apibook($condition, $start, $limit);
$num = $query->num_rows;
$array = [];
if ($num > 0 ){
    while ($row = $query->fetch_array()){
        $array[] = array('book_id'=>$row['book_id']
        ,'book_title'=>$row['book_title']
        ,'book_desc'=>$row['book_desc']
        ,'book_file'=>'http://100.65.64.126:8888/obs/uploads/book/'.$row['book_file']
        ,'book_price'=>$row['book_price']
        ,'book_genre'=>$row['book_genre']
        ,'book_feature'=>$row['book_feature']
        ,'book_thumbnail'=>'http://100.65.64.126:8888/obs/uploads/thumbnail/'.$row['book_thumbnail']
        ,'category_id'=>$row['category_id']
        ,'cate_title'=>$row['cate_title']
        ,'type_id'=>$row['type_id']
        ,'type_title'=>$row['type_title']
        ,'book_createat'=>$row['book_createat']
        ,'book_status'=>$row['book_status']
        ,'book_rate'=>$row['rate']==null? 0:$row['rate']);
    }
}
$next = $api->apibook($condition,0,1000000);
$total = round($next->num_rows / $limit);
$code = $array == [] ?204:200;
$array = array('total_page'=> $total,'code'=>$code, 'data'=> $array);
echo json_encode($array);
?>