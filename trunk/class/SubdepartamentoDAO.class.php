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
	
	public function InsereSubdepartamento( $subdepartamento ){
		$sql = "INSERT INTO subdepartamentos (iddepartamento,subdepartamento) VALUES (?,?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de índices que representa cada valor de minha query
		$stmt->bindValue(1, $subdepartamento->getIddepartamento()); 
		$stmt->bindValue(2, $subdepartamento->getSubdepartamento()); 
					
		// executo a query preparada
		$stmt->execute();
		
		$error = $stmt->errorInfo();
		
		if($error[0] == 00000) {
			return true;
		} else {
			//Implementar classe de LOG
			echo "ERRO".$error[2];
			return false;
		}
	}
	
	//realiza um Update
	public function UpdateSubdepartamento( $subdepartamento, $condicao ) {
		$sql = "UPDATE subdepartamentos SET iddepartamento=? ,subdepartamento=? WHERE idsubdepartamento=?";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->bindValue(1, $subdepartamento->getIddepartamento()); 
		$stmt->bindValue(2, $subdepartamento->getSubdepartamento()); 
		$stmt->bindValue(3, $condicao);
		
		// executo a query preparada
		$stmt->execute();
		
		$error = $stmt->errorInfo();
		
		if($error[0] == 00000) {
			return true;
		} else {
			//Implementar classe de LOG
			echo "ERRO: ".$error[2];
			return false;
		}
	}
	
	//remove um registro
	public function Deleta( $id ) {
		$sql = "DELETE FROM subdepartamentos WHERE idsubdepartamento = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		
		$stmt->execute();
		
		$error = $stmt->errorInfo();
		
		if($error[0] == 00000) {
			return true;
		} else {
			//Implementar classe de LOG
			echo "ERRO: ".$error[2];
			return false;
		}
	}	
	
	public function getSubdepartamentosPorId($id) {
		$sql = "SELECT * FROM subdepartamentos WHERE idsubdepartamento = ".$id;
		$stmt = $this->conexao->prepare($sql);
		//$stmt->bindValues(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Subdepartamento();
						
			$temp->setIdsubdepartamento($rs->idsubdepartamento); 
			$temp->setIddepartamento($rs->iddepartamento); 
			$temp->setSubdepartamento($rs->subdepartamento);
			
			array_push($searchResults, $temp);
		} 
		
		if(count($rs) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
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
