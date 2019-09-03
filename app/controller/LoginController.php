<?php
namespace app\controller{
    use \app\model\Users as Users;
class LoginController extends Controller
{
    
    public function displayLogin(){

       $this->render('login');
    }

    public function login(){
        $res = Users::login($_POST);    
    }

    public function displayRegister(){
        $this->render('register');
    }

    public function register(){
       $res =  Users::createUser($_POST);
    }

    public function teste(array $id){

    }

    public function logout(){
        $this->startSession();
        $this->destroySession();
    }
}
}