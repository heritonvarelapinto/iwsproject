<?php
class ClienteDAO extends PDOConnectionFactory {

	public $conexao = null;
	
	// constructor
	public function ClienteDAO(){
		$this->conexao = PDOConnectionFactory::getConnectionConstrutor();
	}

	public function ListaClientes($sql=null) {
		if($sql == null) {
			$sql = "SELECT * FROM cliente";
			$stmt = $this->conexao->prepare($sql);
		}else{
			$stmt = $this->conexao->prepare($sql);
		}
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Cliente();

			$temp->setIdCliente($rs->idcliente); 
			$temp->setNome($rs->nome); 
			$temp->setVersao($rs->versao); 
			$temp->setLogo($rs->logo); 
			$temp->setEmail($rs->email); 
			
			array_push($searchResults, $temp);
		} 
		
		return $searchResults;
		
	}
	
	function getUsuarioPorID($id) {
		//é esse o nome da tabela ?
		$sql = "SELECT * FROM cliente where idcliente = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Cliente();

			$temp->setIdCliente($rs->idcliente); 
			$temp->setNome($rs->nome); 
			$temp->setVersao($rs->versao); 
			$temp->setLogo($rs->logo);
			$temp->setEmail($rs->email); 
			
			array_push($searchResults, $temp);
		} 
		
		if(count($searchResults) > 1) {
			return $searchResults;
		} else {
			return $temp;
		}
	}
	
	function getUsuarioPorNome($nome) {
		//é esse o nome da tabela ?
		$sql = "SELECT * FROM cliente where nome = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$nome);
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Cliente();

			$temp->setIdCliente($rs->idcliente); 
			$temp->setNome($rs->nome); 
			$temp->setVersao($rs->versao); 
			$temp->setLogo($rs->logo);
			$temp->setEmail($rs->email); 
			
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