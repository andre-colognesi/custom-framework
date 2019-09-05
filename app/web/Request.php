<?php
namespace app\web{
    include_once PATH."/app/Bootstrap.php";
    class Request{
        public $request;
        protected $url;


        public function getRequest(){
            var_dump($this->request);
        }

        public function sanitazeUrl($url){
            $sanitazedUrl = \filter_var($url,FILTER_SANITIZE_URL);
            $this->setUrl($sanitazedUrl);

        }

        protected function setUrl($url){
            $this->url = $url;
        }

        public function getUrl(){
            return $this->url;
        }
    }
}