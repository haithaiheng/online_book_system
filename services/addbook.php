<?php

    date_default_timezone_set('Asia/Phnom_Penh');
    require_once('../providers/books.php');
    $book = new Books();
    $t =  time();
    if (isset($_POST['book-feature'])) {
        $book_feature = 1;
        // Checkbox is selected
    } else {
        $book_feature = 0;
       // Alternate code
    }
    $book_id = $_POST['book-id'];
    $book_title = $_POST['book-title'];
    $book_title = str_replace("'","''",$book_title);
    $book_desc = $_POST['book-desc'];
    $book_desc = str_replace("'","''",$book_desc);
    //prepare pdf file
    $book_file = $_FILES['book-file']['name'];
    if ($book_file != null){
        $temp_file = explode(".", $_FILES['book-file']['name']);
        $book_title = str_replace("'","",$book_title);
        $book_title = str_replace(" ","_",$book_title);
        $book_file = $book_title.'_'.$t.'.'.end($temp_file);
    }else{
        $book_file = $_POST['txt-file'];
    }
    

    $book_price = number_format($_POST['book-price'],2);
    $book_genre = $_POST['book-genre'];

    // prepare thumbnail
    $book_thumbnail = $_FILES['book-thumbnail']['name'];
    if ($book_thumbnail != null){
        $temp_thumbnail = explode(".", $_FILES['book-thumbnail']['name']);
        $book_title = str_replace("'","",$book_title);
        $book_title = str_replace(" ","_",$book_title);
        $book_thumbnail = $book_title.'_'.$t.'.'.end($temp_thumbnail);
    }else{
        $book_thumbnail = $_POST['txt-thumbnail'];
    }

    $cate_id = $_POST['cate-id'];
    $type_id = $_POST['type-id'];
    $book_createat = date('Y-m-d H:i:s');
    // $book_status = 1;
    $target_file = "../uploads/book/".$book_file;
    $target_thumbnail = "../uploads/thumbnail/".$book_thumbnail;

    $res['msg'] = 'failed';
    if ($book_title != ''){
        if ($book_id > 0){
            //update
            $result = $book->updatebook("book_title='".$book_title."'
            ,book_desc='".$book_desc."',book_file='".$book_file."'
            ,book_price='".$book_price."',book_genre='".$book_genre."'
            ,book_feature='".$book_feature."',book_thumbnail='".$book_thumbnail."'
            ,category_id='".$cate_id."',type_id='".$type_id."'",$book_id);
            if ($result){
                $res['msg'] = 'update';
                if ($_FILES['book-thumbnail']['name'] != null){
                    if (move_uploaded_file($_FILES["book-thumbnail"]["tmp_name"], $target_thumbnail)) {
                        // $file_upload = true;
                    } else {
                        $res['msg'] = 'thumbnail';
                    }
                }
                if ($_FILES['book-file']['name'] != null){
                    if (move_uploaded_file($_FILES["book-file"]["tmp_name"], $target_file)) {
                        // $file_upload = true;
                    } else {
                        $res['msg'] = 'file';
                    }
                }
            }else{
                $res['msg'] = $result;
            }
        }else{
            //add
            if (!$book->exists($book_title)){
                $result = $book->addbook("null,'".$book_title."','".$book_desc."'
                ,'".$book_file."','".$book_price."','".$book_genre."'
                ,'".$book_feature."','".$book_thumbnail."','".$cate_id."'
                ,'".$type_id."','".$book_createat."',1");
                if ($result > 0){
                    if (move_uploaded_file($_FILES["book-thumbnail"]["tmp_name"], $target_thumbnail)) {
                        if (move_uploaded_file($_FILES["book-file"]["tmp_name"], $target_file)) {
                            $res['msg'] = 'add';
                        } else {
                            $res['msg'] = 'file';
                        }
                    } else {
                        $res['msg'] = 'thumbnail';
                    }
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