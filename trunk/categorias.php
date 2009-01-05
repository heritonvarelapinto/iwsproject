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
<head>
	<title>OiterBusca - <?=$nomeDepartamento->departamento;?> <? if($nomeSubDepartamento) { echo " / "; ?><?=$nomeSubDepartamento->subdepartamento;?><? } ?></title>
	<meta http-equiv="Content-Type" content="text/html;iso-8859-1">
	<?=$layout->getTheme("");?>
	<link rel="shortcut icon" href="<?=$layout->image_path;?>icones/favicon.ico" >
	<script type="text/javascript" src="<?=$layout->image_path;?>js/jquery.js"></script>
	<script type="text/javascript" src="<?=$layout->image_path;?>js/jquerycalendar.js"></script>
	<script type="text/javascript" src="<?=$layout->image_path;?>js/funcoes.js"></script>
	<script>
		varover = 0;
		$(document).ready(function(){
				var nav = $('#userAgent').html(navigator.userAgent);
				
				$("#departamentos").hide();
				
				if(varover == 0) {
					$("a.showAll").mouseover ( function(event){
						//Seta a posicao do departamentos pro tamanho do browser
						var offset = $("a.showAll").offset();
						offset.top = $("a.showAll").offset().top + 18;
						
						$("#departamentos").css(offset);
						$("#departamentos").fadeIn(300);
						varover = 1;
					} );
				}

				$("a.motors").mouseover ( function(event){
					$("#departamentos").fadeOut(100);
					varover = 0;
				} );
				
				$("#departamentos").mouseout ( function(event){
					$("#departamentos").hide();
					varover = 0;
				} );

				$("#departamentos").mouseover ( function(event){
					$("#departamentos").show();
				} );
				
				$(".menuPesquisa").mouseover ( function(event){
					$("#departamentos").fadeOut(100);
					varover = 0;
				} );
				
		 });
	</script>
</head>

<body>
<div>
	<div id="main">
		<div id="barraLogo">
			
			<table class="logo">
				<tr>
					<td align="left"><img src="<?=$layout->image_path;?>images/logos/logo.jpg" alt="OiterBusca um site "/></td>
					<td align="right" style="padding-right: 10px;"><?=$layout->bannersTopo($topo);?></td>
					<td align="right" width="186"><?=$layout->bannersTopo($topoPeq);?></td>
				</tr>
			</table>
			
		</div>
		<div id="content">
			<!-- Inicio Header -->
			<div id="header">
				<!-- Barra Pesquisa -->
				<div class="menuPesquisa">
					<div class="menuPesquisaEsq">
						<div class="menuPesquisaDir">
							<form method="POST" action="pesquisa.php">
							<table border="0" cellpadding="2" cellspacing="2" class="tablePesquisa">
								<tr>
									<td><?=$layout->input("pesquisa","inputPesquisa");?></td>
									<td><?=$layout->selectDepartamentos($departamentos);?></td>
									<td><?=$layout->button("btEnviar","button","Buscar");?> </td>
									<!--<td><?=$layout->button("btEnviar","button","Pesquisa avan�ada");?> </td>-->
								</tr>
							</table>
							</form>
						</div>
					</div>
				</div>
				<!-- Fim Barra Pesquisa -->
		
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
					<?=$layout->breadcrumb($id,$sub);?>
					
					<? 
						$anuncio = new Anuncio();
						$anuncioDAO = new AnuncioDAO();
						if($sub == "") {
							$anuncio = $anuncioDAO->ListaAnunciosPorDepartamento($id);
						} else {
							$anuncio = $anuncioDAO->ListaAnunciosPorSubDepartamento($sub);
						}
						$totAnuncios = count($anuncio);
						for($i = 0 ; $i < $totAnuncios;$i++) {
							if($i % 2) {
								$cor = "#DDDDDD";
							} else {
								$cor = "#EEEEEE";
							}
							echo "<div id=\"anuncios\" style=\"border-bottom: 1px dashed ".$cor."\">";
							echo "<h3>".$anuncio[$i]->getNome()."</h3>";
							echo "<p class=\"direita\">";
							echo $anuncio[$i]->getEndereco().", ".$anuncio[$i]->getNumero()." ".$anuncio[$i]->getComplemento();
							echo "<br>";
							echo $anuncio[$i]->getBairro()." - ".$anuncio[$i]->getCidade()." - ".$anuncio[$i]->getEstado();
							echo "<br>";
							if($anuncio[$i]->getEmail() != "") echo "<b>E-mail: </b>".$anuncio[$i]->getEmail();
							echo "<br>";
							if($anuncio[$i]->getSite() != "") echo "<b>Site: </b>".$anuncio[$i]->getSite();
							echo "<br>";
							echo "<a onclick=\"this.innerHTML = '".$anuncio[$i]->getTelefones()."'\" id=\"telefone\">Clique aqui para ver o telefone</a>";
							echo "<br>";
							echo "<img src=\"".$layout->image_path."images/info.png\" alt=\"Mais informa��es\" onclick=\"abrirDestaque('".$layout->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."','".$anuncio[$i]->getNome()."',700,500)\">";
							echo "<img src=\"".$layout->image_path."images/mapa.png\" alt=\"Aonde fica ?\" onclick=\"abrirDestaque('".$anuncio[$i]->getIdAnuncio()."')\">";
							if($anuncio[$i]->getEmail() != "") echo "<img src=\"".$layout->image_path."images/mail.png\" alt=\"Mande sua mensagem\">";
							echo "<img src=\"".$layout->image_path."images/foto.png\"alt=\"Fotos\">";
							echo "</p>";
							echo "<p class=\"esquerda\">";
							echo "<img src=\"".$layout->image_path."images/logos/".$anuncio[$i]->getLogo()."\">";
							echo "</p>";
							echo "</div>";
						}
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