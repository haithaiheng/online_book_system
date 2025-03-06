<?php
require_once('../providers/categories.php');
$cate = new Categories();


$id = $_POST['id'];

if ($id > 0){
    $result = $cate->deletecategory("cate_status=0",$id);
    if ($result){
        echo 'success';
    }else{
        echo $result;
    }
}
?>