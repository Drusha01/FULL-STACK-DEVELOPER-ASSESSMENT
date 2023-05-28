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

    function insert($user_name,$user_password,$user_firstname,$user_lastname){
        try{
            $sql = 'INSERT INTO users (user_name,user_password,user_firstname,user_lastname) VALUES(
                :user_name,
                :user_password,
                :user_firstname,
                :user_lastname
            );
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_name', $user_name);
            $query->bindParam(':user_password', $user_password);
            $query->bindParam(':user_firstname', $user_firstname);
            $query->bindParam(':user_lastname', $user_lastname);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

   

    
    
}


?>