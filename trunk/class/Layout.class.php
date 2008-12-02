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
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
		echo "<img src=\"images/departamentos.gif\">";
		echo "</td></tr></table>";
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
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
				» Ver todos os departamentos
			</a>
		</li>
		<?
		echo "</ul>";
		echo "</td></tr></table>";
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
		echo "<br>";
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td>";
		echo "<ul>";
		if($totBanners > 1) {
			for($i = 0; $i < $totBanners; $i++) {
			?>
				<li>
					<a class="bannerEsq" href="<?=$banners[$i]->getUrl();?>" target="<?=$banners[$i]->getTarget();?>">
						<img src="images/banners/<?=$banners[$i]->getBanner();?>" alt="<?=$banners[$i]->getDescricao();?>" border="0">
					</a>
				</li>
			<?
			}
		} else {
			?>
				<li>
					<a class="bannerEsq" href="<?=$banners->getUrl();?>" target="<?=$banners->getTarget();?>">
						<img src="images/banners/<?=$banners->getBanner();?>" alt="<?=$banners->getDescricao();?>" border="0">
					</a>
				</li>
			<?
		}
		echo "</ul>";
		echo "</td></tr>";
		echo "</table>";
	}
	
		function enquete() {
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td>";
		echo "<img src=\"images/enquete.gif\">";
		echo "</td></tr>";
		echo "</table>";
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bordaDestaque\">";
		echo "<tr><td>";
/*		echo "<ul>";
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
		echo "</ul>";*/
		echo "</td></tr>";
		echo "</table>";
	}
	
	function boletim() {
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td>";
		echo "<img src=\"images/boletim.gif\">";
		echo "</td></tr>";
		echo "</table>";
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bordaDestaque\">";
		echo "<tr><td>";
		echo "<ul id=\"boletim\">";
		echo "<li class=\"textoDestaque\">Cadastre-se e participe todas as semanas de nossas promoções.</li>";
		echo "<li> Insira seu nome:</li>";
		echo "<li><input type=\"text\" id=\"nome\" name=\"nome\"/></li>";
		echo "<li> Qual é o seu e-mail ?</li>";
		echo "<li><input type=\"text\" id=\"email\" name=\"email\"/></li>";
		echo "<li><center><input type=\"button\" onclick=\"insereBoletim();\" value=\"Cadastrar\" class=\"botao_boletim\"/></center></li>";		
		echo "</ul>";
/*		echo "<ul>";
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
		echo "</ul>";*/
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
	
	function rodape() {
		echo "<div id=\"footer\">";
		echo "<ul>";
		echo "<li class=\"primeiro\"><a href=\"sobre.php\">Sobre a Oiter Brasil</a></li>";
		echo "<li class=\"vermelho\"><a href=\"publicidade.php\">Publicidade</a></li>";
		echo "<li class=\"azul\"><a href=\"parcerias.php\">Seja um parceiro</a></li>";
		echo "<li class=\"azulClaro\"><a href=\"contato.php\">Fale com a OITER</a></li>";
		echo "<li class=\"amarelo\"><a href=\"imprensa.php\">Oiter na mídia</a></li>";
		echo "<li class=\"amareloEscuro\"><a href=\"imprensa.php\">Nossa Missão</a></li>";
		echo "</ul>";
		$this->copyright();
		echo "</div>";
	}
	
	function copyright() {
		echo "<p class=\"copyright\">Copyright © 2007-".date("Y")." - OITERBUSCA.com | Todos os direitos reservados. Marcas comerciais e as Logos são de propriedade de seus respectivos proprietários. O uso deste site implica a aceitação do acordo OiterBusca <a href=\"uso.php\">Política de Uso</a> e a <a href=\"privacidade.php\">Política de Privacidade</a>.</p>";
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
