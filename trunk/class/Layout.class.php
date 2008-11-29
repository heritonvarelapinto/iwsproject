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
					<a href="categoria.php?id=<?=$departamentos[$i]->getIdDepartamento();?>&titulo=<?=$departamentos[$i]->getDepartamento();?>">
						<?=$departamentos[$i]->getDepartamento();?>
					</a>
				</li>
			<?
			$j++;								
		}
	}

	function menuDepartamentos($departamentos) {
		
		$totDepartamentos = count($departamentos);
		
		for($i = 0; $i < $totDepartamentos; $i++) {
		?>
			<li>
				<a href="categoria.php?id=<?=$departamentos[$i]->getIdDepartamento();?>&titulo=<?=$departamentos[$i]->getDepartamento();?>">
					<?=$departamentos[$i]->getDepartamento();?>
				</a>
			</li>
		<?
		}
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