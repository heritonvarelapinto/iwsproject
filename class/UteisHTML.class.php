<?php
	class UteisHTML extends HTML {
		function UteisMostra($totRegistrosPorPagina) {
			$uteis = new Uteis();
			$uteisDAO = new UteisDAO();
			
			$pagina = $_GET["pag"];
			if(!isset($pagina)) { $pagina = 0;}
			
			$totalPorPagina = $totRegistrosPorPagina;
			$inicio = $pagina * $totalPorPagina;
		?>
			<span class="TituloPage">• Link Úteis Cadastrados</span>
	        <br>
	        <br>
	                             
	        <table border="0" width="100%" border="0" cellpadding="4" cellspacing="1" class="BordaTabela"> 
	        	<?
					switch ($_GET["msg"]) {
						case 1:
							$this->mostraMSG("Link adicionado com sucesso.");
						break;	
						case 2:
							$this->mostraMSG("Link alterado com sucesso.");
						break;
						case 3:
							$this->mostraMSG("Link removido com sucesso.");
						break;							
					}
				?>
	            <tr class="TituloTabela">
	                <td width="10%" align="center">COD</td>
	                <td align="center">LINK</td>                                              
	            </tr>
	            <?
	            	
					$uteis = $uteisDAO->Paginacao($inicio,$totalPorPagina);
					$registros = $uteisDAO->Registros($order);
					
					$paginas = ceil($registros / $totalPorPagina);
					
					$totUteis = count($uteis);

					for ($i=0;$i<$totUteis;$i++) {
	            ?>
					<tr class="Linha1Tabela" onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';" onclick="javascript: window.location='?menu=8&act=alt&iduteis=<?=$uteis[$i]->getIduteis();?>';"> 
			            <td align="center"><?=$uteis[$i]->getIduteis();?></td>					            
			            <td><? if($uteis[$i]->getOpcao() == 0) { echo $uteis[$i]->getLink(); }else{ echo substr($uteis[$i]->getTexto(),0,30); } ?></td>					            					           
			        </tr>
		        <?
					}
		        ?>
		        <? if($totUteis < 1) { ?>
 				<tr class="Linha1Tabela"> 
		            <td align="center" colspan="4"><b>Não há nenhum link util cadastrado.</b></td>
		        </tr>
		        <? } ?>
		        <? 
	        		$this->mostraPaginacao($paginas,$pagina,"menu=2&act=mostra");
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
			            <td width="40%" height="20"><?=$totUteis;?></td>
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
	<?	}
		
		function UteisADD() {
			?>
			<span class="TituloPage">• Alterar Link Útil</span>
	        <br/>
	        <br/>
			<form method="POST" action="act/Uteis.act.php?acao=add" enctype="multipart/form-data">			
			<table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
				<tr class="Linha1Tabela">
					<td align="center">
						<table align="center" width="100%" border="0" cellpadding="3" cellspacing="1">										
							<tr class="Linha1Tabela">
								<td width="35%"><b>Imagem ou animaçao do link útil:</b></td>
								<td><input class="FORMbox" type="file" name="imagem" size="50"></td>							
							</tr>
							<tr class="Linha1Tabela">
								<td><b>Link ou texto ?</b></td>
								<td>
									<select name="opcao" class="FORMBox" onchange="uteis(this.value);">
										<option value="">--Selecione--</option>
										<option value="0">Link</option>
										<option value="1">Texto</option>
									</select>
								</td>
							</tr>	
							<tr id="link" style="display:none" class="Linha1Tabela">
								<td><b>Link:</b></td>
								<td><input class="FORMbox" type="text" name="link" size="50" value=""></td>
							</tr>
							<tr id="texto" style="display:none" class="Linha1Tabela">
								<td align="center" colspan="2"><b>Texto</b></td>
							</tr>
							<tr id="texto1" style="display:none" class="Linha1Tabela">
								<td align="center" colspan="2"><textarea name="texto" cols="100" rows="40" class="FORMBox"></textarea></td>
							</tr>					
							<tr class="Linha1Tabela">
								<td colspan="2"><input type="submit" class="bttn2" name="botao" value="Cadastrar"><input type="button" class="bttn1" value="Voltar" onclick="javascript:history.back();"></td>
							</tr>							
						</table>
					</td>
				</tr>			
				<tr class="Linha1Tabela">
					<td align="center" colspan="2">
					
					</td>
				</tr>
			</table>		
			</form>	
	<?	}
	
		function UteisALT() {
			$iduteis = $_GET["iduteis"];
			
			$uteis = new Uteis();
			$uteisDAO = new UteisDAO();
			$uteis = $uteisDAO->getUteisPorId($iduteis);
			
			?>
			<span class="TituloPage">• Alterar Link Útil</span>
	        <br/>
	        <br/>
			<form method="POST" action="act/Uteis.act.php?acao=alt" enctype="multipart/form-data">			
			<table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
			<input type="hidden" name="iduteis" value="<?=$uteis->getIduteis();?>">
				<tr class="Linha1Tabela">
					<td align="center">
						<table align="center" width="100%" border="0" cellpadding="3" cellspacing="1">										
							<tr class="Linha1Tabela">
								<td width="35%"><b>Imagem ou animaçao do link útil:</b></td>
								<td><input class="FORMbox" type="file" name="imagem" size="50"></td>							
							</tr>
							<tr class="Linha1Tabela">
								<td><b>Link ou texto ?</b></td>
								<td>
									<select name="opcao" class="FORMBox" onchange="uteis(this.value);">
										<option value="">--Selecione--</option>
										<option <? if($uteis->getOpcao() == 0) { echo "selected"; } ?> value="0">Link</option>
										<option <? if($uteis->getOpcao() == 1) { echo "selected"; } ?> value="1">Texto</option>
									</select>
								</td>
							</tr>	
							<tr id="link" <? if($uteis->getOpcao() == 0) { echo "style='display:'"; }else{ echo "style='display:none'"; } ?> class="Linha1Tabela">
								<td><b>Link:</b></td>
								<td><input class="FORMbox" type="text" name="link" size="50" value="<?=$uteis->getLink();?>"></td>
							</tr>
							<tr id="texto" <? if($uteis->getOpcao() == 1) { echo "style='display:'"; }else{ echo "style='display:none'"; } ?> class="Linha1Tabela">
								<td align="center" colspan="2"><b>Texto</b></td>
							</tr>
							<tr id="texto1" <? if($uteis->getOpcao() == 1) { echo "style='display:'"; }else{ echo "style='display:none'"; } ?> class="Linha1Tabela">
								<td align="center" colspan="2"><textarea name="texto" cols="100" rows="40" class="FORMBox"><?=$uteis->getTexto();?></textarea></td>
							</tr>					
							<tr class="Linha1Tabela">
								<td colspan="2"><input type="submit" class="bttn4" name="botao" value="Alterar">&nbsp;&nbsp;<input type="submit" class="bttn3" value="Remover Link" onclick="return confirma_apagar();" name="remover"/></td>
							</tr>							
						</table>
					</td>
				</tr>			
				<tr class="Linha1Tabela">
					<td align="center" colspan="2">
						<img src="../images/uteis/<?=$uteis->getImagem();?>" border="0">
						<input type="hidden" name="imagem" value="<?=$uteis->getImagem();?>">
					</td>
				</tr>
			</table>		
			</form>	
	<?	}
	}
?>