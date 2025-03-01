<?php
require_once('../providers/comments.php');
$comm = new Comments();


$id = $_POST['id'];

if ($id > 0){
    $result = $comm->hide("com_status=0",$id);
    if ($result){
        echo 'success';
    }else{
        echo $result;
    }
}
?>