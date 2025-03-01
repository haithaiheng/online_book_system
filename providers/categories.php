<?php
require_once("connection.php");
class Categories extends Connection{
    public function addCategory($values){
        return $this->insert("obs_categories","".$values."");
    }
    public function fetch($condition, $start, $limit){
        return $this->select("*, (select count(*) from obs_books where category_id=cate_id and book_status=1) as count","obs_categories","".$condition."","cate_id desc limit ".$start.",".$limit."");
    }
    public function exists($condition){
        $query = $this->select("*","obs_categories","cate_title='".$condition."' and cate_status=1",1);
        $num = $query->num_rows;
        if ($num > 0){
            return true;
        }else{
            return false;
        }
    }
    public function updatecategory($values, $id){
        return $this->update("obs_categories","".$values."","cate_id='".$id."'");
        
        
    }
    public function deletecategory($values, $id){
        $q = $this->select("count(*)","obs_books","category_id=".$id." and book_status=1",1);
        $n = $q->fetch_array();
        if ($n[0] > 0){
            return false;
        }else{
            return $this->update("obs_categories","".$values."","cate_id='".$id."'");
        }
        
    }
}
?>