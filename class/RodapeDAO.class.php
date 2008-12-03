<?php
class RodapeDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function RodapeDAO() {
		$this->conexao = PDOConnectionFactory::getConnection();
	}
		
	/**
	 * Lista links do Rodape
	 *
	 * @return array
	 */
	public function listaRodape() {
		$sql = "SELECT * FROM rodape";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Rodape();

			$temp->setIdrodape($rs->idrodape); 
			$temp->setTitulo($rs->titulo); 
			$temp->setTexto($rs->texto);
			
			array_push($searchResults, $temp);
		} 
		return $searchResults;
	}
	
	/**
	 * Insere um link no rodape
	 *
	 * @param objeto $rodape
	 * @return true
	 */
	public function InsereRodape( $rodape ){
		$sql = "INSERT INTO rodape (titulo,texto) VALUES (?,?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de índices que representa cada valor de minha query
		$stmt->bindValue(1, $rodape->getTitulo()); 
		$stmt->bindValue(2, $rodape->getTexto()); 
					
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
	
	public function getUltimoID(){
		$sql = "SELECT max(idrodape) as idrodape FROM rodape";
		$stmt = $this->conexao->prepare($sql);
		
		// executo a query preparada
		$stmt->execute();
		
		$id = $stmt->fetch(PDO::FETCH_OBJ);
		return $id;
	}	
	
	/**
	 * Altera um link do rodape
	 *
	 * @param Objeto $subdepartamento
	 * @param string $condicao
	 * @return true
	 */
	public function UpdateRodape( $rodape, $id ) {
		$sql = "UPDATE rodape SET titulo=? ,texto=? WHERE idrodape='$id'";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->bindValue(1, $rodape->getTitulo()); 
		$stmt->bindValue(2, $rodape->getTexto()); 
		
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
		$sql = "DELETE FROM rodape WHERE idrodape = ?";
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
	
	public function getRodapePorId($id) {
		$sql = "SELECT * FROM rodape WHERE idrodape ='$id'";
		$stmt = $this->conexao->prepare($sql);
		//$stmt->bindValues(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		$temp = new Rodape();
					
		$temp->setIdrodape($rs->idrodape); 
		$temp->setTitulo($rs->titulo); 
		$temp->setTexto($rs->texto);
	
		return $temp;
	}
}
?>
