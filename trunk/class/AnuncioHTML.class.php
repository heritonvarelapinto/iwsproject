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
	        <?
	        	if($rs = classAdmGeral::paginacao("anuncios",$inicio,$totalPorPagina,"WHERE tipo = 'Gold' AND idbairro = '$idbairro' ORDER BY nome")) {
		        	if(mysql_num_rows($rs) > 0) {	
		        		while($anuncios = classAdmGeral::resultado($rs)) {?>
		        				<tr class="Linha1Tabela" onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';" onclick="javascript: window.location='?menu=3&act=altgold&idanuncio=<?=$anuncios->idanuncio;?>';"> 
						            <td align="center"><?=$anuncios->idanuncio;?></td>					            
						            <td><?=$anuncios->nome;?></td>					            					           
						            <td><?=classAdmSQL::get("servicos","idservico",$anuncios->idservico)->servico;?></td>					            					           
							        <td><?=$anuncios->tipo;?></td>    
						        </tr>
		        			<?
		        		}
		        	classAdmGeral::mostraPaginacao($paginas,$pagina,"menu=3&act=gold");
		        	}else{ ?>            		           
						<tr class="Linha1Tabela"> 
				            <td align="center" colspan="4"><b>Não há nenhum anúncio cadastrado.</b></td>
				        </tr>
				<? }
	        	} ?>
		    </table>
		    <br>
		    <table width="400" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
		        <tbody>
			        <tr class="TituloTabela">
			            <td height="30" align="center" colspan="2">RESUMO DESTA CONSULTA</td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros por Página:</b></td>
			            <td width="40%" height="20"><?=mysql_num_rows($rs);?></td>
			        </tr>
			        <tr class="Linha2Tabela">
			            <td height="20"><b>Total de Páginas:</b></td>
			            <td height="20"><?=$paginas;?></td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros:</b></td>
			            <td width="40%" height="20"><?=mysql_num_rows(classAdmSQL::lst("anuncios","WHERE tipo = 'Gold' AND idbairro = '$idbairro'"));?></td>
			        </tr>		        
		    	</tbody>
		    </table>
		    <br>
		    <table>
		    	<tr>
		    		<td><input type="button" value="Cadastrar Anuncio" onclick="document.location='principal.php?menu=3&act=addgold';" class="bttn2"></td>
		    	</tr>
		    </table>
		    
	<?	}
	}
?>