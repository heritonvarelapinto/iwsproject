<?php
	Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	
	$anuncio = new Anuncio();
	$anuncioDAO = new AnuncioDAO();
	
	$acao = $_GET["acao"];
	//$acao = "alt";
	
	$menuDAO = new MenuAdminDAO();
	$menu = $menuDAO->getMenuPorTitulo("anúncios");
	
	$idmenu = $menu->getIdmenu();
	
	
	
    switch ($acao) {
    	case "add":
    		$logo = $_FILES["logo"]["name"];
    		$logo_type = $_FILES["logo"]["type"];
    		$logo_tmp_name = $_FILES["logo"]["tmp_name"];
    		$logo_size = $_FILES["logo"]["size"];
    		$setLogo = $anuncio->upload_imagem($logo,$logo_type,$logo_tmp_name,$logo_size,1000000,220,500,"logos");
    		
    		$imagem1 = $_FILES["imagem1"]["name"];
    		$imagem1_type = $_FILES["imagem1"]["type"];
    		$imagem1_tmp_name = $_FILES["imagem1"]["tmp_name"];
    		$imagem1_size = $_FILES["imagem1"]["size"];    		
    		$setImagem1 = $anuncio->upload($imagem1,$imagem1_type,$imagem1_tmp_name,$imagem1_size,1000000,5000,5000,"album",1);    		
    		
    		$imagem2 = $_FILES["imagem2"]["name"];
    		$imagem2_type = $_FILES["imagem2"]["type"];
    		$imagem2_tmp_name = $_FILES["imagem2"]["tmp_name"];
    		$imagem2_size = $_FILES["imagem2"]["size"];
    		$setImagem2 = $anuncio->upload($imagem2,$imagem2_type,$imagem2_tmp_name,$imagem2_size,1000000,5000,5000,"album",2);
    		
    		$imagem3 = $_FILES["imagem3"]["name"];
    		$imagem3_type = $_FILES["imagem3"]["type"];
    		$imagem3_tmp_name = $_FILES["imagem3"]["tmp_name"];
    		$imagem3_size = $_FILES["imagem3"]["size"];
    		$setImagem3 = $anuncio->upload($imagem3,$imagem3_type,$imagem3_tmp_name,$imagem3_size,1000000,5000,5000,"album",3);
    		
    		$imagem4 = $_FILES["imagem4"]["name"];
    		$imagem4_type = $_FILES["imagem4"]["type"];
    		$imagem4_tmp_name = $_FILES["imagem4"]["tmp_name"];
    		$imagem4_size = $_FILES["imagem4"]["size"];
    		$setImagem4 = $anuncio->upload($imagem4,$imagem4_type,$imagem4_tmp_name,$imagem4_size,1000000,5000,5000,"album",4);
    				   	
    		$setIddepartamento = $_POST["iddepartamento"];
    		$setIdsubdepartamento = $_POST["idsubdepartamento"];
    		$setNome = $_POST["nome"];
    		$setCep = $_POST["cep"];
    		$setEndereco = $_POST["endereco"];
    		$setNumero = $_POST["numero"];
    		$setComplemento = $_POST["complemento"];
    		$setBairro = $_POST["bairro"];
    		$setCidade = $_POST["cidade"];
    		$setEstado = $_POST["estado"];
    		$setTelefones = $_POST["telefones"];
    		$setEmail =$_POST["email"];
    		$setSite = $_POST["site"];    		    		
    		
    		$setDe = $anuncio->FormataData($_POST["de"]);
    		$setAte = $anuncio->FormataData($_POST["ate"]);
    		$setTexto = $_POST["texto"];
    		$setDestaque = $_POST["destaque"];
    		
    		$anuncio->setIddepartamento($setIddepartamento);
    		$anuncio->setIdsubdepartamento($setIdsubdepartamento);
    		$anuncio->setNome($setNome);
    		$anuncio->setCep($setCep);
    		$anuncio->setEndereco($setEndereco);
    		$anuncio->setNumero($setNumero);
    		$anuncio->setComplemento($setComplemento);
    		$anuncio->setBairro($setBairro);
    		$anuncio->setCidade($setCidade);
    		$anuncio->setEstado($setEstado);
    		$anuncio->setTelefones($setTelefones);
    		$anuncio->setEmail($setEmail);
    		$anuncio->setSite($setSite);
    		
    		$anuncio->setLogo($setLogo);
    		$anuncio->setImagem1($setImagem1);
    		$anuncio->setImagem2($setImagem2);
    		$anuncio->setImagem3($setImagem3);
    		$anuncio->setImagem4($setImagem4);
    		
    		$anuncio->setDe($setDe);
    		$anuncio->setAte($setAte);
    		$anuncio->setTexto($setTexto);
    		$anuncio->setDestaque($setDestaque);
    		
    		$anuncioDAO->InsereAnuncio($anuncio);
    			header("location: ../principal.php?menu=7&act=mostra&msg=1");
    	break;  
    	case "alt":
    		if($_POST["remover"]) {
    			$idanuncio = $_POST["idanuncio"];
    			
    			$anuncio = $anuncioDAO->getAnuncioPorId($idanuncio);    	    		
    			
    			$anuncioDAO->Deleta($anuncio->getIdanuncio());
    				header("location: ../principal.php?menu=7&act=mostra&msg=3");    			
    		}else{    			
    			if($_FILES["logo"]["name"] == "") {
    				$setLogo = $_POST["logo"];
    			}else{
    				$logo = $_FILES["logo"]["name"];
		    		$logo_type = $_FILES["logo"]["type"];
		    		$logo_tmp_name = $_FILES["logo"]["tmp_name"];
		    		$logo_size = $_FILES["logo"]["size"];
		    		$setLogo = $anuncio->upload_imagem($logo,$logo_type,$logo_tmp_name,$logo_size,1000000,500,500,"logos");
    			}
	    		
    			if($_FILES["imagem1"]["name"] == "") {
	    			$setImagem1 = $_POST["imagem1"];
	    		}else{
	    			$imagem1 = $_FILES["imagem1"]["name"];
		    		$imagem1_type = $_FILES["imagem1"]["type"];
		    		$imagem1_tmp_name = $_FILES["imagem1"]["tmp_name"];
		    		$imagem1_size = $_FILES["imagem1"]["size"];
		    		$setImagem1 = $anuncio->upload($imagem1,$imagem1_type,$imagem1_tmp_name,$imagem1_size,1000000,5000,5000,"album",1);    		
	    		}
	    		
	    		if($_FILES["imagem2"]["name"] == "") {
	    			$setImagem2 = $_POST["imagem2"];
	    		}else{
		    		$imagem2 = $_FILES["imagem2"]["name"];
		    		$imagem2_type = $_FILES["imagem2"]["type"];
		    		$imagem2_tmp_name = $_FILES["imagem2"]["tmp_name"];
		    		$imagem2_size = $_FILES["imagem2"]["size"];
		    		$setImagem2 = $anuncio->upload($imagem2,$imagem2_type,$imagem2_tmp_name,$imagem2_size,1000000,5000,5000,"album",2);
	    		}
	    		
	    		if($_FILES["imagem3"]["name"] == "") {
	    			$setImagem3 = $_POST["imagem3"];
	    		}else{
		    		$imagem3 = $_FILES["imagem3"]["name"];
		    		$imagem3_type = $_FILES["imagem3"]["type"];
		    		$imagem3_tmp_name = $_FILES["imagem3"]["tmp_name"];
		    		$imagem3_size = $_FILES["imagem3"]["size"];
		    		$setImagem3 = $anuncio->upload($imagem3,$imagem3_type,$imagem3_tmp_name,$imagem3_size,1000000,5000,5000,"album",3);
	    		}
	    		
	    		if($_FILES["imagem4"]["name"] == "") {
	    			$setImagem4 = $_POST["imagem4"];
	    		}else{
		    		$imagem4 = $_FILES["imagem4"]["name"];
		    		$imagem4_type = $_FILES["imagem4"]["type"];
		    		$imagem4_tmp_name = $_FILES["imagem4"]["tmp_name"];
		    		$imagem4_size = $_FILES["imagem4"]["size"];
		    		$setImagem4 = $anuncio->upload($imagem4,$imagem4_type,$imagem4_tmp_name,$imagem4_size,1000000,5000,5000,"album",4);
	    		}
	    		    		   	
	    		$setIdanuncio = $_POST["idanuncio"];
	    		$setIddepartamento = $_POST["iddepartamento"];
	    		$setIdsubdepartamento = $_POST["idsubdepartamento"];
	    		$setNome = $_POST["nome"];
	    		$setCep = $_POST["cep"];
	    		$setEndereco = $_POST["endereco"];
	    		$setNumero = $_POST["numero"];
	    		$setComplemento = $_POST["complemento"];
	    		$setBairro = $_POST["bairro"];
	    		$setCidade = $_POST["cidade"];
	    		$setEstado = $_POST["estado"];
	    		$setTelefones = $_POST["telefones"];
	    		$setEmail =$_POST["email"];
	    		$setSite = $_POST["site"];	    		
	    		
	    		$setDe = $anuncio->FormataData($_POST["de"]);
	    		$setAte = $anuncio->FormataData($_POST["ate"]);
	    		$setTexto = $_POST["texto"];
	    		$setDestaque = $_POST["destaque"];
	    		
	    		$anuncio->setIdanuncio($setIdanuncio);
	    		$anuncio->setIddepartamento($setIddepartamento);
	    		$anuncio->setIdsubdepartamento($setIdsubdepartamento);
	    		$anuncio->setNome($setNome);
	    		$anuncio->setCep($setCep);
	    		$anuncio->setEndereco($setEndereco);
	    		$anuncio->setNumero($setNumero);
	    		$anuncio->setComplemento($setComplemento);
	    		$anuncio->setBairro($setBairro);
	    		$anuncio->setCidade($setCidade);
	    		$anuncio->setEstado($setEstado);
	    		$anuncio->setTelefones($setTelefones);
	    		$anuncio->setEmail($setEmail);
	    		$anuncio->setSite($setSite);
	    		
	    		$anuncio->setLogo($setLogo);
	    		$anuncio->setImagem1($setImagem1);
	    		$anuncio->setImagem2($setImagem2);
	    		$anuncio->setImagem3($setImagem3);
	    		$anuncio->setImagem4($setImagem4);
	    		
	    		$anuncio->setDe($setDe);
	    		$anuncio->setAte($setAte);
	    		$anuncio->setTexto($setTexto);
	    		$anuncio->setDestaque($setDestaque);
	    		
	    		$anuncioDAO->AlteraAnuncio($anuncio);
	    		
					header("location: ../principal.php?menu=7&act=mostra&msg=2");
    		}
    	break;  		
    }
?>