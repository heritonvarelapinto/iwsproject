<?php
class Layout extends HTML {
	
	var $image_path = "http://189.126.104.250/oiterbusca/oiter/";
	
	function mes($mes) {
		switch ($mes) {
			case 1: return "Janeiro";
			case 2: return "Fevereiro";
			case 3: return "Mar�o";
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
			case 2: return "Ter�a";
			case 3: return "Quarta";
			case 4: return "Quinta";
			case 5: return "Sexta";
			case 6: return "S�bado";
			case 7: return "Domingo";
		}
	}
	
	function montaCotacaoDolar() {
		$dolar = $this->carregaCotacao();
		if($dolar != false) {
			echo "<div id=\"cotacaodolar\">";		
			echo "<h3>Cota��o do D�lar</h3>";
			echo "<h4>A OITER n�o assume qualquer responsabilidade pela n�o simultaneidade das informa��es prestadas.</h4>";
			echo "<ul style=\"border-bottom: 1px solid #000;\">";
			echo "<li>&nbsp;</li>";
			echo "<li class=\"titulo\">Compra</li>";
			echo "<li class=\"titulo\">Venda</li>";
			echo "</ul>";
			echo "<ul>";
			echo "<li>Comercial</li>";
			echo "<li class=\"valor\">".$dolar['comercial']['compra']."</li>";
			echo "<li class=\"valor\">".$dolar['comercial']['venda']."</li>";
/*			echo "<li class=\"valor\">".$dolar['comercial']['variacao']."</li>";*/
			echo "</ul>";
			echo "<ul>";
			echo "<li>Turismo</li>";
			echo "<li class=\"valor\">".$dolar['turismo']['compra']."</li>";
			echo "<li class=\"valor\">".$dolar['turismo']['venda']."</li>";
/*			echo "<li class=\"valor\">".$dolar['turismo']['variacao']."</li>";*/
			echo "</ul>";
			echo "<ul>";
			echo "<li>Ptax</li>";
			echo "<li class=\"valor\">".$dolar['ptax']['compra']."</li>";
			echo "<li class=\"valor\">".$dolar['ptax']['venda']."</li>";
/*			echo "<li class=\"valor\">".$dolar['ptax']['variacao']."</li>";*/
			echo "</ul>";
			echo "</div>";
		}
	}
	
	function montaClimaTempo() {
		$clima = $this->carregaClimaTempo();
		if($clima != false) {
			echo "<div id=\"climatempo\">";		
			echo "<h3>Previs�o do Tempo</h3>";
			echo "<h4>Pinhais, ".date("d")." ".$this->mes(date("n"))." ".date("Y")."</h4>";		
			echo "<ul>";
			echo "<li>Agora</li>";
			echo "<li><img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/we/52/".$clima[0]['imagem'].".gif\"></li>";
			echo "<li>".$clima[0]['tempMax']."�</li>";
			echo "</ul>";
			
			echo "<ul>";
			echo "<li>".$this->semana(date("N",mktime(0, 0, 0, date("m"), date("d")+1, date("Y"))))."</li>";
			echo "<li><img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/we/52/".$clima[1]['imagem'].".gif\"></li>";
			echo "<li>".$clima[1]['tempMin']."� / ".$clima[1]['tempMax']."� </li>";
			echo "</ul>";
	
			echo "<ul>";
			echo "<li>".$this->semana(date("N",mktime(0, 0, 0, date("m"), date("d") + 2, date("Y"))))."</li>";
			echo "<li><img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/we/52/".$clima[2]['imagem'].".gif\"></li>";
			echo "<li>".$clima[2]['tempMin']."� / ".$clima[2]['tempMax']."� </li>";
			echo "</ul>";
			echo "</div>";
		}
	}
	
	function carregaCotacao() {

		//error_reporting(15);
		if(!@$fp=fopen("http://cotacoes.agronegocios-e.com.br/investimentos/conteudoi.asp?option=dolar&title=%20D%F3lar" ,"r" )) {
			echo "Erro ao abrir a p�gina de cota��o" ;
		} else {
			
			$conteudo = "";
			
			while(!feof($fp)) { // leia o conte�do da p�gina
				$conteudo .= trim(fgets($fp,1024));
			}
			
			fclose($fp);
		}
		if($conteudo) {
			preg_match_all("/<font size='1' face='verdana'>(.*)<\/font>/Usm",$conteudo,$results);
	        
			$dolar['comercial']['compra'] = $results[1][1];
			$dolar['comercial']['venda'] = $results[1][2];
			$dolar['comercial']['variacao'] = $results[1][3];
			
			$dolar['turismo']['compra'] = $results[1][7];
			$dolar['turismo']['venda'] = $results[1][8];
			$dolar['turismo']['variacao'] = $results[1][9];
			
			$dolar['ptax']['compra'] = $results[1][25];
			$dolar['ptax']['venda'] = $results[1][26];
			$dolar['ptax']['variacao'] = $results[1][27];
			
			return $dolar;
		} else {
			return false;
		}
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
		
		if($content) {
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
		} else {
			return false;
		}
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
			$anuncioDAO = new AnuncioDAO;
			$total = $anuncioDAO->totalAnuncios($departamentos[$i]->getIdDepartamento(),"departamento");
			 
			if($total > 0) {
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
			
			$anuncioDAO = new AnuncioDAO;
			$total = $anuncioDAO->totalAnuncios($departamentos[$i]->getIdDepartamento(),"departamento");
			 
			if($total > 0) {
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
		}
		?>
		<li class="direita">
			<a href="<?=$this->image_path;?>departamentos.php">
				� Ver todos os departamentos
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
		echo "<ul>";
		
		for($i = 0; $i < $totDepartamentos; $i++) {
			$nomeDepartamento = $departamentoDAO->getDepartamentosPorId($departamentos[$i]->getIddepartamento());
			$link = UrlManage::getUrlSubCategoria($departamentos[$i]->iddepartamento,$_GET['titulo'],$departamentos[$i]->idsubdepartamento,$departamentos[$i]->subdepartamento);
			$anuncioDAO = new AnuncioDAO;
			$total = $anuncioDAO->totalAnuncios($departamentos[$i]->getIdsubdepartamento(),"subdepartamento");
			 
			if($total > 0) {
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
		}
		?>
		<li class="direita">
			<a href="<?=$this->image_path;?>departamentos.php">
				� Ver todos os departamentos
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
			
			$enquete = $enqueteDAO->enqueteAtiva();
			$total = $enqueteDAO->totalVotosEnqueteAtiva();
					
			if(count($enquete) > 0) {
				echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				echo "<tr><td>";
				echo "<img src=\"".$this->image_path."images/enquete.gif\">";
				echo "</td></tr>";
				echo "</table>";
				echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bordaDestaque\">";
				echo "<tr><td>";					
				echo "<ul id=\"enquetePergunta\">";
				echo "<li class=\"textoDestaque\">".$enquete[0]->pergunta."</li>";
					if(isset($_COOKIE['voto'])) {
						for($i=0; $i < count($enquete);$i++) {
							$geral = round($enquete[$i]->voto * 100 / $total);
							echo "<li>".$enquete[$i]->resposta."<br>
							<img src=\"http://www.clicknobairro.com.br/xybr/img/orange.gif\" style=\"width: ".($geral+5)."; height: 8px \"> ".$geral."%</li>";
						}
					} else {
						for($i=0; $i < count($enquete);$i++) {
							echo "<li><span><input type=\"radio\" name=\"opcao\" value=\"".$enquete[$i]->idresposta."\">".$enquete[$i]->resposta."</span></li>";
						}
						echo "<li>
							<center>
								<input type=\"button\" onclick=\"votaEnquete();\" value=\"Votar\" class=\"botao_boletim\"/>
								<input type=\"button\" onclick=\"parcialEnquete();\" value=\"Parcial\" class=\"botao_boletim\"/>
							</center>
						</li>";
					}
					echo "</ul>";
				
				echo "</td></tr>";
				echo "</table>";
			}
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
		echo "<li class=\"textoDestaque\">Cadastre-se e participe todas as semanas de nossas promo��es.</li>";
		echo "<li>�Insira seu nome:</li>";
		echo "<li><input type=\"text\" id=\"nome\" name=\"nome\"/></li>";
		echo "<li>�Qual � o seu e-mail ?</li>";
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
		echo "<li class=\"amarelo\"><a href=\"imprensa.php\">Oiter na m�dia</a></li>";
		echo "<li class=\"amareloEscuro\"><a href=\"imprensa.php\">Nossa Miss�o</a></li>";*/
		echo "</ul>";
		$this->copyright();
		echo "</div>";
	}
	
	function copyright() {
		echo "<p class=\"copyright\">Copyright � 2005-".date("Y")." - OITERBUSCA.com | Todos os direitos reservados. Marcas comerciais e as Logos s�o de propriedade de seus respectivos propriet�rios. O uso deste site implica a aceita��o do acordo OiterBusca <a href=\"".UrlManage::getUrlPagina('1','Pol�tica de Uso')."\" title=\"Pol�tica de Uso\">Pol�tica de Uso</a> e a <a href=\"".UrlManage::getUrlPagina('2','Pol�tica de Privacidade')."\" title=\"Pol�tica de Privacidade\">Pol�tica de Privacidade</a>.</p>";
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
		echo "<li><a href=\"".$this->image_path."\">P�gina Inicial</a></li>";
		if($id != "") {
			if(count($subdepartamentoDAO->getSubdepartamentosPorIddepartamento($id)) > 0 && $idsubcategoria != "") {
				$link = "<a href=\"".UrlManage::getUrlCategoria($id,"",$departamento->getDepartamento())."\">".$departamento->getDepartamento()."</a>";
			} else {
				$link = $departamento->getDepartamento();
			}
			echo "<li> � ".$link."</li>";
		}
		if($idsubcategoria != "") {
			echo "<li> � ".$subdepartamento->getSubdepartamento()."</li>";
			/*echo " � <a href=\"".UrlManage::getUrlSubCategoria($id,$departamento->getDepartamento(),$idsubcategoria,$subdepartamento->getSubdepartamento())."\">".$subdepartamento->getSubdepartamento()."</a>";*/
		}
		echo "</ul>";
	}
	
	function breadcrumbPesquisa($id, $idsubcategoria = "") {
		
		$departamento = new Departamento();
		$subdepartamento = new Subdepartamento();
		
		$departamentoDAO = new DepartamentoDAO();
		$subdepartamentoDAO = new SubdepartamentoDAO();
		
		$departamento = $departamentoDAO->getDepartamentosPorId($id);
		$subdepartamento = $subdepartamentoDAO->getSubdepartamentosPorId($idsubcategoria);
		
		if($id != "") {
			//if(count($subdepartamentoDAO->getSubdepartamentosPorIddepartamento($id)) > 0 && $idsubcategoria != "") {
				$link = "<a href=\"".UrlManage::getUrlCategoria($id,"",$departamento->getDepartamento())."\">".$departamento->getDepartamento()."</a>";
			//} else {
			//	$link = $departamento->getDepartamento();
			//}
			echo "� ".$link;
		}
		if($idsubcategoria != 0) {
/*			echo "<li> � ".$subdepartamento->getSubdepartamento()."</li>";*/
			echo " � <a href=\"".UrlManage::getUrlSubCategoria($id,$departamento->getDepartamento(),$idsubcategoria,$subdepartamento->getSubdepartamento())."\">".$subdepartamento->getSubdepartamento()."</a>";
		}
		
		echo "<br>";
	}
		
	function head($nomeDepartamento = "", $nomeSubDepartamento = "") {
		?>
		<head>
			<title>OiterBusca - <?=$nomeDepartamento->departamento;?> <? if($nomeSubDepartamento) { echo " / "; ?><?=$nomeSubDepartamento->subdepartamento;?><? } ?></title>
			<meta http-equiv="Content-Type" content="text/html;iso-8859-1">
			<meta name="revisit-after" content="1" />
			<meta name="distribution" content="Global" />
			<meta name="classification" content="Internet" />
			<meta name="robots" content="all" />
			<meta name="language" content="pt-br" />
			<meta name="author" content="www.oiterbusca.com.br" />							
			<meta name="description" content="" />
			<meta name="keywords" content="" />
			<?=$this->getTheme("");?>
			<link rel="shortcut icon" href="<?=$this->image_path;?>icones/favicon.ico" >
			<script type="text/javascript" src="<?=$this->image_path;?>js/jquery.js"></script>
			<script type="text/javascript" src="<?=$this->image_path;?>js/jquerycalendar.js"></script>
			<script type="text/javascript" src="<?=$this->image_path;?>js/funcoes.js"></script>
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
		<?
	}
	
	function barraPesquisa($departamentos) {
		?>
		<!-- Barra Pesquisa -->
		<div class="menuPesquisa">
			<div class="menuPesquisaEsq">
				<div class="menuPesquisaDir">
					<form method="GET" action="<?=$this->image_path;?>pesquisa.php">
					<table border="0" cellpadding="2" cellspacing="2" class="tablePesquisa">
						<tr>
							<td><?=$this->input("pesquisa","inputPesquisa");?></td>
							<!--<td><?=$this->selectDepartamentos($departamentos);?></td>-->
							<td><?=$this->button("btEnviar","button","Buscar");?> </td>
							<!--<td><?=$this->button("btEnviar","button","Pesquisa avan�ada");?> </td>-->
						</tr>
					</table>
					</form>
				</div>
			</div>
		</div>
		<!-- Fim Barra Pesquisa -->
		<?
	}	
	
	function barraItensMenu($departamentos) {
		?>
		<!-- Barra Itens Menu -->
		<div class="menuItens">
			<div class="menuItensEsq">
				<div class="menuItensDir">
					<ul>
						<li>
							<a href="#" class="showAll">Departamentos <img border="0" src="<?=$this->image_path;?>images/seta.gif"></a>
							<div id="departamentos" style="display: none;">
								<ul>
									<?=$this->menuSuperiorDepartamentos($departamentos);?>
								</ul>
							</div>
						</li>
						<!--<li class="novo"><a href="#" class="motors">Motors</a></li>-->
						<li><a href="<?=$this->image_path;?>">P�gina Inicial</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Fim Barra Itens Menu -->
		<?
	}
	
	function mostraAnuncios($anuncio) {
		
		$totAnuncios = count($anuncio);
							
		for($i = 0 ; $i < $totAnuncios;$i++) {
			if($i % 2) {
				$cor = "#DDDDDD";
			} else {
				$cor = "#EEEEEE";
			}
			echo "<div id=\"anuncios\" style=\"border-bottom: 1px dashed ".$cor."\">";
			echo "<h3>";
			if($anuncio[$i]->getDetalhe() == 1) { 
				echo "<a href=\"javascript:void(0);\" onclick=\"contaAcesso('".$anuncio[$i]->getIdanuncio()."');abrirDestaque('".$this->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."&p=info','".$anuncio[$i]->getNome()."',700,500)\">";
				echo $anuncio[$i]->getNome();
				echo "</a>";
			} else {
				echo $anuncio[$i]->getNome();
			}
			echo "</h3>";
			echo "<p class=\"direita\">";
			echo $anuncio[$i]->getEndereco().", ".$anuncio[$i]->getNumero()." ".$anuncio[$i]->getComplemento()."<br>";
			echo $anuncio[$i]->getBairro()." - ".$anuncio[$i]->getCidade()." - ".$anuncio[$i]->getEstado()."<br>";
			echo "CEP: ".$anuncio[$i]->getCep()."<br>";
			if($anuncio[$i]->getEmail() != "") echo "<b>E-mail: </b>".$anuncio[$i]->getEmail()."<br>";
			if($anuncio[$i]->getSite() != "") echo "<b>Site: </b><a class=\"site\" href=\"javascript:void(0)\" onclick=\"contaAcesso('".$anuncio[$i]->getIdanuncio()."');abrirSite('".$anuncio[$i]->getSite()."')\">".$anuncio[$i]->getSite()."</a><br><br>";
			echo "<a href=\"javascript:void(0)\" onclick=\"contaAcesso('".$anuncio[$i]->getIdanuncio()."');this.innerHTML = '".$anuncio[$i]->getTelefones()."'\" id=\"telefone\">Clique aqui para ver o telefone</a>";
			//echo "<a onclick=\"abrirDestaque('".$layout->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."&p=info','".$anuncio[$i]->getNome()."',700,500)\" id=\"mais_info\" title=\"Mais informa��es\">Saiba um pouco mais sobr� n�s</a>";
			//echo "<img src=\"\".$layout->image_path."images/info.png\" alt=\"Mais informa��es\" onclick=\"abrirDestaque('".$layout->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."&p=info','".$anuncio[$i]->getNome()."',700,500)\">";
			echo "</p>";
			echo "<p onclick=\"contaAcesso('".$anuncio[$i]->getIdanuncio()."');abrirDestaque('".$this->image_path."anunciante.php?id=".$anuncio[$i]->getIdAnuncio()."&p=info','".$anuncio[$i]->getNome()."',700,500)\" class=\"esquerda\">";
			if($anuncio[$i]->getLogo() != "") echo "<img src=\"".$this->image_path."images/logos/".$anuncio[$i]->getLogo()."\" class=\"borda\">";
			echo "</p>";
			echo "</div>";
		}
	}
	
	function lateralDireita($banners, $index = false) {
		?>
		<div id="lateralDireita">
			<?=$this->bannersLaterais($banners);?>
			<? if($index) { ?>
			<br>
			<?=$this->boletim();?>
			<br>
			<?=$this->enquete();?>
			<? } ?>
		</div>
		<?
	}
}
?>