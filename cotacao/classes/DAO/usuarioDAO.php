<?php

require_once("Conexao.php");

class usuarioDAO {

    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function cadastrar(usuario $entUsuario) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO usuario VALUES ('', :us_nome, :us_email, :us_tipo, :us_data, :us_hora, :us_ip, :us_idfornecedor)");
            $param = array(
                ":us_nome" => $entUsuario->getUs_nome(),
                ":us_email" => $entUsuario->getUs_email(),
                ":us_tipo" => $entUsuario->getUs_tipo(),
				':us_idfornecedor' => $entUsuario->getUs_idfornecedor(),
                ":us_data" => date("Y/m/d"),
                ":us_hora" => date("h:i:s"),
                ":us_ip" => $_SERVER["REMOTE_ADDR"]
            );

            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 01: {$ex->getMessage()}";
        }
    }

    function consultarCodUsuario($us_email) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE us_email = :us_email");
            $param = array(":us_email" => $us_email);


            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {

                $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
                return $consulta['us_cod'];
            } else {
                return "";
            }
        } catch (PDOException $ex) {
            echo "ERRO 02: {$ex->getMessage()}";
        }
    }

    function consultarEmail($us_email) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE us_email = :us_email");
            $param = array(":us_email" => $us_email);


            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            echo "ERRO 03: {$ex->getMessage()}";
        }
    }

    function login($us_email, $us_senha) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuario INNER JOIN senha on senha.us_cod = usuario.us_cod WHERE usuario.us_email = :us_email AND senha.us_senha = :us_senha");

            $param = array(
                ":us_email" => $us_email,
                ":us_senha" => md5($us_senha)
            );


            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            echo "ERRO 04: {$ex->getMessage()}";
        }
    }
	
	public function RetornaEmail($email){
		try{
			
			$stmt = $this->pdo->prepare("SELECT us_email FROM usuario WHERE us_email = :email");
			$param = array(
				":email"  => $email
			);
			
		 $stmt->execute($param);
			
			$dados = $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $dados["us_email"];
			
			
		}catch (PDOException $ex) {
            echo "ERRO 04: {$ex->getMessage()}";
			return null;
        }
	}
	public function RetornaTipo($tipo){
		try{
			
			$stmt = $this->pdo->prepare("SELECT us_tipo FROM usuario WHERE us_email = :email");
			$param = array(
				":email"  => $tipo
			);
			
		 $stmt->execute($param);
			
			$dados = $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $dados["us_tipo"];
			
			
		}catch (PDOException $ex) {
            echo "ERRO 04: {$ex->getMessage()}";
			return null;
        }
	}
	public function RetornaIdfornecedor($idfornecedor){
		try{
			
			$stmt = $this->pdo->prepare("SELECT us_idfornecedor FROM usuario WHERE us_email = :email");
			$param = array(
				":email"  => $idfornecedor
			);
			
		 $stmt->execute($param);
			
			$dados = $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $dados["us_idfornecedor"];
			
			
		}catch (PDOException $ex) {
            echo "ERRO 04: {$ex->getMessage()}";
			return null;
        }
	}
	public function RetornaNomefornecedor($nomefornecedor){
		try{
			
			$stmt = $this->pdo->prepare("SELECT us_nome FROM usuario WHERE us_email = :email");
			$param = array(
				":email"  => $nomefornecedor
			);
			
		 $stmt->execute($param);
			
			$dados = $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $dados["us_nome"];
			
			
		}catch (PDOException $ex) {
            echo "ERRO 04: {$ex->getMessage()}";
			return null;
        }
	}
	

}

?>