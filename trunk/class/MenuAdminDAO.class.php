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
		$sql = "SELECT * FROM menu where titulo = ?";
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
	
}
?>