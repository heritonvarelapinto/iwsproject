<?php
	class Auth {
		
		function verificaAcesso() {
			session_start();
			header("Cache-control: private");
			
			$idUsuario = $_SESSION['usuario'];
			
			if(!isset($idUsuario)) {
				header("location: erro.php");
			}
		}
		
		function autentica($usuario,$senha) {
			$usuario = htmlspecialchars($usuario,ENT_QUOTES);
			$senha = htmlspecialchars($senha,ENT_QUOTES);
			
			$senha = md5($senha);		
			
			$cliente = new Cliente();
			$clienteDAO = new ClienteDAO();
			
			$cliente = $clienteDAO->getUsuarioPorNome("Oiter Busca");
						
			$administracao = new AdministracaoDAO();
			$user = new Administracao();
			$user = $administracao->autenticaUsuario($usuario,$senha);
			
			if($user->status == 1) {
				if($user->idcliente == $cliente->getIdcliente()) {
					session_register("usuario");
					$_SESSION["usuario"] = $user;
					header("location: ../principal.php");
				}else{
					header("location: ../index.php?msg=1");
				}
			}else{
				header("location: ../index.php?msg=1");
			}		
		}
	}
?>