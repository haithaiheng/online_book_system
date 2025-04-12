<?php
header('Content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['email'])){
    header("HTTP/1.0 404 Not Found");
    echo json_encode(array('message'=>'paramater missing'));
    exit;
}

require_once('../providers/api.php');
$api = new Api();

$email = $data['email'];
$email = str_replace(" ","", $email);
$email = str_replace("'","", $email);
$password = $data['password'];

$array = [];
$message = 'invalid';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-Z-' ]*$/",$email)) {
    $result = $api->apilogin($email,$password);
    if ($result == 'email'){
        $message = 'incorrect email';
    }else if ($result == 'pwd'){
        $message = 'incorrect password';
    }else{
        $message = 'success';
        while($val = $result->fetch_assoc()){
            $array[] = array('user_id'=>$val['user_id']
            ,'user_firstname'=>$val['user_firstname']
            ,'user_lastname'=>$val['user_lastname']
            ,'user_email'=>$val['user_email']
            ,'user_bio'=>$val['user_bio']
            ,'user_createat'=>$val['user_createat']);
        }
    }
}
echo json_encode(array('message'=>$message,'data'=>$array));
?>