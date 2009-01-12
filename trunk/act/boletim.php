<?
	function __autoload($classe) {
		require_once "../class/".$classe.".class.php";
	}
	
	$informativo = new Informativo();
	$informativoDAO = new InformativoDAO();	
	
	$informativo->setEmail($_POST['email']);
	$informativo->setNome($_POST['nome']);
	$informativo->setStatus(0);

	if($informativoDAO->verificaEmail($informativo->getEmail()) > 0) {
		echo utf8_encode("E-mail já consta em nossa base.");
	} else {
		if($informativoDAO->Insere($informativo)) {
			echo "E-mail cadastrado com sucesso!";
		} else {
			echo "Estamos com dificuldade técnicas!\nTente mais tarde.";
		}
	}
	
?>