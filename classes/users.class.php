<?php 
require_once 'database.php';
class users
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function get_details($user_name){
        try{
            $sql = 'SELECT * FROM users WHERE binary user_name =:user_name;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_name', $user_name);
            
            if($query->execute()){
                $data =  $query->fetch();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }

    function insert($user_name,$user_email,$user_password,$user_firstname,$user_lastname){
        try{
            $sql = 'INSERT INTO users (user_name,user_name_verified,user_email,user_password,user_firstname,user_lastname,user_profile) VALUES(
                :user_name,
                true,
                :user_email,
                :user_password,
                :user_firstname,
                :user_lastname,
                "default.png"
            );
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_name', $user_name);
            $query->bindParam(':user_email', $user_email);
            $query->bindParam(':user_password', $user_password);
            $query->bindParam(':user_firstname', $user_firstname);
            $query->bindParam(':user_lastname', $user_lastname);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function update_user_details($user_id,$user_firstname,$user_lastname){
        try{
            $sql = 'UPDATE users
            SET user_lastname =:user_firstname, user_lastname =:user_lastname
            WHERE user_id =:user_id;
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':user_firstname', $user_firstname);
            $query->bindParam(':user_lastname', $user_lastname);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
        
    }

    function update_user_profile_photo($user_id, $user_profile){
        try{
            $sql = 'UPDATE users
            SET user_profile =:user_profile
            WHERE user_id =:user_id;
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':user_profile', $user_profile);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function user_name_duplicate($user_name){
        try{
            $sql = 'SELECT user_id FROM users WHERE binary user_name  =:user_name;
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_name', $user_name);
            if($query->execute()){
                $data =  $query->fetch();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }
    function user_email_duplicate($user_email){
        try{
            $sql = 'SELECT user_id FROM users WHERE  user_email  =:user_email;
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_email', $user_email);
            if($query->execute()){
                $data =  $query->fetch();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }
   

    
    
}


?>