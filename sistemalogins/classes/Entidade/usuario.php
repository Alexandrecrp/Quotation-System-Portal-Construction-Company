<?php

class usuario {

    private $us_cod;
	private $us_nome;
    private $us_idfornecedor;
    private $us_email;
    private $us_tipo;
    private $us_data;
    private $us_hora;
    private $us_ip;

    public function getUs_cod() {
        return $this->us_cod;
    }
	
	public function getUs_idfornecedor() {
        return $this->us_idfornecedor;
    }

    public function getUs_nome() {
        return $this->us_nome;
    }

    public function getUs_email() {
        return $this->us_email;
    }

    public function getUs_tipo() {
        return $this->us_tipo;
    }

    public function getUs_data() {
        return $this->us_data;
    }

    public function getUs_hora() {
        return $this->us_hora;
    }

    public function getUs_ip() {
        return $this->us_ip;
    }

    public function setUs_cod($us_cod) {
        $this->us_cod = $us_cod;
    }

    public function setUs_nome($us_nome) {
        $this->us_nome = $us_nome;
    }
	

    public function setUs_email($us_email) {
        $this->us_email = $us_email;
    }

    public function setUs_tipo($us_tipo) {
        $this->us_tipo = $us_tipo;
    }

    public function setUs_data($us_data) {
        $this->us_data = $us_data;
    }

    public function setUs_hora($us_hora) {
        $this->us_hora = $us_hora;
    }

    public function setUs_ip($us_ip) {
        $this->us_ip = $us_ip;
    }
	public function setUs_idfornecedor($us_idfornecedor) {
        $this->us_idfornecedor = $us_idfornecedor;
    }
}

?>