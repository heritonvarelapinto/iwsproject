<?php
	Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
    ob_start();
	$enquete = new Enquete();
	$enqueteDAO = new EnqueteDAO();

	$menuDAO = new MenuAdminDAO();
	$menu = $menuDAO->getMenuPorTitulo("enquetes");
	
	$idmenu = $menu->getIdmenu();
	
	$acao = $_GET["acao"];
	//$acao = "add";
	
    switch ($acao) {
    	//cria uma enquete
    	case "add":
    		$act = "addresp";
    		
			$setPergunta = $_POST["pergunta"];
			$setStatus = 0;
			
			$enquete->setPergunta($setPergunta);
			$enquete->setStatus($setStatus);
			
			$enqueteDAO->InserePergunta($enquete);
			$id = $enqueteDAO->getUltimoID();
				header("location: ../principal.php?menu=$idmenu&act=$act&idpergunta=$id->idpergunta");
    	break;
    	//adiciona uma resposta
    	case "addresp":
			$act = "addresp";
    		
			$setIdpergunta = $_POST["idpergunta"];
			$setResposta = $_POST["resposta"];
			
			$enquete->setIdpergunta($setIdpergunta);
			$enquete->setResposta($setResposta);
			
			$enqueteDAO->InsereResposta($enquete);
				header("location: ../principal.php?menu=$idmenu&act=$act&idpergunta=$setIdpergunta");
    	break;      	
    	//altera status da enquete
    	case "status":
    		$act = "mostra";
    		$idpergunta = $_GET["id"];
    		
    		$enquete = $enqueteDAO->getStatusPorID($idpergunta);
    		$stats = $enqueteDAO->listaStatus();
    		
			if($enquete->getStatus() == 1) {
    			$enquete->setStatus('0');
    			$enqueteDAO->UpdateStatus($enquete,$idpergunta);
    				header("location: ../principal.php?menu=$idmenu&act=$act&msg=");
    		}elseif ($enquete->getStatus() == 0) {
    			if($stats > 0) {
	    			header("location: ../principal.php?menu=$idmenu&act=$act&msg=2");
	    		}else{
	    			$enquete->setStatus('1');
	    			$enqueteDAO->UpdateStatus($enquete,$idpergunta);
	    				header("location: ../principal.php?menu=$idmenu&act=$act&msg=");
	    		}
    		}
    	break;
    	case "del":
    		$act = "mostra";
    		
    		$idpergunta = $_POST["idpergunta"];
    			
			$enqueteDAO->DeletaPerguntas($idpergunta);
			$enqueteDAO->DeletaRespostas($idpergunta);
				header("location: ../principal.php?menu=$idmenu&act=$act&msg=1");
    	break;
    }
?>