<?php
    date_default_timezone_set('Asia/Phnom_Penh');
    require_once('../providers/roles.php');
    $role = new Roles();
    
    $roleid = $_POST['role-id'];
    $roletitle = $_POST['role-title'];
    $roletitle = str_replace("'","''",$roletitle);
    $rolecreateat = date('Y-m-d H:i:s');

    $res['msg'] = 'failed';
    if ($roletitle != ''){
        if ($roleid > 0 ){
            //update user
            $result = $role->updaterole("role_title='".$roletitle."'",$roleid);
            if ($result){
                $res['msg'] = 'update';
            }else{
                $res['msg'] = $result;
            }
        }else{
            //add new user
            $result = $role->addrole("null,'".$roletitle."',1,'".$rolecreateat."'");
            if ($result > 0 ){
                $res['msg'] = 'add';
            }else{
                $res['msg'] = $result;
            }
        }
    }
    echo json_encode($res);
?>