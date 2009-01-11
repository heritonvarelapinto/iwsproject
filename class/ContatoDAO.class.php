<?php

/*
 * Classe DAO para a tabela agenda.
 * Data Access Object que irá fazer operações na tabela Agenda (básica: Insert, Update, Delete e Lista)
 */

class ContatoDAO extends PDOConnectionFactory {
	//irá receber a conexão
	public $conex = null;
	
	//construtor
	public function ContatoDAO() {
		$this->conexao = PDOConnectionFactory::getConnection();
	}	
	
	//realiza um Update
	public function Update( $contato ) {
		$sql = "UPDATE contato SET email= ?  WHERE idcontato='1'";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->bindValue(1, $contato->getEmail());
		
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

	
	public function getEmail() {
		$sql = "SELECT * FROM contato WHERE idcontato ='1'";
		$stmt = $this->conexao->prepare($sql);
		//$stmt->bindValues(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		$temp = new Contato();
					
		$temp->setEmail($rs->email); 
	
		return $temp;
	}
}

?>