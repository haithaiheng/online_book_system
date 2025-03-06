<?php
date_default_timezone_set('Asia/Phnom_Penh');
header('Content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['userid'])){
    echo json_encode(array('message'=>'invalid request'));
    exit;
}
require_once('../providers/api.php');
$api = new Api();
$user_id = $data['userid'];

$message = 'failed';
$arr = [];
$result = $api->mybooks($user_id);
if ($result != false){
    while($row = $result->fetch_assoc()){
        $arr[] = array('book_id'=>$row['book_id'],'book_title'=>$row['book_title']
        ,'book_desc'=>$row['book_desc'],'book_file'=>$row['book_file']
        ,'book_thumbnail'=>$row['book_thumbnail']);
    }
    $message = 'success';
}else{
    $message = 'failed';
}
echo json_encode(array('message'=> $message,'datas'=>$arr));
?>