<?php
require_once("connection.php");
class Booktypes extends Connection{
    public function addtype($values){
        return $this->insert("obs_booktype","".$values."");
    }
    public function fetch($condition, $start, $limit){
        return $this->select("*","obs_booktype","".$condition."","type_id desc limit ".$start.",".$limit."");
    }
    public function exists($condition){
        $query = $this->select("*","obs_booktype","type_title='".$condition."' and type_status=1",1);
        $num = $query->num_rows;
        if ($num > 0){
            return true;
        }else{
            return false;
        }
    }
    public function updatetype($values, $id){
        return $this->update("obs_booktype","".$values."","type_id='".$id."'");
    }
    public function deletetype($values, $id){
        $q = $this->select("count(*)","obs_books","type_id=".$id." and book_status=1",1);
        $r = $q->fetch_array();
        if ($r[0] > 0){
            return false;
        }else{
            return $this->update("obs_booktype","".$values."","type_id='".$id."'");
        }
        
    }
}
?>