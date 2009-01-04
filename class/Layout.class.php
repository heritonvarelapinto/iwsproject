<?php
class Layout extends HTML {
	
	var $image_path = "http://localhost/oiter/";
	
	function mes($mes) {
		switch ($mes) {
			case 1: return "Janeiro";
			case 2: return "Fevereiro";
			case 3: return "Março";
			case 4: return "Abril";
			case 5: return "Maio";
			case 6: return "Junho";
			case 7: return "Julho";
			case 8: return "Agosto";
			case 9: return "Setembro";
			case 10: return "Outubro";
			case 11: return "Novembro";
			case 12: return "Dezembro";
		}
	}
	
	function semana($semana) {
		switch ($semana) {
			case 1: return "Segunda";
			case 2: return "Terça";
			case 3: return "Quarta";
			case 4: return "Quinta";
			case 5: return "Sexta";
			case 6: return "Sábado";
			case 7: return "Domingo";
		}
	}
	
	function montaCotacaoDolar() {
		$dolar = $this->carregaCotacao();
		
		echo "<div id=\"cotacaodolar\">";		
		echo "<h3>Cotação do Dólar</h3>";
		echo "<h4>O Portal OITERBUSCA não assume qualquer responsabilidade pela não simultaneidade ou falta das informações prestadas.</h4>";
		echo "<ul style=\"border-bottom: 1px solid #000;\">";
		echo "<li>&nbsp;</li>";
		echo "<li class=\"titulo\">Compra</li>";
		echo "<li class=\"titulo\">Venda</li>";
		echo "</ul>";
		echo "<ul>";
		echo "<li>Comercial</li>";
		echo "<li class=\"valor\">".$dolar['comercial']['compra']."</li>";
		echo "<li class=\"valor\">".$dolar['comercial']['venda']."</li>";
		echo "</ul>";
		echo "<ul>";
		echo "<li>Paralelo</li>";
		echo "<li class=\"valor\">".$dolar['paralelo']['compra']."</li>";
		echo "<li class=\"valor\">".$dolar['paralelo']['venda']."</li>";
		echo "</ul>";
		echo "</div>";
		
	}
	
	function montaClimaTempo() {
		$clima = $this->carregaClimaTempo();
		echo "<div id=\"climatempo\">";		
		echo "<h3>Previsão do Tempo</h3>";
		echo "<h4>Pinhais, ".date("d")." ".$this->mes(date("n"))." ".date("Y")."</h4>";		
		echo "<ul>";
		echo "<li>Agora</li>";
		echo "<li><img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/we/52/".$clima[0]['imagem'].".gif\"></li>";
		echo "<li>".$clima[0]['tempMax']."°</li>";
		echo "</ul>";
		
		echo "<ul>";
		echo "<li>".$this->semana(date("N",mktime(0, 0, 0, date("m"), date("d")+1, date("Y"))))."</li>";
		echo "<li><img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/we/52/".$clima[1]['imagem'].".gif\"></li>";
		echo "<li>".$clima[1]['tempMin']."° / ".$clima[1]['tempMax']."° </li>";
		echo "</ul>";

		echo "<ul>";
		echo "<li>".$this->semana(date("N",mktime(0, 0, 0, date("m"), date("d") + 2, date("Y"))))."</li>";
		echo "<li><img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/we/52/".$clima[2]['imagem'].".gif\"></li>";
		echo "<li>".$clima[2]['tempMin']."° / ".$clima[2]['tempMax']."° </li>";
		echo "</ul>";
		echo "</div>";
		
	}
	
	function carregaCotacao() {
		//$f = fopen('http://cotacao.republicavirtual.com.br/web_cotacao.php?formato=xml','r');
		$url = 'http://cotacao.republicavirtual.com.br/web_cotacao.php?formato=xml';
		
		$ch = curl_init(); 
	    curl_setopt($ch, CURLOPT_URL, $url); 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  		curl_setopt($ch, CURLOPT_HEADER, false);
  		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    $content = curl_exec($ch);
	     

		preg_match('/<dolar_comercial_compra>(.*)<\/dolar_comercial_compra>/Usm',$content,$results);
		$dolar['comercial']['compra'] = $results[1];
		
		preg_match('/<dolar_comercial_venda>(.*)<\/dolar_comercial_venda>/Usm',$content,$results);
		$dolar['comercial']['venda'] = $results[1];
		
		preg_match('/<dolar_paralelo_compra>(.*)<\/dolar_paralelo_compra>/Usm',$content,$results);
		$dolar['paralelo']['compra'] = $results[1];
		
		preg_match('/<dolar_paralelo_venda>(.*)<\/dolar_paralelo_venda>/Usm',$content,$results);
		$dolar['paralelo']['venda'] = $results[1];
		
		return $dolar;		
	}
	
	function carregaClimaTempo() {
		
		$id = "BRXX3902"; // PINHAIS
		//$id = "BRXX0079"; // CURITIBA
		
		$url = 'http://weather.yahooapis.com/forecastrss?p='.$id.'&u=c';
		
		$ch = curl_init(); 
	    curl_setopt($ch, CURLOPT_URL, $url); 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  		curl_setopt($ch, CURLOPT_HEADER, false);
  		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    $content = curl_exec($ch);
		
		//while($t = fread($f,102465)){ $content .= $t; }
		//fclose($f);
			
			preg_match('/<yweather:condition  text="(.*)"  code="(.*)"  temp="(.*)"  date="(.*)" \/>/Usm',$content,$results);
			$clima[0]['tempMax'] = $results[3];
			$clima[0]['tempSituacao'] = $results[1];
			$clima[0]['imagem'] = $results[2];
			
			preg_match_all('/<yweather:forecast day="(.*)" date="(.*)" low="(.*)" high="(.*)" text="(.*)" code="(.*)" \/>/Usm',$content,$results);
			unset($content);
			
			$clima[1]['tempMax'] = $results[4][0];
			$clima[1]['tempSituacao'] = $results[5][0];
			$clima[1]['tempMin'] = $results[3][0];
			$clima[1]['imagem'] = $results[6][0];
			
			$clima[2]['tempMax'] = $results[4][1];
			$clima[2]['tempSituacao'] = $results[5][1];
			$clima[2]['tempMin'] = $results[3][1];
			$clima[2]['imagem'] = $results[6][1];
		
			return $clima;
	}
	
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
			$link = UrlManage::getUrlCategoria($departamentos[$i]->getIdDepartamento(),"",$departamentos[$i]->getDepartamento());
			?>
				<li>
					<a href="<?=$link;?>" title="<?=$departamentos[$i]->getDepartamento();?>">
						<?=$departamentos[$i]->getDepartamento();?>
					</a>
				</li>
			<?
			$j++;								
		}
	}

	function menuDepartamentos($departamentos, $id ="") {
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
		echo "<img src=\"".$this->image_path."images/departamentos.gif\">";
		echo "</td></tr></table>";
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
		$totDepartamentos = count($departamentos);
		echo "<ul>";
		for($i = 0; $i < $totDepartamentos; $i++) {
			$link = UrlManage::getUrlCategoria($departamentos[$i]->getIdDepartamento(),"",$departamentos[$i]->getDepartamento());
		?>
			<li>
				<a href="<?=$link;?>">
					
					<?
					if($departamentos[$i]->idDepartamento == $id) {
						echo "<b>".$departamentos[$i]->getDepartamento()."</b>";
					} else {
						echo $departamentos[$i]->getDepartamento();
					}
					?>
				</a>
			</li>
		<?
		}
		?>
		<li class="direita">
			<a href="<?=$this->image_path;?>departamentos.php">
				» Ver todos os departamentos
			</a>
		</li>
		<?
		echo "</ul>";
		echo "</td></tr></table>";
	}
	
	function menuSubDepartamentos($departamentos,$id="") {
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
		echo "<img src=\"".$this->image_path."images/departamentos.gif\">";
		echo "</td></tr></table>";
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
		$totDepartamentos = count($departamentos);
		$departamentoDAO = new DepartamentoDAO();
		$nomeDepartamento = $departamentoDAO->getDepartamentosPorId($departamentos[$i]->iddepartamento);
		echo "<ul>";
		
		for($i = 0; $i < $totDepartamentos; $i++) {
			$link = UrlManage::getUrlSubCategoria($departamentos[$i]->iddepartamento,$_GET['titulo'],$departamentos[$i]->idsubdepartamento,$departamentos[$i]->subdepartamento);
		?>
			<li>
				<a href="<?=$link;?>">
				<?
					if($departamentos[$i]->getIdSubdepartamento() == $id) {
						echo "<b>".$departamentos[$i]->getSubDepartamento()."</b>";
					} else {
						echo $departamentos[$i]->getSubDepartamento();
					}
					?>
				</a>
			</li>
		<?
		}
		?>
		<li class="direita">
			<a href="<?=$this->image_path;?>departamentos.php">
				» Ver todos os departamentos
			</a>
		</li>
		<?
		echo "</ul>";
		echo "</td></tr></table>";
	}
	
	function bannersTopo($banners) {
		
			$layout = new Layout();
			if(count($banners) > 0 ) {

				if($banners->getExtensao() != "swf") {
				?>
				<a class="bannerEsq" href="<?=$banners->getUrl();?>" target="<?=$banners->getTarget();?>">
					<img src="<?=$this->image_path;?>images/banners/<?=$banners->getBanner();?>" alt="<?=$banners->getDescricao();?>" border="0">
				</a>
				
				<?
				} else {
				?>
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$banners->getWidth();?>" height="<?=$banners->getheight();?>">
					<param name="movie" value="<?=$layout->image_path;?>images/banners/<?=$banners->getBanner();?>" /><param name="quality" value="high" />
					<param name="wmode" value="transparent" />
					<param name="bgcolor" value="#ffffff" />
					<embed src="<?=$layout->image_path;?>images/banners/<?=$banners->getBanner();?>" 
									quality="high"
									wmode="transparent" 
									bgcolor="#ffffff" 
									width="<?=$banners->getWidth();?>" 
									height="<?=$banners->getheight();?>" 
									name="promocao" 
									align="middle" 
									allowScriptAccess="sameDomain" 
									type="application/x-shockwave-flash" 
									pluginspage="http://www.macromedia.com/go/getflashplayer"
					/>
				</object>
				<?
				}
			}
	}

	
function bannersEsquerda($banners) {
		$layout = new Layout();
		$totBanners = count($banners);

		if($totBanners > 0) {
			echo "<br>";
			echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			echo "<tr><td>";
			echo "<ul>";
			if($totBanners > 1) {
				for($i = 0; $i < $totBanners; $i++) {
				?>
					<li>
				<?
					if($banners[$i]->getExtensao() != "swf") {
				?>
						<a class="bannerEsq" href="<?=$banners[$i]->getUrl();?>" target="<?=$banners[$i]->getTarget();?>">
							<img src="<?=$this->image_path;?>images/banners/<?=$banners[$i]->getBanner();?>" alt="<?=$banners[$i]->getDescricao();?>" border="0">
						</a>
					
				<?
					} else {
				?>
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$banners[$i]->getWidth();?>" height="<?=$banners[$i]->getheight();?>">
							<param name="movie" value="<?=$layout->image_path;?>images/banners/<?=$banners[$i]->getBanner();?>" /><param name="quality" value="high" />
							<param name="wmode" value="transparent" />
							<param name="bgcolor" value="#ffffff" />
							<embed src="<?=$layout->image_path;?>images/banners/<?=$banners[$i]->getBanner();?>" 
											quality="high"
											wmode="transparent" 
											bgcolor="#ffffff" 
											width="<?=$banners[$i]->getWidth();?>" 
											height="<?=$banners[$i]->getheight();?>" 
											name="promocao" 
											align="middle" 
											allowScriptAccess="sameDomain" 
											type="application/x-shockwave-flash" 
											pluginspage="http://www.macromedia.com/go/getflashplayer"
							/>
					</object>
				<?
					}
				?>
					</li>
				<?php
				}
			} else {
				?>
					<li>
				<?
					if($banners->getExtensao() != "swf") {
				?>
						<a class="bannerEsq" href="<?=$banners->getUrl();?>" target="<?=$banners->getTarget();?>">
							<img src="<?=$this->image_path;?>images/banners/<?=$banners->getBanner();?>" alt="<?=$banners->getDescricao();?>" border="0">
						</a>
					
				<?
					} else {
				?>
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$banners->getWidth();?>" height="<?=$banners->getheight();?>">
							<param name="movie" value="<?=$layout->image_path;?>images/banners/<?=$banners->getBanner();?>" /><param name="quality" value="high" />
							<param name="wmode" value="transparent" />
							<param name="bgcolor" value="#ffffff" />
							<embed src="<?=$layout->image_path;?>images/banners/<?=$banners->getBanner();?>" 
											quality="high"
											wmode="transparent" 
											bgcolor="#ffffff" 
											width="<?=$banners->getWidth();?>" 
											height="<?=$banners->getheight();?>" 
											name="promocao" 
											align="middle" 
											allowScriptAccess="sameDomain" 
											type="application/x-shockwave-flash" 
											pluginspage="http://www.macromedia.com/go/getflashplayer"
							/>
					</object>
				<?
					}
				?>
					</li>
				<?
			}
			echo "</ul>";
			echo "</td></tr>";
			echo "</table>";
		}
	}
	
		function enquete() {
			$enquete = new Enquete();
			$enqueteDAO = new EnqueteDAO();
			
			$enquete = $enqueteDAO->getPergunta();
			
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td>";
		echo "<img src=\"".$this->image_path."images/enquete.gif\">";
		echo "</td></tr>";
		echo "</table>";
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bordaDestaque\">";
		echo "<tr><td>";
		echo "<ul id=\"enquetePergunta\">";
		echo "<li class=\"pergunta\">".$enquete[0]->getPergunta()."</li>";
		for($i = 0; $i < count($enquete); $i++ ) {
			echo 
			"<li>
			<table>
				<tr>
					<td class=\"radio\"><input type=\"radio\" name=\"resposta\"></td>
					<td>".$enquete[$i]->getResposta()."</td>
				</tr>
			</table>
			</li>";
		}
		echo "<li><center>";
		echo "<input class=\"botao_enquete\" type=\"button\" onclick=\"processaVoto();\" value=\"Votar\"/>";
		echo "<input class=\"botao_enquete\" type=\"button\" onclick=\"abrirResultado('1');\" value=\"Parcial\"/>";
		echo "<center></li>";
		echo "</ul>";
		echo "</td></tr>";
		echo "</table>";
	}
	
	function boletim() {
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		echo "<tr><td>";
		echo "<img src=\"".$this->image_path."images/boletim.gif\">";
		echo "</td></tr>";
		echo "</table>";
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bordaDestaque\">";
		echo "<tr><td>";
		echo "<ul id=\"boletim\">";
		echo "<li class=\"textoDestaque\">Cadastre-se e receba nossas novidades!</li>";
		echo "<li>Insira seu nome:</li>";
		echo "<li><input type=\"text\" id=\"nome\" name=\"nome\"/></li>";
		echo "<li>Qual é o seu e-mail ?</li>";
		echo "<li><input type=\"text\" id=\"email\" name=\"email\"/></li>";
		echo "<li><center><input type=\"button\" onclick=\"insereBoletim();\" value=\"Cadastrar\" class=\"botao_boletim\"/></center></li>";		
		echo "</ul>";
/*		echo "<ul>";
		if($totBanners > 1) {
			for($i = 0; $i < $totBanners; $i++) {
			?>
				<li>
					<a href="<?=$banners[$i]->getUrl();?>" target="<?=$banners[$i]->getTarget();?>">
						<img src="images/banners/<?=$banners[$i]->getBanner();?>" alt="<?=$banners[$i]->getDescricao();?>" border="0">
					</a>
				</li>
			<?
			}
		} else {
			?>
				<li>
					<a href="<?=$banners->getUrl();?>" target="<?=$banners->getTarget();?>">
						<img src="images/banners/<?=$banners->getBanner();?>" alt="<?=$banners->getDescricao();?>" border="0">
					</a>
				</li>
			<?
		}
		echo "</ul>";*/
		echo "</td></tr>";
		echo "</table>";
	}
	

	function bannersLaterais($banners) {
		$layout = new Layout();
		$totBanners = count($banners);
		if($totBanners > 0) {
			echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			echo "<tr><td>";
			echo "<img src=\"".$this->image_path."images/destaques.gif\">";
			echo "</td></tr>";
			echo "</table>";
			echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bordaDestaque\">";
			echo "<tr><td>";
			echo "<ul>";
			if($totBanners > 1) {
				for($i = 0; $i < $totBanners; $i++) {
				?>
					<li>
					<?
					if($banners[$i]->getExtensao() != "swf") {
					?>
					<a class="bannerEsq" href="<?=$banners[$i]->getUrl();?>" target="<?=$banners[$i]->getTarget();?>">
						<img src="<?=$this->image_path;?>images/banners/<?=$banners[$i]->getBanner();?>" alt="<?=$banners[$i]->getDescricao();?>" border="0">
					</a>
					
					<?
					} else {
					?>
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$banners[$i]->getWidth();?>" height="<?=$banners[$i]->getheight();?>">
						<param name="movie" value="<?=$layout->image_path;?>images/banners/<?=$banners[$i]->getBanner();?>" /><param name="quality" value="high" />
						<param name="wmode" value="transparent" />
						<param name="bgcolor" value="#ffffff" />
						<embed src="<?=$layout->image_path;?>images/banners/<?=$banners[$i]->getBanner();?>" 
										quality="high"
										wmode="transparent" 
										bgcolor="#ffffff" 
										width="<?=$banners[$i]->getWidth();?>" 
										height="<?=$banners[$i]->getheight();?>" 
										name="promocao" 
										align="middle" 
										allowScriptAccess="sameDomain" 
										type="application/x-shockwave-flash" 
										pluginspage="http://www.macromedia.com/go/getflashplayer"
						/>
					</object>
					<?
					}
					?>
					</li>
				<?
				}
			} elseif($totBanners == 1) {
				?>
					<li>
					<?
					if($banners->getExtensao() != "swf") {
					?>
					<a class="bannerEsq" href="<?=$banners->getUrl();?>" target="<?=$banners->getTarget();?>">
						<img src="<?=$this->image_path;?>images/banners/<?=$banners->getBanner();?>" alt="<?=$banners->getDescricao();?>" border="0">
					</a>
					
					<?
					} else {
					?>
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$banners->getWidth();?>" height="<?=$banners->getheight();?>">
						<param name="movie" value="<?=$layout->image_path;?>images/banners/<?=$banners->getBanner();?>" /><param name="quality" value="high" />
						<param name="wmode" value="transparent" />
						<param name="bgcolor" value="#ffffff" />
						<embed src="<?=$layout->image_path;?>images/banners/<?=$banners->getBanner();?>" 
										quality="high"
										wmode="transparent" 
										bgcolor="#ffffff" 
										width="<?=$banners->getWidth();?>" 
										height="<?=$banners->getheight();?>" 
										name="promocao" 
										align="middle" 
										allowScriptAccess="sameDomain" 
										type="application/x-shockwave-flash" 
										pluginspage="http://www.macromedia.com/go/getflashplayer"
						/>
					</object>
					<?
					}
					?>
					</li>
					<?
			}
			
			echo "</ul>";
			echo "</td></tr>";
			echo "</table>";
		}
	}
	
	function rodape() {
		
		$pagina = new Rodape();
		$paginaDAO = new RodapeDAO();
		
		$pagina = $paginaDAO->listaRodape();
		$total = count($pagina);
		
		$cores = array("primeiro","vermelho","azul", "azulClaro","amarelo","amareloEscuro");
		$totCor = count($cores);
		
		echo "<div id=\"footer\">";
		echo "<ul>";
		for($i = 2; $i < $total; $i++) {
			if($i > $totCor) {
				$class = $cores[($i-2) - $totCor];
			} else {
				$class = $cores[$i-2];
			}
			
			
			echo "<li class=\"".$class."\"><a href=\"".UrlManage::getUrlPagina($pagina[$i]->getIdrodape(),$pagina[$i]->getTitulo())."\" title=\"".$pagina[$i]->getTitulo()."\">".$pagina[$i]->getTitulo()."</a></li>";	
		}
		
/*		echo "<li class=\"vermelho\"><a href=\"publicidade.php\">Publicidade</a></li>";
		echo "<li class=\"azul\"><a href=\"parcerias.php\">Seja um parceiro</a></li>";
		echo "<li class=\"azulClaro\"><a href=\"contato.php\">Fale com a OITER</a></li>";
		echo "<li class=\"amarelo\"><a href=\"imprensa.php\">Oiter na mídia</a></li>";
		echo "<li class=\"amareloEscuro\"><a href=\"imprensa.php\">Nossa Missão</a></li>";*/
		echo "</ul>";
		$this->copyright();
		echo "</div>";
	}
	
	function copyright() {
		echo "<p class=\"copyright\">Copyright © 2005-".date("Y")." - OITERBUSCA.com | Todos os direitos reservados. Marcas comerciais e as Logos são de propriedade de seus respectivos proprietários. O uso deste site implica a aceitação do acordo OiterBusca <a href=\"".UrlManage::getUrlPagina('1','Política de Uso')."\" title=\"Política de Uso\">Política de Uso</a> e a <a href=\"".UrlManage::getUrlPagina('2','Política de Privacidade')."\" title=\"Política de Privacidade\">Política de Privacidade</a>.</p>";
	}
	
	function getTheme($cor = "") {
		if($cor!="") {
			echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"".$this->image_path."css/padrao_".$cor.".css\"/>";
		} else {
			echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"".$this->image_path."css/padrao.css\"/>";
		}
	}
	
	function breadcrumb($id, $idsubcategoria = "") {
		
		$departamento = new Departamento();
		$subdepartamento = new Subdepartamento();
		
		$departamentoDAO = new DepartamentoDAO();
		$subdepartamentoDAO = new SubdepartamentoDAO();
		
		$departamento = $departamentoDAO->getDepartamentosPorId($id);
		$subdepartamento = $subdepartamentoDAO->getSubdepartamentosPorId($idsubcategoria);
		
		echo "<ul id=\"bread\">";
		echo "<li><a href=\"".$this->image_path."\">Página Inicial</a></li>";
		if($id != "") {
			if(count($subdepartamentoDAO->getSubdepartamentosPorIddepartamento($id)) > 0 && $idsubcategoria != "") {
				$link = "<a href=\"".UrlManage::getUrlCategoria($id,"",$departamento->getDepartamento())."\">".$departamento->getDepartamento()."</a>";
			} else {
				$link = $departamento->getDepartamento();
			}
			echo "<li> » ".$link."</li>";
		}
		if($idsubcategoria != "") {
			echo "<li> » ".$subdepartamento->getSubdepartamento()."</li>";
			/*echo " » <a href=\"".UrlManage::getUrlSubCategoria($id,$departamento->getDepartamento(),$idsubcategoria,$subdepartamento->getSubdepartamento())."\">".$subdepartamento->getSubdepartamento()."</a>";*/
		}
		echo "</ul>";
	}
}
?>
