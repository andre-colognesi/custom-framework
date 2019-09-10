<?php
namespace app\model{
    
    use \app\config\database\Database as DB;
    use \app\web\Request as Request;
    class Salesman extends Model{
        protected $primaryKey = 'salesman_id';
        protected $table = 'salesmans';
        
        public function allSalesman(){
            $query = "SELECT * FROM {$this->table} WHERE active = 'yes'" ;
            $res =  $this->selectRaw($query);
            return $res;
        }

        public function getChild($id){
            $child = $this->child("salesman_id","salesman_id","products",$id);
            return $child;
        }

        public function save(Request $request){
            $request->show();
            $data = array(
                "salesman_name" => $request["name"],
                "birthday" => $request["birthday"],
            );
            if($this->insert($data)){
                return true;
            };
            return false;
        }

        public function delete($id){
            $res = $this->softDelete($id);
            if($res){
                return true;
            }
            return false;
        }

        public function saveUpdate($id,array $request){
            $data = array(
                "salesman_name" => $request["name"],
                "birthday" => $request["birthday"],
            );

            $res = $this->update($id,$data);
            if($res){
                return true;
            }
                return false;
        }
    }
}