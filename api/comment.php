<?php
    date_default_timezone_set('Asia/Phnom_Penh');
    header('Content-type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['text'])){
        echo json_encode(array('message'=>'invalid request'));
        exit;
    }

    require_once('../providers/api.php');
    $api = new Api();
    
    $com_date = date('Y-m-d H:i:s');

    $res = 'failed';
    $resdata = array();
    if ($data['text'] != ''){
        //add new user (user_no,user_firstname,user_lastname,user_email,user_password,user_bio,role_id,user_status,user_createat)
        $result = $api->apiaddcomm("'".$com_date."','".$data['text']."','".$data['userid']."','".$data['bookid']."',1");
        if ($result != false ){
            $res = 'add';
            while($row = $result->fetch_assoc()){
                $resdata = array('id'=>$row['com_id'],
            'com_date'=>$row['com_date'],'com_text'=>$row['com_text']);
            }
        }else{
            $res = $result;
        }
    }
    
    echo json_encode(array('message'=>$res,'data'=>$resdata));
?>