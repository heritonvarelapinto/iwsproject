<?
class BannerDAO extends PDOConnectionFactory {
	//irб receber a conexгo
	public $conex = null;
	
	//construtor
	public function BannerDAO() {
		$this->conexao = PDOConnectionFactory::getConnection();
	}
		//realiza uma inserзгo
	public function Insere( $departamento ) {
		try {
				// preparo a query de inserзao - Prepare Statement				
				$stmt = $this->conexao->prepare("INSERT INTO departamentos (iddepartamento, departamento) VALUES (?, ?)");
				// valores encapsulados nas variбveis da classe AdmDepartamentos.
				// sequencia de нndices que representa cada valor de minha query
				$stmt->bindValue(1, $departamento->getIdDepartamento());
				$stmt->bindValue(2, $departamento->getDepartamento());				
				
				// executo a query preparada
				$stmt->execute();
				
				//fecho a conexгo
				$this->conexao = null;
				
		//caso ocorra um erro, retorna o erro
		}catch ( PDOException $ex ) { echo "Erro:".$ex->getMessage(); }
	}
	
	//realiza um Update
	public function Update( $departamento, $condicao ) {
		try {
				// preparo a query de update - Prepare Statement
				$stmt = $this->conexao->prepare("UPDATE bairros SET idbanner=? WHERE iddepartamento=?");
				$this->conexao->beginTransaction();
				
				$stmt->bindValue(1, $departamento->getDepartamento());				
				$stmt->bindValue(2, $condicao);
				
				// executo a query preparada
				$stmt->execute();
				
				$this->conexao->commit();
				
				//fecho a conexгo
				$this->conexao = null;
				
		//caso ocorra um erro, retorna o erro
		}catch ( PDOException $ex ) { echo "Erro:".$ex->getMessage(); }
	}
	
	//remove um registro
	public function Deleta( $idbanner ) {
		try {
				// executo a query
				$num = $this->conexao->exec("DELETE FROM banners WHERE idbanner=$idbanner");
				// caso seja execuado ele retorna o nъmero de rows que foram afetadas.
				if($num >= 1) { return $num; } else { return 0; }
				
				
		//caso ocorra um erro, retorna o erro
		}catch ( PDOException $ex ) { echo "Erro:".$ex->getMessage(); }
	}
	
	public function getBannerPorId($id) {
		$sql = "SELECT * FROM banners WHERE idbanner = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValues(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Banner();
			$temp->setIdbanner($rs->idbanner);
			$temp->setIdDepartamento($rs->iddepartamento);
			$temp->setLado($rs->lado);
			$temp->setNumero($rs->numero);
			$temp->setBanner($rs->banner);
			$temp->setDescricao($rs->descricao);
			$temp->setWidth($rs->width);
			$temp->setHeight($rs->height);
			$temp->setUrl($rs->url);
			$temp->setTarget($rs->target);
			$temp->setClick($rs->click);
			$temp->setData($rs->data);
			
			array_push($searchResults, $temp);
		} 
		
		if(count($searchResults) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
	}	
	
	public function ListaBannerPorDepartamentoPosicao($id, $posicao, $qtd) {
		$sql = "SELECT * FROM banners WHERE iddepartamento = ? and lado = ? order by rand() limit ".$qtd;
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		$stmt->bindValue(2,$posicao);
		/*$stmt->bindValue(3,$qtd);*/
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Banner();
			
			$temp->setIdbanner($rs->idbanner);
			$temp->setIdDepartamento($rs->iddepartamento);
			$temp->setLado($rs->lado);
			$temp->setNumero($rs->numero);
			$temp->setBanner($rs->banner);
			$temp->setDescricao($rs->descricao);
			$temp->setWidth($rs->width);
			$temp->setHeight($rs->height);
			$temp->setUrl($rs->url);
			$temp->setTarget($rs->target);
			$temp->setClick($rs->click);
			$temp->setData($rs->data);
			
			array_push($searchResults, $temp);
		} 
		
		if(count($searchResults) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
	}
	
	public function ListaBannerPorDepartamento($id) {
		$sql = "SELECT * FROM banners WHERE iddepartamento = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValues(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Banner();
			
			$temp->setIdbanner($rs->idbanner);
			$temp->setIdDepartamento($rs->iddepartamento);
			$temp->setLado($rs->lado);
			$temp->setNumero($rs->numero);
			$temp->setBanner($rs->banner);
			$temp->setDescricao($rs->descricao);
			$temp->setWidth($rs->width);
			$temp->setHeight($rs->height);
			$temp->setUrl($rs->url);
			$temp->setTarget($rs->target);
			$temp->setClick($rs->click);
			$temp->setData($rs->data);
			
			array_push($searchResults, $temp);
		} 
		
		if(count($searchResults) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
	}
	
	//mostra os registros
	public function Lista() {
		$sql = "SELECT * FROM banners";
		$stmt = $this->conexao->prepare($sql);	
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Banner();
			
			$temp->setIdbanner($rs->idbanner);
			$temp->setIdDepartamento($rs->iddepartamento);
			$temp->setLado($rs->lado);
			$temp->setNumero($rs->numero);
			$temp->setBanner($rs->banner);
			$temp->setDescricao($rs->descricao);
			$temp->setWidth($rs->width);
			$temp->setHeight($rs->height);
			$temp->setUrl($rs->url);
			$temp->setTarget($rs->target);
			$temp->setClick($rs->click);
			$temp->setData($rs->data);
			
			array_push($searchResults, $temp);
		} 
		
		if(count($searchResults) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
	}
}
?>