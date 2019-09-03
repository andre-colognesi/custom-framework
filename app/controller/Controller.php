<?php
namespace app\controller{
    include_once 'app/Bootstrap.php';
    use  \app\config\session\Session as Session;
    class Controller extends Session{

        public $auth;
        public $dataUrl = array();
        
        public function __CONSTRUCT(){
            $url = explode("/",$_SERVER['REQUEST_URI']);
            $i = 0;
      
            foreach($url as $key => $value){
                if(preg_match("/[0-9]/",$value)){
                $this->dataUrl[$url[$i-1]] = $value;
                }
                $i++;

            }


        
        }

        public function render($file,$arr = null){
            $view = PATH.DS.'app'.DS.'view'.DS.$file.'.php';
            if(file_exists($view)){
                if(isset($arr)){
                    extract($arr);
                }
                include_once $view;
            }
        }      

        public function include($file){
            $path = PATH.DS.'app'.DS.'view'.DS.$file.'.php';
            if(file_exists($path)){
                include_once $path;
            }
        }
    }
}