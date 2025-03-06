<?php
date_default_timezone_set('Asia/Phnom_Penh');
header('Content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['userid'])){
    echo json_encode(array('message'=>'invalid request'));
    exit;
}
require_once('../providers/api.php');
$api = new Api();
$order_date = $data['date'];
$user_id = $data['userid'];
$total_amount = $data['amount'];
// $detail = json_decode($data['details']);

$message = 'failed';
//invoice_date,invoice_total,invoice_status
$invoice = $api->invoice("'".$order_date."','".$total_amount."',1");
if ($invoice > 0){
    foreach($data['details'] as $obj){
        //invoice_id,book_id,invd_price,invd_amount,invd_remark
        $invoicedetail = $api->invoicedetail("'".$invoice."','".$obj['bookid']."','".$obj['price']."','".$obj['amount']."','".$obj['remark']."'");
        if ($invoicedetail > 0){
        }else{
            $message = 'failed';
        }
    }
    //order_date,user_id,invoice_id,order_status
    $order = $api->userorder("'".$order_date."',".$user_id.",".$invoice.",1");
    if ($order > 0){
        $message = 'success';
    }else{
        $message = 'failed';
    }
}else{
    $message = 'failed';
}
echo json_encode(array('message'=> $message));
?>