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
					<tr class="Linha1Tabela" onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';" onclick="javascript: window.location='?menu=5&act=alt&idpergunta=<?=$enquete[$i]->getIdpergunta();?>';"> 
			            <td><?=$enquete[$i]->getPergunta();?></td>					            
			            <td align="center"><?if($voto->getVoto() == "") { echo "0"; }else{ echo $voto->getVoto(); }?></td>					            					           
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
	}
?>