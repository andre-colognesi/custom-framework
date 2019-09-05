<?php
namespace app\model{
    
    use \app\config\database\Database as DB;
    class Product extends Model{
        protected $primaryKey = 'product_id';
        protected $table = 'products';
        CONST UPDATED_AT = 'TESTE';
        
        public function allProducts(){            
            $query = "SELECT * FROM products WHERE active = 'yes'" ;
            $res =  $this->selectRaw($query);
            return $res;
        }

        public function save(array $request){
            if($request['salesman_id'] == ''){
                $request['salesman_id'] = null;
            }
            $data = array(
                "product_name" => $request["name"],
                "product_price" => $request["price"],
                "salesman_id"   => $request["salesman_id"]
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
            if($request['salesman_id'] == ''){
                $request['salesman_id'] = null;
            }
            $data = array(
                "product_name"  => $request["name"],
                "product_price" => $request["price"],
                "salesman_id"   => $request["salesman_id"]
            );

            $res = $this->update($id,$data);
            if($res){
                return true;
            }
                return false;
        }
    }
}