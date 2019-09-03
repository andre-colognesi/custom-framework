<?php
namespace app\model{
    
    use \app\config\database\Database as DB;
    class Product extends Model{
        protected $primaryKey = 'product_id';
        protected $table = 'products';
        
        public function allProducts(){
            $query = "SELECT * FROM products WHERE active = 'yes'" ;
            $res =  $this->selectRaw($query);
            return $res;
        }

        public function save(array $request){
            $data = array(
                "product_name" => $request["name"],
                "product_price" => $request["price"],
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
                "product_name" => $request["name"],
                "product_price" => $request["price"],
            );

            $res = $this->update($id,$data);
            if($res){
                return true;
            }
                return false;
        }
    }
}