<?php
class SubdepartamentoDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function SubdepartamentoDAO(){
		$this->conexao = PDOConnectionFactory::getConnection();
	}
		
	/**
	 * Lista Subdepartamentos
	 *
	 * @return array
	 */
	function listaSubdepartamento() {
		$sql = "SELECT * FROM subdepartamentos";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Subdepartamento();

			$temp->setIdsubdepartamento($rs->idsubdepartamento); 
			$temp->setIddepartamento($rs->iddepartamento); 
			$temp->setSubdepartamento($rs->subdepartamento);
			
			array_push($searchResults, $temp);
		} 
		return $searchResults;
	}
	
	
	//mostra os registros
	public function Paginacao($order,$inicio,$fim,$id) {
		$sql = "SELECT * FROM subdepartamentos WHERE iddepartamento = ? $order LIMIT $inicio,$fim";
		$stmt = $this->conexao->prepare($sql);	
		
		$stmt->bindValue(1,$id);
		
		$stmt->execute();
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Subdepartamento();

			$temp->setIdsubdepartamento($rs->idsubdepartamento); 
			$temp->setIddepartamento($rs->iddepartamento); 
			$temp->setSubdepartamento($rs->subdepartamento);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
	}
	
	//mostra os registros
	public function Registros($order,$id) {
		$sql = "SELECT * FROM subdepartamentos WHERE iddepartamento = ? $order";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->bindValue(1,$id);	
		
		$stmt->execute();
		$searchResults = array();
		
		$registros = $stmt->rowCount(PDO::FETCH_OBJ);
		
		return $registros;
	}
}
?>
