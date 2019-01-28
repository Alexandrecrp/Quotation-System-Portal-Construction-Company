<?php
session_start();

//Incluir a conexao com BD
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "logsystem";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

//Receber os dados do formulário
//$arquivo = $_FILES['arquivo'];
//var_dump($arquivo);
$arquivo_tmp = $_FILES['arquivo']['tmp_name'];

//ler todo o arquivo para um array
$dados = file($arquivo_tmp);
//var_dump($dados);


/*INICIO DA MAGICA*/
require_once("enviarEmail.php");
$tem_cotacao = false;
$tem_fornecedor = false;
$tem_produto = false;
$cotacao_ja_enviada = false;
$erro_msg = "Arquivo inválido! <br>";
$erro = false;
$lista_sql_insert = "";

foreach($dados as $key => $linha){
	$linha = trim($linha);
	$valor = explode('|', $linha);
	$tipo = $valor[0];
	$id = $valor[1];

	if ($tipo == "C") {
		if($key > 0 || $tem_cotacao) {
			$erro = true;
			$erro_msg .= "Arquivo com mais de um cliente.<br>";
		} else if (count($valor)<8) {
			$erro = true;
			$erro_msg .= "Cliente com colunas insuficientes.";
		} else {
			$sql_cotacao = "SELECT idprincipal FROM cliente WHERE idprincipal = '".$id."';";
			$resultado = mysqli_query($conn,$sql_cotacao);
					
			$linha = mysqli_fetch_array($resultado);
			if ($linha['idprincipal']>0) {
				$erro = true;
				$erro_msg .= "Cliente já cadastrado.<br>";
			} else {
				$tem_cotacao = true;
				$valor[8]='C';
				$lista_sql_insert1 .= "INSERT INTO cliente (idprincipal, cliente_campo1, cliente_campo2, cliente_campo3, cliente_campo4, cliente_campo5, cliente_campo6, cliente_campo7, cliente_campo8) VALUES ('".$valor[1]."', '".$valor[8]."', '".$valor[2]."', '".$valor[3]."', '".$valor[4]."', '".$valor[5]."', '".$valor[6]."', '".$valor[7]."', now());";
				$idprincipal = $valor[1];
			}
		}
	} else if ($tipo == "F") {
		if($key == 0) {
			$erro = true;
			$erro_msg .= "Cotação deve ser primeiro item.<br>";
		} else if (count($valor)<13) {
			$erro = true;
			$erro_msg .= "Fornecedor com colunas insuficientes.";
		} else {
			if(!$tem_fornecedor) $tem_fornecedor = true;
			$valor[13]='F';
			$lista_sql_insert2 .= "INSERT INTO fornecedor (idprincipal, fornecedor_campo1, fornecedor_campo2, fornecedor_campo3, fornecedor_campo4, fornecedor_campo5, fornecedor_campo6, fornecedor_campo7, fornecedor_campo8, fornecedor_campo9, fornecedor_campo10, fornecedor_campo11, fornecedor_campo12, fornecedor_campo13, fornecedor_campo14) VALUES ('".$idprincipal."','".$valor[13]."','".$valor[1]."', '".$valor[2]."', '".$valor[3]."', '".$valor[4]."', '".$valor[5]."', '".$valor[6]."', '".$valor[7]."', '".$valor[8]."', '".$valor[9]."', '".$valor[10]."', '".$valor[11]."', '".$valor[12]."', now());
			 INSERT INTO travafornecedor (idprincipal, idfornecedor, status) VALUES ('".$idprincipal."', '".$valor[1]."', '0');"; 
			$mensagem = "Você esta recebendo este e-mail, por que foi solicitado uma cotação de número ".$idprincipal." nova através do site NOME_SITE, clique no link abaixo para visualizar. <br /><a href='http://localhost/painel.php'>Acessar Site</a>";
			enviarEmail($valor[12], "Prezado", "Solicitação cotação", $mensagem);
		}
	} else if ($tipo == "P") {
		if($key == 0 || !$tem_cotacao) {
			$erro = true;
			$erro_msg .= "Cotação deve ser primeiro item.<br>";
		} else if (count($valor)<8) {
			$erro = true;
			$erro_msg .= "Produto com colunas insuficientes.";
		} else if(!$tem_fornecedor) {
			$erro = true;
			$erro_msg .= "Produto deve vir após cotação/fornecedores.";
		} else {
			if(!$tem_produto) $tem_produto = true;
			$valor[8] = 'P';
			$lista_sql_insert3 .= "INSERT INTO produto (idprincipal, produto_campo1, produto_campo2, produto_campo3, produto_campo4, produto_campo5, produto_campo6, produto_campo7, produto_campo8, produto_campo9) VALUES ('".$idprincipal."','".$valor[8]."','".$valor[1]."', '".$valor[2]."', '".$valor[3]."', '".$valor[4]."', '".$valor[5]."', '".$valor[6]."', '".$valor[7]."', now());";
		}
	} else {
		$erro = true;
	}	
}

if(!$erro) {
	$sql = $lista_sql_insert1 . $lista_sql_insert2 . $lista_sql_insert3;
	$resultado = mysqli_multi_query($conn, $sql);
	$_SESSION['msg'] = "<p style='color: green;'>Carregado os dados com sucesso!</p>";
} else {
	$_SESSION['msg'] = $erro_msg;
}
header("Location: painel.php");
?>
