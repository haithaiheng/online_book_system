<?php
    require_once('../providers/plans.php');
    $plan = new Plans();
    
    $id = $_POST['plan-id'];
    $title = $_POST['plan-title'];
    $title = str_replace("'","''", $title);
    $desc = $_POST['plan-desc'];
    $desc = str_replace("'","''", $desc);
    $days = number_format($_POST['plan-days'],0);
    $days = str_replace(",","",$days);

    $res['msg'] = 'failed';
    if ($title != ''){
        if ($id > 0 ){
            //update user
            $result = $plan->updateplan("plan_title='".$title."',plan_desc='".$desc."',plan_days='".$days."'",$id);
            if ($result){
                $res['msg'] = 'update';
            }else{
                $res['msg'] = $result;
            }
        }else{
            //add new user
            if (!$plan->exists($title)){
                $result = $plan->addplan("null,'".$title."','".$desc."','".$days."',1");
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