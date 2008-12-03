<?php
	Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	ob_start();
	$subdepartamento = new Subdepartamento();
	$subdepartamentoDAO = new SubdepartamentoDAO();
		
	$acao = $_GET["acao"];
	//$acao = "altsub";
	
	$idmenu = 2;
	
    switch ($acao) {
    	//cria um departamento
    	case "addsub":
    		$act = "altdep";
    		$setIddepartamento = $_POST["iddepartamento"];
    		$setSubdepartamento = $_POST["subdepartamento"];
    		
    		$subdepartamento->setIddepartamento($setIddepartamento);
    		$subdepartamento->setSubdepartamento($setSubdepartamento);
    		
    		$subdepartamentoDAO->InsereSubdepartamento($subdepartamento);
    			header("location: ../principal.php?menu=$idmenu&act=$act&iddepartamento=$setIddepartamento&msg=1");
    	break; 
    	case "altsub":
    		if($_POST["remover"]) {
    			$act = "altdep";
    			$idsubdepartamento = $_POST["idsubdepartamento"];
    			
    			$subdepartamento = $subdepartamentoDAO->getSubdepartamentosPorId($idsubdepartamento);
    			$iddepartamento = $subdepartamento->getIddepartamento();
    			
    			$subdepartamentoDAO->Deleta($idsubdepartamento);
    				header("location: ../principal.php?menu=$idmenu&act=$act&iddepartamento=$iddepartamento&msg=3");
    		}else{
    			/*print_r($_POST);
    			exit;*/
    			$act = "altdep";
	    		
    			$setIdsubdepartamento = $_POST["idsubdepartamento"];
	    		$setIddepartamento = $_POST["iddepartamento"];
    			$setSubdepartamento = $_POST["subdepartamento"];
    			
    			/*$setIdsubdepartamento = 8;
	    		$setIddepartamento = 1;
    			$setSubdepartamento = "tetetee";*/
	    		
	    		$subdepartamento->setIdsubdepartamento($setIdsubdepartamento);
	    		$subdepartamento->setIddepartamento($setIddepartamento);
    			$subdepartamento->setSubdepartamento($setSubdepartamento);
	    			    		
	    		$subdepartamentoDAO->UpdateSubdepartamento($subdepartamento,$setIdsubdepartamento);
	    			header("location: ../principal.php?menu=$idmenu&act=$act&iddepartamento=$setIddepartamento&msg=2");
    		}
    	break;     	
    }
?>