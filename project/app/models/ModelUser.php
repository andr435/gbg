<?php

class ModelUser
{
    private $db;
    private $table_name = 'users';

    public function __construct(){
        $this->db = new Database;
    }

    public function addUser($username, $email, $pwd, $birthday, $phone, $url){
        $sql = "INSERT INTO {$this->table_name} 
         (`username`, `email`, `password`, `birthday`, `phone`, `url`)
         VALUES (:username, :email, :password, :birthday, :phone, :url)";

         $this->db->query($sql);

         $this->db->bindValue(":username", $username);
         $this->db->bindValue(":email", $email);
         $this->db->bindValue(":password", $pwd);
         $this->db->bindValue(":birthday", $birthday);
         $this->db->bindValue(":phone", $phone);
         $this->db->bindValue(":url", $url);
         return $this->db->execute();
    }

    public function getUserById($id){
        $this->db->query("SELECT * FROM {$this->table_name} WHERE id=:id LIMIT 1");
        $this->db->bindValue(":id", $id);
        return  $this->db->resultOne();
    }

    public function getAllUsers(){
        $this->db->query("SELECT * FROM {$this->table_name}");
        return $this->db->resultSet();
    }

    public function deleteUser($id){
        $this->db->query("DELETE FROM {$this->table_name} WHERE id=:id LIMIT 1");
        $this->db->bindValue(":id", $id);
        return $this->db->execute();
    }
}