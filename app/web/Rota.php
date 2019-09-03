<?php
namespace app\web{
include_once PATH."/app/Bootstrap.php";

class Rota
{
    protected $_rotas = array();
    protected $_parameters = array();
    public function addRota($method, $url, $controller){
        $this->_rotas[] = [
            'method'=>$method,
            'url'=>$url,
            'controller'=>$controller
        ];
    } 

    public function showRota(){
        return $this->_rotas;
    }
    public function execRota($url){
        $url = $this->validUrl($url);

        foreach($this->_rotas as $index)
        {
            if($index['url'] == $url){
                if($index['method'] == $_SERVER['REQUEST_METHOD']){
                    $controllers = $index['controller'];
                    $controllers = explode("@",$controllers);
                    $controller = "app\\controller\\".$controllers[0];
                    $controller = new $controller;
                    $function = $controllers[1];
                    $controller->$function($this->_parameters);
                    $this->_parameters = array();
                }else{
                    echo 'Método invalido';
                }
            }
        }
    }

    protected function validUrl($url){
            $i = 0;
            $j = 0;
            $url = explode("/",$url);
            foreach($url as $k => $v){
                if(preg_match("/[0-9]/",$v)){
                    $this->_parameters[$j] = (int)$v;
                    $url[$i] = "{id}";   
                    $j++;
                }
                $i++;
            }   

            $url = join("/",$url);
            return $url;
            
    }

}
}