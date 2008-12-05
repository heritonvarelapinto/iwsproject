<?php
class InformativoDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function InformativoDAO(){
		$this->conexao = PDOConnectionFactory::getConnection();
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
}
?>