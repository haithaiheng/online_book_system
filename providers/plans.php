<?php
    require_once('connection.php');

    class Plans extends Connection {
        public function addplan($values){
           return $this->insert("obs_plans","".$values."");
        }
        public function fetch($con,$start,$limit){
            return $this->select("*","obs_plans","".$con."","plan_id desc limit ".$start.",".$limit."");
        }
        public function updateplan($values,$id){
            return $this->update("obs_plans","".$values."","plan_id='".$id."'");
        }
        public function deleteplan($id){
            $q = $this->select("count(*)","obs_invoice_detail","plan_id=".$id."",1);
            $n = $q->fetch_array();
            if ($n[0] > 0){
                return false;
            }else{
                return $this->update("obs_plans","plan_status=0","plan_id='".$id."'");
            }
            
        }
        public function exists($value){
            $query = $this->select("*","obs_plans","plan_title='".$value."'",1);
            $num = $query->num_rows;
            if ($num > 0){
                return true;
            }else{
                return false;
            }
        }
    }
?>