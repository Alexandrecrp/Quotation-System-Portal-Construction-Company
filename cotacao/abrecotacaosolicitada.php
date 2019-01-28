<?php
session_start();

include("conexao.php");

if ($_SESSION['logado'] != 1 || $_SESSION['tipo'] != 'F') {
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
					<li><a href="painelfornecedor.php" class="colorwhite">Início</a></li>
					<li><a href="cotacoessolicitadas.php" class="colorwhite">Cotações solicitadas</a></li>
				  </ul>
				  <ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span></a></li>
					<li><a href="?acao=sair"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				  </ul>
				</div>
			  </div>
			</nav>
			<?php
			if (isset($_GET['idprincipal'])){
						$idprincipal=$_GET["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$querytrava = "select * from travafornecedor where idfornecedor = ".$_SESSION["idfornecedor"]." and idprincipal = ".$idprincipal."";
						$resultadotrava = mysqli_query($conn,$querytrava);
						$linhatrava = mysqli_fetch_array($resultadotrava);
						if($linhatrava["status"]==0){
			?>
				<?php
					if (isset($_GET['idprincipal'])){
						$idprincipal=$_GET["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query = "select * from cliente c inner join fornecedor f on c.idprincipal = f.idprincipal 
						where f.fornecedor_campo2 = ".$_SESSION["idfornecedor"]." and c.idprincipal = ".$idprincipal."";
				
						$resultadocabecalho = mysqli_query($conn,$query);
						$cabecalho = mysqli_fetch_array($resultadocabecalho);
						?>
						<div class="container">
							<h3 class="page-header">Cotação Solicitada - <?php echo $idprincipal." - Fornecedor: ".$cabecalho["fornecedor_campo3"];?>
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
					if (isset($_GET['idprincipal'])){
						$idprincipal=$_GET["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query2 = "select * from produto p inner join cliente c on c.idprincipal = p.idprincipal 
						where c.idprincipal = ".$idprincipal."";
						$resultado2 = mysqli_query($conn,$query2);
						$index=0;
						while($linha2 = mysqli_fetch_array($resultado2)){
					?>
					<form action="abrecotacaosolicitada.php?idprincipal=<?php echo $linha2["idprincipal"];?>" method="POST" enctype="multipart/form-data" name="cadastro">
					<?php	
					?>
					<tr>
						<td width="10" style="display: none">
							<font size="2">
								<input type="text" class="form-control" id="produtofornecedor_campo1" name="produtofornecedor_campo1[]" value="<?php echo $linha2["produto_campo1"];?>" readonly>
							</font>	
						</td>
						<td width="10" style="display: none">
							<font size="2">
								<input type="text" class="form-control" id="idprincipal" name="idprincipal[]" value="<?php echo $linha2["idprincipal"];?>" readonly>
							</font>	
						</td>
						<td width="50" style="display: none">
							<font size="2">
								<input type="text" class="form-control" id="produtofornecedor_campo2" name="produtofornecedor_campo2[]" value="<?php echo $linha2["produto_campo2"];?>" readonly>
							</font>	
						</td>
						<td width="100">
							<font size="2">
								<textarea type="text" class="form-control" id="produtofornecedor_campo3" rows="5" name="produtofornecedor_campo3[]" readonly><?php echo $linha2["produto_campo3"];?></textarea>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="text" class="form-control" id="produtofornecedor_campo4" name="produtofornecedor_campo4[]" value="<?php echo $linha2["produto_campo4"];?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="text" class="form-control" id="produtofornecedor_campo5" name="produtofornecedor_campo5[]" value="<?php echo $linha2["produto_campo5"];?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="number" class="form-control" id="produtofornecedor_campo6[]" step="0.0001" name="produtofornecedor_campo6[]" onchange="soma()" value="0">
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="number" class="form-control" id="produtofornecedor_campo7[]" step="0.0001" name="produtofornecedor_campo7[]" onchange="soma2()" value="0">
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="number" class="form-control decimal" id="produtofornecedor_campo8[]" name="produtofornecedor_campo8[]" value="<?php echo number_format(str_replace(',', '.',$linha2["produto_campo8"]),2);?>" readonly>
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="text" class="form-control" id="produtofornecedor_campo9" name="produtofornecedor_campo9[]" >
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<input type="text" class="form-control" id="produtofornecedor_campo10" name="produtofornecedor_campo10[]" >
							</font>	
						</td>
						<td width="10">
							<font size="2">
								<textarea type="text" class="form-control" id="produtofornecedor_campo11" rows="5" name="produtofornecedor_campo11[]"></textarea>
							</font>	
						</td>
						<td width="10">
							<font size="2" style="display: none">
								<input type="text" class="form-control" id="produtofornecedor_campo12" name="produtofornecedor_campo12[]" value="<?php echo date('d/m/Y', strtotime($linha2["produto_campo9"]));?>" 	readonly>
							</font>	
						</td>
					<?php
						$index++;
						}
					}
					?>
					</tr>
				</tbody>
			</table>
			<h4 class="page-header">Forma de Pagamento</h4>
			<table class="table">
				  <thead>
					<tr>
					  <th>Quantas vezes parcela</th>
					  <th>vencimento da 1º parcela</th>
					  <th>Contato do vendedor</th>
					  <th>Prazo de entrega</th>
					   <th>Preço a vista</th>
					  <th>Preço a prazo</th>
					</tr>
				  </thead>
				  <tbody>			
				<tbody>
						<td width="10">
							<input type="text" class="form-control" id="qtdparcela" name="qtdparcela" >
						</td>
						<td width="10">
							<input type="date" class="form-control" id="datavencparcela" name="datavencparcela" >
						</td>
						<td width="10">
							<input type="text" class="form-control" id="contatovendedor" name="contatovendedor" >
						</td>
						<td width="10">
							<input type="text" class="form-control" id="prazoentrega" step="0.0" name="prazoentrega" >
						</td>
						<td width="50">
							<input type="number" class="form-control" id="precoavista" step="0.0001" name="precoavista">
						</td>
						<td width="50">
							<input type="number" class="form-control" id="precoaprazo" step="0.0001" name="precoaprazo" >
						</td>
				</tbody>
			</table>
			<div style="text-align: right;">
				<button type="submit" class="btn btn-danger btn-md" name="enviarcotacaoaocliente" value="enviarcotacaoaocliente">Enviar cotação para o cliente</button>
			</div>
			</form>
			<script>
			var quant = document.getElementsByName("produtofornecedor_campo6[]");
			var quant2 = document.getElementsByName("produtofornecedor_campo8[]");
				var calcula = [];
				function soma(){
				var soma = 0;
				for (var i=0; i<quant.length; i++){
						calcula[i] = parseFloat(quant[i].value)*parseFloat(quant2[i].value);      
						soma += parseFloat(calcula[i]);
				 }  
				  document.getElementById("precoavista").value = parseFloat(soma).toFixed(4);
				}
			</script>
			<script>
			var quant3 = document.getElementsByName("produtofornecedor_campo7[]");
			var quant4 = document.getElementsByName("produtofornecedor_campo8[]");
				var calcula2 = [];
				function soma2(){
				var soma2 = 0;
				for (var x=0; x<quant3.length; x++){
						calcula2[x] = parseFloat(quant3[x].value)*parseFloat(quant4[x].value);      
						soma2 += parseFloat(calcula2[x]);
				 }  
				  document.getElementById("precoaprazo").value = parseFloat(soma2).toFixed(4);
				}
			</script>
					<?php
						if (isset($_POST['enviarcotacaoaocliente'])){
							for($i=0;$i<$index;$i++){
							$idprincipal =$_POST['idprincipal'][$i];
							$idfornecedor = $_SESSION["idfornecedor"];	
							$produtofornecedor_campo1 = $_POST['produtofornecedor_campo1'][$i];
							$produtofornecedor_campo2 = $_POST['produtofornecedor_campo2'][$i];
							$produtofornecedor_campo3 = $_POST['produtofornecedor_campo3'][$i];
							$produtofornecedor_campo4 = $_POST['produtofornecedor_campo4'][$i];
							$produtofornecedor_campo5 = $_POST['produtofornecedor_campo5'][$i];
							$produtofornecedor_campo6 = $_POST['produtofornecedor_campo6'][$i];
							$produtofornecedor_campo7 = $_POST['produtofornecedor_campo7'][$i];
							$produtofornecedor_campo8 = $_POST['produtofornecedor_campo8'][$i];
							$produtofornecedor_campo9 = $_POST['produtofornecedor_campo9'][$i];
							$produtofornecedor_campo10 = $_POST['produtofornecedor_campo10'][$i];
							$produtofornecedor_campo11 = $_POST['produtofornecedor_campo11'][$i];
							

							$insertproduto[$i] .= "INSERT INTO produtofornecedor (idprincipal, idfornecedor, produtofornecedor_campo1, produtofornecedor_campo2, produtofornecedor_campo3, 
							produtofornecedor_campo4, produtofornecedor_campo5, produtofornecedor_campo6, produtofornecedor_campo7, produtofornecedor_campo8, 
							produtofornecedor_campo9, produtofornecedor_campo10, produtofornecedor_campo11, produtofornecedor_campo12) 
							VALUES ('".$idprincipal."', '".$idfornecedor."', '".$produtofornecedor_campo1."', '".$produtofornecedor_campo2."', '".$produtofornecedor_campo3."', 
							'".$produtofornecedor_campo4."', '".$produtofornecedor_campo5."', '".$produtofornecedor_campo6."', '".$produtofornecedor_campo7."', 
							'".$produtofornecedor_campo8."', '".$produtofornecedor_campo9."', '".$produtofornecedor_campo10."', '".$produtofornecedor_campo11."',now());";
							$resultadoinsertproduto = mysqli_query($conn, $insertproduto[$i]);

						}
						$travandofornecedor = "UPDATE travafornecedor SET status = '1' WHERE idprincipal = '".$idprincipal."' and idfornecedor = '".$idfornecedor."';";
						$resultadotravandofornecedor = mysqli_query($conn, $travandofornecedor);
						
							$qtdparcela = $_POST['qtdparcela'];
							$datavencparcela = $_POST['datavencparcela'];
							$contatovendedor = $_POST['contatovendedor'];
							$prazoentrega = $_POST['prazoentrega'];
							$precoavista = $_POST['precoavista'];
							$precoaprazo = $_POST['precoaprazo'];
							$formapagamento = " INSERT INTO formadepagamento (idprincipal, idfornecedor, qtdparcela, datavencparcela, contatovendedor, 
											prazoentrega, precoavista, precoaprazo) VALUES ('".$idprincipal."','".$idfornecedor."','".$qtdparcela."','".$datavencparcela."',
											'".$contatovendedor."','".$prazoentrega."','".$precoavista."','".$precoaprazo."');";
						
							$resultadoformadepagamento = mysqli_query($conn, $formapagamento);
						?>
						<script>window.location="abrecotacaosolicitada.php?idprincipal=<?php echo $idprincipal;?>";</script>
						<?php
					}
				}//if da trava.
			} //trava do status do fornecedor
		?>			
		<?php
			if (isset($_GET['idprincipal'])){
						$idprincipal=$_GET["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$querytrava = "select * from travafornecedor where idfornecedor = ".$_SESSION["idfornecedor"]." and idprincipal = ".$idprincipal."";
						$resultadotrava = mysqli_query($conn,$querytrava);
						$linhatrava = mysqli_fetch_array($resultadotrava);
						if($linhatrava["status"]==1){
				?>
				<?php
					if (isset($_GET['idprincipal'])){
						$idprincipal=$_GET["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query = "select * from cliente c inner join fornecedor f on c.idprincipal = f.idprincipal 
						where f.fornecedor_campo2 = ".$_SESSION["idfornecedor"]." and c.idprincipal = ".$idprincipal."";
				
						$resultadocabecalho = mysqli_query($conn,$query);
						$cabecalho = mysqli_fetch_array($resultadocabecalho);
						?>
						<div class="container">
							<h3 class="page-header">Cotação Solicitada - <?php echo $idprincipal." - Fornecedor: ".$cabecalho["fornecedor_campo3"];?>
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
					if (isset($_GET['idprincipal'])){
						$idprincipal=$_GET["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query3 = "select * from produtofornecedor pf 
						inner join cliente c on c.idprincipal = pf.idprincipal
						inner join formadepagamento fp on c.idprincipal = fp.idprincipal
						where 
						pf.idprincipal = ".$idprincipal." and pf.idfornecedor = ".$_SESSION["idfornecedor"]."
						and fp.idprincipal = ".$idprincipal." and fp.idfornecedor= ".$_SESSION["idfornecedor"]."";
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
					if (isset($_GET['idprincipal'])){
						$idprincipal=$_GET["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query3 = "select * from produtofornecedor pf 
						inner join cliente c on c.idprincipal = pf.idprincipal
						inner join formadepagamento fp on c.idprincipal = fp.idprincipal
						where 
						pf.idprincipal = ".$idprincipal." and pf.idfornecedor = ".$_SESSION["idfornecedor"]."
						and fp.idprincipal = ".$idprincipal." and fp.idfornecedor= ".$_SESSION["idfornecedor"]."";
						$resultado3 = mysqli_query($conn,$query3);
						$linha3 = mysqli_fetch_array($resultado3);
					?>	
			<h4 class="page-header">Forma de Pagamento</h4>
			<table class="table">
				  <thead>
					<tr>
					  <th>Quantas vezes parcela</th>
					  <th>vencimento da 1º parcela</th>
					  <th>Contato do vendedor</th>
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
				<!--<button type="submit" class="btn btn-danger btn-md" name="enviarcotacaoaocliente" value="enviarcotacaoaocliente">Enviar cotação para o cliente</button>-->
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