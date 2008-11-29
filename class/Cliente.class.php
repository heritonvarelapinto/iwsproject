<?php
class Cliente {
	/**
	 * Classe de um objeto Cliente
	 *
	 *
	 */
	public $idcliente;
	public $nome;
	public $versao;	
	public $logo;	
	public $email;	
	
	
	public function setIdCliente( $idcliente ) {
		$this->idcliente = $idcliente;
	}
	public function setNome( $nome ) {
		$this->nome = $nome;
	}
	
	public function setVersao( $versao ) {
		$this->versao = $versao;
	}

	public function setLogo( $logo ) {
		$this->logo = $logo;
	}
	
	public function setEmail( $email ) {
		$this->email = $email;
	}
	
	public function getIdCliente() {
		return $this->idcliente;
	}
	
	public function getNome() {
		return $this->nome;
	}
	
	public function getVersao() {
		return $this->versao;
	}
	
	public function getLogo() {
		return $this->logo;
	}
	
	public function getEmail() {
		return $this->email;
	}
}
?>