<?php
    require_once('connection.php');
    class Books extends Connection {
        public function fetchcategories(){
            $query = $this->select("*","obs_categories","cate_status=1",1);
            $num = $query->num_rows;
            if ($num > 0){
                while($row = $query->fetch_assoc()){
                    ?>
                    <option value="<?php echo $row['cate_id']; ?>"><?php echo $row['cate_title']; ?></option>
                    <?php
                }
            }
        }
        public function fetchtype(){
            $query = $this->select("*","obs_booktype","type_status=1",1);
            $num = $query->num_rows;
            if ($num > 0){
                while($row = $query->fetch_assoc()){
                    ?>
                    <option value="<?php echo $row['type_id']; ?>"><?php echo $row['type_title']; ?></option>
                    <?php
                }
            }
        }
        public function exists($title){
            $query = $this->select("*","obs_books","book_title='".$title."' and book_status=1",1);
            $num = $query->num_rows;
            if ($num > 0){
                return true;
            }else{
                return false;
            }
        }
        public function addbook($values){
            return $this->insert("obs_books","".$values."");
        }
        public function updatebook($values, $id){
            return $this->update("obs_books","".$values."","book_id='".$id."'");
        }
        public function fetch($condition, $start , $limit){
            return $this->select("b.*,c.cate_title,bt.type_title","obs_books as b inner join obs_categories as c ON b.category_id=c.cate_id INNER join obs_booktype as bt on b.type_id=bt.type_id","".$condition."","book_id desc limit ".$start.",".$limit."");
        }
        public function apifetch($condition, $start , $limit){
            return $this->select("b.*,c.cate_title,bt.type_title,(SELECT AVG(rate_num) FROM obs_rating WHERE book_id=b.book_id) as rate","obs_books as b inner join obs_categories as c ON b.category_id=c.cate_id INNER join obs_booktype as bt on b.type_id=bt.type_id","".$condition."","book_id desc limit ".$start.",".$limit."");
        }

    }

?>