<?php
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	
    session_start();
    header("Cache-control: private");
    
	$autentica = new Auth();
	$autentica->autentica($_POST["usuario"],$_POST["senha"]);		
	//$autentica->autentica("admin","thon");		
?>