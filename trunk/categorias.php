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
	$subdepartamentoDAO = new SubdepartamentoDAO();
	$subdepartamentos = $departamentoDAO->ListaSubdepartamentos($id);
	
	$layout = new Layout();
	$departamentos = new Departamento();
	$departamentosDAO = new DepartamentoDAO();
	$departamentos = $departamentosDAO->Lista();
	$nomeDepartamento = $departamentosDAO->getDepartamentosPorId($id);
	
	if($sub != "") {
		$nomeSubDepartamento = $subdepartamentoDAO->getSubdepartamentosPorId($sub);
	}
	
	$banners = new Banner();
	$bannerDAO = new BannerDAO();
	$banners = $bannerDAO->ListaBannerPorDepartamentoPosicao($id,"lateral",10);

	if(count($banners) == 0) {
		$banners = $bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","lateral",10);
	}
	
	$topoPeq = $bannerDAO->ListaBannerPorDepartamentoPosicao($id,"topopeq",1);
	$topo	 = $bannerDAO->ListaBannerPorDepartamentoPosicao($id,"topo",1);
	
	if(count($topoPeq) == 0) {
		$topoPeq = $bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","topopeq",1);
	}
	
	if(count($topo) == 0) {
		$topo = $bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","topo",1);
	}
	
?>
<html>
<?=$layout->head($nomeDepartamento,$nomeSubDepartamento);?>
<body>
<div>
	<div id="main">
		<div id="barraLogo">
			
			<table class="logo">
				<tr>
					<td align="left"><a href="<?=$layout->image_path;?>"><img border="0" src="<?=$layout->image_path;?>images/logos/logo.jpg" alt="OiterBusca um site "/></a></td>
					<td align="right" style="padding-right: 10px;"><?=$layout->bannersTopo($topo);?></td>
					<td align="right" width="186"><?=$layout->bannersTopo($topoPeq);?></td>
				</tr>
			</table>
		</div>
		<div id="content">
			<!-- Inicio Header -->
			<div id="header">
				<? $layout->barraPesquisa($departamentos); ?>
				<? $layout->barraItensMenu($departamentos);?>
			</div>
			<!-- Fim do Header -->
			<div id="corpo">
				<div class="menu">
						<?
							if($id != "") {
								$subdepartamento = new Subdepartamento();
								$subdepartamentoDAO = new SubdepartamentoDAO();
								$subdepartamentos = $subdepartamentoDAO->getSubdepartamentosPorIddepartamento($id);
								if(count($subdepartamentos) == 0) {
									$layout->menuDepartamentos($departamentos, $id);
								} else {
									$layout->menuSubDepartamentos($subdepartamentos, $sub);
								}
							}
						
						echo $layout->bannersEsquerda($bannerDAO->ListaBannerPorDepartamentoPosicao($id,"lateralesq",3));?>
				</div>
				<div class="miolo">
					<? 
						if($_GET['totalPP']) {
							$totalPorPagina = $_GET['totalPP'];
						} else {
							$totalPorPagina = 10;
						}
												
						$anuncio = new Anuncio();
						$anuncioDAO = new AnuncioDAO();
						if($sub == "") {
							$anuncio = $anuncioDAO->ListaAnunciosPorDepartamento($id);
							$regra = "where iddepartamento = ".$id." ";
						} else {
							$anuncio = $anuncioDAO->ListaAnunciosPorSubDepartamento($sub);
							$regra = "where idsubdepartamento = ".$sub." ";
						}
						
						$totAnuncios = count($anuncio);
						if($totAnuncios > 0) {
							$paginas = ceil($totAnuncios / $totalPorPagina);				
												
							if($_GET['pag']) {
								$pagina = $_GET['pag'];
							} else {
								$pagina = 0;
							}
							
							
							$layout->breadcrumb($id,$sub);
							
							echo "<div id=\"resultados\"><ul>
								<li>Encontrados ".$totAnuncios." anúncios</li>
								<li class=\"totalpagina\">Resultados por página
								<select name=\"totalPP\" onchange=\"reload('".$id."','".$sub."','".$pagina."',this.value,'".$layout->image_path."')\">";
								?>
										<option value="10" <? if($totalPorPagina == 10) { echo "selected"; } ?> >10</option>
										<option value="15" <? if($totalPorPagina == 15) { echo "selected"; } ?> >15</option>
										<option value="30" <? if($totalPorPagina == 30) { echo "selected"; } ?> >30</option>
										<option value="50" <? if($totalPorPagina == 50) { echo "selected"; } ?> >50</option>
								<?
								echo "</select>
								</li>
							</ul></div>";
							
							$inicio = $pagina * $totalPorPagina;
						
							$regra .= "Order by detalhe DESC, acessos DESC, nome ASC";
							
							$anuncio = $anuncioDAO->Paginacao($regra, $inicio, $totalPorPagina);
							
							$layout->mostraAnuncios($anuncio);
							
							$pagina = $pagina + 1;
							$layout->paginacaoAnuncio($pagina,$paginas,$id,$sub,$totalPorPagina);
						} else {
							echo "Sem anúncios no cadastro";
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