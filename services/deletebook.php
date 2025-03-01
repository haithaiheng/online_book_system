<?php
require_once('../providers/books.php');
$book = new Books();


$id = $_POST['id'];

if ($id > 0){
    $result = $book->updatebook("book_status=0",$id);
    if ($result){
        echo 'success';
    }else{
        echo $result;
    }
}
?>