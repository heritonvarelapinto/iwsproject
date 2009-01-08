<?php
function __autoload($classe) {
		require_once "class/".$classe.".class.php";
	}
	$id = $_GET['id'];
	$titulo = $_GET['titulo'];
	$sub = $_GET['sub'];
	$subtitulo = $_GET['subtitulo'];
	$cid = $_GET['cid'];
	$cliente = $_GET['cliente'];
	
	$departamentoDAO = new DepartamentoDAO();
	$subdepartamentos = $departamentoDAO->ListaSubdepartamentos($id);
	
	$layout = new Layout();
	$departamentos = new Departamento();
	$departamentosDAO = new DepartamentoDAO();
	$departamentos = $departamentosDAO->Lista();
	$nomeDepartamento = $departamentosDAO->getDepartamentosPorId($id);
	$banners = new Banner();
	$bannerDAO = new BannerDAO();
	$banners = $bannerDAO->ListaBannerPorDepartamentoPosicao($id,"lateral",10);
	if(count($banners == 0)) {
		$banners = $bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","lateral",10);
	}
?>
<html>
<head>
<?=$layout->head($nomeDepartamento);?>
<body>
<div>
	<div id="main">
		<div id="barraLogo">
			
			<table class="logo">
				<tr>
					<td align="left"><a href="<?=$layout->image_path;?>"><img border="0" src="<?=$layout->image_path;?>images/logos/logo.jpg" alt="OiterBusca um site "/></a></td>
					<td align="right" style="padding-right: 10px;"><?=$layout->bannersTopo($bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","topo",1));?></td>
					<td align="right" width="186"><?=$layout->bannersTopo($bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","topopeq",1));?></td>
				</tr>
			</table>
			
		</div>
		<div id="content">
			<!-- Inicio Header -->
			<div id="header">
				<? $layout->barraPesquisa($departamentos);?>
				<? $layout->barraItensMenu($departamentos);?>
			</div>
			<!-- Fim do Header -->
			<div id="corpo">
				<div class="lista">
				<?
					$subdepartamentoDAO = new SubdepartamentoDAO();
					$totDepartamentos = count($departamentos);
					for($i = 0; $i < $totDepartamentos ; $i++) {
						echo "<ul id=\"listaDepartamento\">";
						$subdepartamentos = $subdepartamentoDAO->getSubdepartamentosPorIddepartamento($departamentos[$i]->getIddepartamento());
						$totSubdepartamento = count($subdepartamentos);
						echo "<li class=\"categoria\"><a href=\"".UrlManage::getUrlCategoria($departamentos[$i]->getIddepartamento(),"",$departamentos[$i]->getDepartamento())."\" title=\"".$departamentos[$i]->getDepartamento()."\">".$departamentos[$i]->getDepartamento()." (".$subdepartamentoDAO->contaAnuncios($departamentos[$i]->getIddepartamento(),"departamento").")</a>";
						if($totSubdepartamento > 0) {
							/*echo "(".$totSubdepartamento.")";*/
							echo "<ul>";
							for($y = 0; $y < $totSubdepartamento; $y++) {
								echo "<li class=\"subcategoria\"><a href=\"".UrlManage::getUrlSubCategoria($departamentos[$i]->getIddepartamento(),$departamentos[$i]->getDepartamento(),$subdepartamentos[$y]->getIdSubdepartamento(),$subdepartamentos[$y]->getSubdepartamento())."\" title=\"".$subdepartamentos[$y]->getSubdepartamento()."\">".$subdepartamentos[$y]->getSubdepartamento()." (".$subdepartamentoDAO->contaAnuncios($subdepartamentos[$y]->getIdsubdepartamento()).")</a></li>";
							}
							echo "</ul></li>";
							
						} else {
							echo "</li>";
						}
						echo "</ul>";
					}
				?>
				</div>
			</div>
		</div>
		<?=$layout->lateralDireita($banners);?>
		<?=$layout->rodape();?>
	</div>
</div>
</body>
</html>