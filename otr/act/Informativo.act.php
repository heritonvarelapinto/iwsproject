<?php
	Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	
	$informativo = new Informativo();
	$informativoDAO = new InformativoDAO();
	$informativoHTML = new InformativoHTML();
	
	$acao = $_GET["acao"];
	//$acao = "Alterar";
	
	$menuDAO = new MenuAdminDAO();
	$menu = $menuDAO->getMenuPorTitulo("informativos");
	
	$idmenu = $menu->getIdmenu();
	
    switch ($acao) {
    	case "add":    		
    		$setNome = $_POST["nome"];
			$setEmail = $_POST["email"];
			$setStatus = "Autoriza Recebimento";

			$informativo->setNome($setNome);
			$informativo->setEmail($setEmail);
			$informativo->setStatus($setStatus);
							
			$informativoDAO->Insere($informativo);
		
			header("location: ../principal.php?menu=4&act=mostra&msg=4");	
    	break; 
    	case "addlista":
    		if($_FILES["lst"]["name"] == null) {
	    		$texto = $_POST["lista"];
					
				$texto = explode(",",$texto);
						
				$n = count($texto);
				
				if($n > 5000) {
					$menos = 5000;
					$total = $n - $menos;
														
					header("location: ../principal.php?menu=4&act=add&menos=$menos&n=$n&total=$total");
				}else{
					for($i=0;$i<$n;$i++) {										
						$setNome = $_POST["nome"];
						$setEmail = $texto[$i];
						$setStatus = "Autoriza Recebimento";
	
						$informativo->setNome($setNome);
						$informativo->setEmail($setEmail);
						$informativo->setStatus($setStatus);
										
						$informativoDAO->Insere($informativo);
					}	
					header("location: ../principal.php?menu=4&act=mostra&msg=1");
				}
    		
    		}else{
	    		//abrimos o arquivo em leitura
				$arquivo = $_FILES["lst"]["tmp_name"];
				$fp = fopen($arquivo,'r');
				
				//lemos o arquivo
				$texto = fread($fp, filesize($arquivo));
				
				$texto = explode(",",$texto);
							
				$n = count($texto);
				
				if($n > 5000) {
					$menos = 5000;
					$total = $n - $menos;
					
					header("location: ../principal.php?menu=4&act=add&menos=$menos&n=$n&total=$total");
				}else{
					for($i=0;$i<$n;$i++) {
						$setNome = $_POST["nome"];
						$setEmail = $texto[$i];
						$setStatus = "Autoriza Recebimento";
	
						$informativo->setNome($setNome);
						$informativo->setEmail($setEmail);
						$informativo->setStatus($setStatus);
										
						$informativoDAO->Insere($informativo);
					}
					header("location: ../principal.php?menu=4&act=mostra&msg=1");	
				}
    		}
    	break;    
    	case "criar":
    		$setAssunto = $_POST["assunto"];
    		$setTexto = htmlspecialchars($_POST["texto"],ENT_QUOTES);
    		
    		$informativo->setAssunto($setAssunto);
    		$informativo->setTexto($setTexto);
    		
    		$informativoDAO->CriaModelo($informativo);
    		
    		header("location: ../principal.php?menu=4&act=modelos&msg=1");    		 
    	break;	    	  		
    }
?>