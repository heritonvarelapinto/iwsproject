<?php
function __autoload($classe) {
		require_once "class/".$classe.".class.php";
	}
	$id = $_GET['id'];
	$titulo = $_GET['titulo'];
	$sub = $_GET['sub'];
	$subtitulo = $_GET['subtitulo'];
	$cid = $_GET['cid'];
	$cliente = $_GET['cliente'];
	
	echo "ID = ".$id."<br>";
	echo "TITULO = ".$titulo."<br>";
	echo "SUB = ".$sub."<br>";
	echo "SUBtitulo = ".$subtitulo."<br>";
	echo "cid = ".$cid."<br>";
	echo "CLiente = ".$cliente."<br>";
	
	$departamentoDAO = new DepartamentoDAO();
	$subdepartamentos = $departamentoDAO->ListaSubdepartamentos($id);
	
	for($i = 0; $i < count($subdepartamentos); $i++) {
		echo "<a href=\"".UrlManage::getUrlSubCategoria($id,$titulo,$subdepartamentos[$i]->getIdSubdepartamento(),$subdepartamentos[$i]->getSubdepartamento())."\">".$subdepartamentos[$i]->getSubdepartamento()."</a><br>";
	}

?>