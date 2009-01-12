<?php
class InformativoDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function InformativoDAO(){
		$this->conexao = PDOConnectionFactory::getConnection();
	}
	
	public function Insere( $informativo ){
		$sql = "INSERT INTO informativo (nome,email,status) VALUES (?,?,?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de índices que representa cada valor de minha query
		$stmt->bindValue(1, $informativo->getNome()); 
		$stmt->bindValue(2, $informativo->getEmail()); 		
		$stmt->bindValue(3, $informativo->getStatus()); 		
					
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

	public function CriaModelo( $informativo ){
		$sql = "INSERT INTO infomodelo (assunto,texto) VALUES (?,?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de índices que representa cada valor de minha query
		$stmt->bindValue(1, $informativo->getAssunto()); 
		$stmt->bindValue(2, $informativo->getTexto()); 		
					
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
		
	//mostra os registros
	public function Paginacao($order,$inicio,$fim) {
		$sql = "SELECT * FROM informativo $order LIMIT $inicio,$fim";
		$stmt = $this->conexao->prepare($sql);	
		
		$stmt->execute();
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Informativo();

			$temp->setIdinformativo($rs->idinformativo);
			$temp->setNome($rs->nome);
			$temp->setEmail($rs->email);
			$temp->setStatus($rs->status);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
	}
	
	//mostra os registros
	public function Registros($order) {
		$sql = "SELECT * FROM informativo $order";
		$stmt = $this->conexao->prepare($sql);	
		
		$stmt->execute();
		$searchResults = array();
		
		$registros = $stmt->rowCount(PDO::FETCH_OBJ);
		
		return $registros;
	}
	
	public function verificaEmail($email) {
		$sql = "SELECT * FROM informativo WHERE email like '%%".$email."%%'";
		$stmt = $this->conexao->prepare($sql);	
		
		$stmt->execute();
		$searchResults = array();
		
		$registros = $stmt->rowCount(PDO::FETCH_OBJ);
		
		return $registros;
	}
}
?>