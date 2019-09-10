<?php
namespace app\model{
    
    use \app\config\database\Database as DB;
    use \app\web\Request as Request;
    class Product extends Model{
        protected $primaryKey = 'product_id';
        protected $table = 'products';
        CONST UPDATED_AT = 'TESTE';
        
        public function allProducts(){            
            $res = $this->select(['*'],'products')->where('active','=',"'yes'")->paginate(3);
            return $res;
        }

        public function searchProducts(Request $request){
            $res = $this->select(['*'],'products')->where('active','=',"'yes'");
            if(isset($request->id) && $request->id != ""){
                $res = $res->andWhere('product_id','=',$request->id);
            }
            if(isset($request->name) && $request->name != ""){
                $res = $res->andWhere('product_name','=',"'".$request->name."'");
            }
            $res = $res->paginate(1);

            return $res;
        }

        public function save(Request $request){
            $data = array(
                "product_name" => $request->name,
                "product_price" => $request->price,
                "salesman_id"   => $request->salesman_id
            );
            if($this->insert($data)){
                return true;
            };
            return false;
        }

        public function delete($id,Request $resquest){
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