<?php
	Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	
	$banner = new Banner();
	$bannerDAO = new BannerDAO();
	
	$acao = $_GET["acao"];
	//$acao = "Alterar";
	
	$menuDAO = new MenuAdminDAO();
	$menu = $menuDAO->getMenuPorTitulo("banners");
	
	$idmenu = $menu->getIdmenu();
	
    switch ($acao) {
    	//adiciona um banner
    	case "Adicionar":
    		if($_POST["valor"] == "") {
				if($_POST["tempo"] == "0") {
					$tempo = '0000-00-00 00:00:00';
				}else{
					$dias = $_POST["tempo"];
					$dias = "+".$dias." days";			
					$timestamp = strtotime($dias);
					$tempo = date('Y-m-d G:i:s', $timestamp);
				}
			}else{
				$dias = $_POST["valor"];
				$dias = "+".$dias." days";			
				$timestamp = strtotime($dias);
				$tempo = date('Y-m-d G:i:s', $timestamp);
			}
    		$act = "mostra";
    		
    		$name = $_FILES["banner"]["name"];
    		$type = $_FILES["banner"]["type"];
    		$tmp_name = $_FILES["banner"]["tmp_name"];
    		$size = $_FILES["banner"]["size"];
    		$tamanho = 1000000;
    		
    		$setBanner = $name;
    		$setUrl = $_POST["url"];
    		$setTarget = $_POST["target"];
    		$setData = $tempo;
    		$setIddepartamento = $_POST["iddep"];
    		$setLado = $_POST["lado"];
    		$setNumero = $_POST["numero"];
    		$setWidth = $_POST["largura"];
    		$setHeight = $_POST["altura"];
    		
    		$banner->setLado($setLado);
    		$banner->setIddepartamento($setIddepartamento);
    		$banner->setNumero($setNumero);
    		$banner->setBanner($setBanner);
    		$banner->setWidth($setWidth);
    		$banner->setHeight($setHeight);
    		$banner->setUrl($setUrl);
    		$banner->setTarget($setTarget);
    		$banner->setData($setData);
    		
    		$ok = $banner->upload_banners($name,$type,$tmp_name,$size,$tamanho,$banner->getWidth(),$banner->getHeight());
    		
    		if($ok == true) {
    			$iddep = $banner->getIddepartamento();
    			$bannerDAO->Insere($banner);
    			header("location: ../principal.php?menu=$idmenu&act=$act&iddep=$iddep");
    		}else{
    			header("location: ../principal.php?menu=$idmenu&act=$act");
    		}
    	break;
    	//altera banner
    	case "Alterar":
    		$act = "mostra";
    		
    		if($_POST["remover"]) {
    			$idbanner = $_POST["idbanner"];
    			
    			$banner = $bannerDAO->getBannerPorId($idbanner);
    			$iddep = $banner->getIddepartamento();
	    		$bannerDAO->Deleta($banner->getIdbanner());
    				header("location: ../principal.php?menu=$idmenu&act=$act&iddep=$iddep");
    		}else{
    			if($_POST["valor"] == "") {
					if($_POST["tempo"] == "0") {
						$tempo = '0000-00-00 00:00:00';
					}else{
						$dias = $_POST["tempo"];
						$dias = "+".$dias." days";			
						$timestamp = strtotime($dias);
						$tempo = date('Y-m-d G:i:s', $timestamp);
					}
				}else{
					$dias = $_POST["valor"];
					$dias = "+".$dias." days";			
					$timestamp = strtotime($dias);
					$tempo = date('Y-m-d G:i:s', $timestamp);
				}
	    		if($_FILES["banner"]["name"] !== "") {	
		    		$name = $_FILES["banner"]["name"];
		    		$type = $_FILES["banner"]["type"];
		    		$tmp_name = $_FILES["banner"]["tmp_name"];
		    		$size = $_FILES["banner"]["size"];
		    		$tamanho = 1000000;
		    	}else{
		    		$name = $_POST["banner"];
		    		$bann = $name;
		    		$ok = true;
		    	}
		    	$setBanner = $name;
	    		$setUrl = $_POST["url"];
	    		$setTarget = $_POST["target"];
	    		$setData = $tempo;
	    		$setIdbanner = $_POST["idbanner"];
	    		$setIddepartamento = $_POST["iddep"];
	    		$setLado = $_POST["lado"];
	    		$setNumero = $_POST["numero"];
	    		$setWidth = $_POST["largura"];
	    		$setHeight = $_POST["altura"];
		    	
		    	$banner->setIdbanner($setIdbanner);
		    	$banner->setLado($setLado);
	    		$banner->setIddepartamento($setIddepartamento);
	    		$banner->setNumero($setNumero);
	    		$banner->setBanner($setBanner);
	    		$banner->setWidth($setWidth);
	    		$banner->setHeight($setHeight);
	    		$banner->setUrl($setUrl);
	    		$banner->setTarget($setTarget);
	    		$banner->setData($setData);
	    	  		   		
	    		if (!isset($bann)) {
	    			$ok = $banner->upload_banners($name,$type,$tmp_name,$size,$tamanho,$banner->getWidth(),$banner->getHeight());
	    		}
	    		
	    		if($ok == true) {
	    			$iddep = $banner->getIddepartamento();
	    			$bannerDAO->Update($banner,$banner->getIdbanner());
	    				header("location: ../principal.php?menu=$idmenu&act=$act&iddep=$iddep");
	    		}
    		}
    	break;  
    	  		
    }
?>