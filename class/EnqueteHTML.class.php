<?php
	class EnqueteHTML extends HTML {
		public function EnquetesMostra($totRegistrosPorPagina) {
			$enquete = new Enquete();
			$enqueteDAO = new EnqueteDAO();
			
			$pagina = $_GET["pag"];
			if(!isset($pagina)) { $pagina = 0;}
					
			$order = "ORDER BY pergunta";
			
			$totalPorPagina = $totRegistrosPorPagina;
			$inicio = $pagina * $totalPorPagina;
			
			?>
			<span class="TituloPage">• Enquetes</span>
	        <br>
	        <br>
	        <table border="0" width="100%" border="0" cellpadding="4" cellspacing="1" class="BordaTabela"> 
	        	<?
					switch ($_GET["msg"]) {
						case 1:
							$this->mostraMSG("Enquete removida com sucesso.");
						break;	
						case 2:
							$this->mostraMSG("Apenas uma enquete pode ficar ativa.");
						break;												
					}
				?>
	            <tr class="TituloTabela">
	                <td width="75%" align="center">PERGUNTAS</td>
	                <td align="center">TOTAL VOTOS</td>                                              
	                <td align="center">STATUS</td>                                              
	            </tr>
	            <?
	            	$enquete = $enqueteDAO->Paginacao($order,$inicio,$totalPorPagina);
					$registros = $enqueteDAO->Registros($order);
					
					$paginas = ceil($registros / $totalPorPagina);
					
					$totEnquete = count($enquete);
					
	            	for ($i=0;$i<$totEnquete;$i++) {
	            		$voto = $enqueteDAO->getVotosPorID($enquete[$i]->getIdpergunta());
	            ?>
					<tr class="Linha1Tabela" onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';"> 
			            <td onclick="javascript: window.location='?menu=5&act=addresp&idpergunta=<?=$enquete[$i]->getIdpergunta();?>';"><?=$enquete[$i]->getPergunta();?></td>					            
			            <td onclick="javascript: window.location='?menu=5&act=addresp&idpergunta=<?=$enquete[$i]->getIdpergunta();?>';" align="center"><?if($voto->getVoto() == "") { echo "0"; }else{ echo $voto->getVoto(); }?></td>					            					           
			            <td align="center"><? $this->statusEnquete($enquete[$i]->getStatus(),$enquete[$i]->getIdpergunta());?></td>					            					           
			        </tr>
		        <?
	            	}
		        ?>
				<? if($totEnquete < 1) { ?>
 				<tr class="Linha1Tabela"> 
		            <td align="center" colspan="4"><b>Não há nenhuma enquete cadastrada.</b></td>
		        </tr>
		        <? } ?>
		        <? 
	        		$this->mostraPaginacao($paginas,$pagina,"menu=5&act=mostra");
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
			            <td width="40%" height="20"><?=$totEnquete;?></td>
			        </tr>
			        <tr class="Linha2Tabela">
			            <td height="20"><b>Total de Páginas:</b></td>
			            <td height="20"><?=$paginas;?></td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros:</b></td>
			            <td width="40%" height="20"><?=$registros;?></td>
			        </tr>
			        <? $execucao = new pageExecutionTimer(); ?>		        
		    	</tbody>
		    </table>
	<?	}
	
		public function EnqueteADDPerg() { ?>
		<span class="TituloPage">• Adicionar Enquete</span>
	    <br/>
	    <br/>
		<form method="POST" action="act/Enquete.act.php?acao=add" name="enquete" onsubmit="return valida_enquete_perg();">
			<table border="0" width="100%" border="0" cellpadding="4" cellspacing="1" class="BordaTabela">								
				<input type="hidden" name="data" value="<?=date("Y-m-d G:i:s");?>">			
	 			<tr class="Linha1Tabela">
					<td><b>PERGUNTA ENQUETE:</b></td>
					<td><input type="text" name="pergunta" size="80" class="FORMBox"></td>
				</tr>
				<tr class="Linha3Tabela">
					<td colspan="2" align="right"><input type="submit" value="Adicionar" class="bttn2">&nbsp;&nbsp;<input type="button" value="Voltar" onclick="javascript:history.back();" class="bttn1"></td>
				</tr>
			</table>
		</form>
	<?	}
	
		function EnqueteADDResp() {
			$enquete = new Enquete();
			$enqueteDAO = new EnqueteDAO();
			
			$idpergunta = $_GET["idpergunta"];
			$voto = $enqueteDAO->getVotosPorID($idpergunta);
			$total = $voto->getVoto();
			
			$enquete = $enqueteDAO->getPerguntaPorID($idpergunta);	
			
			$totRespostas = count($enquete);
			
			?>
			<span class="TituloPage">• Adicionar Respostas</span>
		    <br/>
		    <br/>
			<form method="POST" action="act/Enquete.act.php?acao=addresp" name="enquete" onsubmit="return valida_enquete_resp();">
				<table align="center" border="0" width="100%" cellpadding="4" cellspacing="1" class="BordaTabela">			
					<tr class="TituloTabela">
						<td colspan="2" align="center"><span class="titulo">Adicionar Respostas</span></td>								
					</tr>			
					<input type="hidden" name="idpergunta" value="<?=$idpergunta;?>">			 			
					<tr class="Linha1Tabela">
						<td><b>RESPOSTA:</b></td>
						<td><input type="text" name="resposta" size="80" class="FORMBox"></td>
					</tr>			
					<tr class="Linha3Tabela">
						<td align="right" colspan="2"><input type="submit" value="Adicionar" class="bttn2">&nbsp;&nbsp;<input type="button" value="Voltar" onclick="javascript:document.location='principal.php?menu=5&act=mostra';" class="bttn1"></td>				
					</tr>			
				</table>
				<br>
				<table align="center" border="0" width="100%" cellpadding="4" cellspacing="1" class="BordaTabela">			
					<tr>
						<td colspan="7" class="TituloTabela"><b><?=strtoupper($enquete[0]->getPergunta());?></b></td>
					</tr>
					<? if($enquete[0]->getIdresposta() != "") { ?>
					<tr class="Linha2Tabela">
						<td width="55%"><b>RESPOSTA</b></td>
						<td width="10%"><b>VOTO</b></td>
						<td width="25%"><b>PORCENTAGEM</b></td>
						<td width="10%" colspan="4"><b>EXCLUIR</b></td>						
					</tr>
						<? 
							for ($i=0;$i<$totRespostas;$i++) {							
						?>
							<tr class="Linha1Tabela">
								<td><?=$enquete[$i]->getResposta();?></td>
								<td><?=$enquete[$i]->getVoto();?></td>
								<td><?$this->pegaPercentual($enquete[$i]->getVoto(),$total);?> %</td>
								<td align="center" width="5%" colspan="7"><a href="act/Enquete.act.php?acao=3&idpergunta=<?//=$enquete[$i]->getIdpergunta();?>&idresposta=<?//=$enquete[$i]->getIdresposta();?>"><img src="img/excluir.gif" border='0'></a></td>
							</tr>
						<?
							}
						?>
					<tr class="Linha3Tabela">
						<td colspan="7"><b>Total de votos:</b> <?=$total;?></td>
					</tr>
					<? } ?>
					<? 
						if($enquete[0]->getIdresposta() == "") {
					?>
					<tr class="Linha1Tabela">
						<td align="center" colspan="7"><b>Não há respostas cadastradas !</b></td>
					</tr>
					<?
						}
					?>
					</form>
					<form method="POST" action="act/Enquete.act.php?acao=del" >
					<input type="hidden" name="idpergunta" value="<?=$idpergunta;?>">
					<tr class="Linha3Tabela">
						<td align="right" colspan="7"><input type="submit" class="bttn3" onclick="return confirma_apagar();" value="Remover Enquete" name="remover"/></td>
					</tr>
					</form>
				</table>	
	<?	}
	
		function pegaPercentual($voto,$total) {
			if($voto > 0) {
  				$percentual = (100 * $voto) / $total;
  			} else {
  				$percentual = 0;
  			}
  			
  			$perc = $percentual / 3;						     
  			
  			for ($i=0;$i<$perc;$i++) {
  				?><img src="img/orange.gif"><?
  			}
  			echo "&nbsp;".round($percentual,1);
		}
	
	}
?>