<?php
session_start();
error_reporting(0);
ini_set(“display_errors”, 0 );
if ($_SESSION['logado'] != 1 || $_SESSION['tipo'] == 'F') {
    ?>
    <script type="text/javascript">
        document.location.href = "index.php?erro=1";
    </script>
    <?php
} else {
require_once ("classes/DAO/usuarioDAO.php");
require_once("classes/Entidade/usuario.php");

require_once ("classes/DAO/senhaDAO.php");
require_once("classes/Entidade/senha.php");


$usuarioDAO = new usuarioDAO();
$senhaDAO = new senhaDAO();

$usuario = new usuario();
$senha = new senha();

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
				  </ul>
				  <ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span></a></li>
					<li><a href="?acao=sair"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				  </ul>
				</div>
			  </div>
			</nav>
        <div class="container">
				<form method="post" class="form-signin" name="frmLogin">
					<div class="alert">
						<center>
							<img src="img/portal.png">
							<h2 class="page-header"></h2>
						</center>
						<tr>
							<td><h5 class="colorwhite">Código do Fornecedor:</h5></td>
							<td><input type="number" name="txtidFornecedor" class="form-control" placeholder="100" autocomplete="off" /></td>
						</tr>
						<tr>
							<td><h5 class="colorwhite">Nome:</h5></td>
							<td><input type="text" name="txtNome" class="form-control" placeholder="Miguel Dias" autocomplete="off" /></td>
						</tr>
						<tr>
							<td><h5 class="colorwhite">E-mail:</h5></td>
							<td><input type="text" name="txtEmail" class="form-control" placeholder="email@dominio.com" autocomplete="off" /></td>
						</tr>
						<tr>
							<td><h5 class="colorwhite">Senha:</h5></td>
							<td><input onKeyUp="validarSenha('txtPass', 'txtPassAccept', 'resultadoCadastro');" type="password" id="txtPass" name="txtPass" class="form-control" placeholder="*********" autocomplete="off" /></td>
						</tr>
						<tr>
							<td><h5 class="colorwhite">Confirmar senha:</h5></td>
							<td><input type="password" onKeyUp="validarSenha('txtPass', 'txtPassAccept', 'resultadoCadastro');" id="txtPassAccept" name="txtPassAccept" class="form-control" placeholder="*********" autocomplete="off" /></td>
						</tr>
						<tr>
							<td><h5 class="colorwhite">Tipo:</h5></td>
							<td>
								<select class="form-control" name="slTipo">
									<option value="F">Fornecedor</option>
								</select> 
							</td>
						</tr>
						<tr>
							<td colspan="2"><p id="resultadoCadastro" style="font-weight: bold;">&nbsp;</p></td>
						</tr>
						<tr>
							<td colspan="2">
							<center>
								<input type="submit" name="btnSubmit" value="Cadastrar" class="btn btn-danger"  /> <td><a href="painel.php"  class="btn btn-default">Voltar</a></td>
							</center>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<footer class="footer">
				<p><center>&copy; Portal Construtora.</center></p>
		</footer>

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
	if (isset($_POST['btnSubmit'])) {
		$usuario->setUs_nome($_POST['txtNome']);
		$usuario->setUs_email($_POST['txtEmail']);
		$usuario->setUs_tipo($_POST['slTipo']);
		$usuario->setUs_idfornecedor($_POST['txtidFornecedor']);

		if (!$usuarioDAO->consultarEmail($_POST['txtEmail'])) {

			if ($usuarioDAO->cadastrar($usuario)) {

				$codigoUsuario = $usuarioDAO->consultarCodUsuario($_POST['txtEmail']);

				$senha->setUs_senha($_POST['txtPassAccept']);
				$senha->setUs_cod($codigoUsuario);

				if ($senhaDAO->cadastrar($senha)) {
					?>
					<script type = "text/javascript">
						document.getElementById("resultadoCadastro").innerHTML = "Cadastrado com sucesso.";
						document.getElementById("resultadoCadastro").style.color = "white";</script>
					<?php
				} else {
					?>
					<script type="text/javascript">
						document.getElementById("resultadoCadastro").innerHTML = "Erro ao cadastrar.";
						document.getElementById("resultadoCadastro").style.color = "white";</script>
					<?php
				}
			}
		} else {
			?>
			<script type="text/javascript">
				document.getElementById("resultadoCadastro").innerHTML = "O E-mail informado já está cadastrado.";
				document.getElementById("resultadoCadastro").style.color = "white";</script>
			<?php
		}
	}
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
