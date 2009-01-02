<?
/**
 * Classe DAO para Anuncios
 * 
 * Criaчуo 
 * 29/11/2008 - Fernando Colnaghi
 * 
 * Alteraчѕes
 *
 */
class AnuncioDAO extends PDOConnectionFactory {
	//irс receber a conexуo
	public $conexao = null;
	
	//construtor
	public function AnuncioDAO() {
		$this->conexao = PDOConnectionFactory::getConnection();
	}
		//realiza uma inserчуo
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
		
		//fecho a conexуo
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
	public function getAnuncioPorId($id) {
		$sql = "SELECT * FROM anuncios WHERE idanuncio = ".$id;
		$stmt = $this->conexao->prepare($sql);
		//$stmt->bindValues(1,$id);
		$stmt->execute();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		
		$temp = new Anuncio();
		$temp->setIdanuncio($rs->idanuncio);
	    $temp->setIddepartamento($rs->iddepartamento);
	    $temp->setIdsubdepartamento($rs->idsubdepartamento);
	    $temp->setNome($rs->nome);
	    $temp->setEndereco($rs->endereco);
	    $temp->setNumero($rs->numero);
	    $temp->setComplemento($rs->complemento);
	    $temp->setCidade($rs->cidade);
	    $temp->setEstado($rs->estado);
	    $temp->setCep($rs->cep);
	    $temp->setTelefones($rs->telefones);
	    $temp->setSite($rs->site);
	    $temp->setEmail($rs->email);
	    $temp->setLogo($rs->logo);
	    $temp->setTexto($rs->texto);
	    $temp->setDe($rs->de);
	    $temp->setAte($rs->ate);
    	$temp->setStatus($rs->status);
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
	
	public function ListaAnunciosPorDepartamento($id) {
		$sql = "SELECT * FROM anuncios WHERE iddepartamento = ".$id." and status = '1'";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Anuncio();
			$temp->setIdanuncio($rs->idanuncio);
		    $temp->setIddepartamento($rs->iddepartamento);
		    $temp->setIdsubdepartamento($rs->idsubdepartamento);
		    $temp->setNome($rs->nome);
		    $temp->setEndereco($rs->endereco);
		    $temp->setNumero($rs->numero);
		    $temp->setComplemento($rs->complemento);
		    $temp->setCidade($rs->cidade);
		    $temp->setEstado($rs->estado);
		    $temp->setCep($rs->cep);
		    $temp->setTelefones($rs->telefones);
		    $temp->setSite($rs->site);
		    $temp->setEmail($rs->email);
		    $temp->setLogo($rs->logo);
		    $temp->setTexto($rs->texto);
		    $temp->setDe($rs->de);
		    $temp->setAte($rs->ate);
	    	$temp->setStatus($rs->status);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
		
	}
	
	public function ListaAnunciosPorSubDepartamento($id) {
		$sql = "SELECT * FROM anuncios WHERE idsubdepartamento = ".$id." and status = '1'";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Anuncio();
			$temp->setIdanuncio($rs->idanuncio);
		    $temp->setIddepartamento($rs->iddepartamento);
		    $temp->setIdsubdepartamento($rs->idsubdepartamento);
		    $temp->setNome($rs->nome);
		    $temp->setEndereco($rs->endereco);
		    $temp->setNumero($rs->numero);
		    $temp->setComplemento($rs->complemento);
		    $temp->setBairro($rs->bairro);
		    $temp->setCidade($rs->cidade);
		    $temp->setEstado($rs->estado);
		    $temp->setCep($rs->cep);
		    $temp->setTelefones($rs->telefones);
		    $temp->setSite($rs->site);
		    $temp->setEmail($rs->email);
		    $temp->setLogo($rs->logo);
		    $temp->setTexto($rs->texto);
		    $temp->setDe($rs->de);
		    $temp->setAte($rs->ate);
	    	$temp->setStatus($rs->status);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
		
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