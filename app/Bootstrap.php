<?php

require_once "Autoload.php";
class Bootstrap
{
    
    protected $url;
    protected $indexUrl;
    public function __CONSTRUCT(){
        putenv("URL=http://localhost/meuMVC/");
        spl_autoload_register('Autoload::loader');
        date_default_timezone_set("UTC");
}

    public static function server(){
        foreach($_SERVER as $index => $value){
            echo '<b>'.$index.'</b>: '.$value.'<br>';
        }
    }

    public function setUrl($url){
        $this->url = $url;
    }

    public function getUrl(){
        return $this->url;
    }

    public function setIndex($path){
        $this->indexUrl = $path;
    }

    public function getIndex(){
        return $this->indexUrl;
    }
}

$bootstrap = new Bootstrap;
