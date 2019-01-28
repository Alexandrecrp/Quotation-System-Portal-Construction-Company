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
			<div class="container">
				<h3 class="page-header">Olá, <?=$_SESSION["email"];?> - Enviar dados para cotação em arquivo TXT</h3>
				<?php
				if(isset($_SESSION['msg'])){
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
				?>
			<div class="alert aler-warning">
				<form method="POST" action="processaImportar.php" enctype="multipart/form-data" class="form">
					<label class="colorwhite">Arquivo</label>
					<input type="file" class="form-control" name="arquivo"><br>						
					<input type="submit" value="Importar" class="btn btn-danger">
				</form>
			</div>
			<h4 class="page-header"></h4>
			<h4 class="">Última cotação enviada</h4>
			<table class="table">
			<thead>
				<tr>
				  <th scope="col">Código</th>
				  <th scope="col">Data da cotação</th>
				  <th scope="col">Nome do Cliente</th>
				  <th scope="col">Data de envio de cotação</th>
				</tr>
			  </thead>
			<tbody>
					<?php
						//fazendo uma consulta SQL e retornando os resultados								
						$query = "  SELECT * 
									FROM cliente 
									ORDER BY cliente_campo8 DESC";
						$resultado = mysqli_query($conn,$query);

						for($i=1;$i<=1;$i++){
							($linha = mysqli_fetch_array($resultado))
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
							<?php echo date('d/m/Y H:i:s', strtotime($linha["cliente_campo8"]));;?>
						</td>
					</tr>	
					<?php
					}	
					?>
				</tbody>
			</table>
			<div style="text-align: right;">
				<a href="cotacoestotaisenviadasadm.php" class="btn btn-danger btn-md" role="button">Ver lista de todas cotações que você solicitou - Clique aqui.</a>
			</div>	
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