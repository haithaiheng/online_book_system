<?php
require_once('../providers/booktypes.php');
$type = new Booktypes();


$id = $_POST['id'];

if ($id > 0){
    $result = $type->deletetype("type_status=0",$id);
    if ($result){
        echo 'success';
    }else{
        echo $result;
    }
}
?>