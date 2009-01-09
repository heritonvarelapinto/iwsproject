
<?
	require("requires.php");
	
	$anuncioHTML = new AnuncioHTML();	
	$cepget = $_POST['cep'];
	
	$cep = $anuncioHTML->busca_cep($cepget);
		
	echo $cep;
	
?>
	