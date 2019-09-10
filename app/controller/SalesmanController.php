<?php
namespace app\controller{
    use \app\model\Salesman as Salesman;
    use \app\config\session\Session as Session;
    use \app\web\Request as Request;
    class SalesmanController extends Controller
{
    public function __CONSTRUCT(){
    
        $this->startSession();
        parent::__construct();
        $this->addBread("Vendedores","vendedores");

    }

    public function all(){
        $salesman = new Salesman;
        $vendedores = $salesman->allSalesman();
        $this->render('salesmans/allSalesman',compact("vendedores","child"));

    }

    public function create(){
        $this->addBread("Criar Vendedor","");

        $this->render('salesmans/createSalesman');
    }

    public function save(){
        $salesman = new Salesman;
        if($salesman->save(new Request($_POST))){
            Session::addMsg('Vendedor inserido com sucesso.','success');
            $this->redirect("vendedores");
        }else{
            Session::addMsg('Ocorreu um erro.','warning');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        };
    }

    public function delete(array $id){

        $id = $id[0];
        $salesman = new Salesman;
        $res = $salesman->delete($id);
        if($res){
            Session::addMsg("Produto ({$id}) deletado com sucesso.","success");
        }else{
            Session::addMsg("Ocorreu um erro.","danger");
        };
        $this->redirect("produtos");
    }

    public function read($id){
        $id = $id[0];
        $this->addBread("Editar Vendedor ".$id,"vendedor/".$id."/editar") ;
        $salesman = new Salesman($id);
        $sales = $salesman->getConfig();
        $this->render('salesmans/updateSalesman',compact('sales'));
    }

    public function view($id){
        $id = $id[0];
        $this->addBread("Editar Vendedor ".$id,"vendedor/".$id."/editar") ;
        $salesman = new Salesman();
        $child = $salesman->getChild($id);
        $sales = $salesman->read($id);
        $this->render('salesmans/viewSalesman',compact('sales','child'));
    }

    public function update($id){
        $id = $id[0];
        $salesman = new Salesman;
        $res = $salesman->saveUpdate($id,$_REQUEST);
        if($res){
            Session::addMsg("Vendedor ".$id." editado com sucesso!","success");
        }else{
            Session::addMsg("Ocorreu um erro","danger");
        }
        $this->redirect("vendedor/".$id."/editar");;
    }
}
}