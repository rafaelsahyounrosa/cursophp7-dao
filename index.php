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
/*$usuario = new Usuario();
$usuario->login("root", "123");
echo $usuario;
*/
/*
$aluno = new Usuario("rafael", "!123ds");
$aluno->insert();

echo $aluno;
*/
/*
$usuario = new Usuario();
$usuario->loadById(2);
$usuario->update("professor", "abc");
echo $usuario;
*/
$usuario = new Usuario();
$usuario->loadById(2);
$usuario->delete();
echo $usuario;
?>