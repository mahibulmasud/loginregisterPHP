<?php
    include_once 'Session.php';
    include 'Database.php';
    class User{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }
        public function userRegistration($data){
            $name     = $data['name'];
            $username = $data['username'];
            $email    = $data['email'];
            $password = $data['password'];
            $chk_email = $this->emailCheck($email);

            if ($name == "" OR $username == "" OR $email == "" OR $password == "") {
                $msg = "<div class='alert alert-danger'>Field must not be Empty</div>";
                return $msg;
            }
            if(strlen($username) < 3){
                $msg = "<div class='alert alert-danger'>User name must be geater than 3</div>";
                return $msg;
            }elseif(preg_match('/[^a-z0-9_-]+/i',$username)){
                $msg = "<div class='alert alert-danger'>Username must contain alphanumerical, dashes and underscores!</div>";
            }

            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                $msg = "<div class='alert alert-danger'>Invalid Email!</div>";
                return $msg;
            }
            if ($chk_email == true) {
                $msg = "<div class='alert alert-danger'>This email already exits</div>";
                return $msg;
            }
        
        $password = md5($data['password']);
        $sql = "INSERT INTO tbl_user (name, username, email, password) VALUES(:name, :username, :email, :password)";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':username', $username);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $result = $query->execute();
        if($result){
            $msg = "<div class='alert alert-success'>Data Inserted SuccessFully,<br/> You have been successfully registerd</div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-danger'>Sorry, there is a problem while inserting data into database</div>";
            return $msg;
        }
    }
        public function emailCheck($email){
            $sql = "SELECT email FROM tbl_user WHERE email = :email";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':email', $email);
            $query->execute();
            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
        // public function CheckPasswordlogin($id, $password){
        //     $password = md5($password);
        //     $sql = "SELECT * FROM tbl_user WHERE id = :id AND password = :password";
        //     $query = $this->db->pdo->prepare($sql);
        //     $query->bindValue(':id', $id);
        //     $query->bindValue(':password', $password);
        //     $query->execute();
        //     if($query->rowCount() > 0){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }
        public function getLoginUser($email, $password){
            $sql = "SELECT * FROM tbl_user WHERE email = :email AND :password LIMIT 1";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', $password);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result; 
        }
        public function userLogin($data){
            $email    = $data['email'];
            $password = md5($data['password']);
            $chk_email = $this->emailCheck($email);
            // $chk_pass = $this->CheckPasswordlogin($id, $password);

            if ($email == "" OR $password == "") {
                $msg = "<div class='alert alert-danger'>Field must not be Empty</div>";
                return $msg;
            }
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                $msg = "<div class='alert alert-danger'>Invalid Email!</div>";
                return $msg;
            }
            if ($chk_email == false) {
                $msg = "<div class='alert alert-danger'>email not found! registration first</div>";
                return $msg;
            }
            // if ($chk_pass == false) {
            //     $msg = "<div class='alert alert-danger'>password not match</div>";
            //     return $msg;
            // }

            $result = $this->getLoginUser($email, $password);
            if ($result) {
                Session::init();
                Session::set("login", true);
                Session::set("id", $result->id);
                Session::set("name", $result->name);
                Session::set("username", $result->username);
                Session::set("loginmsg", "<div class='alert alert-success'>Successfully login</div>");
                header("Location:index.php");

            }else{
                $msg = "<div class='alert alert-danger'>Data not Found</div>";
                return $msg;
            }
        }

        public function getUserData(){
            $sql = "SELECT * FROM tbl_user ORDER BY id DESC";
            $query = $this->db->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        }

        public function getUserById($id){
            $sql = "SELECT * FROM tbl_user WHERE id = :id LIMIT 1";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result; 
        }
// ------------------------------------------------------------------------------------
        public function updateUserData($id, $data){
            $name     = $data['name'];
            $username = $data['username'];
            $email    = $data['email'];

            if ($name == "" OR $username == "" OR $email == "") {
                $msg = "<div class='alert alert-danger'>Field must not be Empty</div>";
                return $msg;
            }

        $sql = "UPDATE tbl_user set
            name     = :name,
            username = :username,
            email    = :email
            WHERE id = :id;
        ";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':username', $username);
        $query->bindValue(':email', $email);
        $query->bindValue(':id', $id);
        $result = $query->execute();
        if($result){
            $msg = "<div class='alert alert-success'>Data Updated SuccessFully</div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-danger'>Sorry, there is a problem while upadte data into database</div>";
            return $msg;
        }
    }

        public function CheckPassword($old_pass, $id){
            $password = md5($old_pass);
            $sql = "SELECT * FROM tbl_user WHERE id = :id AND password = :password";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':id', $id);
            $query->bindValue(':password', $password);
            $query->execute();
            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function updatePassword($id,$data){
            $old_pass = $data['old_pass'];
            $new_pass = $data['new_pass'];
            $chk_pass = $this->CheckPassword($old_pass, $id);

            if ($old_pass == "" OR $new_pass == "") {
                $msg = "<div class='alert alert-danger'>Field must not be Empty</div>";
                return $msg;
            }
            
            if ($chk_pass == false) {
                $msg = "<div class='alert alert-danger'>Old pass not exits</div>";
                return $msg;
            }
            if (strlen($new_pass) < 6) {
                $msg = "<div class='alert alert-danger'>password too short , must be geater than 6</div>";
                return $msg;
            }

            $password = md5($new_pass); 

            // upadte pass
            $sql = "UPDATE tbl_user set
            password     = :password
            WHERE id = :id;
            ";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':password', $password);
            $query->bindValue(':id', $id);
            $result = $query->execute();
            if($result){
                $msg = "<div class='alert alert-success'>Password Updated SuccessFully</div>";
                return $msg;
            }else{
                $msg = "<div class='alert alert-danger'>Sorry, there is a problem while upadte Password</div>";
                return $msg;
            }
        }
    }    
?>