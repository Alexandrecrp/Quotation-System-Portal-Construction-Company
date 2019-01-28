<?php
session_start();
require_once ("classes/DAO/usuarioDAO.php");

$usuarioDAO = new usuarioDAO();

if (isset($_POST['btnSubmit'])) {

    if ($usuarioDAO->login($_POST['txtEmail'], $_POST['txtPassword'])) {

        $_SESSION['logado'] = '1';
		$_SESSION['email'] = $usuarioDAO->RetornaEmail($_POST['txtEmail']);
		$_SESSION['tipo'] = $usuarioDAO->RetornaTipo($_POST['txtEmail']);
	  if($_SESSION['tipo'] != 'F'){
		header ("Location: painel.php");
	  }
	  else{
		  $_SESSION['idfornecedor'] = $usuarioDAO->RetornaIdfornecedor($_POST['txtEmail']);
		  $_SESSION['nomefornecedor'] = $usuarioDAO->RetornaNomefornecedor($_POST['txtEmail']);
		  header ("Location: painelfornecedor.php");
	  }
    } else {
        ?>
        <script type="text/javascript">
            alert("Usuário ou senha inválido.");
        </script>
        <?php
    }
}

if (isset($_GET['erro'])) {
    switch ($_GET['erro']) {
        case "1":
            ?>
            <script type="text/javascript">
                alert("Você não tem permissão para acessar o painel.");
            </script>
            <?php
            break;
        case "2":
            ?>
            <script type="text/javascript">
                alert("Você saiu do painel.");
            </script>
            <?php
            break;
    }
}

/*if ($_SESSION['logado'] == 1) {
   header ("Location: painel.php");
}*/
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
		<link href="assets/css/logins2.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
		
		<link href="asset/css/themify-icons.css" rel="stylesheet">
		
        <link rel="shortcut icon" href="img/logo2.png" />
    </head>
    <body style="background-color: #983A35">
	<div class="container-fluid">
		<img src="img/portal.png">
	</div>
	<div class="container">
            <form method="post" class="form-signin" name="frmLogin">
				<div class="alert">
					<center>
						<h3 class="page-header"><strong>Faça seu login</strong></h3>
					</center>
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						<div class="form-group">
							Email
							<input type="text" name="txtEmail" class="form-control" placeholder="" autocomplete="off" required >
						</div>
							<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
						<div class="form-group">
							Senha
							<input type="password" name="txtPassword" class="form-control " placeholder="" autocomplete="off" required >		
						</div>
						<div class="form-group">
							<center><input type="submit" name="btnSubmit" value="Login" class="btn btn-danger"/><center>
						</div>
						<center>
							<a href="recuperarSenha.php" class="colorred">Recuperar Senha</a>
						</center>
				</div>		
            </form>
	</div>	
    </body>
</html>
