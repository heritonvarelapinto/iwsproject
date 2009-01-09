<?php
class EnqueteDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function EnqueteDAO(){
		$this->conexao = PDOConnectionFactory::getConnection();
	}
	
	public function InserePergunta( $enquete ){
		$sql = "INSERT INTO perguntas (pergunta,status) VALUES (?,?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de índices que representa cada valor de minha query
		$stmt->bindValue(1, $enquete->getPergunta()); 
		$stmt->bindValue(2, $enquete->getStatus()); 
					
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
	
	public function InsereResposta( $enquete ){
		$sql = "INSERT INTO respostas (idpergunta,resposta) VALUES (?,?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de índices que representa cada valor de minha query
		$stmt->bindValue(1, $enquete->getIdpergunta()); 
		$stmt->bindValue(2, $enquete->getResposta()); 
					
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
		$sql = "SELECT max(idpergunta) as idpergunta FROM perguntas";
		$stmt = $this->conexao->prepare($sql);
		
		// executo a query preparada
		$stmt->execute();
		
		$id = $stmt->fetch(PDO::FETCH_OBJ);
		return $id;
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
	function listaStatus() {
		$sql = "SELECT * FROM perguntas WHERE status = '1'";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->execute();
		
		$searchResults = array();
		
		$regs = $stmt->rowCount(PDO::FETCH_OBJ);
			
		return $regs;
	}
	
	function enqueteAtiva() {
		$sql = "SELECT perguntas.idpergunta,pergunta,idresposta, resposta, voto FROM perguntas INNER JOIN respostas ON perguntas.idpergunta = respostas.idpergunta WHERE STATUS =1";
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
	
	function getPergunta() {
		//é esse o nome da tabela ?
		$sql = "SELECT perguntas.idpergunta,pergunta,idresposta,resposta,voto FROM perguntas LEFT JOIN respostas ON perguntas.idpergunta = respostas.idpergunta WHERE perguntas.status = '1'";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Enquete();

			$temp->setIdpergunta($rs->idpergunta);
			$temp->setPergunta($rs->pergunta);
			$temp->setIdresposta($rs->idresposta);
			$temp->setResposta($rs->resposta);
			$temp->setVoto($rs->voto);
						
			array_push($searchResults, $temp);
		} 
		return $searchResults;
	}
	
	function getPerguntaPorID($id) {
		//é esse o nome da tabela ?
		$sql = "SELECT perguntas.idpergunta,pergunta,idresposta,resposta,voto FROM perguntas LEFT JOIN respostas ON perguntas.idpergunta = respostas.idpergunta WHERE perguntas.idpergunta =?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Enquete();

			$temp->setIdpergunta($rs->idpergunta);
			$temp->setPergunta($rs->pergunta);
			$temp->setIdresposta($rs->idresposta);
			$temp->setResposta($rs->resposta);
			$temp->setVoto($rs->voto);
						
			array_push($searchResults, $temp);
		} 
		return $searchResults;
	}
	
	function getStatusPorID($id) {
		//é esse o nome da tabela ?
		$sql = "SELECT * FROM perguntas WHERE idpergunta =?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		
		$stmt->execute();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		$temp = new Enquete();

		$temp->setStatus($rs->status);; 
			
		return $temp;
	}

	//realiza um Update
	public function UpdateStatus( $enquete, $condicao ) {
		$sql = "UPDATE perguntas SET status=? WHERE idpergunta=?";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->bindValue(1, $enquete->getStatus());
		$stmt->bindValue(2, $condicao);
		
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
	public function DeletaPerguntas( $id ) {
		$sql = "DELETE FROM perguntas WHERE idpergunta =?";
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
	
	//remove um registro
	public function DeletaRespostas( $id ) {
		$sql = "DELETE FROM respostas WHERE idpergunta =?";
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