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
			
			$idCliente = $clienteDAO->getUsuarioPorNome("Oiter Busca");
						
			$administracao = new AdministracaoDAO();
			$user = new Administracao();
			$user = $administracao->listaUsuarios("SELECT * FROM administracao WHERE usuario ='$usuario' AND senha ='$senha'");
			
			if($user[0]->status == 1) {
				if($user[0]->idcliente == $idCliente->getIdcliente()) {
					session_register("usuario");
					$_SESSION["usuario"] = $user[0];
					header("location: ../principal.php");
				}else{
					header("location: ../index.php");
				}
			}else{
				header("location: ../index.php");
			}		
		}
	}
?>