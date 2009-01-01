
<?
	require("requires.php");
	
	$layout = new AnuncioHTML();	
	$cepget = $_POST['cep'];
	
	$cep = $layout->busca_cep($cepget);
	
	foreach ($cep as $dados => $valor) {
		$resultado .= utf8_encode($valor).";";
	}
	echo $resultado;
?>
	