<?php
header('Content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['userid'])){
    echo json_encode(array('message'=>'invalid request'));
    exit;
}

require_once('../providers/api.php');
$api = new Api();

$frist = $data['first'];
$last = $data['last'];
$bio = $data['bio'];
$frist = str_replace("'","''", $frist);
$last = str_replace("'","''", $last);
$user_updateat = date('Y-m-d H:i:s');

$message = 'failed';
if ($data['userid']>0) {
    $result = $api->updateprofile("user_firstname='".$frist."',user_lastname='".$last."'
    ,user_bio='".$bio."',user_updateat='".$user_updateat."'",$data['userid']);
    if ($result){
        $message = 'success';
    }
}

echo json_encode(array('message'=>$message));
?>