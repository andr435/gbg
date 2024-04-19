<?php

/**
 * Base Database class
 */
class Database
{
    private $dbh;
    private $stmp;
    private $error;

    public function __construct(){
        $connect_str = "mysql:host=".Config::get('db_host').";dbname=".Config::get('db_name');
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($connect_str, Config::get('db_user'), Config::get('db_pwd'), $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            die("DB connection failture \n". $e->getMessage());
        }
    }

    public function query($sql)
    {
        $this->stmp = $this->dbh->prepare($sql);
    }

    public function bindValue($param, $value, $type=null)
    {
        if(is_null($type)) {
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmp->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmp->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmp->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resultOne(){
        $this->execute();
        return $this->stmp->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
        return $this->stmp->rowCount();
    }
}