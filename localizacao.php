<?
	function __autoload($classe) {
		require_once "class/".$classe.".class.php";
	}	
	
	$id = $_REQUEST['id'];
	
	$layout = new Layout();
	$anuncio = new Anuncio();
	$anuncioDAO = new AnuncioDAO();
	
	$anuncio = $anuncioDAO->getAnuncioPorId($id);		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
    <title>Mapa do local</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAdYDULndWHw73mv6IA5TzQxRMtg-kJ86tYRuSzULgUSI7o9IM_xTBnZ5iDcBkLKVAq13VtrFrxJwhxA" type="text/javascript"></script>
    <script>
    //<![CDATA[
    
    function load() {
		if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map"));
			/*Início GeoCoder — localização pelo endereço*/
			var address = '<?=$anuncio->getEndereco();?> - <?=$anuncio->getNumero();?>, <?=$anuncio->getCep();?>, <?=$anuncio->getCidade();?>, <?=$anuncio->getEstado();?>, Brasil';
			var geocoder = new GClientGeocoder;
			if(geocoder) {
					geocoder.getLatLng( 
					address,
					function(point) {
	            		if (!point) {
							alert(address + " Não encontrado");
	            		} else {
					        map.setCenter(point, 15);
 							map.addControl(new GSmallMapControl());
        					var mapControl = new GMapTypeControl();
        					map.addControl(mapControl);
							var html = '<div style=" float: left; padding-right: 0px; font: bold 11px Trebuchet MS, Arial, Helvetica, sans-serif;"><? if($anuncio->getLogo()) { ?><img src="<?=$layout->image_path;?>images/logos/<?=$anuncio->getLogo();?>" ><br/><? } ?><?=$anuncio->getNome();?><br><?=$anuncio->getEndereco()." - ".$anuncio->getNumero();?><br><?=$anuncio->getTelefones();?><\/div>';
		            		var marker = new GMarker(point,{title:"<?=$anuncio->getNome();?>"});
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
    <div id="map" style="width: 400px; height: 250px;"></div>
    <? 
    	echo $anuncio->getTexto();
    ?>
  </body>
</html>