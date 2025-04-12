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
    $start = 1 + ($limit * ($page -1 ));
}
$condition = "b.category_id =".$_GET['id']." and b.book_status=1";
$arr = [];
$bookdata = $api->bookbycate($condition, $start, $limit);
if ($bookdata != false){
    while($val = $bookdata->fetch_assoc()){
        $arr[] = array('book_id'=>$val['book_id'],'book_title'=>$val['book_title']
        ,'book_price'=>$val['book_price'],'book_rate'=>$val['rate'],'book_cate'=>$val['cate_title']
        ,'book_file'=>$baseurl.'uploads/book/'.$val['book_file'],'book_genre'=>$val['book_genre']
    ,'book_thumbnail'=>$baseurl.'uploads/thumbnail/'.$val['book_thumbnail']);
    }
}
$next = $api->bookbycate($condition,0,1000000);
$total = ceil($next->num_rows / $limit);
$code = $arr == [] ?204:200;
$array = array('total_page'=> $total,'code'=>$code, 'data'=> $arr);
echo json_encode($array);
?>