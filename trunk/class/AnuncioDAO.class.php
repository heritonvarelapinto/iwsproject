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
	
	public function InsereAnuncio( $anuncio ){
		$sql = "INSERT INTO anuncios (iddepartamento,idsubdepartamento,nome,endereco,numero,complemento,bairro,cidade,estado,cep,telefones,site,email,logo,imagem1,imagem2,imagem3,imagem4,texto,keywords,de,ate,destaque,pesquisa) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de эndices que representa cada valor de minha query
		$stmt->bindValue(1, $anuncio->getIddepartamento()); 
		$stmt->bindValue(2, $anuncio->getIdsubdepartamento()); 
		$stmt->bindValue(3, $anuncio->getNome()); 
		$stmt->bindValue(4, $anuncio->getEndereco()); 
		$stmt->bindValue(5, $anuncio->getNumero()); 
		$stmt->bindValue(6, $anuncio->getComplemento()); 
		$stmt->bindValue(7, $anuncio->getBairro()); 
		$stmt->bindValue(8, $anuncio->getCidade()); 
		$stmt->bindValue(9, $anuncio->getEstado()); 
		$stmt->bindValue(10, $anuncio->getCep()); 
		$stmt->bindValue(11, $anuncio->getTelefones()); 
		$stmt->bindValue(12, $anuncio->getSite()); 
		$stmt->bindValue(13, $anuncio->getEmail()); 
		$stmt->bindValue(14, $anuncio->getLogo()); 
		$stmt->bindValue(15, $anuncio->getImagem1()); 
		$stmt->bindValue(16, $anuncio->getImagem2()); 
		$stmt->bindValue(17, $anuncio->getImagem3()); 
		$stmt->bindValue(18, $anuncio->getImagem4());
		$stmt->bindValue(19, $anuncio->getTexto()); 
		$stmt->bindValue(20, $anuncio->getKeywords()); 
		$stmt->bindValue(21, $anuncio->getDe()); 
		$stmt->bindValue(22, $anuncio->getAte()); 
		$stmt->bindValue(23, $anuncio->getDestaque()); 
		$stmt->bindValue(24, $anuncio->getPesquisa()); 
					
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

	public function AlteraAnuncio( $anuncio ){
		$sql = "UPDATE anuncios SET iddepartamento = ?,idsubdepartamento = ?,nome = ?,endereco = ?,numero = ?,complemento = ?,bairro = ?,cidade = ?,estado = ?,cep = ?,telefones = ?,site = ?,email = ?,logo = ?,imagem1 = ?,imagem2 = ?,imagem3 = ?,imagem4 = ?,texto = ?,keywords = ?,de = ?,ate = ?,destaque = ?,pesquisa = ? WHERE idanuncio = ?";

		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de эndices que representa cada valor de minha query
		$stmt->bindValue(1, $anuncio->getIddepartamento()); 
		$stmt->bindValue(2, $anuncio->getIdsubdepartamento()); 
		$stmt->bindValue(3, $anuncio->getNome()); 
		$stmt->bindValue(4, $anuncio->getEndereco()); 
		$stmt->bindValue(5, $anuncio->getNumero()); 
		$stmt->bindValue(6, $anuncio->getComplemento()); 
		$stmt->bindValue(7, $anuncio->getBairro()); 
		$stmt->bindValue(8, $anuncio->getCidade()); 
		$stmt->bindValue(9, $anuncio->getEstado()); 
		$stmt->bindValue(10, $anuncio->getCep()); 
		$stmt->bindValue(11, $anuncio->getTelefones()); 
		$stmt->bindValue(12, $anuncio->getSite()); 
		$stmt->bindValue(13, $anuncio->getEmail()); 
		$stmt->bindValue(14, $anuncio->getLogo()); 
		$stmt->bindValue(15, $anuncio->getImagem1()); 
		$stmt->bindValue(16, $anuncio->getImagem2()); 
		$stmt->bindValue(17, $anuncio->getImagem3()); 
		$stmt->bindValue(18, $anuncio->getImagem4());
		$stmt->bindValue(19, $anuncio->getTexto()); 
		$stmt->bindValue(20, $anuncio->getKeywords()); 
		$stmt->bindValue(21, $anuncio->getDe()); 
		$stmt->bindValue(22, $anuncio->getAte()); 
		$stmt->bindValue(23, $anuncio->getDestaque()); 
		$stmt->bindValue(24, $anuncio->getPesquisa()); 
		$stmt->bindValue(25, $anuncio->getIdanuncio()); 
		
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

	public function contaAcesso ($id) {
		
		$sql = "UPDATE anuncios SET acessos=acessos+1  where idanuncio=".$id;
		$stmt = $this->conexao->prepare($sql);
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
	
	public function totalAnuncios($id, $tipo = "") {
		if($tipo == "departamento") {
			$sql = "SELECT count(*) as total FROM anuncios WHERE iddepartamento = ".$id;
		} else {
			$sql = "SELECT count(*) as total FROM anuncios WHERE idsubdepartamento = ".$id;
		}
		
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute();
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		
		return $rs->total;
	}
	
	public function total($order) {
		$sql = "SELECT count(*) as total FROM anuncios $order";
		
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute();
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		
		return $rs->total;
	}

	
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
	    $temp->setBairro($rs->bairro);
	    $temp->setCidade($rs->cidade);
	    $temp->setEstado($rs->estado);
	    $temp->setCep($rs->cep);
	    $temp->setTelefones($rs->telefones);
	    $temp->setSite($rs->site);
	    $temp->setEmail($rs->email);
	    $temp->setLogo($rs->logo);
	    $temp->setImagem1($rs->imagem1);
	    $temp->setImagem2($rs->imagem2);
	   	$temp->setImagem3($rs->imagem3);
	   	$temp->setImagem4($rs->imagem4);
	    $temp->setTexto($rs->texto);
	    $temp->setKeywords($rs->keywords);
	    $temp->setDe($rs->de);
	    $temp->setAte($rs->ate);
    	$temp->setDestaque($rs->destaque);
    	$temp->setPesquisa($rs->pesquisa);
		return $temp;
	}	
	
	public function ListaAnunciosDestaqueHome() {
		$sql = "SELECT * FROM anuncios WHERE destaque = '1' order by rand() limit 9";
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
		    $temp->setImagem1($rs->imagem1);
		    $temp->setImagem2($rs->imagem2);
		   	$temp->setImagem3($rs->imagem3);
		   	$temp->setImagem4($rs->imagem4);
		    $temp->setTexto($rs->texto);
		    $temp->setKeywords($rs->keywords);
		    $temp->setDe($rs->de);
		    $temp->setAte($rs->ate);
	    	$temp->setDestaque($rs->destaque);
	    	$temp->setPesquisa($rs->pesquisa);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
		
	}
	
	public function ListaAnunciosPorDepartamento($id) {
		$sql = "SELECT * FROM anuncios WHERE iddepartamento = ".$id;
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
		    $temp->setImagem1($rs->imagem1);
	    	$temp->setImagem2($rs->imagem2);
	   		$temp->setImagem3($rs->imagem3);
	   		$temp->setImagem4($rs->imagem4);
		    $temp->setTexto($rs->texto);
		    $temp->setKeywords($rs->keywords);
		    $temp->setDe($rs->de);
		    $temp->setAte($rs->ate);
	    	$temp->setDestaque($rs->destaque);
	    	$temp->setPesquisa($rs->pesquisa);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
		
	}
	
	public function getLastID(){
		$sql = "SELECT MAX(idanuncio) as idanuncio FROM anuncios";
		$stmt = $this->conexao->prepare($sql);
		
		// executo a query preparada
		$stmt->execute();
		
		$id = $stmt->fetch(PDO::FETCH_OBJ);
		return $id;
	}
	
	public function ListaAnunciosPorSubDepartamento($id) {
		$sql = "SELECT * FROM anuncios WHERE idsubdepartamento = ".$id;
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
		    $temp->setImagem1($rs->imagem1);
		    $temp->setImagem2($rs->imagem2);
		   	$temp->setImagem3($rs->imagem3);
		   	$temp->setImagem4($rs->imagem4);
		    $temp->setTexto($rs->texto);
		    $temp->setKeywords($rs->keywords);
		    $temp->setDe($rs->de);
		    $temp->setAte($rs->ate);
	    	$temp->setDestaque($rs->destaque);
	    	$temp->setPesquisa($rs->pesquisa);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
		
	}
	
	//remove um anuncio
	public function Deleta( $id ) {
		$sql = "DELETE FROM anuncios WHERE idanuncio = ?";
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
		$sql = "SELECT * FROM anuncios $order LIMIT $inicio,$fim";
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
		    $temp->setImagem1($rs->imagem1);
		    $temp->setImagem2($rs->imagem2);
		   	$temp->setImagem3($rs->imagem3);
		   	$temp->setImagem4($rs->imagem4);
		    $temp->setTexto($rs->texto);
		    $temp->setKeywords($rs->keywords);
		    $temp->setDe($rs->de);
		    $temp->setAte($rs->ate);
	    	$temp->setDestaque($rs->destaque);
	    	$temp->setPesquisa($rs->pesquisa);
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
	}
	
	//mostra os registros
	public function Registros($order) {
		$sql = "SELECT * FROM anuncios $order";
		$stmt = $this->conexao->prepare($sql);	
		
		$stmt->execute();
		$searchResults = array();
		
		$registros = $stmt->rowCount(PDO::FETCH_OBJ);
		
		return $registros;
	}
	
}
?>