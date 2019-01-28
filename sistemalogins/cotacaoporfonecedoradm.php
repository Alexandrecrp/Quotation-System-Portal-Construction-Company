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
			<div class="container-fluid">
			<h3 class="page-header">Cotações enviadas pelos fornecedores</h3>
			<table class="table">
			<thead>
				<tr>
				  <th scope="col">Código</th>
				  <th scope="col">Data da cotação</th>
				  <th scope="col">Nome do Cliente</th>
				  <th scope="col"><center>Data de envio de cotação<center></th>
				</tr>
			  </thead>
			<tbody>
					<?php
					if (isset($_GET['idprincipal'])){
						$idprincipal=$_GET["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query = " SELECT * FROM cliente c INNER JOIN fornecedor f on c.idprincipal = f.idprincipal WHERE c.idprincipal = ".$idprincipal."";
						$resultado = mysqli_query($conn,$query);

						$linha = mysqli_fetch_array($resultado);
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
					</tr>
					<?php		
					}				
					?>
				</tbody>
			</table>
			</div>
			<div class="container">
			<table class="table">
			<thead>
				<tr>
				  <th>Código fornecedor</th>
				  <th>Fornecedor</th>
				  <th>Endereço</th>
				  <th>Cidade</th>
				  <th>CPF/CNPJ</th>
				  <th>Email</th>
				  <th><center>Status</center></th>
				</tr>
			  </thead>
			<tbody>
					<?php
					if (isset($_GET['idprincipal'])){
						$idprincipal=$_GET["idprincipal"];
						//fazendo uma consulta SQL e retornando os resultados								
						$query = " SELECT * FROM cliente c INNER JOIN fornecedor f on c.idprincipal = f.idprincipal WHERE c.idprincipal = ".$idprincipal."";
						$resultado = mysqli_query($conn,$query);

						while($linha = mysqli_fetch_array($resultado)){
					?>
					<tr>
						<td width="200">
							<a href="#" class="btn btn-danger btn-md" role="button"><?php echo $linha["fornecedor_campo2"];?></a>
						</td>
						<td width="600">
							<?php echo $linha["fornecedor_campo3"];?>
						</td>
						<td width="600">
							<?php echo $linha["fornecedor_campo4"];?>
						</td>
						<td width="600">
							<?php echo $linha["fornecedor_campo8"];?>
						</td>
						<td width="600">
							<?php echo $linha["fornecedor_campo9"];?>
						</td>
						<td width="200">
							<?php echo $linha["fornecedor_campo13"];?>
						</td>

						<?php
						$querytrava = "select * from travafornecedor where idfornecedor = ".$linha["fornecedor_campo2"]." and idprincipal = ".$linha["idprincipal"]."";
						$resultadotrava = mysqli_query($conn,$querytrava);
						$linhatrava = mysqli_fetch_array($resultadotrava);
						if($linhatrava["status"]==0){
							?>
						<td width="400">
							<center>
								<a href="#" class="btn btn-danger btn-md" role="button">Aguardando cotação</a>
							</center>
						</td>
						<?php
						}if($linhatrava["status"]==1){
							?>
							<td width="400">
							<center>
								<form action="downloadcotacaorecebida.php" method="POST">
									<input type="text" name="idprincipal" value="<?php echo $linha["idprincipal"];?>" style="display: none"/>
									<input type="text" name="idfornecedor" value="<?php echo $linha["fornecedor_campo2"];?>" style="display: none"/>
									<input type="submit" class="btn btn-success" value="Cotação Enviada" />
								</form>
							</center>
						</td>
						<?php
						}
						?>

					</tr>
					<?php
						}	
					}				
					?>
				</tbody>
			</table>

        
		
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