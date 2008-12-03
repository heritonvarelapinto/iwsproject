<?php
class MenuAdminDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function MenuAdminDAO(){
		$this->conexao = PDOConnectionFactory::getConnection();
	}
	
	function listaMenus() {
		$sql = "SELECT menu.idmenu, menu.titulo, idtitulo, titulolink, acao FROM menu LEFT JOIN tituloslinks ON menu.idmenu = tituloslinks.idMenu";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new TituloLinks();

			$temp->setIdmenu($rs->idmenu);
			$temp->setTitulo($rs->titulo);
			
			$temp->setIdtitulo($rs->idtitulo);
			$temp->setTituloLink($rs->titulolink);
			$temp->setAcao($rs->acao);
			
			array_push($searchResults, $temp);
		} 
		return $searchResults;
	}	
		
	function getMenuPorID($id) {
		//é esse o nome da tabela ?
		$sql = "SELECT menu.idmenu, menu.titulo, idtitulo, titulolink, acao FROM menu LEFT JOIN tituloslinks ON menu.idmenu = tituloslinks.idMenu WHERE menu.idmenu = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new TituloLinks();

			$temp->setIdmenu($rs->idmenu);
			$temp->setTitulo($rs->titulo);
			
			$temp->setIdtitulo($rs->idtitulo);
			$temp->setTituloLink($rs->titulolink);
			$temp->setAcao($rs->acao);
			
			array_push($searchResults, $temp);
		} 
		
		if(count($searchResults) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
	}
	
	function getMenuPorTitulo($titulo) {
		//é esse o nome da tabela ?
		$sql = "SELECT menu.idmenu, menu.titulo, idtitulo, titulolink, acao FROM menu LEFT JOIN tituloslinks ON menu.idmenu = tituloslinks.idMenu WHERE menu.titulo = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$titulo);
		
		$stmt->execute();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		
		$temp = new TituloLinks();

		$temp->setIdmenu($rs->idmenu);
		$temp->setTitulo($rs->titulo);
		
		$temp->setIdtitulo($rs->idtitulo);
		$temp->setTituloLink($rs->titulolink);
		$temp->setAcao($rs->acao);
			
		return $temp;
	}
	
	public function InsereTituloLink( $tituloLink ){
		$sql = "INSERT INTO tituloslinks (idMenu,titulolink,acao) VALUES (?,?,?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de índices que representa cada valor de minha query
		$stmt->bindValue(1, $tituloLink->getIdmenu()); 
		$stmt->bindValue(2, $tituloLink->getTituloLink()); 
		$stmt->bindValue(3, $tituloLink->getAcao()); 
					
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
	
	public function UpdateLinkTituloRodape( $tituloLink, $condicao ) {
		$sql = "UPDATE tituloslinks SET titulolink=? WHERE idMenu='6' AND acao =?";
		$stmt = $this->conexao->prepare($sql);
		
		$stmt->bindValue(1, $tituloLink->getTituloLink()); 
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
	public function DeletaLinksRodape( $id ) {
		$sql = "DELETE FROM tituloslinks WHERE idMenu = 6 AND acao = ?";
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
}
?>