<?php
require_once('../providers/users.php');
$user = new users();


$id = $_POST['id'];
$prompt = $_POST['prompt'];
$password = password_hash('admin', PASSWORD_DEFAULT);
if ($id > 0){
    if ($prompt == 'delete'){
        $result = $user->deleteuser($id);
    }else if ($prompt == 'reset'){
        $result = $user->updateuser("user_password='".$password."'",$id);
    }
    if ($result){
        echo 'success';
    }else{
        echo $result;
    }
}
?>