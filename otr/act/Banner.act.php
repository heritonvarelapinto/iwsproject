<?php
	//Auth::verificaAcesso();
	function __autoload($classe)
    {
        require_once "../../class/".$classe.".class.php";
    }
	
	$banner = new Banner();
	$bannerDAO = new BannerDAO();
	
	$clienteDAO = new ClienteDAO();
	$cliente = $clienteDAO->getUsuarioPorNome("Oiter Busca");
		
	//$acao = $_GET["acao"];
	$acao = "Adicionar";
	
	$idmenu = 3;
	
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
    		/*echo $name = "bann468x80.GIF";//$_FILES["banner"]["name"];
    		echo $type = "image/gif";//$_FILES["banner"]["type"];
    		echo $tmp_name = "C:\WINDOWS\Temp\phpF5.tmp";//$_FILES["banner"]["tmp_name"];
    		echo $size = "2063";//$_FILES["banner"]["size"];*/
    		
    		$tamanho = 800000;
    		/*$setBanner = $name;
    		$setUrl = "www.clicknobairro.com.br";//$_POST["url"];
    		$setTarget = "_self";//$_POST["target"];
    		$setData = "0000-00-00 00:00:00";//$tempo;
    		$setIddepartamento = "inicial";//$_POST["iddep"];
    		$setLado = "topo";//$_POST["lado"];
    		$setNumero = "5";//$_POST["numero"];
    		$setWidth = "468";//$_POST["largura"];
    		$setHeight = "80";//$_POST["altura"];*/
    		
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
    			echo "falha";
    		}
    	break;
    	//altera um usuario
    	case "Alterar":
    		
    	break;    		
    }
?>