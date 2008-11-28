<?php
class AdministracaoDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function AdministracaoDAO(){
		$this->conexao = PDOConnectionFactory::getConnection();
	}
	
	public function InsereUsuarios( $administracao ){
			$sql = "INSERT INTO administracao (nome) VALUES (?)";
			$stmt = $this->conexao->prepare($sql);
			
			// sequencia de índices que representa cada valor de minha query
			$stmt->bindValue(1, $administracao->getNome()); 
			$stmt->bindValue(2, $administracao->getEmail); 
			$stmt->bindValue(3, $administracao->getDdd()); 
			$stmt->bindValue(4, $administracao->getTelefone()); 
			$stmt->bindValue(5, $administracao->getUsuario()); 
			$stmt->bindValue(6, $administracao->getSenha()); 
			$stmt->bindValue(7, $administracao->getStatus()); 
						
			// executo a query preparada
			$stmt->execute();
			
			$error = $stmt->errorInfo();
			
			if($error[0] == 00000) {
				echo "Salvou".$administracao->getNome();
				return true;
			} else {
				//Implementar classe de LOG
				echo "ERRO".$error[2];
				return false;
			}
	}
	
	
	function listaUsuarios($sql=null) {
		if($sql == null) {
			$sql = "SELECT * FROM administracao";
			$stmt = $this->conexao->prepare($sql);
		}else{
			$stmt = $this->conexao->prepare($sql);
		}
		
		$stmt->execute();
		
		$searchResults = array();
		
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$temp = new Administracao();

			$temp->setIdadministracao($rs->idadministracao); 
			$temp->setIdcliente($rs->idcliente); 
			$temp->setNome($rs->nome);
			$temp->setEmail($rs->email);
			$temp->setDdd($rs->ddd);
			$temp->setTelefone($rs->telefone);
			$temp->setUsuario($rs->usuario);
			$temp->setSenha($rs->senha);
			$temp->setStatus($rs->status);
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