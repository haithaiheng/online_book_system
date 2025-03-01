<?php
header('Content-type: application/json');
require_once('../providers/api.php');
$api = new Api();

$condition = "cate_status=1";
$query = $api->apicategories($condition);
$num = $query->num_rows;
$array = [];
if ($num > 0 ){
    while ($row = $query->fetch_array()){
        $array[] = array('cate_id'=>$row['cate_id']
        ,'cate_title'=>$row['cate_title']);
    }
}
$code = $array == [] ?204:200;
$array = array('code'=>$code, 'data'=> $array);
echo json_encode($array);
?>