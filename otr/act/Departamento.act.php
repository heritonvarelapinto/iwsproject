<?php
	Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	ob_start();
	$departamento = new Departamento();
	$departamentoDAO = new DepartamentoDAO();
		
	$subdepartamentoDAO = new SubdepartamentoDAO();
		
	$acao = $_GET["acao"];
	//$acao = "altdep";
	
	$menuDAO = new MenuAdminDAO();
	$menu = $menuDAO->getMenuPorTitulo("departamentos");
	
	$idmenu = $menu->getIdmenu();
	
    switch ($acao) {
    	//cria um departamento
    	case "adddep":
    		$act = "mostra";
    		$setDepartamento = $_POST["departamento"];
    		
    		$departamento->setDepartamento($setDepartamento);
    		
    		$departamentoDAO->InsereDepartamento($departamento);
    			header("location: ../principal.php?menu=$idmenu&act=$act&msg=1");
    	break; 
    	case "altdep":
    		if($_POST["remover"]) {
    			
    			
    			$act = "mostra";
    			$iddepartamento = $_POST["iddepartamento"];
    			
    			$departamentoDAO->Deleta($iddepartamento);
    			$subdepartamentoDAO->DeletaALL($iddepartamento);
    				header("location: ../principal.php?menu=$idmenu&act=$act&msg=3");
    		}else{
    			$act = "mostra";
	    		$iddep = $_POST["iddepartamento"];
	    		$setDepartamento = $_POST["departamento"];
	    			    		
	    		$departamentoDAO->UpdateDepartamento($setDepartamento,$iddep);
	    			header("location: ../principal.php?menu=$idmenu&act=$act&msg=2");
    		}
    	break;     	
    }
?>