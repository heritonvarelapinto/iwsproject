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
	
	function checkErrors($err,$errno) {

        //global $systemLog;
        // Only thing that we need todo is define some variables
        // And ask from RDBMS, if there was some sort of errors.

        if($errno) {
                // SQL Error occurred. This is FATAL error. Error message and 
                // SQL command will be logged and aplication will teminate immediately.
                $message = "The following SQL command ".$sql." caused Database error: ".$err.".";

                //$message = addslashes("SQL-command: ".$sql." error-message: ".$message);
                //$systemLog->writeSystemSqlError ("SQL Error occurred", $errno, $message);

                print "Unrecowerable error has occurred. All data will be logged.";
                print "Please contact System Administrator for help! \n";
                print "<!-- ".$message." -->\n";
                exit;

        } else {
                // Since there was no error, we can safely return to main program.
                return;
        }
	}
}
?>