<?php
    require_once('../providers/categories.php');
    $cate = new Categories();
    
    $id = $_POST['cate-id'];
    $title = $_POST['cate-title'];
    $title = str_replace("'","''",$title);

    $res['msg'] = 'failed';
    if ($title != ''){
        if ($id > 0 ){
            //update user
            // if (!$cate->exists($title)){
                $result = $cate->updatecategory("cate_title='".$title."'",$id);
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
            if (!$cate->exists($title)){
                $result = $cate->addCategory("null,'".$title."',1");
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