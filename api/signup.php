<?php
    date_default_timezone_set('Asia/Phnom_Penh');
    header('Content-type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['email'])){
        header("HTTP/1.0 404 Not Found");
        echo json_encode(array('message'=>'invalid paramater'));
        exit;
    }

    require_once('../providers/api.php');
    $api = new Api();
    
    $user_no = $data['no'];
    $user_first = $data['first'];
    $user_last = $data['last'];
    $user_email = $data['email'];
    $user_email = str_replace("'","",$user_email);
    $user_password = password_hash($data['pwd'], PASSWORD_DEFAULT);
    $user_bio = $data['bio'];
    $role_id = 1;
    $user_status = 1;
    $user_createat = date('Y-m-d H:i:s');

    $res = 'failed';
    $resdata = array();
    if ($user_email != ''){
        if (!$api->apivalidateemail($user_email)){
            //add new user (user_no,user_firstname,user_lastname,user_email,user_password,user_bio,role_id,user_status,user_createat)
            $result = $api->apiregister("'".$user_no."','".$user_first."','".$user_last."','".$user_email."','".$user_password."','".$user_bio."','".$role_id."','".$user_status."','".$user_createat."'");
            if ($result != false ){
                $res = 'add';
                while($row = $result->fetch_assoc()){
                    $resdata = array('email'=>$row['user_email'],
                'user_no'=>$row['user_no'],'bio'=>$row['user_bio'],'first'=>$row['user_firstname'],'last'=>$row['user_lastname']);
                }
            }else{
                $res = $result;
            }
        }else{
            $res = 'exists';
        }
    }
    
    echo json_encode(array('message'=>$res,'data'=>$resdata));
?>