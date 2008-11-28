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
	$banners = $bannerDAO->ListaBannerPorDepartamentoPosicao(1000,"lateral",10);
?>
<html>
<head>
	<title>OiterBusca</title>
	<meta http-equiv="Content-Type" content="text/html;iso-8859-1">
	<?=$layout->getTheme("");?>
	<link rel="shortcut icon" href="icones/favicon.ico" >
	<script type="text/javascript" src="js/jquery.js"></script>
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
					<td align="left"><img src="images/logos/logo.jpg" alt="OiterBusca um site "/></td>
					<td align="right" style="padding-right: 10px;"><?=$layout->bannersTopo($bannerDAO->ListaBannerPorDepartamentoPosicao(1000,"topo",1));?></td>
					<td align="right" width="186"><?=$layout->bannersTopo($bannerDAO->ListaBannerPorDepartamentoPosicao(1000,"topopeq",1));?></td>
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
							<table border="0" cellpadding="2" cellspacing="2" class="tablePesquisa">
								<tr>
									<td><?=$layout->input("pesquisa","inputPesquisa");?></td>
									<td><?=$layout->selectDepartamentos($departamentos);?></td>
								</tr>
							</table>
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
									<a href="#" class="showAll">Departamentos</a>
									<div id="departamentos" style="display: none;">
										<ul>
											<?=$layout->menuSuperiorDepartamentos($departamentos);?>
										</ul>
									</div>
								</li>
								<li class="novo"><a href="#" class="motors">Motors</a></li>
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
						<?=$layout->bannersEsquerda($bannerDAO->ListaBannerPorDepartamentoPosicao(1000,"topopeq",1));?>
				</div>
				<div class="menu">
						
				</div>
				
				<div class="miolo">
					
				</div>
			</div>
		</div>
		<div id="lateralDireita">
			<?=$layout->bannersLaterais($banners);?>
		</div>
		<div id="footer">
			Modulo Rodapé
		</div>
	</div>
</div>
</body>
</html>