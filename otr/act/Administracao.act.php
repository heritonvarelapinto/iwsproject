<?php
	Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	
	$administracao = new Administracao();
	$administracaoDAO = new AdministracaoDAO();
	
	$acao = $_GET["acao"];
	//$acao = "senha";
	
	$idmenu = 2;
	
    switch ($acao) {
    	//cria um departamento
    	case "adddep":
    		
    	break;    	
    }
?>