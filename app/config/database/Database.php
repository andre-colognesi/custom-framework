<?php
namespace app\config\database{
    include_once 'app/Bootstrap.php';
    class Database{
        protected $host;
        protected $db;
        protected $username; 
        protected $password;
        protected $query;

        private function _connect(){
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

        public static function connect(){
            $db = new self;
            return $db->_connect();
        }

        public static function init(){
            return new Database();
        }

        public function getQuery(){
            return $this->query;
        }

        protected function setQuery($query){
            $this->query = $query;
        }

        public function select(array $columns,$tables ,array $where = null){
            $db = self::connect();
            $prepare = [];
            $execute = [];
            $query = "SELECT ".join(",",$columns)." FROM ".$tables;
            $this->setQuery($query);
            return $this;
        }
    
 

        public function where($where,$definiton,$value){
            $where = $where.$definiton.$value;
            $query = $this->getQuery();
            $query = $query . ' WHERE ' . $where;
            $this->setQuery($query);
            return $this;
        }
    
        public function andWHere($where,$definiton,$value){
            $where = $where.$definiton.$value;
            $query = $this->getQuery();
            $query = $query . ' AND ' . $where;
            $this->setQuery($query);
            return $this;
        }
    
        public function orWhere($where,$definiton,$value){
            $where = $where.$definiton.$value;
            $query = $this->getQuery();
            $query = $query . ' OR ' . $where;
            $this->setQuery($query);
            return $this;
        }
    
        public function fetchQuery($count = false){
            $query = $this->getQuery();
            $db = self::connect();
            $select = $db->query($query);
            if($count){
                return $select->rowCount();
            }
            $res    = $select->fetchAll(\PDO::FETCH_CLASS);
            return $res;
        }
    
        public function paginate($limit){
            $query  = $this->getQuery();
            $total  = $this->fetchQuery(true);
            $pages  = ceil($total / $limit);
            $page = 1;
            if(isset($_GET['page']) && !empty($_GET['page'])){
                $page   = filter_var($_GET['page'],FILTER_VALIDATE_INT);
                $page   = filter_var($page,FILTER_VALIDATE_INT);
            }
            if(empty($page) || $page == ""){
                $page = 1;
            }
            if($page > $pages){
                $page = $pages;
            }
    
            $offset = ($page - 1) * $limit;
            $paginate = " LIMIT " . $limit . " OFFSET ". $offset;
            $query = $query . $paginate;
            $this->setQuery($query);
            $res = $this->fetchQuery();
         
            $res[0]->pages = $pages;
            return $res;
            }
    }

}