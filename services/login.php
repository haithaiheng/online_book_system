<?php
require_once('../providers/users.php');
$user = new Users();

$email = $_POST['email'];
$email = trim($email);
$email = str_replace("'","", $email);
$password = $_POST['password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-Z-' ]*$/",$email)) {
    $result = $user->login($email,$password);
    if ($result){
        header('Location: ../index');
    }else{
        header('Location: ../login');
    }
}
// header('Location: login.php');
?>