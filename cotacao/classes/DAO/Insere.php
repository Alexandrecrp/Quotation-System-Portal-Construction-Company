<?php

require_once("Conexao.php");

class insereDAO {

    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function insere(senha $entSenha) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO produtos (nome, valor) VALUES ('$nome', '$valor')";
            $param = array(
                ":us_cod" => $entSenha->getUs_cod(),
                ':us_senha' => md5($entSenha->getUs_senha())
            );

            return $stmt->execute($param);
        } /*catch (PDOException $ex) {
            echo "ERRO 01,  SENHA: {$ex->getMessage()}";
        }*/
    }
}