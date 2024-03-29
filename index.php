<?php
define('PATH',dirname(__FILE__));
define('DS',DIRECTORY_SEPARATOR);
include_once 'app/Bootstrap.php';
$url = $_SERVER['REQUEST_URI'];
$sanitzer = new app\web\Request();
$sanitzer->setUrl($url);
$rota = new app\web\Rota;
$rota->addRota('GET','/meuMVC/home','HomeController@home');
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
$rota->addRota('GET','vendedores','SalesmanController@all');
$rota->addRota('GET','criar-vendedor','SalesmanController@create');
$rota->addRota('POST','salvar-vendedor','SalesmanController@save');
$rota->addRota('GET','vendedor/{id}/editar','SalesmanController@read');
$rota->addRota('GET','vendedor/{id}/visualizar','SalesmanController@view');
$rota->addRota('POST','vendedor/{id}/update','SalesmanController@update');
$rota->addRota('POST','vendedor/{id}/excluir','SalesmanController@delete');
$rota->addRota('GET','configuracao','UserController@userConfig');
$rota->addRota('POST','atualizar-usuario','UserController@updateUser');
$rota->addRota('GET','buscar-produtos','ProductController@search');
$rota->addRota('GET','produtos-csv','ProductController@csv');

$rota->execRota($sanitzer->getUrl());
