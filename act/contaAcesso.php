<?
	function __autoload($classe) {
		require_once "../class/".$classe.".class.php";
	}
	
	$anuncioDAO = new AnuncioDAO();
	$anuncioDAO->contaAcesso($_POST['id']);
	
	print_r($_POST);
?>