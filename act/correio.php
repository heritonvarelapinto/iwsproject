<?
	session_start();
	
	function __autoload($classe) {
		require_once "../class/".$classe.".class.php";
	}
	
	/*$cliente = new Cliente();
	$clienteDAO = new ClienteDAO();
	
	$cliente = $clienteDAO->getUsuarioPorNome("Oiter Busca");
	
	print_r($cliente);*/
	
	$anuncio = new Anuncio();
	$anuncioDAO = new AnuncioDAO();
	
	$anuncio = $anuncioDAO->getAnuncioPorId($_POST['id']);
	
	if($_POST['unid'] == $_SESSION['sid_textoCaptcha']) {
		$headers = "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "From: ".$_POST['nome']." <".$_POST['email'].">";
		$assunto = $_POST['assunto']. " - Contato pelo OITERBUSCA";
		if($_POST['telefone']) $telefone = '<p>Telefone: '.$_POST['telefone'].'</p>';
		$mensagem = '<html dir="ltr">
					    <head>
					    </head>
					    <body spellcheck="false">
					    	'.$telefone.'
					        <p>'.nl2br($_POST['mensagem']).'</p>
					    </body>
					</html>';			
		if(mail($anuncio->getEmail(),$assunto,$mensagem,$headers)) {
			echo true;
		}
	} else {
		echo false;
	}
?>