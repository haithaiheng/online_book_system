<?php
date_default_timezone_set('Asia/Phnom_Penh');
header('Content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['id'])){
    header("HTTP/1.0 404 Not Found");
    echo json_encode(array('message'=>'paramaters missing'),true);
    exit;
}
require_once('../providers/api.php');
$api = new Api();
$user_id = $data['id'];
$page =1;
if (isset($data['page'])){
    $page = $data['page'];
}
$limit = 10;
$start = 0;
if ($page > 1){
    $start = $limit * ($page -1);
}
$message = 'failed';
$arr = [];
$result = $api->mybooks($user_id,$start,$limit);
if ($result != false){
    while($row = $result->fetch_assoc()){
        $arr[] = array('book_id'=>$row['book_id'],'book_title'=>$row['book_title']
        ,'book_desc'=>$row['book_desc'],'book_file'=>$baseurl.'uploads/book/'.$row['book_file']
        ,'book_thumbnail'=>$baseurl.'uploads/thumbnail/'.$row['book_thumbnail'],'book_category'=>$row['cate_title']);
    }
    $message = 'success';
}else{
    $message = 'unfound';
}
$count = $api->mybooks($user_id,0,1000000);
$total = ceil($count->num_rows / $limit);
echo json_encode(array('message'=> $message,'page'=>$total,'data'=>$arr));
?>