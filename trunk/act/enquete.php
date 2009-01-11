<?
	function __autoload($classe) {
		require_once "../class/".$classe.".class.php";
	}
	
	$enquete = new Enquete();
	$enqueteDAO = new EnqueteDAO();	
	
	function lista($enqueteDAO) {
		$enquete = $enqueteDAO->enqueteAtiva();
		$total = $enqueteDAO->totalVotosEnqueteAtiva();
		for($i=0; $i < count($enquete);$i++) {
			$geral = round($enquete[$i]->voto * 100 / $total);
			echo "<li>".utf8_encode($enquete[$i]->resposta)."<br>
			<img src=\"http://www.clicknobairro.com.br/xybr/img/orange.gif\" style=\"width: ".($geral+5)."; height: 8px \"> ".$geral."%</li>";
		}
	}
	
	if($_POST['id'] != "") {
		if(!isset($_COOKIE['voto'])) {
			if(setcookie("voto", $_POST['id'] , time()+60*60*24)) {
				$enqueteDAO->computaVoto($_POST['id']);	
				echo "<script>alert('".utf8_encode("Voto computado com sucesso!")."');</script>";
				lista($enqueteDAO);
			} else {
				echo 'Ocorreu algum erro, tente mais tarde!';
			}
		} else {
			echo "<script>alert('".utf8_encode("Seu voto já foi computado!")."');</script>";
			lista($enqueteDAO);
		}
	} else {
		lista($enqueteDAO);
	}
?>