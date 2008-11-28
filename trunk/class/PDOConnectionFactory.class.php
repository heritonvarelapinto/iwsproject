<?php
class PDOConnectionFactory{
	//recebe a conexão
	public $conexao = null;
	//qual o banco de dados
	public $dbType = "mysql";
	
	//parâmetros de conexão
	// quando não for necessário deixe em branco apenas com as aspas duplas ""
	public $host = "localhost";
	public $user = "root";
	public $senha = "root";
	public $db = "oiter";
	
	public $dbConstrutor = "construtor";
	
	
	//seta a persistência da conexão
	public $persistent = false;
	
	//new PDOConnectionFactory( true ) <--- conexão persistente
	//new PDOConnectionFactory()       <--- conexao não persistente
	public function PDOConnectionFactory( $persistent=false ) {
		// verifico a persistência da conexao
		if($persistent != false) { $this->persistent = true; }
	}
	
	public function getConnection() {
		try {
			//realiza a conexão
			$this->conexao = new PDO($this->dbType.":host=".$this->host.";dbname=".$this->db, $this->user, $this->senha,array( PDO::ATTR_PERSISTENT => $this->persistent ));
			// realizado com sucesso, retorna conectado
			return $this->conexao;
		// caso ocorra um erro, retorna o erro;
		}catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
	}
	
	public function getConnectionConstrutor() {
		try {
			//realiza a conexão
			$this->conexao = new PDO($this->dbType.":host=".$this->host.";dbname=".$this->dbConstrutor, $this->user, $this->senha,array( PDO::ATTR_PERSISTENT => $this->persistent ));
			// realizado com sucesso, retorna conectado
			return $this->conexao;
		// caso ocorra um erro, retorna o erro;
		}catch ( PDOException $ex ){  echo "Erro: ".$ex->getMessage(); }
	}
	
	// desconecta
	public function Close() {
		if($this->conexao != null)
			$this->conexao = null;
	}
}
?>