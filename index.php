<?php
define('PATH',dirname(__FILE__));
define('DS',DIRECTORY_SEPARATOR);
include_once 'app/Bootstrap.php';
$url = explode("=",$_SERVER['QUERY_STRING']);
$url = $url[1];
$bootstrap->setUrl($url);
$bootstrap->setIndex('http://localhost/meuMVC/');
$rota = new app\web\Rota;
$rota->addRota('GET','','HomeController@home');
$rota->addRota('GET','pessoa','PessoaController@read');
$rota->addRota('GET','home','HomeController@home');
$rota->addRota('GET','login','LoginController@displayLogin');
$rota->addRota('POST','check-login','LoginController@login');
$rota->addRota('GET','cadastrar-login','LoginController@displayRegister');
$rota->addRota('POST','criar-usuario','LoginController@register');
$rota->addRota('GET','logout','LoginController@logout');
$rota->addRota('GET','teste/{id}/list/{id}','LoginController@teste');
$rota->addRota('GET','produtos','ProductController@all');
$rota->addRota('GET','criar-produto','ProductController@create');
$rota->addRota('POST','salvar-produto','ProductController@save');
$rota->addRota('POST','produto/{id}/excluir','ProductController@delete');
$rota->addRota('GET','produto/{id}/editar','ProductController@read');
$rota->addRota('POST','produto/{id}/update','ProductController@update');
$rota->execRota($url);
