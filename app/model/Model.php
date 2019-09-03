<?php
namespace app\model{
    include_once 'app/Bootstrap.php';
    use \app\config\session\Session as Session;
    use \app\config\database\Database as Database;
    class Model extends Session{

        protected $config;
        public function __CONSTRUCT($id = null){
  
            if($id){
                $db = new Database();
                $db = $db->connect();
                $stmt = $db->prepare("SELECT * FROM " .$this->table. " WHERE ".$this->primaryKey." = :id");
                $stmt->execute(array(
                    ":id" => $id,
                ));
                $res = $stmt->fetch();
                if(!$res){
                    return false;        
                }
                $this->config = $res;
            }
        }

        public function getUser(){
            return $this->config;
        }


        protected function config(){
            $db = new Database();
            $db = $db->connect();
            $stmt = $db->query('SHOW COLUMNS FROM '.$this->table );
            $list = $stmt->fetchAll();
            return $list;
        }       
        
  

    public function insert(array $data){
        $db = new Database();
        $db = $db->connect();
        $columns = [];
        $params = [];
        $execute = [];
        $values  = [];
        $i = 0;
        foreach($data as $k => $v){
            $columns[] = $k;
            $params[] =   (string)':'.$k;
            $values[$k] = $v;
            $i++;
        }
        $params[]   = ":created_by";
        $params[]   = ":created_at";
        $params[]   = ":active";
        $columns[]  = "created_by";
        $columns[]  = "created_at";
        $columns[]  = "active";
        $values["created_by"] = $_SESSION["USER_ID"];
        $values["created_at"] = date("Y-m-d h:i:s");
        $values["active"]     = "yes";  
        $query = "INSERT INTO ".$this->table."(".join(",",$columns) . ") VALUES (".join(",",$params).")";
        $insert = $db->prepare($query);
        $insert->execute($values);
        if($insert->rowCount() == 1){
            return true;
        }
            return false;
        
    }

    public function select(array $columns,$tables ,array $where = null){
        $db = new Database();
        $db = $db->connect();
        $prepare = [];
        $execute = [];

        $query = "SELECT ".join(",",$columns)." FROM ".$tables." WHERE ".$where;
   
    }

    public function selectRaw($query){
        $db = new Database();
        $db = $db->connect();
        $select = $db->query($query);
        $res = $select->fetchAll(\PDO::FETCH_CLASS);
        return $res;

    }

    public function read($id){
        $db = new Database();
        $db = $db->connect();
        $query = "SELECT * FROM ".$this->table." WHERE ".$this->primaryKey." = :id ";
        $select = $db->prepare($query);
        $select->execute(array(
            ":id" => $id
        ));
        $res = $select->fetch();
        if($res){
            return $res;
        }
            return false;
    }

    public function softDelete($id){
    $query = "UPDATE ".$this->table." SET active = 'no', removed_by = ".$_SESSION['USER_ID'].", removed_at = ".date("Y-m-d h:i:s")." WHERE ".$this->primaryKey." = :id";
    $db = new Database();
    $db = $db->connect();
    $stmt = $db->prepare($query);
    $stmt->execute(array(
        ":id" => $id,
    ));
    if($stmt->rowCount() == 1){
        return true;
    }
        return false;
    }

    public function update($id, array $data){
        $db = new Database();
        $db = $db->connect();
        $columns = [];
        $params = [];
        $execute = [];
        $values  = [];
        $i = 0;
        foreach($data as $k => $v){
            $columns[] = $k;
            $params[] =  $k ." = ".(string)':'.$k;
            $values[$k] = $v;
            $i++;
        }
            $params[] = "updated_by = :updated_by";
            $params[] = "updated_at = :updated_at";  
            $values["updated_by"] = $_SESSION['USER_ID'];
            $values["updated_at"] = date('Y-m-d h:i:s');
            $values[$this->primaryKey] = $id;
            $query = "UPDATE ".$this->table." SET ".join(',',$params). " WHERE ".$this->primaryKey ." = :".$this->primaryKey ."";
            echo $query;
            $insert = $db->prepare($query);
            $insert->execute($values);
            if($insert->rowCount() == 1){
                return true;
            }
                return false;

    }

    }
}