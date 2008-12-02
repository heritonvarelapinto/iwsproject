<?php
	//Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	ob_start();
	$departamento = new Departamento();
	$departamentoDAO = new DepartamentoDAO();
		
	$acao = $_GET["acao"];
	//$acao = "adddep";
	
	$idmenu = 2;
	
    switch ($acao) {
    	//cria um departamento
    	case "adddep":
    		$act = "mostra";
    		$setDepartamento = $_POST["departamento"];
    		
    		$departamento->setDepartamento($setDepartamento);
    		
    		$departamentoDAO->InsereDepartamento($departamento);
    			header("location: ../principal.php?menu=$idmenu&act=$act");
    	break;    	
    }
?>