<?php
    require_once('connection.php');

    class Users extends Connection {
        public function adduser($values){
           return $this->insert("obs_users(user_no,user_email,user_password,role_id,user_status,user_createat)","".$values."");
        }
        public function fetchallrole(){
            $data = $this->select("*","obs_roles","role_status=1",1);
            $num = $data->num_rows;
            if ($num> 0){
                while ($row = $data->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['role_id']; ?>"><?php echo $row['role_title']; ?></option>
                    <?php
                }
            }

        }
        public function validateemail( $email ){
            $query = $this->select('*','obs_users',"user_email='".$email."' and user_status=1",1);
            $num = $query->num_rows;
            if ($num> 0){
                return true;
            }else{
                return false;
            }
        }
        public function fetchuser($con,$start,$limit){
            return $this->select("u.*,r.*","obs_users as u inner join obs_roles as r on u.role_id=r.role_id","".$con."","u.user_id desc limit ".$start.",".$limit."");
        }
        public function updateuser($values,$id){
            return $this->update("obs_users","".$values."","user_id='".$id."'");
        }
        public function deleteuser($id){
            return $this->update("obs_users","user_status=0","user_id='".$id."'");
        }
        public function login($email,$password){
            $query = $this->select("*","obs_users","user_email='".$email."' and role_id=1 and user_status=1",1);
            $num = $query->num_rows;
            if ($num > 0){
                $pwd = $this->select("user_id,user_password","obs_users","user_email='".$email."'",1);
                while ($row = $pwd->fetch_assoc()){
                    if (password_verify($password, $row['user_password'])){
                        session_start();
				        $_SESSION['userid']=$row['user_id'];
                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                return 'email';
            }
        }
    }
?>