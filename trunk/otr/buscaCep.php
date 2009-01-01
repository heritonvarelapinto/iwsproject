
<?
	require("requires.php");
	
	$anuncioHTML = new AnuncioHTML();	
	$cepget = $_POST['cep'];
	
	$cep = $anuncioHTML->busca_cep($cepget);
	
	foreach ($cep as $dados => $valor) {
		$resultado .= utf8_encode($valor).";";
	}
		
	echo $resultado;
?>
	