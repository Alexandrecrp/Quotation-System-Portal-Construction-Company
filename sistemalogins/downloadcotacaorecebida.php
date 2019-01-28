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
					<li><a href="#"><span class="glyphicon glyphicon-user"></span></a></li>
					<li><a href="?acao=sair"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				  </ul>
				</div>
			  </div>
			</nav>
			
		<?php
			if (isset($_POST['idprincipal'])){
						$idprincipal=$_POST["idprincipal"];
						$idfornecedor=$_POST["idfornecedor"];
						//fazendo uma consulta SQL e retornando os resultados								
						$querytrava = "select * from travafornecedor where idfornecedor = ".$idfornecedor." and idprincipal = ".$idprincipal."";
						$resultadotrava = mysqli_query($conn,$querytrava);
						$linhatrava = mysqli_fetch_array($resultadotrava);
						if($linhatrava["status"]==1){
			?>
							<?php
					if (isset($_POST['idprincipal'])){
						$idprincipal=$_POST["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query = "select * from cliente c inner join fornecedor f on c.idprincipal = f.idprincipal 
						where f.fornecedor_campo2 = ".$idfornecedor." and c.idprincipal = ".$idprincipal."";
				
						$resultadocabecalho = mysqli_query($conn,$query);
						$cabecalho = mysqli_fetch_array($resultadocabecalho);
						?>
						<div class="container">
							<h3 class="page-header">Cotação Solicitada - <?php echo $idprincipal." - ".$cabecalho["fornecedor_campo3"];?>
								<h4 class="page-header">Data da Solicitação: <?php echo date('d/m/Y', strtotime($cabecalho["fornecedor_campo14"]));?><h4>	
								<h4 class="page-header">Dados Fornecedor<h4>
							<div class="page-header">
								<h5><strong>Fornecedor: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo3"];?></h6>
								<h5><strong>Endereço: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo4"].", "; echo $cabecalho["fornecedor_campo5"];?></h6>
								<h5><strong>Bairro: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo6"];?></h6>
								<h5><strong>Cidade: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo8"];?></h6>
								<h5><strong>CEP: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo7"];?></h6>
								<h5><strong>CPF/CNPJ: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo9"];?></h6>
								<h5><strong>CPF/CNPJ: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo10"];?></h6>
								<h5><strong>Telefone/Celular: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo11"];?></h6>
								<h5><strong>Telefone/Celular: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo12"];?></h6>
								<h5><strong>Email: </strong></h5><h6> - <?php echo $cabecalho["fornecedor_campo13"];?></h6>
							</div>	
						<?php
						$resultado = mysqli_query($conn,$query);
					while($linha = mysqli_fetch_array($resultado)){
					?>
						<h4 class="page-header">Dados Cliente</h4>	
					<div class="page-header	">
						<h5><strong>Obra: </strong></h5><h6> - <?php echo $linha["cliente_campo4"];?></h6>
						<h5><strong>Solicitante: </strong></h5><h6> - <?php echo $linha["cliente_campo5"];?></h6>
						<h5><strong>Comprador: </strong></h5><h6> - <?php echo $linha["cliente_campo6"];?></h6>
						<h5><strong>Observação: </strong></h5><h6><?php echo $linha["cliente_campo7"];?></h6>
					</div>
					<?php
						}
					}
					?>
			<h4 class="page-header">Dados dos Produtos a serem orçados</h4>
			<table class="table">	
				   <thead>
					<tr>
					  <th>Produto</th>
					  <th>Unidade</th>
					  <th>Tipo Produto</th>
					  <th>Preço a Vista</th>
					  <th>Preço a Prazo</th>
					  <th>Qtd. </br>Requisitada</th>
					  <th>Unidade de Venda</th>
					  <th>Marca do produto</th>
					  <th>Observação</th>
					</tr>
				  </thead>
				  <tbody>		
				<tbody>
					<?php
					if (isset($_POST['idprincipal'])){
						$idprincipal=$_POST["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query3 = "select * from produtofornecedor pf inner join cliente c on c.idprincipal = pf.idprincipal 
						where pf.idprincipal = ".$idprincipal." and pf.idfornecedor = ".$idfornecedor."";
						$resultado3 = mysqli_query($conn,$query3);
						while($linha3 = mysqli_fetch_array($resultado3)){
					?>
					<form action="#" method="POST" enctype="multipart/form-data" name="cadastro">
					<?php	
					?>	
					<tr>
						<td width="10" style="display: none">
							<font size="2">
								<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["produtofornecedor_campo1"];?>" readonly>
							</font>	
						</td>
						<td width="10" style="display: none">
							<font size="2">
								<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["idprincipal"];?>" readonly>
							</font>	
						</td>
						<td width="50" style="display: none">
							<font size="2">
								<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["produtofornecedor_campo2"];?>" readonly>
							</font>	
						</td>
						<td width="100">
							<font size="2">
								<textarea type="text" class="form-control" id="" rows="5" name="" readonly><?php echo $linha3["produtofornecedor_campo3"];?></textarea>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["produtofornecedor_campo4"];?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["produtofornecedor_campo5"];?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="number" class="form-control" id="" name="" value="<?php echo number_format(str_replace(',', '.',$linha3["produtofornecedor_campo6"]),4);?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="number" class="form-control" id="" name="" value="<?php echo number_format(str_replace(',', '.',$linha3["produtofornecedor_campo7"]),4);?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="number" class="form-control decimal" id="" name="produtofornecedor_campo8[]" value="<?php echo number_format(str_replace(',', '.',$linha3["produtofornecedor_campo8"]),2);?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["produtofornecedor_campo9"];?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["produtofornecedor_campo10"];?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<textarea type="text" class="form-control" id="" rows="5" name="" readonly><?php echo $linha3["produtofornecedor_campo11"];?></textarea>
							</font>	
						</td>
						<td width="30" style="display: none">
							<font size="2">
								<input type="text" class="form-control" id="" name="" value="<?php echo date('d/m/Y', strtotime($linha3["produtofornecedor_campo12"]));?>" 	readonly>
							</font>	
						</td>
					</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
						<?php
					if (isset($_POST['idprincipal'])){
						$idprincipal=$_POST["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query3 = "select * from produtofornecedor pf 
						inner join cliente c on c.idprincipal = pf.idprincipal
						inner join formadepagamento fp on c.idprincipal = fp.idprincipal
						where 
						pf.idprincipal = ".$idprincipal." and pf.idfornecedor = ".$idfornecedor."
						and fp.idprincipal = ".$idprincipal." and fp.idfornecedor= ".$idfornecedor."";
						$resultado3 = mysqli_query($conn,$query3);
						$linha3 = mysqli_fetch_array($resultado3);
					?>	
			<h4 class="page-header">Forma de Pagamento</h4>
			<table class="table">
				  <thead>
					<tr>
					  <th>Quantas vezes parcela</th>
					  <th>vencimento da 1º parcela</th>
					  <th>Contato do vendendor</th>
					  <th>Prazo de entrega</th>
					   <th>Preço a vista</th>
					  <th>Preço a prazo</th>
					</tr>
				  </thead>
				  <tbody>			
				<tbody>
						<td width="10">
							<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["qtdparcela"];?>" readonly>
						</td>
						<td width="10">
							<input type="text" class="form-control" id="" name="" value="<?php echo date('d/m/Y', strtotime($linha3["datavencparcela"]));?>" readonly>
						</td>
						<td width="10">
							<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["contatovendedor"];?>" readonly>
						</td>
						<td width="10">
							<input type="text" class="form-control" id="" name="" value="<?php echo $linha3["prazoentrega"];?>" readonly>
						</td>
						<td width="50">
							<input type="number" class="form-control" id="" name="" value="<?php echo $linha3["precoavista"];?>" readonly>
						</td>
						<td width="50">
							<input type="number" class="form-control" id="" name="" value="<?php echo $linha3["precoaprazo"];?>" readonly>
						</td>
				</tbody>
			</table>
			<?php
		}
		?>
			<div style="text-align: right;">
				<a href="downloadarquivocotacaorecebida.php?arquivo=cotacaorecebida/<?php echo $idprincipal;?>-<?php echo $idfornecedor;?>.txt" class="btn btn-success">Baixar Arquivo</a>
			</div>
					<?php
				}//if da trava.
			} //trava do status do fornecedor
		?>	
		
		</form>
        </div>		
		<footer class="footer">
				<p><center>&copy; Portal Construtora.</center></p>
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
$fh = fopen("cotacaorecebida/".$idprincipal."-".$idfornecedor.".txt", 'w');

/* INSERINDO CLIENTES NO ARQUIVO */

$sql = "SELECT cliente_campo1, idprincipal, cliente_campo2, cliente_campo3, cliente_campo4, cliente_campo5, cliente_campo6, cliente_campo7 FROM 
cliente where idprincipal = '".$idprincipal=$_POST["idprincipal"]."'";
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
							$sql2 = "SELECT
										f.fornecedor_campo1,
										f.fornecedor_campo2,
										f.fornecedor_campo3,
										f.fornecedor_campo4,
										f.fornecedor_campo5,
										f.fornecedor_campo6,
										f.fornecedor_campo7,
										f.fornecedor_campo8,
										f.fornecedor_campo9,
										f.fornecedor_campo10,
										f.fornecedor_campo11,
										f.fornecedor_campo12,
										f.fornecedor_campo13,
										DATE_FORMAT( fp.datavencparcela, '%d/%m/%Y' ),
										fp.qtdparcela,
										fp.contatovendedor,
										fp.prazoentrega,
										fp.precoavista,
										fp.precoaprazo 
									FROM
										fornecedor f
										INNER JOIN formadepagamento fp ON f.idprincipal = fp.idprincipal 
										AND f.fornecedor_campo2 = fp.idfornecedor
										INNER JOIN cliente c ON c.idprincipal = fp.idprincipal 
									WHERE
										f.idprincipal = ".$idprincipal=$_POST["idprincipal"]." 
										AND f.fornecedor_campo2 = ".$idfornecedor=$_POST["idfornecedor"]." 
										AND fp.idprincipal = ".$idprincipal=$_POST["idprincipal"]." 
										AND fp.idfornecedor = ".$idfornecedor=$_POST["idfornecedor"]."";
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
															$sql3 = "select pf.produtofornecedor_campo1, pf.produtofornecedor_campo2, pf.produtofornecedor_campo3,
																		pf.produtofornecedor_campo4, pf.produtofornecedor_campo5, pf.produtofornecedor_campo6,
																		pf.produtofornecedor_campo7, pf.produtofornecedor_campo8, pf.produtofornecedor_campo9,
																		pf.produtofornecedor_campo10, pf.produtofornecedor_campo11
																		from produtofornecedor pf inner join cliente c on c.idprincipal = pf.idprincipal 
																		where pf.idprincipal = '".$idprincipal=$_POST["idprincipal"]."' 
																		and pf.idfornecedor = '".$idfornecedor=$_POST["idfornecedor"]."'";
															$query3 = mysqli_query($conn, $sql3);   
															while($row3 = mysqli_fetch_array($query3, MYSQLI_ASSOC)){                     
																$last3 = sizeof($row3)-1;
																$i3 = 0;
																foreach($row3 as $field3) {
																	fwrite($fh, $field3);                       
																		if ($i3 != $last3) {
																			fwrite($fh, "|");
																	}
																		$i3++;
																}                                                                 
																		
																		fwrite($fh, "|\r\n");
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