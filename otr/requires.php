<?php
	function __autoload($classe)
    {
        require_once "../class/".$classe.".class.php";
    }	
?>
