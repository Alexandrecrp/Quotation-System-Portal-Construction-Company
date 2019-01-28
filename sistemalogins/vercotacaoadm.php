<?php
session_start();

include("conexao.php");

if ($_SESSION['logado'] != 1 || $_SESSION['tipo'] == 'F') {
    ?>
    <script type="text/javascript">
        document.location.href = "index.php?erro=1";
    </script>
    <?php
} else {
	$idprincipal=$_GET["idprincipal"];
    ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>.::Portal Construtora::.</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
		<!-- Bootstrap core CSS -->
		<link href="dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="assets/css/painel.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
		
		<link href="asset/css/themify-icons.css" rel="stylesheet">
		
        <link rel="shortcut icon" href="img/logo2.png" />
    </head>
    <body>
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				  </button>
				  <a class="navbar-brand" href="#"></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
				  <ul class="nav navbar-nav">
					<li><a href="painel.php" class="colorwhite">Painel de envio de cotações</a></li>
					<li><a href="cotacoesrecebidasadm.php" class="colorwhite">Cotações recebidas de fornecedores</a></li>
					<li><a href="cadastro.php">Cadastro de Fornecedor</a></li> 
				  </ul>
				  <ul class="nav navbar-nav navbar-right">
					<li><a href="cotacoestotaisenviadasadm.php">Voltar para lista de cotações enviadas</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span></a></li>
					<li><a href="?acao=sair"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				  </ul>
				</div>
			  </div>
			</nav>
			<div class="container">
			<h3 class="page-header">Arquivo gerado com sucesso <?=$_SESSION["email"];?></h3>
			<table class="table">
			<thead>
				<tr>
				  <th scope="col">Código</th>
				  <th scope="col">Data da cotação</th>
				  <th scope="col">Nome do Cliente</th>
				  <th scope="col"><center>Data de envio de cotação<center></th>
				  <th scope="col"><center>Download</center></th>
				</tr>
			  </thead>
			<tbody>
					<?php
						//fazendo uma consulta SQL e retornando os resultados								
						$query = "  SELECT * 
									FROM cliente 
									WHERE idprincipal = ".$idprincipal."";
						$resultado = mysqli_query($conn,$query);

						while($linha = mysqli_fetch_array($resultado)){
					?>
					<tr>
						<td width="200">
							<a href="#" class="btn btn-danger btn-md" role="button"><?php echo $linha["idprincipal"];?></a>
						</td>
						<td width="200">
							<?php echo $linha["cliente_campo2"];?>
						</td>
						<td width="600	">
							<?php echo $linha["cliente_campo4"];?>
						</td>
						<td width="400">
						<center>
							<?php echo date('d/m/Y H:i:s', strtotime($linha["cliente_campo8"]));?>
						</center>	
						</td>
						<td width="400">
						<center>
							<a href="downloadarquivoadm.php?arquivo=cotacaoenviadaadm/<?php echo $linha["idprincipal"];?>.txt" class="btn btn-success">Baixar Arquivo</a>
						<center>
						</td>
					</tr>	
					<?php
					}	
					?>
				</tbody>
			</table>	
        </div>
				<p><center></center></p>
		</footer>
		</br></br>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
		<script src="dist/js/bootstrap.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
        </body>
    </html>
<?php
$fh = fopen("cotacaoenviadaadm/".$idprincipal.".txt", 'w');

/* INSERINDO CLIENTES NO ARQUIVO */

$sql = "SELECT cliente_campo1, idprincipal, cliente_campo2, cliente_campo3, cliente_campo4, cliente_campo5, cliente_campo6, cliente_campo7 FROM cliente where idprincipal = '".$idprincipal=$_GET["idprincipal"]."'";
$query = mysqli_query($conn, $sql);   
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){                     
    $last = sizeof($row)-1;
    $i = 0;
    foreach($row as $field) {
        fwrite($fh, $field);                       
        if ($i != $last) {
            fwrite($fh, "|");
        }
        $i++;
    }                                                                 
   		fwrite($fh, "|");
		fwrite($fh, "\r\n");
/* FIM DO INSERIR CLIENTES NO ARQUIVO */							
							/* INSERINDO FORNECEDORES NO ARQUIVO */
							$sql2 = "SELECT fornecedor_campo1, fornecedor_campo2, fornecedor_campo3, fornecedor_campo4, fornecedor_campo5, fornecedor_campo6, fornecedor_campo7, fornecedor_campo8, fornecedor_campo9, fornecedor_campo10, fornecedor_campo11, fornecedor_campo12, fornecedor_campo13 FROM fornecedor where idprincipal = '".$idprincipal=$_GET["idprincipal"]."'";
							$query2 = mysqli_query($conn, $sql2);   
							while($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)){                     
								$last2 = sizeof($row2)-1;
								$i2 = 0;
								foreach($row2 as $field2) {
									fwrite($fh, $field2);                       
										if ($i2 != $last2) {
											fwrite($fh, "|");
									}
										$i2++;
								}                                                                 
										fwrite($fh, "|");
										fwrite($fh, "\r\n");
							}
							/* FIM DO INSERIR FORNECEDORES NO ARQUIVO */
															/* INSERINDO PRODUTOS NO ARQUIVO */
															$sql3 = "SELECT produto_campo1, produto_campo2, produto_campo3, produto_campo4, produto_campo5, produto_campo6, produto_campo7, produto_campo8 FROM produto where idprincipal = '".$idprincipal=$_GET["idprincipal"]."'";
															$query3 = mysqli_query($conn, $sql3);   
															while($row3 = mysqli_fetch_array($query3, MYSQLI_ASSOC)){                     
																$last3 = sizeof($row3)-1;
																$i3 = 0;
																foreach($row3 as $field3) {
																	fwrite($fh, $field3);                       
																		if ($i2 != $last3) {
																			fwrite($fh, "|");
																	}
																		$i3++;
																}                                                                 
																		
																		fwrite($fh, "\r\n");
															}
															/* FIM DO INSERIR PRODUTOS NO ARQUIVO */						
	}
fclose($fh);
/*header ("Location: painel.php");*/
}
if (isset($_GET["acao"])) {

    if ($_GET["acao"] == "sair") {
        $_SESSION['logado'] = 0;
        ?>
        <script type="text/javascript">
            document.location.href = "index.php?erro=2";
        </script>
        <?php
    }
}
?>
