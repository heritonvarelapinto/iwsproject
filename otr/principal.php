<?php
	require("requires.php");
	Auth::verificaAcesso();
	
	$LayoutAdmin = new LayoutAdmin();
	$LayoutAdmin->EstruturaPainel();
?>