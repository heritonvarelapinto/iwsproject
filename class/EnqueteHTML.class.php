<?php
	class EnqueteHTML extends HTML {
		public function EnquetesMostra() { 
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
				<tr class="Linha1Tabela" onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';" onclick="javascript: window.location='?menu=4&act=alt&idpergunta=<?//=$enquetes->idpergunta;?>';"> 
		            <td><?//=$enquetes->pergunta;?></td>					            
		            <td align="center"><? //$votos = AdmEnquetes::totalVotos($enquetes->idpergunta); echo $total = classAdmGeral::resultado($votos)->votos;?></td>					            					           
		            <td align="center"><?//=AdmEnquetes::status($enquetes->status,$enquetes->idpergunta);?></td>					            					           
		        </tr>
				<tr class="Linha1Tabela"> 
		            <td align="center" colspan="4"><b>Não há nenhuma enquete cadastrado.</b></td>
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
			            <td width="40%" height="20"></td>
			        </tr>
			        <tr class="Linha2Tabela">
			            <td height="20"><b>Total de Páginas:</b></td>
			            <td height="20"></td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros:</b></td>
			            <td width="40%" height="20"></td>
			        </tr>
			        <? $execucao = new pageExecutionTimer(); ?>		        
		    	</tbody>
		    </table>
	<?	}
	}
?>