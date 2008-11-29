<?php
class AdministracaoDAO extends PDOConnectionFactory {
	
	public $conexao = null;
	
	// constructor
	public function AdministracaoDAO(){
		$this->conexao = PDOConnectionFactory::getConnection();
	}
	
	public function InsereUsuarios( $administracao ){
		$sql = "INSERT INTO administracao (idcliente,nome,email,ddd,telefone,usuario,senha,status) VALUES (?,?,?,?,?,?,?,?)";
		$stmt = $this->conexao->prepare($sql);
		
		// sequencia de índices que representa cada valor de minha query
		$stmt->bindValue(1, $administracao->getIdcliente()); 
		$stmt->bindValue(2, $administracao->getNome()); 
		$stmt->bindValue(3, $administracao->getEmail()); 
		$stmt->bindValue(4, $administracao->getDdd()); 
		$stmt->bindValue(5, $administracao->getTelefone()); 
		$stmt->bindValue(6, $administracao->getUsuario()); 
		$stmt->bindValue(7, $administracao->getSenha()); 
		$stmt->bindValue(8, $administracao->getStatus()); 
					
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
	
	function getUsuarioPorID($id) {
		//é esse o nome da tabela ?
		$sql = "SELECT * FROM administracao WHERE idadministracao = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$id);
		
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
	
	function getUsuarioPorUsuario($usuario) {
		//é esse o nome da tabela ?
		$sql = "SELECT * FROM administracao WHERE usuario = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$usuario);
		
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
	
	function autenticaUsuario($usuario,$senha) {
		//é esse o nome da tabela ?
		$sql = "SELECT * FROM administracao WHERE usuario = ? AND senha = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->bindValue(1,$usuario);
		$stmt->bindValue(2,$senha);
		
		$stmt->execute();
		
		$rs = $stmt->fetch(PDO::FETCH_OBJ);
		
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
		 
		return $temp;
	}
	
	/**
	 * Lista usuarios Administrativo
	 *
	 * @return array
	 */
	function listaUsuarios() {
		$sql = "SELECT * FROM administracao";
		$stmt = $this->conexao->prepare($sql);
		
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
		return $searchResults;
	}
	
	//realiza um Update
	public function Update( $administracao, $condicao ) {
		// preparo a query de update - Prepare Statement
		$stmt = $this->conexao->prepare("UPDATE administracao SET nome=?, email=?, ddd=?, telefone=?, usuario=?, senha=?, status=? WHERE idadministracao=?");
		$this->conexao->beginTransaction();
		
		$stmt->bindValue(1, $administracao->getNome());
		$stmt->bindValue(2, $administracao->getEmail());
		$stmt->bindValue(3, $administracao->getDdd());
		$stmt->bindValue(4, $administracao->getTelefone());
		$stmt->bindValue(5, $administracao->getUsuario());
		$stmt->bindValue(6, $administracao->getSenha());
		$stmt->bindValue(7, $administracao->getStatus());
						
		$stmt->bindValue(8, $condicao);
		
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
		
		//fecho a conexão
		$this->conexao = null;
				
	}
	
	//realiza um Update
	public function UpdateStatus( $administracao, $condicao ) {
		// preparo a query de update - Prepare Statement
		$stmt = $this->conexao->prepare("UPDATE administracao SET status=? WHERE idadministracao=?");
		$this->conexao->beginTransaction();
		
		$stmt->bindValue(1, $administracao->getStatus());
						
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
		
		$this->conexao->commit();
		
		//fecho a conexão
		$this->conexao = null;
				
	}
	
	//realiza um Update
	public function UpdateSenha( $administracao, $condicao ) {
		// preparo a query de update - Prepare Statement
		$stmt = $this->conexao->prepare("UPDATE administracao SET senha=? WHERE idadministracao=?");
		$this->conexao->beginTransaction();
		
		$stmt->bindValue(1, $administracao->getSenha());
						
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
		
		$this->conexao->commit();
		
		//fecho a conexão
		$this->conexao = null;
				
	}
	
	//remove um registro
	public function Deleta( $id ) {
		$sql = "DELETE FROM administracao WHERE idadministracao = ?";
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