<?php
    header('Content-type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['email']) || !isset($data['password'])){
        header("HTTP/1.0 404 Not Found");
        echo json_encode(array('message'=>'paramaters missing'),true);
        exit;
    }
    
    require_once('../providers/api.php');
    $api = new Api();

    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    $message = 'failed';
    $result = $api->resetpassword("user_password='".$password."'",$email);
    if ($result){
        $message = 'success';
    }

    echo json_encode(array('message'=>$message));
?>