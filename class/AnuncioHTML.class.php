<?php
	class AnuncioHTML extends HTML {
		function AnuncioMostra() { ?>
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
						<form method="POST" action="principal.php?menu=3&act=gold">
							<tr>
								<td width="12%"><b>Bairro :</b></td>
								<td>
									<? 
										$departamentos = new Departamento();
										$departamentosDAO = new DepartamentoDAO();
										$departamentos = $departamentosDAO->Lista();
										
										$this->selectDepartamentosAdmin($departamentos); 
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
	                <td>SERVIÇO</td>                                              
	                <td>ANÚNCIO</td>                                              
	            </tr>
				<tr class="Linha1Tabela" onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';" onclick="javascript: window.location='?menu=3&act=altgold&idanuncio=<?=$anuncios->idanuncio;?>';"> 
		            <td align="center"><?=$anuncios->idanuncio;?></td>					            
		            <td><?=$anuncios->nome;?></td>					            					           
		            <td><?//=classAdmSQL::get("servicos","idservico",$anuncios->idservico)->servico;?></td>					            					           
			        <td><?=$anuncios->tipo;?></td>    
		        </tr>
				<tr class="Linha1Tabela"> 
		            <td align="center" colspan="4"><b>Não há nenhum anúncio cadastrado.</b></td>
		        </tr>
		    </table>
		    <br>
		    <table width="400" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
		        <tbody>
			        <tr class="TituloTabela">
			            <td height="30" align="center" colspan="2">RESUMO DESTA CONSULTA</td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros por Página:</b></td>
			            <td width="40%" height="20"><?//=mysql_num_rows($rs);?></td>
			        </tr>
			        <tr class="Linha2Tabela">
			            <td height="20"><b>Total de Páginas:</b></td>
			            <td height="20"><?=$paginas;?></td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros:</b></td>
			            <td width="40%" height="20"><?//=mysql_num_rows(classAdmSQL::lst("anuncios","WHERE tipo = 'Gold' AND idbairro = '$idbairro'"));?></td>
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
		 
		function busca_subdepartamentos($departamento) {
    		$subdepartamento = new Subdepartamento();
    		$subdepartamentoDAO = new SubdepartamentoDAO();
    		$subdepartamento = $subdepartamentoDAO->getSubdepartamentosPorIddepartamento($departamento);
    		
    		$this->selectSubdepartamentosAdminAnuncios($subdepartamento);
		}
	
		function AnuncioADD() { ?>
		<?
		
			$cep = $_GET["cep"];
			
			if(isset($cep)) {
				$resultado_busca = $this->busca_cep($cep);
			}
			
			$iddepartamento = $_GET["iddepartamento"]; 
		?>		
	        <span class="TituloPage">• Adicionar Anúncio</span>
	        <br/>
	        <br/>                         
	        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
	        <form action="act/Anuncio.act.php?acao=add" name="anuncios" method="post" enctype="multipart/form-data">                       
	        <input type="hidden" name="iddepartamento" value="<?=$iddepartamento;?>">
		        <tbody>
		        	<tr class="Linha2Tabela">
	                    <td align="right"><b> DEPARTAMENTO:</b></td>
	                    <td>
	                    	<?
	                    		$departamento = new Departamento();
	                    		$departamentoDAO = new DepartamentoDAO();
	                    		$departamento = $departamentoDAO->Lista();
	                    		if(isset($iddepartamento)) {
	                    			$this->selectDepartamentosAdminAnuncios($departamento);
	                    		}else{
	                    			$this->selectDepartamentosAdminAnuncios($departamento);
	                    		}
	                    	?>
	                    </td>
	                </tr>
	                <? if(isset($iddepartamento)) { ?>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> SUBDEPARTAMENTOS:</b></td>
	                    <td>
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
								<?
		                    		$subdepartamento = new Subdepartamento();
		                    		$subdepartamentoDAO = new SubdepartamentoDAO();
		                    		$subdepartamento = $subdepartamentoDAO->getSubdepartamentosPorIddepartamento($iddepartamento);
		                    		
		                    		$this->selectSubdepartamentosAdminAnuncios($subdepartamento);
		                    	?>
								</tr>
							</table>
	                    </td>                    
	                </tr>
	                <? }else{ ?>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> SUBDEPARTAMENTOS:</b></td>
	                    <td>
	                    	<select class="FORMbox" name="idsubdepartamento" id="idsubdepartamento" style="z-index:0" disabled>		                	
	                    		<option value="">--Selecione o departamento--</option>                    		
			                </select>
	                    </td>
	                </tr>
	                <? } ?>		        	                            	   	
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> NOME DO ANÚNCIANTE</b></td>
	                    <td><input type="text" value="" class="FORMbox" size="75" name="nome"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> CEP</b></td>
	                    <td><input type="text" tipo="numerico" mascara="#####-###" onfocus="this.value = ''" onblur="javascript:buscaCep(this.value)" id="campoCEP" name="campoCEP" maxlength="9" snegativo="n" title="Cep" style="width: 80px;" tabindex="4" class="FORMBox"/></td>
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
	                    <td><input type="text" value="<?=$resultado_busca['bairro'];?>" class="FORMbox" size="15" id="bairro" name="bairro"/></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> CIDADE</b></td>
	                    <td><input type="text" value="<?=$resultado_busca['cidade'];?>" class="FORMbox" size="15" id="cidade" name="cidade"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> ESTADO</b></td>
	                    <td><input type="text" value="<?=$resultado_busca['uf'];?>" class="FORMbox" size="15" id="estado" name="estado"/></td>
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
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> IMAGEM 1</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem1"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> IMAGEM 2</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem2"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> IMAGEM 3</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem3"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="right"><b> IMAGEM 4</b></td>
	                    <td><input type="file" value="" class="FORMbox" size="45" name="imagem4"/></td>
	                </tr>
	                <tr class="Linha1Tabela">
	                    <td align="center"><b>DESCRIÇÃO DO ANÚNCIO</b></td>
	                    <td>                                    	
	                    	<textarea name="texto" rows="10" cols="70" class="FORMBox"></textarea>  		                                                                                                     
	                    </td>
	            	</tr>
	                <!--<tr class="Linha1Tabela">
	                    <td align="right"><b> BANNER</b></td>
	                    <td>
		                    <select name="destaque" class="FORMBox" onchange="dest(this.value);">
		                    	<option value="">--Selecione--</option>
		                    	<option value="1">Sim</option>
		                    	<option value="2">Não</option>
		                    </select>
		                     <select id="pagina" name="pagina" class="FORMBox" style="display:none;">
		                    	<option value="">--Selecione--</option>
		                    	<option value="1">Inicial</option>
		                    	<option value="2">Bairros</option>
		                    </select>
	                    </td>                    
	                </tr>-->
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> PAGAMENTO</b></td>
	                    <td>
	                    	<select name="pagamento" class="FORMBox">
		                    	<option value="">--Selecione--</option>
		                    	<option value="1">1 Mês</option>	              
		                    	<option value="2">2 Meses</option>	              
		                    	<option value="3">3 Meses</option>
		                    	<option value="4">4 Meses</option>
		                    	<option value="5">5 Meses</option>
		                    	<option value="6">6 Meses</option>
		                    	<option value="12">12 Meses</option>
		                    </select>
		                    <input type="text" class="data">
	                    </td>
	                </tr>
	                <!--<tr class="Linha1Tabela">
	                    <td align="right"><b> ENVIAR CONTRATO</b></td>
	                    <td><input type="checkbox" value="sim" name="contrato" class="FORMBox"></td>
	                </tr>
	                <tr class="Linha2Tabela">
	                    <td align="right"><b> STATUS</b></td>
	                    <td>
	                    	<select name="status" class="FORMBox">
		                    	<option value="0">Ativo</option>
		                    	<option value="1">Inativo</option>	              	                    	
		                    </select>
	                    </td>
	                </tr>-->
	                <tr class="Linha3Tabela">
		                <td align="right" colspan="2"><input type="submit" class="bttn2" value="Inserir Anuncio" name="alterar"/></td>
		            </tr>
	        	</tbody>
	        </table>
	        </form>                
	<?	}
	}
?>