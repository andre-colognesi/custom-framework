<?php
namespace app\controller{
    use \app\model\Product as Product;
    use \app\config\session\Session as Session;
    class ProductController extends Controller
{

    public function __CONSTRUCT(){
        $this->startSession();
        parent::__construct();
    }

    public function all(){
        $product = new Product;
        $produto = $product->allProducts();
        $this->render('allProducts',compact('produto'));
    }

    public function create(){
    
        $this->render('createProduct');
    }

    public function save(){
        $product = new Product;
        if($product->save($_REQUEST)){
            Session::addMsg('Produto inserido com sucesso.','success');
            header("location: http://localhost/meuMVC/produtos");
        }else{
            Session::addMsg('Ocorreu um erro.','warning');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        };
    }

    public function delete(array $id){

        $id = $id[0];
        $product = new Product;
        $res = $product->delete($id);
        if($res){
            Session::addMsg("Produto ({$id}) deletado com sucesso.","success");
        }else{
            Session::addMsg("Ocorreu um erro.","danger");
        };
        header("location: http://localhost/meuMVC/produtos");
    }

    public function read($id){
        $id = $id[0];
        $product = new Product();
        $prod = $product->read($id);
        $this->render('updateProduct',compact('prod'));
    }

    public function update($id){
        $id = $id[0];
        $product = new Product;
        $res = $product->saveUpdate($id,$_REQUEST);
        if($res){
            Session::addMsg("Produto ".$id." editado com sucesso!","success");
        }else{
            Session::addMsg("Ocorreu um erro","danger");
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
}