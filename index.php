<?php

require_once("config.php");

//Carrega 1 usuario
/*
$root = new Usuario();
$root->loadById(1);
echo $root;
*/
//Carrega uma lista de usuários
/*$lista = Usuario::getList();
echo json_encode($lista);
*/
//Carrega uma lista de usuáriios buscando pelo login
//$search = Usuario::search("us");
//echo json_encode($search);


//Carrega user usando o login e a senha
$usuario = new Usuario();
$usuario->login("root", "123");
echo $usuario;
?>