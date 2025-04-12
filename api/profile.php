<?php
header('Content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['id'])){
    header("HTTP/1.0 404 Not Found");
    echo json_encode(array('message'=>'paramaters missing'),true);
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
$arr = [];
if ($data['id']>0) {
    $result = $api->updateprofile("user_firstname='".$frist."',user_lastname='".$last."'
    ,user_bio='".$bio."',user_updateat='".$user_updateat."'",$data['id']);
    if ($result){
        $profile = $api->getprofile($data['id']);
        while($val = $profile->fetch_assoc()){
            $arr[] = array('user_id'=>$val['user_id'],'user_firstname'=>$val['user_firstname']
            ,'user_lastname'=>$val['user_lastname'],'user_email'=>$val['user_email'],'user_bio'=>$val['user_bio']
            ,'user_createat'=>$val['user_createat']);
        }
        $message = 'success';
    }
}

echo json_encode(array('message'=>$message,'data'=>$arr));
?>