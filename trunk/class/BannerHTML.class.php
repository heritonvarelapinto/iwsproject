<?php
	class BannerHTML extends HTML {
		function BannerMostra($titulo) { 
			$departamento = new Departamento();
		    $departamentoDAO = new DepartamentoDAO();
			
			if($_POST["iddepartamento"]) {
				$iddep = $_POST["iddepartamento"];
			}elseif($_GET["iddep"]) {
				$iddep = $_GET["iddep"];
			}
		?>				
			<span class="TituloPage">• <?=$titulo;?></span>
	        <br/>
	        <br/>
	        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">								
				<tr class="TituloTabela">
					<td  colspan="3" class="label2">Página </td>
				</tr>
				<tr class="Linha1Tabela">
	                <form action="" name="departamento" method="post" onsubmit="return valida_dropmenu(document.departamento.iddepartamento,'departamento');"/>
	                <td height="20" align="right">Pagina:</td>
	                <td>
		            <?
		            	$departamento = $departamentoDAO->Lista();
		            	$this->selectDepartamentosAdmin($departamento);
					?>			            
					</td>
	                <td><input type="submit" style="width: 80px;" class="bttn2" value="Buscar" name="pesquisar"/></td>
	                </form>
	            </tr>			
			</table>
			<? if(isset($iddep)) { ?>		
			<table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
				<tr class="Linha1Tabela">
					<td colspan="3">
						<? $this->BannerMostraTopo($iddep); ?>
					</td>
				</tr>
				<tr class="Linha1Tabela">
					<td colspan="3">
						<? $this->BannerMostraTopoPeq($iddep); ?>
					</td>
				</tr>
				<tr class="Linha1Tabela">
					<td colspan="3">
						<? $this->BannerLateralDireita($iddep); ?>
					</td>
				</tr>
				<tr class="Linha1Tabela">
					<td colspan="3">
						<? $this->BannerLateralEsquerda($iddep); ?>
					</td>
				</tr>			
			</table>
			<? } ?>
	<?	}
	
		/**
		 * Mostra data do banner
		 *
		 * @param string $data
		 */
		function data($data) {
			if($data == "0000-00-00 00:00:00") {
				echo "<font color='blue'>ILIMITADO</font>";
			}else{
				echo "<font color='green'>".$data."</font>";
			}
		}
				
		/*
		function verifica_banner2() {
			$rs = classAdmSQL::lst("banners");
				while ($banner = classAdmGeral::resultado($rs)) {
					$tempo = $banner->data;
					$tempo = explode(" ",$tempo);
					$tempo = $tempo[0];
					
					$dataatual = date('Y-m-d');
					
					if($tempo <= $dataatual) {			
						if($tempo > "0000-00-00") {
							AdmBanners::limpar($banner->idbanner);
						}
					}
				}		
		}
	
		
		function verifica_banner($id) {
			$tempo = classAdmSQL::get("banners","idbanner",$id)->data;
			$tempo = explode(" ",$tempo);
			$tempo = $tempo[0];
			
			$dataatual = date('Y-m-d');
			
			if($tempo <= $dataatual) {			
				if($tempo == "0000-00-00") {
					echo "<font color='blue'>ILIMITADO</font>";
				}else{
					AdmBanners::limpar($id);
				}
			}else {
				echo "<font color='green'>".classAdmGeral::MostraDataSemHora($tempo)."</font>";
			}
		}
	
		function limpar($id) {
			//$query = "UPDATE banners SET banner = 'banner_home_46880.gif', url = 'http://', data = '0000-00-00 00:00:00' WHERE idbanner = '$id'";
			$query = "DELETE FROM banners WHERE idbanner = '$id'";
			$resultado = conexao::query($query);
			if(!$resultado) { echo "Erro na função limpar:".mysql_error(); }
			
			return $resultado;
		}*/
		
		/**
		 * Pega a extensao do arquivo
		 *
		 * @param string $nome
		 * @return string
		 */
		function pegaExt($nome) {
			preg_match("/\.(gif|png|jpg|jpeg|swf){1}$/i", $nome, $ext);
			return $ext[1];
		}
		
		function BannerMostraTopo($iddep) {
			$departamentoDAO = new DepartamentoDAO();
			$departamento = $departamentoDAO->getDepartamentosPorId($iddep);
			?>		
			<table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
				<tr class="TituloTabela">
					<td  colspan="3" class="label2">Página [<? if($iddep == "inicial") { echo "Página Inicial"; }else{ echo $departamento->getDepartamento(); } ?>]</td>
				</tr>			
				<tr class="TituloTabela">
					<td  colspan="3" class="label2">Banners Grande Topo (468x80)</td>
				</tr>								
				<? 					
					$banner = new Banner();
					$bannerDAO = new BannerDAO();
					$banner = $bannerDAO->ListaBannerPorDepartamentoPosicaoAdmin($iddep,"topo");

					$totBanner = count($banner);
					$a = $totBanner + 1;				
						
					for ($i=0;$i<$totBanner;$i++) {			
						$width = $banner[$i]->getWidth(); 
					    $height = $banner[$i]->getHeight();
					    $largura = $width / 2;
					    $altura = $height / 2;
					
				?>
						<tr class="Linha1Tabela">
							<td width="25%" align="center">Banner <?=$i+1;?><br><input type="button" class="bttn4" value="Alterar" onclick="altBanner('<?=$banner[$i]->getIdbanner();?>','468','80');"><br><? $this->data($banner[$i]->getData()); ?></td>							
							<td align="center">
								<? if($this->pegaExt($banner[$i]->getBanner()) == "swf") { ?>													
									<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$largura;?>" height="<?=$altura;?>" id="promocao" align="middle">
									<param name="movie" value="../images/banners/<?=$banner->getBanner();?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="bgcolor" value="#ffffff" /><embed src="../images/banners/<?=$banner[$i]->getBanner();?>" quality="high" wmode="transparent" bgcolor="#ffffff" width="<?=$largura;?>" height="<?=$altura;?>" name="promocao" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
									</object>
								<? }else{ ?>
									<img src="../images/banners/<?=$banner[$i]->getBanner();?>" width="<?=$largura;?>" height="<?=$altura;?>" border="0">
								<? } ?>
							</td>							
						</tr>						
				<?
					}					
				?>
				<? if($iddep == "inicial") { ?>
				<tr class="Linha1Tabela">
					<td colspan="2" align="center">Tamanho Máximo<br>468x80<br><br><input type="button" class="bttn2" value="Adicionar Banner" onclick="addBanner('<?=$iddep;?>','topo','<?=$a;?>','468','80')"></td>
				</tr>
				<? }else{ ?>
					<tr class="Linha1Tabela">
						<td colspan="2" align="center">Tamanho Máximo<br>468x80<br><br><input type="button" class="bttn2" value="Adicionar Banner" onclick="addBanner('<?=$iddep;?>','topo','<?=$a;?>','468','80')"></td>
					</tr>
				<? } ?>							
			</table>
	<?	}
	
		function BannerMostraTopoPeq($iddep) { ?>		
			<table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
				<tr class="TituloTabela">
					<td  colspan="3" class="label2">Página [<? if($iddep == "inicial") { echo "Página Inicial"; }else{ echo "Sub-páginas"; } ?>]</td>
				</tr>
				<tr>
					<td class="TituloTabela" colspan="3">Banners Pequeno Topo (140x80)</td>
				</tr>
				<? 
					$banner = new Banner();
					$bannerDAO = new BannerDAO();
					$banner = $bannerDAO->ListaBannerPorDepartamentoPosicaoAdmin($iddep,"topopeq");

					$totBanner = count($banner);									
					$a = $totBanner + 1;
						
					for ($i=0;$i<$totBanner;$i++) {	
						$width = $banner[$i]->getWidth(); 
					    $height = $banner[$i]->getHeight();
					    $largura = $width / 2;
					    $altura = $height / 2;
				?>
						<tr class="Linha1Tabela">
							<td width="25%" align="center">Banner <?=$i+1;?><br><input type="button" class="bttn4" value="Alterar" onclick="altBanner('<?=$banner[$i]->getIdbanner();?>','140','80');"><br><? $this->data($banner[$i]->getData()); ?></td>							
							<td align="center">
								<? if($this->pegaExt($banner[$i]->getBanner()) == "swf") { ?>													
									<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$largura;?>" height="<?=$altura;?>" id="promocao" align="middle">
									<param name="movie" value="../images/banners/<?=$banner[$i]->getBanner();?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="bgcolor" value="#ffffff" /><embed src="../images/banners/<?=$banner[$i]->getBanner();?>" quality="high" wmode="transparent" bgcolor="#ffffff" width="<?=$largura;?>" height="<?=$altura;?>" name="promocao" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
									</object>
								<? }else{ ?>
									<img src="../images/banners/<?=$banner[$i]->getBanner();?>" width="<?=$largura;?>" height="<?=$altura;?>" border="0">
								<? } ?>
							</td>							
						</tr>
				<?	} ?>						
				<? if($iddep == "inicial") { ?>
				<tr class="Linha1Tabela">
					<td colspan="2" align="center">Tamanho Máximo<br>140x80<br><br><input type="button" class="bttn2" value="Adicionar Banner" onclick="addBanner('<?=$iddep;?>','topopeq','<?=$a;?>','140','80')"></td>
				</tr>
				<? }else{ ?>
					<tr class="Linha1Tabela">
						<td colspan="2" align="center">Tamanho Máximo<br>140x80<br><br><input type="button" class="bttn2" value="Adicionar Banner" onclick="addBanner('<?=$iddep;?>','topopeq','<?=$a;?>','140','80')"></td>
					</tr>
				<? } ?>										
			</table>
	<?	}
	
		function BannerLateralDireita($iddep) { ?>		
			<table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
				<tr class="TituloTabela">
					<td  colspan="3" class="label2">Página [<? if($iddep == "inicial") { echo "Página Inicial"; }else{ echo "Sub-páginas"; } ?>]</td>
				</tr>
				<tr>
					<td class="TituloTabela" colspan="3">Banners Lateral Direita(150x***)</td>
				</tr>
				<? 
					$banner = new Banner();
					$bannerDAO = new BannerDAO();
					$banner = $bannerDAO->ListaBannerPorDepartamentoPosicaoAdmin($iddep,"lateral");

					$totBanner = count($banner);									
					$a = $totBanner + 1;
						
					for ($i=0;$i<$totBanner;$i++) {	
						$width = $banner[$i]->getWidth(); 
					    $height = $banner[$i]->getHeight();
					    $largura = $width / 2;
					    $altura = $height / 2;
				?>
							<tr class="Linha1Tabela">
								<td width="25%" align="center">Banner <?=$i+1;?><br><input type="button" class="bttn4" value="Alterar" onclick="altBanner('<?=$banner[$i]->getIdbanner();?>','150','5000');"><br><? $this->data($banner[$i]->getData()); ?></td>							
								<td align="center">
									<? if($this->pegaExt($banner[$i]->getBanner()) == "swf") { ?>													
										<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$largura;?>" height="<?=$altura;?>" id="promocao" align="middle">
										<param name="movie" value="../images/banners/<?=$banner[$i]->getBanner();?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="bgcolor" value="#ffffff" /><embed src="../images/banners/<?=$banner[$i]->getBanner();?>" quality="high" wmode="transparent" bgcolor="#ffffff" width="<?=$largura;?>" height="<?=$altura;?>" name="promocao" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
										</object>
									<? }else{ ?>
										<img src="../images/banners/<?=$banner[$i]->getBanner();?>" width="<?=$largura;?>" height="<?=$altura;?>" border="0">
									<? } ?>
								</td>							
							</tr>						
							
				<?	}				
				?>
				<? if($iddep == "inicial") { ?>
				<tr class="Linha1Tabela">
					<td colspan="2" align="center">Tamanho Máximo<br>150x***<br><br><input type="button" class="bttn2" value="Adicionar Banner" onclick="addBanner('<?=$iddep;?>','lateral','<?=$a;?>','150','5000')"></td>
				</tr>
				<? }else{ ?>
					<tr class="Linha1Tabela">
						<td colspan="2" align="center">Tamanho Máximo<br>150x***<br><br><input type="button" class="bttn2" value="Adicionar Banner" onclick="addBanner('<?=$iddep;?>','lateral','<?=$a;?>','150','5000')"></td>
					</tr>
				<? } ?>										
			</table>
	<?	}
	
		function BannerLateralEsquerda($iddep) { ?>		
			<table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
				<tr class="TituloTabela">
					<td  colspan="3" class="label2">Página [<? if($iddep == "inicial") { echo "Página Inicial"; }else{ echo "Sub-páginas"; } ?>]</td>
				</tr>
				<tr>
					<td class="TituloTabela" colspan="3">Banners Lateral Esquerda(150x***)</td>
				</tr>
				<? 
					$banner = new Banner();
					$bannerDAO = new BannerDAO();
					$banner = $bannerDAO->ListaBannerPorDepartamentoPosicaoAdmin($iddep,"lateralesq");

					$totBanner = count($banner);									
					$a = $totBanner + 1;
						
					for ($i=0;$i<$totBanner;$i++) {	
						$width = $banner[$i]->getWidth(); 
					    $height = $banner[$i]->getHeight();
					    $largura = $width / 2;
					    $altura = $height / 2;
				?>
							<tr class="Linha1Tabela">
								<td width="25%" align="center">Banner <?=$i+1;?><br><input type="button" class="bttn4" value="Alterar" onclick="altBanner('<?=$banner[$i]->getIdbanner();?>','150','5000');"><br><? $this->data($banner[$i]->getData()); ?></td>							
								<td align="center">
									<? if($this->pegaExt($banner[$i]->getBanner()) == "swf") { ?>													
										<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$largura;?>" height="<?=$altura;?>" id="promocao" align="middle">
										<param name="movie" value="../images/banners/<?=$banner[$i]->getBanner();?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="bgcolor" value="#ffffff" /><embed src="../images/banners/<?=$banner[$i]->getBanner();?>" quality="high" wmode="transparent" bgcolor="#ffffff" width="<?=$largura;?>" height="<?=$altura;?>" name="promocao" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
										</object>
									<? }else{ ?>
										<img src="../images/banners/<?=$banner[$i]->getBanner();?>" width="<?=$largura;?>" height="<?=$altura;?>" border="0">
									<? } ?>
								</td>							
							</tr>						
							
				<?	}				
				?>
				<? if($iddep == "inicial") { ?>
				<tr class="Linha1Tabela">
					<td colspan="2" align="center">Tamanho Máximo<br>150x***<br><br><input type="button" class="bttn2" value="Adicionar Banner" onclick="addBanner('<?=$iddep;?>','lateral','<?=$a;?>','150','5000')"></td>
				</tr>
				<? }else{ ?>
					<tr class="Linha1Tabela">
						<td colspan="2" align="center">Tamanho Máximo<br>150x***<br><br><input type="button" class="bttn2" value="Adicionar Banner" onclick="addBanner('<?=$iddep;?>','lateral','<?=$a;?>','150','5000')"></td>
					</tr>
				<? } ?>										
			</table>
	<?	}
	
		function ADDALTBanner() {
			
			$idbanner = $_GET["idbanner"];
			$banner = new Banner();
			$bannerDAO = new BannerDAO();
			$banner = $bannerDAO->getBannerPorId($idbanner);
				
			$iddep = $_GET["iddep"];
			$lado = $_GET["lado"];
			$numero = $_GET["numero"];
			$largura = $_GET["w"];
			$altura = $_GET["h"];
							
			if(isset($idbanner)) {
				$width = $banner->getWidth(); 
			    $height = $banner->getHeight();
			    $width = $width / 2;
			    $height = $height / 2;
				$acao = "Alterar";
				$classBotao = "bttn4";
			}else{
				$acao = "Adicionar";
				$classBotao = "bttn2";
			}
			
			//print_r($banner);
			?>
			<span class="TituloPage">• <?=$acao;?> Banner</span>
	        <br/>
	        <br/>
			<form method="POST" action="act/actBanners.php?acao=<?=$acao;?>" enctype="multipart/form-data">			
			<table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
				<tr class="TituloTabela">
					<td colspan="3">
						<b><?=$acao;?> Banner</b>
					</td>
				</tr>
				<tr class="Linha1Tabela">
					<td align="center">
						<table align="center" width="100%" border="0" cellpadding="3" cellspacing="1">										
							<tr class="Linha1Tabela">
								<td width="35%" class="label">Imagem ou animaçao do Banner</td>
								<td><input class="FORMbox" type="file" name="banner" size="50"></td>							
							</tr>
							<tr class="Linha1Tabela">
								<td class="label">URL</td>
								<td><input class="FORMbox" type="text" name="url" size="50" value="<?=$banner->getUrl();?>"></td>
							</tr>						
							<tr class="Linha1Tabela">
								<td class="label">Ao clicar, Pagina designada:</td>
								<td valign="bottom"><select class="FORMbox" name='target'><option value='_self' <? if($banner->getTarget() == "_self") { echo "selected"; } ?>>Abra em Pagina Atual</option><option value='_blank' <? if($banner->getTarget() == "_blank") { echo "selected"; } ?>>Abra em uma Nova Pagina</option></select></td>
							</tr>
							<tr>
								<td>Por quanto tempo<br>este banner será exibido:</td>
								<td>
									<select name="tempo" class="FORMBox">
										<option value="0">Ilimitado</option>
										<option value="valor">- Escolha o valor -</option>
										<option value="5">5 DIAS</option>
										<option value="10">10 DIAS</option>
										<option value="15">15 DIAS</option>
										<option value="20">20 DIAS</option>
										<option value="25">25 DIAS</option>
										<option value="30">30 DIAS</option>
										<option value="60">60 DIAS</option>
										<option value="90">90 DIAS</option>
										<option value="120">120 DIAS</option>
										<option value="150">150 DIAS</option>
										</select>
										 (ou) Entre valor:<input name="valor" size="5" type="text"  class="FORMBox">
								</td>
							</tr>
							<tr class="Linha1Tabela">
								<td colspan="2"><br></td>
							</tr>
							<tr class="Linha1Tabela">
								<td colspan="2"><input type="submit" class="<?=$classBotao;?>" name="botao" value="<?=$acao;?>"><input type="button" class="bttn1" value="Voltar" onclick="javascript:history.back();"><? if($acao == "Alterar") {?><input type="button" value="Excluir Banner" class="bttn3" onclick="delBanner('<?=$banner->getIddepartamento();?>','<?=$banner->getIdbanner();?>');"><? } ?></td>
							</tr>							
						</table>
					</td>
				</tr>			
				<tr class="Linha1Tabela">
					<td align="center" colspan="2">
					<? if($this->pegaExt($banner->getBanner()) == "swf") { ?>													
						<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$width;?>" height="<?=$height;?>" id="promocao" align="middle">
						<param name="movie" value="../images/banners/<?=$banner->getBanner();?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="bgcolor" value="#ffffff" /><embed src="../images/banners/<?=$banner->getBanner();?>" quality="high" wmode="transparent" bgcolor="#ffffff" width="<?=$width;?>" height="<?=$height;?>" name="promocao" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
						</object>
					<? }else{ ?>
						<img src="../images/banners/<?=$banner->getBanner();?>" width="<?=$width;?>" height="<?=$height;?>" border="0">
					<? } ?>
					<? if(!$idbanner) { ?>																	
					<input type="hidden" name="iddep" value="<?=$iddep;?>">				
					<input type="hidden" name="lado" value="<?=$lado;?>">				
					<input type="hidden" name="numero" value="<?=$numero;?>">				
					<input type="hidden" name="largura" value="<?=$largura;?>">				
					<input type="hidden" name="altura" value="<?=$altura;?>">				
					<? }else{ ?>
					<input type="hidden" name="idbanner" value="<?=$banner->getIdbanner();?>">
					<input type="hidden" name="banner" value="<?=$banner->getBanner();?>">																	
					<input type="hidden" name="iddep" value="<?=$banner->getIddepartamento();?>">																	
					<input type="hidden" name="lado" value="<?=$banner->getLado();?>">				
					<input type="hidden" name="numero" value="<?=$banner->getNumero();?>">
					<input type="hidden" name="largura" value="<?=$largura;?>">				
					<input type="hidden" name="altura" value="<?=$altura;?>">	
					<? } ?>
					</td>
				</tr>
			</table>		
			</form>	
	<?	}
	}
?>