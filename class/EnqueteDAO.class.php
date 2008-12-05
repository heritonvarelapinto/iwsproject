<?php
class EnqueteDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function EnqueteDAO(){
		$this->conexao = PDOConnectionFactory::getConnection();
	}
	
	/**
	 * Lista perguntas das enquete
	 *
	 * @return array
	 */
	function listaPergunta() {
		$sql = "SELECT * FROM perguntas";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Enquete();

			$temp->setIdpergunta($rs->idpergunta);
			$temp->setPergunta($rs->pergunta);
			$temp->setStatus($rs->status);
			$temp->setIdresposta($rs->idresposta);
			$temp->setResposta($rs->resposta);
			$temp->setVoto($rs->voto);
						
			array_push($searchResults, $temp);
		} 
		return $searchResults;
	}
	
	/**
	 * Lista perguntas das enquete
	 *
	 * @return array
	 */
	function listaEnquete() {
		$sql = "SELECT * FROM perguntas INNER JOIN respostas ON perguntas.idpergunta = respostas.idpergunta";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Enquete();

			$temp->setIdpergunta($rs->idpergunta);
			$temp->setPergunta($rs->pergunta);
			$temp->setStatus($rs->status);
			$temp->setIdresposta($rs->idresposta);
			$temp->setResposta($rs->resposta);
			$temp->setVoto($rs->voto);
						
			array_push($searchResults, $temp);
		} 
		return $searchResults;
	}
	
	
	
	function getVotosPorID($id) {
		//é esse o nome da tabela ?
		$sql = "SELECT sum( voto ) AS voto FROM respostas WHERE idpergunta =?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		
		$stmt->execute();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		$temp = new Enquete();

		$temp->setVoto($rs->voto);; 
			
		return $temp;
	}
	
	//remove um registro
	public function Deleta( $id ) {
		$sql = "DELETE FROM administracao WHERE idadministracao = ?";
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
	
	//mostra os registros
	public function Paginacao($order,$inicio,$fim) {
		$sql = "SELECT * FROM perguntas $order LIMIT $inicio,$fim";
		$stmt = $this->conexao->prepare($sql);	
		
		$stmt->execute();
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Enquete();

			$temp->setIdpergunta($rs->idpergunta);
			$temp->setPergunta($rs->pergunta);
			$temp->setStatus($rs->status);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
	}
	
	//mostra os registros
	public function Registros($order) {
		$sql = "SELECT * FROM perguntas $order";
		$stmt = $this->conexao->prepare($sql);	
		
		$stmt->execute();
		$searchResults = array();
		
		$registros = $stmt->rowCount(PDO::FETCH_OBJ);
		
		return $registros;
	}
}
?>