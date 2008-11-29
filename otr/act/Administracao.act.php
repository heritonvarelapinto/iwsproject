<?php
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	
	$administracao = new Administracao();
	$administracaoDAO = new AdministracaoDAO();
	
	$clienteDAO = new ClienteDAO();
	$cliente = $clienteDAO->getUsuarioPorNome("Oiter Busca");
		
	$acao = $_GET["acao"];
	//$acao = "senha";
	
	$idmenu = 1;
	
    switch ($acao) {
    	//cria um usuario
    	case "add":
    		$setIdcliente = 1;
			$setNome = $_POST["nome"];
			$setUsuario = $_POST["usuario"];
			$setEmail = $_POST["email"];
			$setDdd = $_POST["ddd"];	
			$setTelefone = $_POST["telefone"];
			$senha = $administracao->geraSenha();
			$setSenha = $senha;
			$setStatus = 1;
			
			session_register("pass");
			$_SESSION["pass"] = $senha;
			
			/*$setIdcliente = 1;
			$setNome = "Erinthon C.";
			$setUsuario = "thon";
			$setEmail = "erinthonc@gmail.com";
			$setDdd = "41";	
			$setTelefone = "35662108";
			$setSenha = $senha = md5($administracao->geraSenha());
			$setStatus = 1;	*/
    		
    		$administracao->setIdcliente($setIdcliente);
    		$administracao->setNome($setNome);
    		$administracao->setUsuario($setUsuario);
    		$administracao->setEmail($setEmail);
    		$administracao->setDdd($setDdd);
    		$administracao->setTelefone($setTelefone);
    		$administracao->setSenha(md5($senha));
    		$administracao->setStatus($setStatus);
    		
    		$administracaoDAO->InsereUsuarios($administracao);
    		$usuarios = $administracaoDAO->getUsuarioPorUsuario($setUsuario);
    		
    		$administracao->EnviaDadosEmailAdministracao($cliente,$usuarios,$senha);
    		
    		
			$act = "altera";
			$iduser = $usuarios->getIdadministracao();
    		
    			header("location: ../principal.php?menu=$idmenu&act=$act&id=$iduser&msg=2");
    	break;
    	//altera um usuario
    	case "alt":
    		$iduser = $_POST["idadministracao"];   		    		
    		$administracao = $administracaoDAO->getUsuarioPorID($iduser);
    		
    		if(isset($_POST["remover"])) {
    			$act = "mostra";
    			$administracaoDAO->Deleta($iduser);
    			
    				header("location: ../principal.php?menu=$idmenu&act=$act&msg=1");
    		}else{    		
    			$act = "altera";

    			if(isset($_POST["ativasenha"])) {
    				$senha = $administracao->getSenha();
    				$senha_atual = md5($_POST["senha_atual"]);
    				$nova_senha = md5($_POST["nova_senha"]);
    				$confirma_nova_senha = md5($_POST["confirma_nova_senha"]);
    				
					if($senha_atual == $senha) {
    					if($nova_senha == $confirma_nova_senha) {
    						$senha = $nova_senha;
    						$ok = true;    						
    					}else{
    						$ok = false;
    					}
    				}else{
    					$ok = false;
    				}    				   									
				}else{
					$senha = $administracao->getSenha();
					$ok = true;
				}
    				
				if($ok == true) {
					$setIdcliente = 1;
					$setNome = $_POST["nome"];
					$setUsuario = $administracao->getUsuario();
					$setEmail = $_POST["email"];
					$setDdd = $_POST["ddd"];
					$setTelefone = $_POST["telefone"];
					$setSenha = $senha;
					$setStatus = 1;
					
					$administracao->setIdcliente($setIdcliente);
		    		$administracao->setNome($setNome);
		    		$administracao->setUsuario($setUsuario);
		    		$administracao->setEmail($setEmail);
		    		$administracao->setDdd($setDdd);
		    		$administracao->setTelefone($setTelefone);
		    		$administracao->setSenha($setSenha);
		    		$administracao->setStatus($setStatus);
	    			
	    			$administracaoDAO->Update($administracao,$iduser);
	    				header("location: ../principal.php?menu=$idmenu&act=$act&id=$iduser&msg=3");
				}else{
					header("location: ../principal.php?menu=$idmenu&act=$act&id=$iduser&msg=4");
				}
    		}
    	break;
    	//altera o status do usuario
    	case "block":
    		$act = "mostra";
    		    		
    		$iduser = $_GET["idadministracao"];
    		$administracao = $administracaoDAO->getUsuarioPorID($iduser);
    		
    		if($administracao->getStatus() == 1) {
    			$administracao->setStatus(0);    				
    		}elseif($administracao->getStatus() == 0) {
    			$administracao->setStatus(1);    				
    		}
    		
    		$administracaoDAO->UpdateStatus($administracao,$iduser);
    		
    			header("location: ../principal.php?menu=$idmenu&act=$act&msg=2");
    	break;
    	//reenvia os dados de acesso ao painel
    	case "reenvio":
    		$act = "altera";
    		    		
    		$iduser = $_GET["idadministracao"];
			$administracao = $administracaoDAO->getUsuarioPorID($iduser);
			$senha = $administracao->geraSenha();
			$setSenha = md5($senha);
			
			$administracao->setSenha($setSenha);		
    		
			$administracaoDAO->UpdateSenha($administracao,$iduser);
			
    		$administracao->EnviaDadosEmailAdministracao($cliente,$administracao,$senha);
    			header("location: ../principal.php?menu=$idmenu&act=$act&id=$iduser&msg=5");
    		
    	break;    	
    }
?>