<?
/**
 * Classe DAO para Banners
 * 
 * Cria��o 
 * 29/11/2008 - Fernando Colnaghi
 * 
 * Altera��es
 *
 */
class BannerDAO extends PDOConnectionFactory {
	//ir� receber a conex�o
	public $conexao = null;
	
	//construtor
	public function BannerDAO() {
		$this->conexao = PDOConnectionFactory::getConnection();
	}
		//realiza uma inser��o
	public function Insere( $banner ) {
		$sql = "INSERT INTO banners (lado, iddepartamento, numero, banner, width, height, url, target, data) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $this->conexao->prepare($sql);

		$stmt->bindValue(1, $banner->getLado());
		$stmt->bindValue(2, $banner->getIddepartamento());				
		$stmt->bindValue(3, $banner->getNumero());				
		$stmt->bindValue(4, $banner->getBanner());				
		$stmt->bindValue(5, $banner->getWidth());				
		$stmt->bindValue(6, $banner->getHeight());				
		$stmt->bindValue(7, $banner->getUrl());				
		$stmt->bindValue(8, $banner->getTarget());				
		$stmt->bindValue(9, $banner->getData());				
		
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
	public function Update( $banner, $condicao ) {
		// preparo a query de update - Prepare Statement
		$stmt = $this->conexao->prepare("UPDATE banners SET lado=?, iddepartamento=?, numero=?, banner=?, width=?, height=?, url=?, target=?, data=? WHERE idbanner=?");
		$this->conexao->beginTransaction();
		
		$stmt->bindValue(1, $banner->getLado());
		$stmt->bindValue(2, $banner->getIddepartamento());
		$stmt->bindValue(3, $banner->getNumero());
		$stmt->bindValue(4, $banner->getBanner());
		$stmt->bindValue(5, $banner->getWidth());
		$stmt->bindValue(6, $banner->getHeight());
		$stmt->bindValue(7, $banner->getUrl());
		$stmt->bindValue(8, $banner->getTarget());
		$stmt->bindValue(9, $banner->getData());
						
		$stmt->bindValue(10, $condicao);
		
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
		
		$this->conexao->commit();
		
		//fecho a conex�o
		$this->conexao = null;
				
	}
	
	//remove um banner
	public function Deleta( $id ) {
		$sql = "DELETE FROM banners WHERE idbanner = ?";
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
	
	/**
	 * Retorna um banner, apartir de seu ID
	 *
	 * @param Id $id
	 * @return Banner Object
	 */
	public function getBannerPorId($id) {
		$sql = "SELECT * FROM banners WHERE idbanner = ".$id;
		$stmt = $this->conexao->prepare($sql);
		//$stmt->bindValues(1,$id);
		$stmt->execute();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		
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
		$temp->setExtensao($rs->banner);
	
		return $temp;
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
			$temp->setExtensao($rs->banner);
			
			array_push($searchResults, $temp);
		} 
		
		if(count($searchResults) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
	}
	
	public function ListaBannerPorDepartamentoPosicaoAdmin($id, $posicao) {
		$sql = "SELECT * FROM banners WHERE iddepartamento = ? and lado = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		$stmt->bindValue(2,$posicao);		
		
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
			$temp->setExtensao($rs->banner);
			
			array_push($searchResults, $temp);
		} 
		return $searchResults;
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
			$temp->setExtensao($rs->banner);
			
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
			$temp->setExtensao($rs->banner);
			
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