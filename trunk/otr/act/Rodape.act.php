<?php
	Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
    ob_start();
	$rodape = new Rodape();
	$rodapeDAO = new RodapeDAO();

	$menuDAO = new MenuAdminDAO();
	$menu = $menuDAO->getMenuPorTitulo("rodapé");
	
	$idmenu = $menu->getIdmenu();
	
	$acao = $_GET["acao"];
	//$acao = "alt";
	

	
    switch ($acao) {
    	//cria um departamento
    	case "add":
			$act = "add";
			
    		$setTitulo = $_POST["titulo"];
    		$setTexto = $_POST["texto"];
    		
    		$rodape->setTitulo($setTitulo);
    		$rodape->setTexto($setTexto);
    		
			$rodapeDAO->InsereRodape($rodape);
			
			$lastID = $rodapeDAO->getUltimoID();
			
			$menu->setIdmenu($idmenu); 
    		$menu->setTituloLink($setTitulo);
    		$menu->setAcao($lastID->idrodape);
			
			$menuDAO->InsereTituloLink($menu);
				header("location: ../principal.php?menu=$idmenu&act=$act");
    	break;  
    	//cria um departamento
    	case "alt":
    		if($_POST["remover"]) {
    			print_r($_POST);
    			
    			$act = "add";
    			
    			$idrodape = $_POST["idrodape"];
    			
    			$rodapeDAO->Deleta($idrodape);
    			$menuDAO->DeletaLinksRodape($idrodape);
    				header("location: ../principal.php?menu=$idmenu&act=$act");
    		}else{
    			$act = $_POST["idrodape"];
			
	    		$setTitulo = $_POST["titulo"];
	    		$setTexto = $_POST["texto"];
	    		
	    		$rodape->setTitulo($setTitulo);
	    		$rodape->setTexto($setTexto);
    		 
	    		$menu->setTituloLink($setTitulo);
	    		
				$rodapeDAO->UpdateRodape($rodape,$act);
				$menuDAO->UpdateLinkTituloRodape($menu,$act);
					header("location: ../principal.php?menu=$idmenu&act=$act");
    		}
    	break;   	
    }
?>