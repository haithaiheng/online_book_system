<?php
    if (!isset($_GET['id'])){
        echo "<center><strong>"."invalid request!"."</strong></center>";
        exit;
    }
session_start();
include_once('header.php');
include_once('menu.php');
require_once('./providers/orders.php');
$execute = new Orders();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-6"><p class="fs-2">Orders of Invoice No <?php echo $_GET['id']; ?></p></div>
        <div class="col"></div>
    </div>
    <?php 
    echo $execute->fetchdetail($_GET['id']);
    ?>
</div>