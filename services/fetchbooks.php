<?php
header('Content-type: application/json');
require_once('../providers/books.php');
$book = new Books();

$start = $_POST['start'];
$limit = $_POST['limit'];
$title = $_POST['title'];
$condition = "(book_title like '%".$title."%' or cate_title like '%".$title."%' or type_title like '%".$title."%') and book_status=1";
$query = $book->fetch($condition, $start, $limit);
$num = $query->num_rows;
$array = [];
if ($num > 0 ){
    while ($row = $query->fetch_array()){
        $array[] = array('book_id'=>$row['book_id']
        ,'book_title'=>$row['book_title']
        ,'book_desc'=>$row['book_desc']
        ,'book_file'=>$row['book_file']
        ,'book_price'=>$row['book_price']
        ,'book_genre'=>$row['book_genre']
        ,'book_feature'=>$row['book_feature']
        ,'book_thumbnail'=>$row['book_thumbnail']
        ,'category_id'=>$row['category_id']
        ,'cate_title'=>$row['cate_title']
        ,'type_id'=>$row['type_id']
        ,'type_title'=>$row['type_title']
        ,'book_createat'=>$row['book_createat']
        ,'book_status'=>$row['book_status']);
    }
}
$next = $book->fetch($condition,0,1000000);
$total = $next->num_rows;
$array = array('total'=> $total, 'data'=> $array);
echo json_encode($array);
?>