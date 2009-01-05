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
	<title>OiterBusca - Todos os departamentos</title>
	<meta http-equiv="Content-Type" content="text/html;iso-8859-1">
	<?=$layout->getTheme("");?>
	<link rel="shortcut icon" href="<?=$layout->image_path;?>icones/favicon.ico" >
	<script type="text/javascript" src="<?=$layout->image_path;?>js/jquery.js"></script>
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
					<td align="right" style="padding-right: 10px;"><?=$layout->bannersTopo($bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","topo",1));?></td>
					<td align="right" width="186"><?=$layout->bannersTopo($bannerDAO->ListaBannerPorDepartamentoPosicao("inicial","topopeq",1));?></td>
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
				<div class="lista">
				<?
					$subdepartamentoDAO = new SubdepartamentoDAO();
					$totDepartamentos = count($departamentos);
					
					for($i = 0; $i < $totDepartamentos ; $i++) {
						echo "<ul id=\"listaDepartamento\">";
						$subdepartamentos = $subdepartamentoDAO->getSubdepartamentosPorIddepartamento($departamentos[$i]->getIddepartamento());
						$totSubdepartamento = count($subdepartamentos);
						echo "<li class=\"categoria\"><a href=\"".UrlManage::getUrlCategoria($departamentos[$i]->getIddepartamento(),"",$departamentos[$i]->getDepartamento())."\" title=\"".$departamentos[$i]->getDepartamento()."\">".$departamentos[$i]->getDepartamento()."</a>";
						if($totSubdepartamento > 0) {
							echo "(".$totSubdepartamento.")";
							echo "<ul>";
							for($y = 0; $y < $totSubdepartamento; $y++) {
								echo "<li class=\"subcategoria\"><a href=\"".UrlManage::getUrlSubCategoria($departamentos[$i]->getIddepartamento(),$departamentos[$i]->getDepartamento(),$subdepartamentos[$y]->getIdSubdepartamento(),$subdepartamentos[$y]->getSubdepartamento())."\" title=\"".$subdepartamentos[$y]->getSubdepartamento()."\">".$subdepartamentos[$y]->getSubdepartamento()."</a></li>";
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
		<div id="lateralDireita">
			<?=$layout->bannersLaterais($banners);?>
		</div>
		<?=$layout->rodape();?>
	</div>
</div>
</body>
</html>