<?php session_start(); ?>
<?php 
if (is_null($_SESSION['userid'])){
    header('Location: login');
    exit;
}
include_once('header.php');
include_once('menu.php');
?>

<div class="container-fluid">
    <div class="position-relative" style="height: 90vh;">
    <div class="position-absolute top-50 start-50 translate-middle">
    <strong class="fs-1">Welcome, you're user id: <?php echo $_SESSION['userid']; ?></strong>    
    </div>
    </div>
    
</div>

<?php 
include_once('footer.php');
?>