<?php

/*
 * Classe DAO para a tabela agenda.
 * Data Access Object que irá fazer operações na tabela Agenda (básica: Insert, Update, Delete e Lista)
 */

class DepartamentoDAO extends PDOConnectionFactory {
	//irá receber a conexão
	public $conex = null;
	
	//construtor
	public function DepartamentoDAO() {
		$this->conexao = PDOConnectionFactory::getConnection();
	}
	
	public function InsereDepartamento( $departamento ){
		$sql = "INSERT INTO departamentos (departamento) VALUES (?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de índices que representa cada valor de minha query
		$stmt->bindValue(1, $departamento->getDepartamento()); 
					
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
	public function Update( $departamento, $condicao ) {
		try {
				// preparo a query de update - Prepare Statement
				$stmt = $this->conexao->prepare("UPDATE departamentos SET departamento=? WHERE iddepartamento=?");
				$this->conexao->beginTransaction();
				
				$stmt->bindValue(1, $departamento->getDepartamento());				
				$stmt->bindValue(2, $condicao);
				
				// executo a query preparada
				$stmt->execute();
				
				$this->conexao->commit();
				
				//fecho a conexão
				$this->conexao = null;
				
		//caso ocorra um erro, retorna o erro
		}catch ( PDOException $ex ) { echo "Erro:".$ex->getMessage(); }
	}
	
	//remove um registro
	public function Deleta( $iddepartamento ) {
		try {
				// executo a query
				$num = $this->conexao->exec("DELETE FROM departamentos WHERE iddepartamento=$iddepartamento");
				// caso seja execuado ele retorna o número de rows que foram afetadas.
				if($num >= 1) { return $num; } else { return 0; }
				
				
		//caso ocorra um erro, retorna o erro
		}catch ( PDOException $ex ) { echo "Erro:".$ex->getMessage(); }
	}
	
	public function getDepartamentosPorId($id) {
		$sql = "SELECT * FROM departamentos WHERE iddepartamento = ".$id;
		$stmt = $this->conexao->prepare($sql);
		//$stmt->bindValues(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Departamento();
			$temp->setIdDepartamento($rs->iddepartamento);
			$temp->setDepartamento($rs->departamento);
			
			array_push($searchResults, $temp);
		} 
		
		if(count($rs) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
	}

	function Pag() {
		$sql = "SELECT * FROM departamentos LIMIT 0,10";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->execute();
		
		
		$registros = $stmt->rowCount(PDO::FETCH_OBJ);
		$temp = new Paginacao();
		
		$temp->setRegistrosPorPagina($registros);
			
		return $temp;
	}
	
	//mostra os registros
	public function Lista() {
		$sql = "SELECT * FROM departamentos";
		$stmt = $this->conexao->prepare($sql);	
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Departamento();
			$temp->setIdDepartamento($rs->iddepartamento);
			$temp->setDepartamento($rs->departamento);
			
			array_push($searchResults, $temp);
		} 
		
		if(count($searchResults) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
	}
	
	/*function pegarPaginas($qtd) {
		//é esse o nome da tabela ?
		$sql = "SELECT * FROM departamentos";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->execute();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		print_r($rs);
		
		//echo $registros;
		
		//$paginas = ceil($registros / $qtd);
		
		//return $searchResults;
	}*/
	
	//mostra os registros
	public function Paginacao($order,$inicio,$fim) {
		$sql = "SELECT * FROM departamentos $order LIMIT $inicio,$fim";
		$stmt = $this->conexao->prepare($sql);	
		
		$stmt->execute();
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Departamento();
			$temp->setIdDepartamento($rs->iddepartamento);
			$temp->setDepartamento($rs->departamento);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
	}
	
	//mostra os registros
	public function Registros($order) {
		$sql = "SELECT * FROM departamentos $order";
		$stmt = $this->conexao->prepare($sql);	
		
		$stmt->execute();
		$searchResults = array();
		
		$registros = $stmt->rowCount(PDO::FETCH_OBJ);
		
		return $registros;
	}
	
}

?>