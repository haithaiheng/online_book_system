<?php
require_once('../providers/plans.php');
$plan = new Plans();


$id = $_POST['id'];

if ($id > 0){
    $result = $plan->deleteplan($id);
    if ($result){
        echo 'success';
    }else{
        echo $result;
    }
}
?>