<?php
// if (!isset($_GET['s'])){
//     echo json_encode(array('code'=>404));
//     exit;
// }
// if (!isset($_GET['page'])){
//     $_GET['page'] = 1;
// }
header('Content-type: application/json');
require_once('../providers/api.php');
$api = new Api();

$catedata = $api->fetchcategory();

$catarr = [];
while ($row = $catedata->fetch_assoc()){
    $catarr = array('cate_id'=>$row['cate_id'],'cate_title'=>$row['cate_title']);
    $bookdata = $api->fetchbookbycate($row['cate_id']);
    $arr = [];
    if ($bookdata != false){
        while($val = $bookdata->fetch_assoc()){
            $arr[] = array('book_id'=>$val['book_id'],'book_title'=>$val['book_title']
            ,'book_file'=>$baseurl.'uploads/book/'.$val['book_file'],'book_genre'=>$val['book_genre']
        ,'book_thumbnail'=>$baseurl.'uploads/thumbnail/'.$val['book_thumbnail']
        ,'book_price'=>number_format($val['book_price'],2),'book_genre'=>$val['book_genre']
        ,'book_feature'=>$val['book_feature'],'rating'=>number_format((float)$val['rating'],2));
        }
    }
    $finalarr[] = array('categories'=>$catarr,'books'=>$arr);
}
echo json_encode(array('data'=>$finalarr));
?>