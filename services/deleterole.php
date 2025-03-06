<?php
require_once('../providers/roles.php');
$role = new Roles();


$id = $_POST['id'];

if ($id > 0){
    $result = $role->deleterole($id);
    if ($result){
        echo 'success';
    }else{
        echo $result;
    }
}
?>