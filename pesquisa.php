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
				<div class="miolo" style="width: 100%;">
					<? 
						if($_GET['totalPP']) {
							$totalPorPagina = $_GET['totalPP'];
						} else {
							$totalPorPagina = 10;
						}
						
						$departamento =$_GET['selDepartamentos'];
						$pesquisa = stripcslashes($_GET['pesquisa']);
																	
						$anuncio = new Anuncio();
						$anuncioDAO = new AnuncioDAO();
						
						if($departamento != "") {
							//$anuncio = $anuncioDAO->ListaAnunciosPorDepartamento($departamento);
							$regra = "where iddepartamento = ".$departamento." and (nome LIKE '%%".$pesquisa."%%' OR endereco LIKE '%%".$pesquisa."%%' OR bairro LIKE '%%".$pesquisa."%%' OR cidade LIKE '%%".$pesquisa."%%' OR estado LIKE '%%".$pesquisa."%%' OR cep LIKE '%%".$pesquisa."%%' OR telefones LIKE '%%".$pesquisa."%%' OR site LIKE '%%".$pesquisa."%%' OR email LIKE '%%".$pesquisa."%%' OR texto LIKE '%%".$pesquisa."%%' OR keywords LIKE '%%".$pesquisa."%%' OR pesquisa LIKE '%%".$pesquisa."%%')";
						} else {
							//$anuncio = $anuncioDAO->ListaAnunciosPorSubDepartamento($sub);
							$regra = "
								WHERE (nome LIKE '%%".$pesquisa."%%' OR endereco LIKE '%%".$pesquisa."%%' OR bairro LIKE '%%".$pesquisa."%%' OR cidade LIKE '%%".$pesquisa."%%' OR estado LIKE '%%".$pesquisa."%%' OR cep LIKE '%%".$pesquisa."%%' OR telefones LIKE '%%".$pesquisa."%%' OR site LIKE '%%".$pesquisa."%%' OR email LIKE '%%".$pesquisa."%%' OR texto LIKE '%%".$pesquisa."%%' OR keywords LIKE '%%".$pesquisa."%%' OR pesquisa LIKE '%%".$pesquisa."%%')
							";
						}
								
						$regra .= " Order by detalhe DESC, acessos DESC, nome ASC";
						
						if($_GET['pag']) {
							$pagina = $_GET['pag'];
						} else {
							$pagina = 0;
						}
						
						$regra = stripslashes($regra);
						
						$inicio = $pagina * $totalPorPagina;
						$anuncio = $anuncioDAO->Paginacao($regra, $inicio, $totalPorPagina);
						
						$totAnuncios = count($anuncio);
						$total = $anuncioDAO->total($regra);
						$paginas = ceil($anuncioDAO->total($regra) / $totalPorPagina);			
											
						$a = 0;
						foreach ($_GET as $chave => $valor) {
							$a != 0 ? $virgula = "&" : $virgula = "";
							if($chave != "btEnviar")
							$dados .= $virgula.$chave."=".htmlentities($valor,ENT_QUOTES,'UTF-8');
							$a++;
						}
						?>
						
						<div id="resultados">
							<ul>
								<li>Encontrados <?=$total;?> anúncios com a palavra: <?=$pesquisa;?></li>
								<li class="totalpagina">Resultados por página
								<select name="totalPP" onchange="reloadPesquisa('<?=$layout->image_path;?>pesquisa.php?<?=$dados?>&totalPP=' + this.value)">
									<option value="10" <? if($totalPorPagina == 10) { echo "selected"; } ?> >10</option>
									<option value="15" <? if($totalPorPagina == 15) { echo "selected"; } ?> >15</option>
									<option value="30" <? if($totalPorPagina == 30) { echo "selected"; } ?> >30</option>
									<option value="50" <? if($totalPorPagina == 50) { echo "selected"; } ?> >50</option>
								</select>
								</li>
							</ul>
						</div>
						
						<?
						
						$layout->mostraAnuncios($anuncio);
						
						$pagina = $pagina + 1;
						$layout->paginacaoPesquisa($pagina,$paginas,$_GET);
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