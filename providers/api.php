<?php
    require_once('connection.php');
    require_once('../__config.php');
    class Api extends Connection {
        public function apibook($condition, $start , $limit){
            return $this->select("b.*,c.cate_title,bt.type_title,(SELECT AVG(rate_num) 
            FROM obs_rating WHERE book_id=b.book_id) as rate","obs_books as b 
            inner join obs_categories as c ON b.category_id=c.cate_id 
            INNER join obs_booktype as bt on b.type_id=bt.type_id","".$condition."","book_id desc limit ".$start.",".$limit."");
        }
        public function apilogin($email,$password){
            $query = $this->select("*","obs_users","user_email='".$email."' and user_status=1",1);
            $num = $query->num_rows;
            if ($num > 0){
                $pwd = $this->select("user_password","obs_users","user_email='".$email."'",1);
                while ($row = $pwd->fetch_assoc()){
                    if (password_verify($password, $row['user_password'])){
                        return $query;
                    }else{
                        return 'pwd';
                    }
                }
            }else{
                return 'email';
            }
        }
        public function apivalidateemail( $email ){
            $query = $this->select('*','obs_users',"user_email='".$email."' and user_status=1",1);
            $num = $query->num_rows;
            if ($num> 0){
                return true;
            }else{
                return false;
            }
        }
        public function apiregister($values){
            $query = $this->insert("obs_users(user_no,user_firstname,user_lastname,user_email,user_password,user_bio,role_id,user_status,user_createat)","".$values."");
            if ($query>0){
               return $this->select("*","obs_users","user_id='".$query."' and user_status=1",1);
            }else{
                return false;
            }
        }
        public function apicategories($condition){
            return $this->select("*","obs_categories","".$condition."","cate_id desc");
        }
        public function apidetail($id, $uid){
            $query = $this->select("b.*,c.cate_title,bt.type_title,(SELECT AVG(rate_num) 
            FROM obs_rating WHERE book_id=".$id.") as rate, (SELECT COUNT(*) FROM obs_usersorder as uo
            INNER JOIN obs_invoice_detail as ivd ON uo.invoice_id=ivd.invoice_id WHERE ivd.book_id =".$id." and uo.order_status=1 and uo.user_id=".$uid.") as ordered","obs_books as b 
            inner join obs_categories as c ON b.category_id=c.cate_id 
            INNER join obs_booktype as bt on b.type_id=bt.type_id","book_id=".$id."",1);
            $num = $query->num_rows;
            if ($num>0){
                return $query;
            }else{
                return false;
            }
        }
        public function apicomment($id){
            $query = $this->select("c.*,u.user_firstname","obs_comments as c left join obs_users as u on c.user_id=u.user_id","book_id=".$id." and com_status=1",1);
            $num = $query->num_rows;
            if ($num>0){
                return $query;
            }else{
                return false;
            }
        }
        public function apiaddcomm($values){
            $query = $this->insert("obs_comments(com_date,com_text,user_id,book_id,com_status)","".$values."");
            if ($query > 0){
                return $this->select("*","obs_comments","com_id='".$query."' and com_status=1",1);
            }else{
                return false;
            }
        }
        public function invoice($values) {
            $result = $this->insert("obs_invoice(invoice_date,invoice_total,invoice_transac,invoice_status)","".$values."");
            if ($result > 0){
                return $result;
            }else{
                return false;
            }
        }
        public function invoicedetail($values){
            $result = $this->insert("obs_invoice_detail(invoice_id,book_id,invd_price,invd_amount)","".$values."");
            if ($result > 0){
                return $result;
            }else{
                return false;
            }
        }
        public function userorder($values) {
            $result = $this->insert("obs_usersorder(order_date,user_id,invoice_id,order_status)","".$values."");
            if ($result > 0){
                return $result;
            }else{
                return false;
            }
        }
        public function mybooks($id,$start,$limit){
            $result = $this->select("b.*,c.cate_title","obs_usersorder as o inner join obs_invoice as i on o.invoice_id=i.invoice_id
             inner join obs_invoice_detail as id on i.invoice_id=id.invoice_id inner join obs_books as b on id.book_id=b.book_id inner join obs_categories as c on b.category_id = c.cate_id",
            "o.user_id=".$id." and i.invoice_status=1","b.book_id desc limit ".$start.",".$limit."");
            $num = $result->num_rows;
            if ($num > 0){
                return $result;
            }else{
                return false;
            }
        }
        public function fetchcategory(){
            $category = $this->select("*","obs_categories","cate_status=1",1);
            $num = $category->num_rows;
            if ($num > 0){
                return $category;
            }else{
                return false;
            }
        }
        public function fetchbookbycate($id){
            $book = $this->select("b.*,c.cate_title,(select AVG(rate_num) from obs_rating where book_id=b.book_id)as rating","obs_books as b inner join obs_categories as c on b.category_id=c.cate_id","b.category_id=".$id." and b.book_status=1","b.book_id desc limit 0,2");
            $num = $book->num_rows;
            if ($num > 0){
                return $book;
            }else{
                return false;
            }
        }
        public function bookbycate($condition, $start, $limit){
            $book = $this->select("b.*,c.cate_title,(SELECT AVG(rate_num) 
            FROM obs_rating WHERE book_id=b.book_id) as rate","obs_books as b inner join obs_categories as c on b.category_id=c.cate_id","".$condition."","b.book_id desc limit ".$start.",".$limit."");
            $num = $book->num_rows;
            if ($num > 0){
                return $book;
            }else{
                return false;
            }
        }
        public function updateprofile($values, $id){
            return $this->update("obs_users","".$values."","user_id=".$id."");
        }
        public function getprofile($id){
            $query = $this->select("*","obs_users","user_id='".$id."' and user_status=1",1);
            $num = $query->num_rows;
            if ($num > 0){
                return $query;
            }else{
                return 'email';
            }
        }
        public function forgot($email){
            $qemail = $this->select("*","obs_users","user_email='".$email."' and user_status=1",1);
            $num = $qemail->num_rows;
            if ($num > 0){
                $six_digit_random_number =  sprintf("%06d", mt_rand(1, 999999));
                $query = $this->update("obs_users","user_confirmcode='".$six_digit_random_number."'","user_email='".$email."'");
                if ($query){
                    return $qemail;
                }
                
            }else{
                return null;
            }
        }
        public function resetpassword($values, $email){
            $query = $this->update("obs_users","".$values."","user_email='".$email."'");
            if ($query){
                return true;
            }else{
                return false;
            }
        }
    }

?>