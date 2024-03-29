<?php
namespace app\model{
    include_once 'app/Bootstrap.php';
    use \app\config\session\Session     as Session;
    use \app\config\database\Database   as Database;
    class Model extends Session{
        CONST CREATED_AT    = "created_at";
        CONST CREATED_BY    = "created_by";
        CONST UPDATED_AT    = "updated_at";
        CONST UPDATED_BY    = "updated_by";
        CONST REMOVED_AT    = "removed_at";
        CONST REMOVED_BY    = "removed_by";
        CONST ACTIVE        = "active";
        
        protected $config;
        protected $query;
        protected $dataFromServer;

        public function __CONSTRUCT($id = null){
  
            if($id){
                $db = Database::connect();
                $stmt = $db->prepare("SELECT * FROM " .$this->table. " WHERE ".$this->primaryKey." = :id");
                $stmt->execute(array(
                    ":id" => $id,
                ));
                $res = $stmt->fetch();
                if(!$res){
                    return false;        
                }
                $this->setConfig($res);
            }
        }

        public function getConfig(){
            return $this->config;
        }

        protected function setConfig($value){
            $this->config = $value;
        }

        protected function config(){
            $db = Database::connect();
            $stmt = $db->query('SHOW COLUMNS FROM '.$this->table );
            $list = $stmt->fetchAll();
            return $list;
        }       
        
  

    public function insert(array $data){
        $db = Database::connect();
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

    
    public function selectRaw($query){
        $db = Database::connect();
        $select = $db->query($query);
        $res = $select->fetchAll(\PDO::FETCH_CLASS);
        return $res;

    }

    

    public function read($id){
        $db = Database::connect();
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
    $query = "UPDATE ".$this->table." SET active = :active, removed_by = :removed_by, removed_at = :removed_at WHERE ".$this->primaryKey." = :".$this->primaryKey."";
    $db = Database::connect();
    $stmt = $db->prepare($query);
    $stmt->execute(array(
        "active" => "no",
        "removed_by" => $_SESSION['USER_ID'],
        "removed_at" => date("Y-m-d h:i:s"),
        $this->primaryKey => $id
    ));
    if($stmt->rowCount() == 1){
        return true;
    }
        return false;
    }

    public function update($id, array $data){

        $db = Database::connect();
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
            $params[] = self::UPDATED_BY." = :".self::UPDATED_BY;
            $params[] = self::UPDATED_AT." = :".self::UPDATED_AT;  
            $values[self::UPDATED_BY] = $_SESSION['USER_ID'];
            $values[self::UPDATED_AT] = date('Y-m-d h:i:s');
            $values[$this->primaryKey] = $id;
            $query = "UPDATE ".$this->table." SET ".join(',',$params). " WHERE ".$this->primaryKey ." = :".$this->primaryKey ."";
            $insert = $db->prepare($query);
            $insert->execute($values);
            if($insert->rowCount() == 1){
                return true;
            }
                return false;

    }

    public function child($fatherKey, $childKey, $childTable, $id){
        $db = Database::connect();
        $query = "SELECT ".$childTable.".* FROM ".$childTable." INNER JOIN ".$this->table." ON ".$childTable.".".$childKey." = ".$this->table.".".$fatherKey." WHERE ".$this->table.".".$fatherKey." = ".$id." "; 
        $select = $db->query($query);
        $res = $select->fetchAll(\PDO::FETCH_CLASS);
        return $res;
    }

    public function remove($id){
        $db = Database::connect();
        $query = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $db->prepare($query);
        $stmt->execute(array(
            ":id" => $id
        ));
        if($stmt->rowCount == 1){
            return true;
        }
        return false;
    }
    
    public function orderBy($column, $order){
        $query = $this->getQuery();
        $query = $query . ' ORDER BY '. $column . ' ' . $order;
        $this->setQuery($query);
    }


    }
}