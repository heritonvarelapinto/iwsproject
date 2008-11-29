<?php
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
    
    if(isset($_POST["acao"])) {		
		$administracao = new Administracao();
		$administracaoDAO = new AdministracaoDAO();
		
		$clienteDAO = new ClienteDAO();
		$cliente = $clienteDAO->getUsuarioPorNome("Oiter Busca");
		
		$usuario = $_POST["usuario"];		
		$administracao = $administracaoDAO->getUsuarioPorUsuario($usuario);
		$senha = $administracao->geraSenha();
		$setSenha = md5($senha);
		
		$administracao->setSenha($setSenha);		
		
		$administracaoDAO->UpdateSenha($administracao,$administracao->getIdadministracao());
		
		$administracao->EnviaDadosEmailAdministracao($cliente,$administracao,$senha);		
			header("location: ../index.php?msg=3");
	}else{				
	    session_start();
	    header("Cache-control: private");
	    
		$autentica = new Auth();
		$autentica->autentica($_POST["usuario"],$_POST["senha"]);		
		//$autentica->autentica("admin","tekrox");	
	}
?>