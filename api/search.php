<?php
header('Content-type: application/json');
require_once('../providers/api.php');
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['s'])){
    header("HTTP/1.0 404 Not Found");
    echo json_encode(array('message'=>'paramaters missing'),true);
    exit;
}
$api = new Api();
$page =1;
if (isset($data['page'])){
    $page = $data['page'];
}
$title = $data['s'];
$limit = 10;
$start = 0;
if ($page > 1){
    $start = $limit * ($page -1);
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
        ,'book_file'=>$baseurl.'uploads/book/'.$row['book_file']
        ,'book_price'=>$row['book_price']
        ,'book_genre'=>$row['book_genre']
        ,'book_feature'=>$row['book_feature']
        ,'book_thumbnail'=>$baseurl.'uploads/thumbnail/'.$row['book_thumbnail']
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
$total = ceil($next->num_rows / $limit);
$code = $array == [] ?'unfound':'success';
$array = array('total_page'=> $total,'message'=>$code, 'data'=> $array);
echo json_encode($array);
?>