<?php
    require_once('connection.php');

    class Roles extends Connection {
        public function addrole($values){
           return $this->insert("obs_roles","".$values."");
        }
        public function fetch($con,$start,$limit){
            return $this->select("*","obs_roles","".$con."","role_id desc limit ".$start.",".$limit."");
        }
        public function updaterole($values,$id){
            return $this->update("obs_roles","".$values."","role_id='".$id."'");
        }
        public function deleterole($id){
            $q = $this->select("count(*)","obs_users","role_id=".$id." and user_status=1",1);
            $r = $q->fetch_array();
            if ($r[0] > 0){
                return false;
            }else{
                return $this->update("obs_roles","role_status=0","role_id='".$id."'");
            }
            
        }
    }
?>