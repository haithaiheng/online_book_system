<?php
header('Content-type: application/json');
require_once('../providers/orders.php');
$order = new Orders();

$text = $_POST['text'];
$start = $_POST['start'];
$limit = $_POST['limit'];

$condition = "(u.user_email like '%".$text."%' or i.invoice_id like '%".$text."%')";
$result = $order->fetch($condition,$start,$limit);
$data = [];
if ($result != false){
    while ($val = $result->fetch_assoc()){
        $data[] = array('order_id'=>$val['order_id'],
        'order_date'=>$val['order_date'],
        'user_id'=>$val['user_id'],
        'invoice_id'=>$val['invoice_id'],
        'order_status'=>$val['order_status'],
        'user_email'=>$val['user_email'],
        'invoice_total'=>$val['invoice_total'],
        'invoice_transac'=>$val['invoice_transac']);
    }
}
$next = $order->fetch($condition,0,1000000);
$total = $next->num_rows;
$array = array('total'=> $total, 'data'=> $data);
echo json_encode($array);
?>