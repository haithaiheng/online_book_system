<?php
    require_once('../providers/booktypes.php');
    $type = new Booktypes();
    
    $id = $_POST['type-id'];
    $title = $_POST['type-title'];
    $title = str_replace("'","''",$title);

    $res['msg'] = 'failed';
    if ($title != ''){
        if ($id > 0 ){
            //update user
            // if (!$type->exists($title)){
                $result = $type->updatetype("type_title='".$title."'",$id);
                if ($result){
                    $res['msg'] = 'update';
                }else{
                    $res['msg'] = $result;
                }
            // }else{
            //     $res['msg'] = 'exists';
            // }
            
        }else{
            //add new user
            if (!$type->exists($title)){
                $result = $type->addtype("null,'".$title."',1");
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