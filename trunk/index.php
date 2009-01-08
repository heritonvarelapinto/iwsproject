<?
	function __autoload($classe) {
		require_once "class/".$classe.".class.php";
	}
	
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
					<td align="left"><a href="<?=$layout->image_path;?>"><img border="0" src="<?=$layout->image_path;?>images/logos/logo.jpg" alt="OiterBusca um site "/></a></td>
					<td align="right" style="padding-right: 10px;"><?=$layout->bannersTopo($bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","topo",1));?></td>
					<td align="right" width="186"><?=$layout->bannersTopo($bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","topopeq",1));?></td>
				</tr>
			</table>
		</div>
		<div id="content">
			<!-- Inicio Header -->
			<div id="header">
				<? $layout->barraPesquisa($departamentos); ?>
		
				<!-- Barra Itens Menu -->
				<div class="menuItens">
					<div class="menuItensEsq">
						<div class="menuItensDir">
							<ul>
								<li>
									<a href="#" class="showAll">Departamentos <img border="0" src="images/seta.gif"></a>
									<div id="departamentos" style="display: none;">
										<ul>
											<?=$layout->menuSuperiorDepartamentos($departamentos);?>
										</ul>
									</div>
								</li>
								<!--<li class="novo"><a href="#" class="motors">Motors</a></li>-->
							</ul>
						</div>
					</div>
				</div>
				<!-- Fim Barra Itens Menu -->
			</div>
			<!-- Fim do Header -->
			<div id="corpo">
				<div class="menu">
						<?=$layout->menuDepartamentos($departamentos);?>
						<?=$layout->bannersEsquerda($bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","lateralesq",3));?>
				</div>
				<div class="miolo">
					<div id="destaqueHome">
						<h2>Destaques</h2>
						<ul>
						<?
							$anuncio = new Anuncio();
							$anuncioDAO = new AnuncioDAO();
							
							$anuncio = $anuncioDAO->ListaAnunciosDestaqueHome();
							$departamento = new Departamento();
							$departamentoDAO = new DepartamentoDAO();
							
							for($i=0; $i < count($anuncio);$i++) {
								
								$departamento = $departamentoDAO->getDepartamentosPorId($anuncio[$i]->getIddepartamento());
								echo "
								<li>
									<img width=\"175\" height=\"80\" alt=\"".$anuncio[$i]->getNome()."\" src=\"".$layout->image_path."images/logos/".$anuncio[$i]->getLogo()."\" onclick=\"contaAcesso('".$anuncio[$i]->getIdAnuncio()."');abrirDestaque('".$layout->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."&p=info','".$anuncio[$i]->getNome()."',700,500)\">
									<p><a href=\"".UrlManage::getUrlCategoria($anuncio[$i]->getIddepartamento(),"",$departamento->getDepartamento())."\">".$departamento->getDepartamento()."</a></p>
								</li>";
							}							
						?>
						</ul>
					</div>
					<div id="homeMeio">
						
					</div>
					<div id="servicos">
						<?=$layout->montaClimaTempo(); ?>
						<?=$layout->montaCotacaoDolar();?>
					</div>
				</div>
			</div>
		</div>
		<div id="lateralDireita">
			<?=$layout->bannersLaterais($banners);?>
		</div>		
		<div id="lateralDireita">
			<?=$layout->boletim();?>
		</div>		
		<div id="lateralDireita">
			<?=$layout->enquete();?>
		</div>
		<?=$layout->rodape();?>
	</div>
</div>
</body>
</html>