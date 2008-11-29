<?php
class Layout extends HTML {
	
	function menuSuperiorDepartamentos($departamentos) {
		$j = 0;
		$totDepartamentos = count($departamentos);
		for($i = 0; $i < $totDepartamentos; $i++) {
			if($j == 12) {
				$fecha = "</ul><ul>";
				$j = 0;
			} else {
				$fecha = "";
			}
			echo $fecha;
			?>
				<li>
					<a href="categoria.php?id=<?=$departamentos[$i]->getIdDepartamento();?>&titulo=<?=$departamentos[$i]->getDepartamento();?>" title="<?=$departamentos[$i]->getDepartamento();?>">
						<?=$departamentos[$i]->getDepartamento();?>
					</a>
				</li>
			<?
			$j++;								
		}
	}

	function menuDepartamentos($departamentos) {
		
		$totDepartamentos = count($departamentos);
		echo "<ul>";
		for($i = 0; $i < $totDepartamentos; $i++) {
		?>
			<li>
				<a href="categoria.php?id=<?=$departamentos[$i]->getIdDepartamento();?>&titulo=<?=$departamentos[$i]->getDepartamento();?>">
					<?=$departamentos[$i]->getDepartamento();?>
				</a>
			</li>
		<?
		}
		?>
		<li class="direita">
			<a href="">
				Ver todos os departamentos
			</a>
		</li>
		<?
		echo "</ul>";
	}
	
	function bannersTopo($banners) {
		?>
		<a href="<?=$banners->getUrl();?>" target="<?=$banners->getTarget();?>">
				<img src="images/banners/<?=$banners->getBanner();?>" alt="<?=$banners->getDescricao();?>" border="0">
		</a>
		<?
	}
	
function bannersEsquerda($banners) {
		
		$totBanners = count($banners);
		/*echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td>";
		echo "<img src=\"images/destaques.gif\">";
		echo "</td></tr>";
		echo "</table>";*/
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#CCC\">";
		echo "<tr><td>";
		echo "<ul>";
		if($totBanners > 1) {
			for($i = 0; $i < $totBanners; $i++) {
			?>
				<li>
					<a href="<?=$banners[$i]->getUrl();?>" target="<?=$banners[$i]->getTarget();?>">
						<img src="images/banners/<?=$banners[$i]->getBanner();?>" alt="<?=$banners[$i]->getDescricao();?>" border="0">
					</a>
				</li>
			<?
			}
		} else {
			?>
				<li>
					<a href="<?=$banners->getUrl();?>" target="<?=$banners->getTarget();?>">
						<img src="images/banners/<?=$banners->getBanner();?>" alt="<?=$banners->getDescricao();?>" border="0">
					</a>
				</li>
			<?
		}
		echo "</ul>";
		echo "</td></tr>";
		echo "</table>";
	}
	
	function bannersLaterais($banners) {
		
		$totBanners = count($banners);
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td>";
		echo "<img src=\"images/destaques.gif\">";
		echo "</td></tr>";
		echo "</table>";
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bordaDestaque\">";
		echo "<tr><td>";
		echo "<ul>";
		if($totBanners > 1) {
			for($i = 0; $i < $totBanners; $i++) {
			?>
				<li>
					<a href="<?=$banners[$i]->getUrl();?>" target="<?=$banners[$i]->getTarget();?>">
						<img src="images/banners/<?=$banners[$i]->getBanner();?>" alt="<?=$banners[$i]->getDescricao();?>" border="0">
					</a>
				</li>
			<?
			}
		} else {
			?>
				<li>
					<a href="<?=$banners->getUrl();?>" target="<?=$banners->getTarget();?>">
						<img src="images/banners/<?=$banners->getBanner();?>" alt="<?=$banners->getDescricao();?>" border="0">
					</a>
				</li>
			<?
		}
		echo "</ul>";
		echo "</td></tr>";
		echo "</table>";
	}
	
	function getTheme($cor = "") {
		if($cor!="") {
			echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"css/padrao_".$cor.".css\"/>";
		} else {
			echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"css/padrao.css\"/>";
		}
	}
}
?>
