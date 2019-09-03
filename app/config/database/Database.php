<?php
namespace app\config\database{
    include_once 'app/Bootstrap.php';
    class Database{
        protected $host;
        protected $db;
        protected $username;
        protected $password;


        public function connect(){
            try{
                 $this->host     = 'localhost:3306';
                 $this->db       = 'DB_TESTE';
                 $this->username = 'root';
                 $this->password = '123';
            $con = new \PDO("mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8", $this->username,$this->password); 
            $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $con;
            }catch(Exception $e){
                echo 'Ocorreu um erro de conexão: '.$e->getMessage();
            }
        }
    }

}