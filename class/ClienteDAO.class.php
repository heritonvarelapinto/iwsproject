<?php
class ClienteDAO extends PDOConnectionFactory {

	public $conexao = null;
	
	// constructor
	public function ClienteDAO(){
		$this->conexao = PDOConnectionFactory::getConnectionConstrutor();
	}

	public function ListaClientes($sql=null) {
		$sql = "SELECT * FROM cliente";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Cliente();

			$temp->setIdCliente($rs->idcliente); 
			$temp->setNome($rs->nome); 
			$temp->setVersao($rs->versao); 
			$temp->setLogo($rs->logo); 
			$temp->setEmail($rs->email); 
			
			array_push($searchResults, $temp);
		} 
		
		if(count($rs) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
		
	}
	
	function getUsuarioPorID($id) {
		//é esse o nome da tabela ?
		$sql = "SELECT * FROM cliente where idcliente = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		
		$stmt->execute();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		$temp = new Cliente();

		$temp->setIdCliente($rs->idcliente); 
		$temp->setNome($rs->nome); 
		$temp->setVersao($rs->versao); 
		$temp->setLogo($rs->logo);
		$temp->setEmail($rs->email); 
			
		return $temp;
	}
	
	function getUsuarioPorNome($nome) {
		//é esse o nome da tabela ?
		$sql = "SELECT * FROM cliente where nome = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$nome);
		
		$stmt->execute();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		
		$temp = new Cliente();

		$temp->setIdCliente($rs->idcliente); 
		$temp->setNome($rs->nome); 
		$temp->setVersao($rs->versao); 
		$temp->setLogo($rs->logo);
		$temp->setEmail($rs->email); 
			
		 
		return $temp;
	}
}
?>