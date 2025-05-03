<?php
date_default_timezone_set('Asia/Phnom_Penh');
header('Content-type: application/json');
$request = json_decode(file_get_contents('php://input'), true);
if (!isset($request['id']) || !isset($request['uid'])){
    
    echo json_encode(array('code'=>404,'message'=>'missing param'));
    exit;
}
    require_once('../providers/api.php');
    $api = new Api();

    $id = $request['id'];
    $uid = $request['uid'];
    $data = '';
    $cdata = [];
    $result = $api->apidetail($id, $uid);
    $comment = $api->apicomment($id);
    if ($comment){
        while($row = $comment->fetch_assoc()){
            $cdata[] = array('com_id'=>$row['com_id']
            ,'com_date'=>$row['com_date']
            ,'com_text'=>$row['com_text']
            ,'user_id'=>$row['user_id']
            ,'user_firstname'=>$row['user_firstname']);
        }
    }
    if ($result){
        while($row = $result->fetch_assoc()){
            $data = array('book_id'=>$row['book_id']
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
            ,'book_rate'=>$row['rate']== null? "0":number_format($row['rate'],2)
            ,'ordered'=>$row['ordered']== 0? false: true
            ,'comments'=>$cdata);
        }
    }
    echo json_encode(array('code'=>!$result?404:200,'data'=>$data));
?>