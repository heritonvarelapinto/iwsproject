<?php
	class AnuncioHTML extends HTML {
		function AnuncioMostra($totRegistrosPorPagina) { 
			$anuncio = new Anuncio();
			$anuncioDAO = new AnuncioDAO();
			
			
			
			if($_POST["iddepartamento"] != "") {
				$_SESSION["iddepartamento"] = $_POST["iddepartamento"];
				$iddepartamento = $_SESSION["iddepartamento"];
			}
			
			$pagina = $_GET["pag"];
			if(!isset($pagina)) { $pagina = 0;}
			
			$letra = $_GET["letra"];
			if(isset($_GET["letra"])) {
				$order = "WHERE iddepartamento = '$_SESSION[iddepartamento]' AND nome LIKE '$letra%' ORDER BY idanuncio";				
			}else{
				if(isset($iddepartamento)) {
					$order = "WHERE iddepartamento = '$iddepartamento' ORDER BY idanuncio";					
				}else{
					$order = "ORDER BY idanuncio";
				}
				
			}
			
			$totalPorPagina = $totRegistrosPorPagina;
			$inicio = $pagina * $totalPorPagina;
			?>
			<span class="TituloPage">• Anúncios</span>
	        <br>
	        <br>
	        <table border="0" width="100%" border="0" cellpadding="4" cellspacing="1" class="BordaTabela"> 
	        	<?
					switch ($_GET["msg"]) {
						case 1:
							$this->mostraMSG("Anúncio adicionado com sucesso.");
						break;	
						case 2:
							$this->mostraMSG("Anúncio alterado com sucesso.");
						break;
						case 3:
							$this->mostraMSG("Anúncio removido com sucesso.");
						break;							
					}
				?>
				<tr>
					<td colspan="2">
					
						<table border="0" width="100%" class="BordaTabela">
						<form method="POST" action="principal.php?menu=7&act=mostra" onsubmit="return valida_dropmenu(iddepartamento,'opção');">
							<tr>
								<td width="12%"><b>Departamento:</b></td>
								<td>
									<? 
										$departamentos = new Departamento();
										$departamentosDAO = new DepartamentoDAO();
										$departamentos = $departamentosDAO->Lista();
										
										$this->selectDepartamentosAdminMostra($departamentos); 
									?>
								</td>
								<td><input type="submit" value="Enviar" class="bttn1"></td>							
							</tr>
							</form>						
						</table>
					
					</td>				
				</tr>
	            <tr class="TituloTabela">
	                <td width="10%" align="center">COD</td>
	                <td>NOME</td>                                              
	                <td>BAIRRO</td>                                              
	                <td>VALIDADE</td>                                              
	            </tr>
	            <?
	            	
					$anuncio = $anuncioDAO->Paginacao($order,$inicio,$totalPorPagina);
					$registros = $anuncioDAO->Registros($order);
					
					$paginas = ceil($registros / $totalPorPagina);
					
					$totAnuncios = count($anuncio);

					for ($i=0;$i<$totAnuncios;$i++) {
	            ?>
				<tr class="Linha1Tabela" onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';" onclick="javascript: window.location='?menu=7&act=alt&idanuncio=<?=$anuncio[$i]->getIdanuncio();?>';"> 
		            <td align="center"><?=$anuncio[$i]->getIdanuncio();?></td>					            
		            <td><?=$anuncio[$i]->getNome();?></td>					            					           
		            <td><?=$anuncio[$i]->getBairro();?></td>					            					           
			        <td><?=$anuncio[$i]->MostraDataSemHora($anuncio[$i]->getAte());?></td>    
		        </tr>
		        <?
					}
		        ?>
		        <? if($totAnuncios < 1) { ?>
 				<tr class="Linha1Tabela"> 
		            <td align="center" colspan="4"><b>Não há nenhum anúncio cadastrado.</b></td>
		        </tr>
		        <? } ?>
		        <? 
		        	if(isset($_GET["letra"])) {
		        		$this->mostraPaginacao($paginas,$pagina,"menu=7&act=mostra&letra=$letra");
		        	}else{
		        		$this->mostraPaginacao($paginas,$pagina,"menu=7&act=mostra");
		        	}
		        	$this->mostraPaginacaoLetras("menu=7&act=mostra",$letra);
		        	
		        ?>
		    </table>
		    <br>
		    <table width="400" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
		        <tbody>
			        <tr class="TituloTabela">
			            <td height="30" align="center" colspan="2">RESUMO DESTA CONSULTA</td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros por Página:</b></td>
			            <td width="40%" height="20"><?=$totAnuncios;?></td>
			        </tr>
			        <tr class="Linha2Tabela">
			            <td height="20"><b>Total de Páginas:</b></td>
			            <td height="20"><?=$paginas;?></td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros:</b></td>
			            <td width="40%" height="20"><?=$registros;?></td>
			        </tr>
		    	</tbody>
		    </table>
		    <br>
		    <table>
		    	<tr>
		    		<td><input type="button" value="Cadastrar Anuncio" onclick="document.location='principal.php?menu=7&act=add';" class="bttn2"></td>
		    	</tr>
		    </table>
		    
	<?	}
	
		function busca_cep($cep){  
			 
			 $url = 'http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string';
		     $resultado = @file_get_contents($url);  
		     if(!$resultado){  
		         $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
		     } 
		     parse_str($resultado, $retorno);   
		     return $retorno;  
		 }
	
		function AnuncioADD() { ?>
		<?
		
			$cep = $_GET["cep"];
			
			if(isset($cep)) {
				$resultado_busca = $this->busca_cep($cep);
			}
			
		?>
		<script>
				$(function() {
				    // valida o formulário
				    $('#anuncios').validate({
				        // define regras para os campos
				        rules: {					        			          
				            nome: {
				                required: true,
				                minlength: 2
				            },
				            cep: {
				                required: true,
				                minlength: 9
				            },
				            endereco: {
				                required: true,
				                minlength: 2
				            },
				            numero: {
				                required: true,
				                minlength: 1
				            },
				            bairro: {
				                required: true,
				                minlength: 2
				            },
				            cidade: {
				                required: true,
				                minlength: 2
				            },
				            estado: {
				                required: true,
				                minlength: 2
				            },
				            telefones: {
				                required: true,
				                minlength: 2
				            },				            
				            destaque: {
				                required: true
				            },
				            de: {
				                required: true,
				                minlength: 9
				            },
				            ate: {
				                required: true,
				                minlength: 9
				            },
				            texto: {
				                required: true,
				                minlength: 2
				            }
				        },
				        // define messages para cada campo
				        messages: {				            
				            nome: "<br><b><font color='red'>Preencha o seu nome</font></b>",
				            cep: "<br><b><font color='red'>Digite um número de Cep</font></b>",
				            endereco: "<br><b><font color='red'>Se não sabe seu endereço , coloque o cep no campo CEP</font></b>",
				            numero: "<br><b><font color='red'>Digite o número</font></b>",
				            bairro: "<br><b><font color='red'>Se não sabe seu bairro , coloque o cep no campo CEP</font></b>",
				            cidade: "<br><b><font color='red'>Se não sabe sua cidade , coloque o cep no campo CEP</font></b>",
				            estado: "<br><b><font color='red'>Se não sabe seu estado , coloque o cep no campo CEP</font></b>",
				            telefones: "<br><b><font color='red'>Nescessário no mínimo um número de telefone</font></b>",
				            destaque: "<br><b><font color='red'>Selecione uma opção</font></b>",
				            de: "<b><font color='red'>Coloque uma data</font></b>",
				            ate: "<b><font color='red'>Coloque uma data</font></b>",
				            texto: "<br><b><font color='red'>Escreva uma descrição</font></b>",
				        }
				    });
				});				
			</script>			
	        <span class="TituloPage">• Adicionar Anúncio</span>
	        <br/>
	        <br/>                         
	        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
	        <form action="act/Anuncio.act.php?acao=add" name="anuncios" id="anuncios" method="post" enctype="multipart/form-data">                       
	        <input type="hidden" name="iddepartamento" value="<?=$iddepartamento;?>">
		        <tbody>
		        	<tr class="Linha2Tabela">
	                    <td align="right"><b> DEPARTAMENTO:</b></td>
	                    <td>
	                    	<div id="departamento">
		                    	<?
		                    		$departamento = new Departamento();
		                    		$departamentoDAO = new DepartamentoDAO();
		                    		$departamento = $departamentoDAO->Lista();
	                    			$this->selectDepartamentosAdminAnuncios($departamento);
		                    	?>
			                </div>
	                    </td>
	                </tr>	                
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> SUBDEPARTAMENTOS:</b></td>
	                    <td>	                    	
		                	<select name="idsubdepartamento" id="idsubdepartamento" class="FORMbox">
		                		<option>--Selecione um departamento--</option>
		                	</select>
	                    </td>
	                </tr>	                		        	                            	   
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> NOME DO ANÚNCIANTE</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="75" name="nome"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> CEP</b></td>
	                    <td><input type="text" tipo="numerico" mascara="#####-###" onfocus="this.value = ''" onblur="javascript:buscaCep(this.value)" id="cep" name="cep" maxlength="9" snegativo="n" title="Cep" style="width: 80px;" tabindex="4" class="FORMBox"/></td>
	                </tr>
	                <div id="resultado">
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> ENDEREÇO</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="75" id="endereco" name="endereco"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> NÚMERO</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="15" name="numero"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> COMPLEMENTO</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="15" name="complemento"/></td>
	                </tr>  
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> BAIRRO</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="15" id="bairro" name="bairro"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> CIDADE</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="15" id="cidade" name="cidade"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> ESTADO</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="15" id="estado" name="estado"/></td>
	                </tr>
	                </div>               
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> TELEFONES</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="75" name="telefones"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> E-MAIL</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="75" name="email"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> SITE</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="75" name="site"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> LOGO</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="logo"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> IMAGEM 1</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem1"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> IMAGEM 2</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem2"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> IMAGEM 3</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem3"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> IMAGEM 4</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem4"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> DESTAQUE</b></td>
	                    <td>
	                    	<select name="destaque" id="destaque" class="FORMBox">
	                    		<option value="">--Selecione--</option>
	                    		<option value="1">Sim</option>
	                    		<option value="0">Não</option>
	                    	</select>
	                    </td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> PAGAMENTO</b></td>
	                    <td>
	                    	De:<input type="text" name="de" class="data FORMBox">
	                    	até:<input type="text" name="ate" class="data FORMBox">
	                    </td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="center"><b>DESCRIÇÃO DO ANÚNCIO</b></td>
	                    <td>                                    	
	                    	<textarea name="texto" rows="10" cols="70" class="FORMBox"></textarea>  		                                                                                                     
	                    </td>
	            	</tr>
	                <tr class="Linha3Tabela">
		                <td align="right" colspan="2"><input type="submit" class="bttn2" value="Inserir Anuncio" name="alterar"/></td>
		            </tr>
	        	</tbody>
	        </table>
	        </form>                
	<?	}
	
		function AnuncioALT() { ?>
		<?
			$anuncio = new Anuncio();
			$anuncioDAO = new AnuncioDAO();
		
			$cep = $_GET["cep"];
			
			if(isset($cep)) {
				$resultado_busca = $this->busca_cep($cep);
			}
			
			$idanuncio = $_GET["idanuncio"]; 
			$anuncio = $anuncioDAO->getAnuncioPorId($_GET["idanuncio"]);
		?>		
	        <span class="TituloPage">• Alterar Anúncio</span>
	        <br/>
	        <br/>                         
	        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
	        <form action="act/Anuncio.act.php?acao=alt" name="anuncios" method="post" enctype="multipart/form-data">                       
	        <input type="hidden" name="idanuncio" value="<?=$anuncio->getIdanuncio();?>">
	        <input type="hidden" name="iddepartamento" value="<?=$iddepartamento;?>">
		        <tbody>
		        	<tr class="Linha2Tabela">
	                    <td align="right"><b> DEPARTAMENTO:</b></td>
	                    <td>
	                    	<div id="departamento">
		                    	<?
		                    		$departamento = new Departamento();
		                    		$departamentoDAO = new DepartamentoDAO();
		                    		$departamento = $departamentoDAO->Lista();
	                    			$this->selectDepartamentosAdminAlt($departamento,$anuncio->getIddepartamento());
		                    	?>
			                </div>
	                    </td>
	                </tr>	                
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> SUBDEPARTAMENTOS:</b></td>
	                    <td>	
	                    	<?
								$subdepartamento = new Subdepartamento();
								$subdepartamentoDAO = new SubdepartamentoDAO();
								$subdepartamento = $subdepartamentoDAO->getSubdepartamentosPorIddepartamento($anuncio->getIddepartamento());
	                		?>                    	
		                		<select name="idsubdepartamento" id="idsubdepartamento" class="FORMbox">
								<?
								if(count($subdepartamento) > 0 && $anuncio->getIdsubdepartamento() != 0) {
								for($i=0;$i < count($subdepartamento);$i++) { ?>
								<option <? if($anuncio->getIdsubdepartamento() == $subdepartamento[$i]->getIdsubdepartamento()) echo "selected" ?> value="<?=$subdepartamento[$i]->getIdsubdepartamento();?>"><?=$subdepartamento[$i]->getSubdepartamento();?></option>
								<? }
								} else {
								?>
								<option value="0">Sem Subdepartamento</option>
								<?
								}
								?>
								</select>
	                    </td>
	                </tr>	        	                            	   	
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> NOME DO ANÚNCIANTE</b></td>
	                    <td><input type="text" value="<?=$anuncio->getNome();?>" class="FORMbox" size="75" name="nome"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> CEP</b></td>
	                    <td><input type="text" tipo="numerico" mascara="#####-###" value="<?=$anuncio->getCep();?>" onfocus="this.value = ''" onblur="javascript:buscaCep(this.value)" id="cep" name="cep" maxlength="9" snegativo="n" title="Cep" style="width: 80px;" class="FORMBox"/></td>
	                </tr>
	                <div id="resultado">
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> ENDEREÇO</b></td>
	                    <td><input type="text" value="<?=$anuncio->getEndereco();?>" class="FORMbox" size="75" id="endereco" name="endereco"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> NÚMERO</b></td>
	                    <td><input type="text" value="<?=$anuncio->getNumero();?>" class="FORMbox" size="15" name="numero"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> COMPLEMENTO</b></td>
	                    <td><input type="text" value="<?=$anuncio->getComplemento();?>" class="FORMbox" size="15" name="complemento"/></td>
	                </tr>  
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> BAIRRO</b></td>
	                    <td><input type="text" value="<?=$anuncio->getBairro();?>" class="FORMbox" size="15" id="bairro" name="bairro"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> CIDADE</b></td>
	                    <td><input type="text" value="<?=$anuncio->getCidade();?>" class="FORMbox" size="15" id="cidade" name="cidade"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> ESTADO</b></td>
	                    <td><input type="text" value="<?=$anuncio->getEstado();?>" class="FORMbox" size="15" id="estado" name="estado"/></td>
	                </tr>
	                </div>               
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> TELEFONES</b></td>
	                    <td><input type="text" value="<?=$anuncio->getTelefones();?>" class="FORMbox" size="75" name="telefones"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> E-MAIL</b></td>
	                    <td><input type="text" value="<?=$anuncio->getEmail();?>" class="FORMbox" size="75" name="email"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> SITE</b></td>
	                    <td><input type="text" value="<?=$anuncio->getSite();?>" class="FORMbox" size="75" name="site"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> LOGO</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="logo"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                	<td align="center" colspan="2"><img src="../images/logos/<?=$anuncio->getLogo();?>" border="0"><input type="hidden" name="logo" value="<?=$anuncio->getLogo();?>"></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> IMAGEM 1</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem1"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                	<td align="center" colspan="2"><img src="../images/thumbs/<?=$anuncio->getImagem1();?>" border="0"><input type="hidden" name="imagem1" value="<?=$anuncio->getImagem1();?>"></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> IMAGEM 2</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem2"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                	<td align="center" colspan="2"><img src="../images/thumbs/<?=$anuncio->getImagem2();?>" border="0"><input type="hidden" name="imagem2" value="<?=$anuncio->getImagem2();?>"></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> IMAGEM 3</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem3"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                	<td align="center" colspan="2"><img src="../images/thumbs/<?=$anuncio->getImagem3();?>" border="0"><input type="hidden" name="imagem3" value="<?=$anuncio->getImagem3();?>"></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> IMAGEM 4</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem4"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                	<td align="center" colspan="2"><img src="../images/thumbs/<?=$anuncio->getImagem4();?>" border="0"><input type="hidden" name="imagem4" value="<?=$anuncio->getImagem4();?>"></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> DESTAQUE</b></td>
	                    <td>
	                    	<select name="destaque" id="destaque" class="FORMBox">
	                    		<option value="">--Selecione--</option>
	                    		<option value="1" <? if($anuncio->getDestaque() == 1) { echo "selected"; } ?>>Sim</option>
	                    		<option value="0" <? if($anuncio->getDestaque() == 0) { echo "selected"; } ?>>Não</option>
	                    	</select>
	                    </td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> PAGAMENTO</b></td>
	                    <td>
	                    	De:<input type="text" name="de" value="<?=$anuncio->MostraDataSemHora($anuncio->getDe());?>" class="data FORMBox">
	                    	até:<input type="text" name="ate" value="<?=$anuncio->MostraDataSemHora($anuncio->getAte());?>" class="data FORMBox">
	                    </td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="center"><b>DESCRIÇÃO DO ANÚNCIO</b></td>
	                    <td>                                    	
	                    	<textarea name="texto" rows="10" cols="70" class="FORMBox"><?=$anuncio->getTexto();?></textarea>  		                                                                                                     
	                    </td>
	            	</tr>
	                <tr class="Linha3Tabela">
		                <td align="right" colspan="2"><input type="submit" class="bttn4" value="Alterar Anuncio" name="alterar"/>&nbsp;&nbsp;<input type="submit" class="bttn3" value="Remover Anuncio" onclick="return confirma_apagar();" name="remover"/></td>
		            </tr>
	        	</tbody>
	        </table>
	        </form>                
	<?	}
	}
?>