<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
//Incluir a conexao com BD
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "logsystem";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
?>