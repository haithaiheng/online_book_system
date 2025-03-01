<?php
		
	/**
	 * 
	 */
	class Connection{
		private $cn;
		private function conn(){
			$this->cn=new mysqli("localhost","root","root","obs_db");
			$this->cn->set_charset("utf8");
		}
		protected function insert($tbl,$val){
			$this->conn();
			$sql="INSERT INTO ".$tbl." VALUES(".$val.")";
			$this->cn->query($sql);
			return $this->cn->insert_id;
		}
		protected function update($tbl,$val,$con){
			$this->conn();
			$sql="UPDATE ".$tbl." SET ".$val." WHERE ".$con."";
			return $this->cn->query($sql);
		}
		protected function select($filed,$tbl,$con,$order){
			$this->conn();
			$sql="SELECT ".$filed." FROM ".$tbl." WHERE ".$con." ORDER BY ".$order."";
			return $this->cn->query($sql);
		}
		protected function filter($filed,$tbl,$con,$order,$limit){
			$this->conn();
			$data_list=array();
			$sql="SELECT ".$filed." FROM ".$tbl." WHERE ".$con." ORDER BY ".$order." LIMIT ".$limit."";
			$result=$this->cn->query($sql);
			$num=$result->num_rows;
			if ($num>0){
				while ($row=$result->fetch_array()){
					$data_list[]=$row;
				}
				return $data_list;
			}else{
				return 0;
			}
		}
		public function get_lastid(){
			return $this->cn->insert_id;
		}
		public function generate_uuid() {
		    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		        mt_rand( 0, 0xffff ),
		        mt_rand( 0, 0x0C2f ) | 0x4000,
		        mt_rand( 0, 0x3fff ) | 0x8000,
		        mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
		    );
		}
	}
?>