<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
//Incluir a conexao com BD
$servidor = "portal123.mysql.dbaas.com.br";
$usuario = "portal123";
$senha = "portal@123";
$dbname = "";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
?>