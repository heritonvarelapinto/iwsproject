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
		
				<!-- Barra Itens Menu -->
				<div class="menuItens">
					<div class="menuItensEsq">
						<div class="menuItensDir">
							<ul>
								<li>
									<a href="#" class="showAll">Departamentos <img border="0" src="<?=$layout->image_path;?>images/seta.gif"></a>
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
							$regra = "where iddepartamento = ".$departamento." ";
						} else {
							//$anuncio = $anuncioDAO->ListaAnunciosPorSubDepartamento($sub);
							$regra = "
								WHERE (nome LIKE '%%".$pesquisa."%%' OR endereco LIKE '%%".$pesquisa."%%' OR bairro LIKE '%%".$pesquisa."%%' OR cidade LIKE '%%".$pesquisa."%%' OR estado LIKE '%%".$pesquisa."%%' OR cep LIKE '%%".$pesquisa."%%' OR telefones LIKE '%%".$pesquisa."%%' OR site LIKE '%%".$pesquisa."%%' OR email LIKE '%%".$pesquisa."%%' OR texto LIKE '%%".$pesquisa."%%' OR keywords LIKE '%%".$pesquisa."%%' OR pesquisa LIKE '%%".$pesquisa."%%')
							";
						}
								
						$regra .= " Order by acessos DESC, nome ASC";
						
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
						for($i = 0 ; $i < $totAnuncios;$i++) {
							if($i % 2) {
								$cor = "#DDDDDD";
							} else {
								$cor = "#EEEEEE";
							}
							echo "<div id=\"anuncios\" style=\"border-bottom: 1px dashed ".$cor."\">";
							echo "<h3 onclick=\"contaAcesso('".$anuncio[$i]->getIdanuncio()."');abrirDestaque('".$layout->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."&p=info','".$anuncio[$i]->getNome()."',700,500)\">".$anuncio[$i]->getNome()."</h3>";
							echo "<p class=\"direita\">";
							$layout->breadcrumbPesquisa($anuncio[$i]->getIddepartamento(),$anuncio[$i]->getIdsubdepartamento());
							echo $anuncio[$i]->getEndereco().", ".$anuncio[$i]->getNumero()." ".$anuncio[$i]->getComplemento();
							echo "<br>";
							echo $anuncio[$i]->getBairro()." - ".$anuncio[$i]->getCidade()." - ".$anuncio[$i]->getEstado();
							echo "<br>";
							if($anuncio[$i]->getEmail() != "") echo "<b>E-mail: </b>".$anuncio[$i]->getEmail();
							echo "<br>";
							if($anuncio[$i]->getSite() != "") echo "<b>Site: </b><a class=\"site\" onclick=\"contaAcesso('".$anuncio[$i]->getIdanuncio()."');abrirSite('".$anuncio[$i]->getSite()."')\">".$anuncio[$i]->getSite()."</a>";
							echo "<br>";
							echo "<br>";
							echo "<a onclick=\"contaAcesso('".$anuncio[$i]->getIdanuncio()."');this.innerHTML = '".$anuncio[$i]->getTelefones()."'\" id=\"telefone\">Clique aqui para ver o telefone</a>";
							echo "<br>";
							//echo "<a onclick=\"abrirDestaque('".$layout->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."&p=info','".$anuncio[$i]->getNome()."',700,500)\" id=\"mais_info\" title=\"Mais informações\">Saiba um pouco mais sobré nós</a>";
							//echo "<img src=\"\".$layout->image_path."images/info.png\" alt=\"Mais informações\" onclick=\"abrirDestaque('".$layout->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."&p=info','".$anuncio[$i]->getNome()."',700,500)\">";
							echo "</p>";
							echo "<p onclick=\"contaAcesso('".$anuncio[$i]->getIdanuncio()."');abrirDestaque('".$layout->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."&p=info','".$anuncio[$i]->getNome()."',700,500)\" class=\"esquerda\">";
							echo "<img src=\"".$layout->image_path."images/logos/".$anuncio[$i]->getLogo()."\" class=\"borda\">";
							echo "</p>";
							echo "</div>";
						}
						
						$pagina = $pagina + 1;
						$layout->paginacaoPesquisa($pagina,$paginas,$_GET);
					?>
					
				</div>
			</div>
		</div>
		<div id="lateralDireita">
			<?=$layout->bannersLaterais($banners);?>
		</div>
		<?=$layout->rodape();?>
	</div>
</div>
</body>
</html>