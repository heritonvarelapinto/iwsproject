<?
	function __autoload($classe) {
		require_once "class/".$classe.".class.php";
	}	
	
	$id = $_REQUEST['id'];	
	$p = $_GET['p'];
	
	$layout = new Layout();
	$anuncio = new Anuncio();
	$anuncioDAO = new AnuncioDAO();
	
	$anuncio = $anuncioDAO->getAnuncioPorId($id);		
	$key['local']  = "ABQIAAAAdYDULndWHw73mv6IA5TzQxRMtg-kJ86tYRuSzULgUSI7o9IM_xTBnZ5iDcBkLKVAq13VtrFrxJwhxA";
	$key['online'] = "ABQIAAAAdYDULndWHw73mv6IA5TzQxRQnSlT4KQ-GYzt3qGqXg8vKTdKzBSXAZnS0UBwi2weHwDkS7HX_OEF6Q";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title><?=utf8_encode($anuncio->getNome());?></title>
    <?=$layout->getTheme("");?>
	<link rel="shortcut icon" href="<?=$layout->image_path;?>icones/favicon.ico" >
	<script type="text/javascript" src="<?=$layout->image_path;?>js/jquery.js"></script>
	<script type="text/javascript" src="<?=$layout->image_path;?>js/funcoes.js"></script>
	<script>
	$(document).ready(function(){
		$("#map").show();
		$("#contato").hide();
		$("#foto").hide();				
	});	
	</script>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?=$key['online']; ?>" type="text/javascript"></script>
    <script>
    //<![CDATA[
    
    function load() {
		if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map"));
			/*Início GeoCoder — localização pelo endereço*/
			var address = '<?=utf8_encode($anuncio->getEndereco());?> - <?=$anuncio->getNumero();?>, <?=$anuncio->getCep();?>, <?=$anuncio->getCidade();?>, <?=$anuncio->getEstado();?>, Brasil';
			var geocoder = new GClientGeocoder;
			if(geocoder) {
					geocoder.getLatLng( 
					address,
					function(point) {
	            		if (!point) {
							alert("Erro ao localizar");
	            		} else {
					        map.setCenter(point, 15);
 							map.addControl(new GSmallMapControl());
        					var mapControl = new GMapTypeControl();
        					map.addControl(mapControl);
							var html = '<div style="text-align: left; float: left; padding-right: 0px; font: bold 11px Trebuchet MS, Arial, Helvetica, sans-serif;"><?=utf8_encode($anuncio->getNome());?><br><?=utf8_encode($anuncio->getEndereco())." - ".$anuncio->getNumero();?><br><?=$anuncio->getTelefones();?><\/div>';
		            		var marker = new GMarker(point,{title:"<?=utf8_encode($anuncio->getNome());?>"});
              				map.addOverlay(marker);
           					marker.openInfoWindowHtml(html);
		            	}
					}
				);
			}

		}
    }
    
    //]]>
    </script>
  </head>
  <body onload="load()">
  	<div id="anunciante">   
    <table border="0" width="100%">
    	<tr>
    		<td height="100" width="40%" valign="top"><? echo "<img src=\"".$layout->image_path."images/logos/".$anuncio->getLogo()."\" alt=\"".utf8_encode($anuncio->getNome())."\" title=\"".utf8_encode($anuncio->getNome())."\">"; ?></td>
    		<td align="right" valign="top">
    			<div class="endereco">
    				<p><b><?=utf8_encode("Endereço");?>:</b> <?=utf8_encode($anuncio->getEndereco());?>, <?=utf8_encode($anuncio->getNumero());?><? if(utf8_encode($anuncio->getComplemento())) echo " - ".utf8_encode($anuncio->getComplemento());?></p>
    				<p><?=utf8_encode($anuncio->getBairro());?> - <?=utf8_encode($anuncio->getCidade());?> - <?=utf8_encode($anuncio->getEstado());?></p>
    				<p><?=utf8_encode($anuncio->getTelefones());?></p>
    				<p><br></p>
    				<p><a title="Clique aqui entrar em contato" href="javascript:void(0)" onclick="contatoAnuncio('<?=$anuncio->getIdanuncio();?>')">Clique aqui entrar em contato</a></p>
    				<p><a title="<?=utf8_encode("Clique aqui e veja nossa localização");?>" href="javascript:void(0)" onclick="localizacao()"><?=utf8_encode("Clique aqui e veja nossa localização");?></a></p>
    			</div>
    		</td>
    	</tr>
    	<tr>
    		<td colspan="2">
    		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		    	<tr>
		    		<td width="400" valign="top">
		    			<div id="quadro">
		    				<div id="map" style="width: 390px; height: 300px;"></div>
		    				<div id="contato"></div>
		    				<div id="foto"></div>
	    				</div>
		    		</td>
		    		<td valign="top">
		    			<h2><? echo utf8_encode($anuncio->getNome()); ?></h2>
		    			<div class="texto" style="overflow: auto; height: 220px;">
		    			<? echo utf8_encode($anuncio->getTexto()); ?>
		    			</div>
		    		</td>
		    	</tr>
		    	<tr><td colspan="2">&nbsp;</td></tr>
		    	<?
		    	$ok = false;

		    	for($i=1; $i <= 4;$i++) {
					$imagem = "getImagem".$i;
		    		if($anuncio->$imagem() != "") {
			    		$ok = true;
			    		break;	
			    	}
		    	}
		    	
		    	if($ok == true) {
		    		?>
			    	<tr><td colspan="2" height="20"><h2>Fotos</h2></td></tr>
			    	<tr>
			    		<td colspan="2" height="50">
			    			<? if($anuncio->getImagem1() != "") echo "<div class=\"thumb\"><img src=\"".$layout->image_path."images/thumbs/".$anuncio->getImagem1()."\" onclick=\"verFoto('".$layout->image_path."images/album/".$anuncio->getImagem1()."')\"></div>"; ?>
			    			<? if($anuncio->getImagem2() != "") echo "<div class=\"thumb\"><img src=\"".$layout->image_path."images/thumbs/".$anuncio->getImagem2()."\" onclick=\"verFoto('".$layout->image_path."images/album/".$anuncio->getImagem2()."')\"></div>"; ?>
			    			<? if($anuncio->getImagem3() != "") echo "<div class=\"thumb\"><img src=\"".$layout->image_path."images/thumbs/".$anuncio->getImagem3()."\" onclick=\"verFoto('".$layout->image_path."images/album/".$anuncio->getImagem3()."')\"></div>"; ?>
			    			<? if($anuncio->getImagem4() != "") echo "<div class=\"thumb\"><img src=\"".$layout->image_path."images/thumbs/".$anuncio->getImagem4()."\" onclick=\"verFoto('".$layout->image_path."images/album/".$anuncio->getImagem4()."')\"></div>"; ?>
			    		</td>
			    	</tr>
			    	<?
		    	} else {
		    		?><tr><td colspan="2" height="70">&nbsp;</td></tr><?
		    	}
		    	?>
		    </table>
    		</td>
    	</tr>
    	<tr><td align="right" colspan="2"><a href="javascript:window.close();">Fechar Janela</a></td></tr>
    	<tr><td align="right" colspan="2"><img src="<?=$layout->image_path;?>/images/logos/miniLogo.png" title="Criado por OiterBusca" alt="Mini Logo Oiter"></td></tr>
    </table>
    </div>
  </body>
</html>