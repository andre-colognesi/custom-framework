<?php
namespace app\controller{
    use \app\model\Product as Product;
    use \app\model\Salesman as Salesman;
    use \app\config\session\Session as Session;
    use \app\web\Request as Request;
    use \app\web\File as File;
    class ProductController extends Controller
{
    public function __CONSTRUCT(){
    
        $this->startSession();
        parent::__construct();
        $this->addBread("Produtos","produtos");

    }

    public function all(){
        $product = new Product;
        $produto = $product->allProducts();
        $this->render('allProducts',compact('produto'));

    }

    public function search(){
        $product = new Product;
        $produto = $product->searchProducts(new Request($_GET));
        $this->render('allProducts',compact('produto'));
    }

    public function create(){
        $sales = new Salesman();
        $salesmans = $sales->allSalesman();
        $this->addBread("Criar Produto","");
        $this->render('createProduct',compact('salesmans'));
    }

    public function save(){
        $product = new Product;         

        if($product->save(new Request($_POST))){
            Session::addMsg('Produto inserido com sucesso.','success');
            $this->redirect("produtos");
        }else{
            Session::addMsg('Ocorreu um erro.','warning');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        };
    }

    
    public function delete(array $id){

        $id = $id[0];
        $product = new Product;
        $res = $product->delete($id,new Request($_POST));
        if($res){
            Session::addMsg("Produto ({$id}) deletado com sucesso.","success");
        }else{
            Session::addMsg("Ocorreu um erro.","danger");
        };
        $this->redirect("produtos");
    }

    public function read($id){
        $id = $id[0];
        $sales = new Salesman();
        $salesmans = $sales->allSalesman();
        $this->addBread("Editar produto ".$id,"produto/".$id."/editar") ;
        $product = new Product($id);
        $prod = $product->getConfig();
        $this->render('updateProduct',compact('prod','salesmans'));
    }

    public function update($id){
        $id = $id[0];
        $product = new Product;
        $res = $product->saveUpdate(new Request($_POST));
        if($res){
            Session::addMsg("Produto ".$id." editado com sucesso!","success");
        }else{
            Session::addMsg("Ocorreu um erro","danger");
        }
        $this->redirect("produto/".$id."/editar");;
    }

}
}