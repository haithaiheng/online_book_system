<?php
require_once("connection.php");
class Comments extends Connection{
    public function fetch($condition, $start, $limit){
        return $this->select("c.*,u.user_firstname,b.book_title","obs_comments as c
                        inner join obs_users as u on c.user_id=u.user_id
                        inner join obs_books as b on c.book_id=b.book_id","".$condition."","c.com_id desc limit ".$start.",".$limit."");
    }
    public function hide($values, $id){
        return $this->update("obs_comments","".$values."","com_id='".$id."'");
    }
}
?>