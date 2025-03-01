<?php
    date_default_timezone_set('Asia/Phnom_Penh');
    require_once('../providers/users.php');
    $user = new Users();
    
    $user_id = $_POST['user-id'];
    $user_no = $_POST['user-no'];
    // $user_first = $_POST['user-first'];
    // $user_last = $_POST['user-last'];
    $user_email = $_POST['user-email'];
    $user_email = str_replace("'","",$user_email);
    $user_password = password_hash($_POST['user-pwd'], PASSWORD_DEFAULT);
    // $user_bio = $_POST['user-bio'];
    // $user_confirm = '';
    $role_id = $_POST['role-id'];
    $user_status = 1;
    $user_createat = date('Y-m-d H:i:s');
    $user_updateat = date('Y-m-d H:i:s');
    // $user_lastlogin = date('Y-m-d H:i:s');

    $res['msg'] = 'failed';
    if ($user_email != ''){
        if ($user_id > 0 ){
            //update user
            $result = $user->updateuser("user_email='".$user_email."',user_updateat='".$user_updateat."',role_id='".$role_id."'",$user_id);
            if ($result){
                $res['msg'] = 'update';
            }else{
                $res['msg'] = $result;
            }
        }else{
            if (!$user->validateemail($user_email)){
                //add new user
                $result = $user->adduser("'".$user_no."','".$user_email."','".$user_password."','".$role_id."','".$user_status."','".$user_createat."'");

                // $result = $user->adduser("null,'".$user_no."','".$user_first."','".$user_last."','".$user_email."','".$user_password."','".$user_bio."','".$user_confirm."','".$role_id."','".$user_status."','".$user_createat."','".$user_updateat."','".$user_lastlogin."'");
                if ($result > 0 ){
                    $res['msg'] = 'add';
                }else{
                    $res['msg'] = $result;
                }
            }else{
                $res['msg'] = 'exists';
            }
        }
    }
    echo json_encode($res);
?>