<?php
/**
 * Classe DAO Links Úteis
 *
 */
class UteisDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function UteisDAO() {
		$this->conexao = PDOConnectionFactory::getConnection();
	}
		
	/**
	 * Lista links úteis
	 *
	 * @return array
	 */
	public function ListaUteis() {
		try {
			$sql = "SELECT * FROM uteis";
			$stmt = $this->conexao->prepare($sql);
			$stmt->execute();
			
			$searchResults = array();
			
			while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
				$temp = new Uteis();
				$temp->setIduteis($rs->iduteis);
				$temp->setImagem($rs->imagem);
				$temp->setTexto($rs->texto);
				$temp->setLink($rs->link);
				$temp->setOpcao($rs->opcao);
				
				array_push($searchResults, $temp);
			}
			
			return $searchResults;
			
		} catch (PDOException $e) {
			echo $e->getTraceAsString();
			
			$trace = $e->getTrace();
			echo "OCORREU UM ERRO na classe: '".$trace[1]['class']."'<br>";
			echo "OCORREU UM ERRO na funcao: '".$trace[1]['function']."'<br>";
			echo "OCORREU UM ERRO na linha: '".$e->getLine()."'<br>";
			echo "OCORREU UM ERRO do arquivo: '".$e->getFile()."'<br>";
		}
	}
	
	function getUteisPorId($id) {
		try {
				//é esse o nome da tabela ?
			$sql = "SELECT * FROM uteis WHERE iduteis =?";
			$stmt = $this->conexao->prepare($sql);
			$stmt->bindValue(1,$id);
			
			$stmt->execute();
			
			while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
				$temp = new Uteis();
				$temp->setIduteis($rs->iduteis);
				$temp->setImagem($rs->imagem);
				$temp->setTexto($rs->texto);
				$temp->setLink($rs->link);
				$temp->setOpcao($rs->opcao);
			}							
			return $temp;
		} catch (PDOException $e) {
			echo $e->getTraceAsString();
			
			$trace = $e->getTrace();
			echo "OCORREU UM ERRO na classe: '".$trace[1]['class']."'<br>";
			echo "OCORREU UM ERRO na funcao: '".$trace[1]['function']."'<br>";
			echo "OCORREU UM ERRO na linha: '".$e->getLine()."'<br>";
			echo "OCORREU UM ERRO do arquivo: '".$e->getFile()."'<br>";
		}
	}
	
	public function InsereUteis( $uteis ){
		try{
			$sql = "INSERT INTO uteis (imagem,texto,link,opcao) VALUES (?,?,?,?)";
			$stmt = $this->conexao->prepare($sql);
			
			// sequencia de índices que representa cada valor de minha query
			$stmt->bindValue(1, $uteis->getImagem()); 
			$stmt->bindValue(2, $uteis->getTexto()); 
			$stmt->bindValue(3, $uteis->getLink()); 
			$stmt->bindValue(4, $uteis->getOpcao()); 
						
			// executo a query preparada
			$stmt->execute();
		} catch (PDOException $e) {
			echo $e->getTraceAsString();
			
			$trace = $e->getTrace();
			echo "OCORREU UM ERRO na classe: '".$trace[1]['class']."'<br>";
			echo "OCORREU UM ERRO na funcao: '".$trace[1]['function']."'<br>";
			echo "OCORREU UM ERRO na linha: '".$e->getLine()."'<br>";
			echo "OCORREU UM ERRO do arquivo: '".$e->getFile()."'<br>";
		}
	}
	
	public function UpdateUteis( $uteis ){
		try{
			$sql = "UPDATE uteis SET imagem = ?,texto = ?,link = ?,opcao = ? WHERE iduteis = ?";
			$stmt = $this->conexao->prepare($sql);
			
			// sequencia de índices que representa cada valor de minha query
			$stmt->bindValue(1, $uteis->getImagem()); 
			$stmt->bindValue(2, $uteis->getTexto()); 
			$stmt->bindValue(3, $uteis->getLink()); 
			$stmt->bindValue(4, $uteis->getOpcao()); 
			$stmt->bindValue(5, $uteis->getIduteis()); 
						
			// executo a query preparada
			$stmt->execute();
		} catch (PDOException $e) {
			echo $e->getTraceAsString();
			
			$trace = $e->getTrace();
			echo "OCORREU UM ERRO na classe: '".$trace[1]['class']."'<br>";
			echo "OCORREU UM ERRO na funcao: '".$trace[1]['function']."'<br>";
			echo "OCORREU UM ERRO na linha: '".$e->getLine()."'<br>";
			echo "OCORREU UM ERRO do arquivo: '".$e->getFile()."'<br>";
		}
	}
	
	
	//mostra os registros
	public function Paginacao($inicio,$fim) {
		try {
			$sql = "SELECT * FROM uteis LIMIT $inicio,$fim";
			$stmt = $this->conexao->prepare($sql);	
			
			$stmt->execute();
			$searchResults = array();
			
			while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
				$temp = new Uteis();
				$temp->setIduteis($rs->iduteis);
				$temp->setImagem($rs->imagem);
				$temp->setTexto($rs->texto);
				$temp->setLink($rs->link);
				$temp->setOpcao($rs->opcao);
				
				array_push($searchResults, $temp);
			} 
			
			return $searchResults;
		
		} catch (PDOException $e) {
			echo $e->getTraceAsString();
			
			$trace = $e->getTrace();
			echo "OCORREU UM ERRO na classe: '".$trace[1]['class']."'<br>";
			echo "OCORREU UM ERRO na funcao: '".$trace[1]['function']."'<br>";
			echo "OCORREU UM ERRO na linha: '".$e->getLine()."'<br>";
			echo "OCORREU UM ERRO do arquivo: '".$e->getFile()."'<br>";
		}
	}
	
	//remove um link
	public function Deleta( $id ) {
		try {
			$sql = "DELETE FROM uteis WHERE iduteis = ?";
			$stmt = $this->conexao->prepare($sql);
			$stmt->bindValue(1,$id);
			
			$stmt->execute();
			
		} catch (PDOException $e) {
			echo $e->getTraceAsString();
			
			$trace = $e->getTrace();
			echo "OCORREU UM ERRO na classe: '".$trace[1]['class']."'<br>";
			echo "OCORREU UM ERRO na funcao: '".$trace[1]['function']."'<br>";
			echo "OCORREU UM ERRO na linha: '".$e->getLine()."'<br>";
			echo "OCORREU UM ERRO do arquivo: '".$e->getFile()."'<br>";
		}		
	}
	
	//mostra os registros
	public function Registros($order) {
		try {
			$sql = "SELECT * FROM uteis $order";
			$stmt = $this->conexao->prepare($sql);	
			
			$stmt->execute();
			$searchResults = array();
			
			$registros = $stmt->rowCount(PDO::FETCH_OBJ);
			
			return $registros;
		
		} catch (PDOException $e) {
			echo $e->getTraceAsString();
			
			$trace = $e->getTrace();
			echo "OCORREU UM ERRO na classe: '".$trace[1]['class']."'<br>";
			echo "OCORREU UM ERRO na funcao: '".$trace[1]['function']."'<br>";
			echo "OCORREU UM ERRO na linha: '".$e->getLine()."'<br>";
			echo "OCORREU UM ERRO do arquivo: '".$e->getFile()."'<br>";
		}
	}
}
?>
