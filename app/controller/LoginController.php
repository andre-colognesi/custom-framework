<?php
namespace app\controller{
    use \app\model\Users as Users;
    use \app\config\session\Session as Session;
class LoginController extends Controller
{
    
    public function displayLogin(){

       $this->render('login');
    }

    public function login(){
        if(!Users::login($_POST)){
            header("location: ".getenv("URL")."login");
        }   
    }

    public function displayRegister(){
        $this->render('register');
    }

    public function register(){
       $res =  Users::createUser($_POST);
    }

    public function logout(){
        $this->startSession();
        $this->destroySession();
    }
}
}