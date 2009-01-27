<?php
	Auth::verificaAcesso();
	ob_start();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	
	$uteis = new Uteis();
	$func = new FuncUteis();
	$uteisDAO = new UteisDAO();
	
	$acao = $_GET["acao"];
	//$acao = "alt";
	
    switch ($acao) {
    	case "add":    		   	
			//print_r($_FILES);
			//print_r($_POST);
			
			$imagem = $_FILES["imagem"]["name"];
    		$imagem_type = $_FILES["imagem"]["type"];
    		$imagem_tmp_name = $_FILES["imagem"]["tmp_name"];
    		$imagem_size = $_FILES["imagem"]["imagem"];
    		$setImagem = $func->upload_imagem($imagem,$imagem_type,$imagem_tmp_name,$imagem_size,1000000,5000,540,"uteis");
			
			$uteis->setImagem($setImagem);
			$uteis->setTexto($_POST["texto"]);
			$uteis->setLink($_POST["link"]);
			$uteis->setOpcao($_POST["opcao"]);
			
			$uteisDAO->InsereUteis($uteis);
				header("location: ../principal.php?menu=8&act=mostra&msg=1");
    	break;  
    	case "alt": 
    		if($_POST["remover"]) {
				$iduteis = $_POST["iduteis"];    			
    			   			
    			$uteisDAO->Deleta($iduteis);
    				header("location: ../principal.php?menu=8&act=mostra&msg=3");
    		}else{
    			//print_r($_FILES);
				//print_r($_POST);
				
				if($_FILES["imagem"]["name"] == "") {
					$setImagem = $_POST["imagem"];
				}else{
					$imagem = $_FILES["imagem"]["name"];
		    		$imagem_type = $_FILES["imagem"]["type"];
		    		$imagem_tmp_name = $_FILES["imagem"]["tmp_name"];
		    		$imagem_size = $_FILES["imagem"]["imagem"];
		    		$setImagem = $func->upload_imagem($imagem,$imagem_type,$imagem_tmp_name,$imagem_size,1000000,5000,540,"uteis");
				}
				
				$uteis->setImagem($setImagem);
				$uteis->setTexto($_POST["texto"]);
				$uteis->setLink($_POST["link"]);
				$uteis->setOpcao($_POST["opcao"]);
				
				$uteisDAO->UpdateUteis($uteis);
					header("location: ../principal.php?menu=8&act=mostra&msg=2");
    		}
    	break;  
    }
?>