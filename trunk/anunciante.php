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
  <body onload="load()" onunload="GUnload()">
  	<div id="anunciante">
     <? /*
    	echo "<img src=\"".$layout->image_path."images/album/".$anuncio->getImagem1()."\">";
    	echo "<img src=\"".$layout->image_path."images/album/".$anuncio->getImagem2()."\">";
    	echo "<img src=\"".$layout->image_path."images/album/".$anuncio->getImagem3()."\">";
    	echo "<img src=\"".$layout->image_path."images/album/".$anuncio->getImagem4()."\">";
    	*/
    ?>
    
    <table border="0">
    	<tr>
    		<td height="100" valign="top"><? echo "<img src=\"".$layout->image_path."images/logos/".$anuncio->getLogo()."\">"; ?></td>
    		<td align="right" valign="top">
    			<div class="endereco">
    				<p><?=utf8_encode($anuncio->getEndereco());?>, <?=utf8_encode($anuncio->getNumero());?><? if(utf8_encode($anuncio->getComplemento())) echo " - ".utf8_encode($anuncio->getComplemento());?></p>
    				<p><?=utf8_encode($anuncio->getBairro());?> - <?=utf8_encode($anuncio->getCidade());?> - <?=utf8_encode($anuncio->getEstado());?></p>
    				<p><?=utf8_encode($anuncio->getTelefones());?></p>
    				<p><br></p>
    				<p><a href="javascript:void(0)" onclick="contatoAnuncio()">Clique aqui para enviar um e-mail</a></p>
    				<p><a href="javascript:void(0)" onclick="localizacao()"><?=utf8_encode("Clique aqui e veja nossa localização");?></a></p>
    			</div>
    		</td>
    	</tr>
    	<tr>
    		<td colspan="2">
    		<table border="0" cellpadding="0" cellspacing="0">
		    	<tr>
		    		<td width="400" valign="top">
		    			<div id="quadro">
		    				<div id="map" style="width: 390px; height: 250px;"></div>
		    				<div id="contato">
		    				<form method="POST" action="email.php">
		    				<table border="0" cellpadding="0" cellspacing="0" width="98%">
		    					<tr>
		    						<td colspan="2" class="label"><h2>Contato</h2></td>
		    					</tr>
		    					<tr>
		    						<td class="label">Nome:</td>
			            			<td><input type="text" name="nome"></td>
		    					</tr>
		    					<tr>
		    						<td class="label">* E-mail:</td>
			            			<td><input type="text" name="email"></td>
		    					</tr>
		    					<tr>
		    						<td class="label">Telefone:</td>
			            			<td><input type="text" name="telefone"></td>
		    					</tr>
		    					<tr>
		    						<td class="label">* Assunto:</td>
			            			<td><input type="text" name="assunto"></td>
		    					</tr>
		    					<tr>
		    						<td class="label">* Mensagem:</td>
			            			<td>
			            				<textarea name="mensagem" cols="30" rows="4"></textarea>
			            			</td>
		    					</tr>
		    					<tr>
		    						<td class="label"></td>
			            			<td><input type="submit" value="Enviar e-mail"></td>
		    					</tr>
		    				</table>
		    				</form>
		    				</div>
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
		    	<tr><td colspan="2"><h2>Fotos</h2></td></tr>
		    	<tr>
		    		<td colspan="2">
		    			<? if($anuncio->getImagem1() != "") echo "<div style=\"width: 50px; height: 50px; overflow: hidden; float: left;\"><img src=\"".$layout->image_path."images/thumbs/".$anuncio->getImagem1()."\" onclick=\"verFoto('".$layout->image_path."images/album/".$anuncio->getImagem1()."')\"></div>"; ?>
		    			<? if($anuncio->getImagem2() != "") echo "<div style=\"width: 50px; height: 50px; overflow: hidden; float: left;\"><img src=\"".$layout->image_path."images/thumbs/".$anuncio->getImagem2()."\" onclick=\"verFoto('".$layout->image_path."images/album/".$anuncio->getImagem2()."')\"></div>"; ?>
		    			<? if($anuncio->getImagem3() != "") echo "<div style=\"width: 50px; height: 50px; overflow: hidden; float: left;\"><img src=\"".$layout->image_path."images/thumbs/".$anuncio->getImagem3()."\" onclick=\"verFoto('".$layout->image_path."images/album/".$anuncio->getImagem3()."')\"></div>"; ?>
		    			<? if($anuncio->getImagem4() != "") echo "<div style=\"width: 50px; height: 50px; overflow: hidden; float: left;\"><img src=\"".$layout->image_path."images/thumbs/".$anuncio->getImagem4()."\" onclick=\"verFoto('".$layout->image_path."images/album/".$anuncio->getImagem4()."')\"></div>"; ?>
		    		</td>
		    	</tr>
		    </table>
    		</td>
    	</tr>
    	<tr><td align="right" colspan="2"><a href="javascript:window.close();">Fechar Janela</a></td></tr>
    </table>
    </div>
  </body>
</html>