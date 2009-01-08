<?php
	function __autoload($classe) {
		require_once "class/".$classe.".class.php";
	}
	
	$id = $_GET['id'];
	$titulo = $_GET['titulo'];
	
	$pagina = new Rodape();
	$paginaDAO = new RodapeDAO();	
	$pagina = $paginaDAO->getRodapePorId($id);
	
	$layout = new Layout();
	$departamentos = new Departamento();
	$departamentosDAO = new DepartamentoDAO();
	$departamentos = $departamentosDAO->Lista();
	
	$banners = new Banner();
	$bannerDAO = new BannerDAO();
	$banners = $bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","lateral",10);
?>
<html>
<?=$layout->head();?>
<body>
<div>
	<div id="main">
		<div id="barraLogo">
			
			<table class="logo">
				<tr>
					<td align="left"><img src="<?=$layout->image_path;?>images/logos/logo.jpg" alt="OiterBusca um site "/></td>
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
				<div class="menu">
						<?=$layout->menuDepartamentos($departamentos);?>
						<?=$layout->bannersEsquerda($bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","lateralesq",3));?>
				</div>
				<div class="miolo">
					<h3><?=$pagina->titulo;?></h3>
					<p>
						<?=nl2br($pagina->texto);?>
						<? $pos = strpos(strtoupper($pagina->titulo), "FALE"); 
							if((string)$pos === (string)0) {
								echo $layout->formContato();
							}
						?>
					</p>
				</div>
			</div>
		</div>
		<?=$layout->lateralDireita($banners);?>
		<?=$layout->rodape();?>
	</div>
</div>
</body>
</html>