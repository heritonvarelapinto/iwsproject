<?php
	class InformativoHTML extends HTML {
		function InformativoMostra($totRegistrosPorPagina) {
			$informativo = new Informativo();
			$informativoDAO = new InformativoDAO();
			
			$pagina = $_GET["pag"];
			if(!isset($pagina)) { $pagina = 0;}
			
			$letra = $_GET["letra"];
			if(isset($_GET["letra"])) {
				$order = "WHERE nome LIKE '$letra%' ORDER BY nome";
			}else{
				$order = "ORDER BY nome";
			}
			
			$totalPorPagina = $totRegistrosPorPagina;
			$inicio = $pagina * $totalPorPagina;
			
			?>
			<span class="TituloPage">&#8226; Usuários Informativo</span>
	        <br>
	        <br>
	        <table width="558" border="0" cellpadding="4" cellspacing="1" class="BordaTabela">
	        	<?
					switch ($_GET["msg"]) {
						case 1:
							$this->mostraMSG("Lista adicionada com sucesso.");
						break;	
						case 2:
							$this->mostraMSG("E-Mail alterado com sucesso.");
						break;	
						case 3:
							$this->mostraMSG("E-Mail removido com sucesso.");
						break;							
					}
				?>
	            <tr class="TituloTabela"> 
	                <td width="20%"><a class="TextoTabTopico"><b>NOME</b></a></td>
	                <td width="50%"><a class="TextoTabTopico"><b>E-MAIL</b></a></td>
	                <td width="20%"><a class="TextoTabTopico"><b>STATUS</b></a></td>
	            </tr>
	            <?
	            	
					$informativo = $informativoDAO->Paginacao($order,$inicio,$totalPorPagina);
					$registros = $informativoDAO->Registros($order);
					
					$paginas = ceil($registros / $totalPorPagina);
					
					$totEmails = count($informativo);

					for ($i=0;$i<$totEmails;$i++) {
	            ?>
		            <tr class='Linha1Tabela' onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';" onclick="javascript: window.location='?menu=7&act=alterar&idinformativo=<?=$informativo[$i]->getIdinformativo();?>';">  
		                <td><?=$informativo[$i]->getNome();?></td>
		                <td><?=$informativo[$i]->getEmail();?></td>
		                <td><?=$informativo[$i]->getStatus();?></td>                
		            </tr>
		        <?
					}
		        ?> 
				<? if($totEmails < 1) { ?>
	 				<tr class="Linha1Tabela"> 
			            <td align="center" colspan="4"><b>Não há e-mails cadastrados.</b></td>
			        </tr>
		        <? } ?>
		        <? 
		        	if(isset($_GET["letra"])) {
		        		$this->mostraPaginacao($paginas,$pagina,"menu=4&act=mostra&letra=$letra");
		        	}else{
		        		$this->mostraPaginacao($paginas,$pagina,"menu=4&act=mostra");
		        	}
		        	$this->mostraPaginacaoLetras("menu=4&act=mostra",$letra);
		        	
		        ?>
	        </table>
	        <br>
	        <table width="400" border="0" cellpadding="4" cellspacing="1" class="BordaTabela">
	            <tr class="TituloTabela">
	                <td colspan="2" align="center" height="30">RESUMO DESTA CONSULTA</td>
	            </tr>
	            <tr class="Linha1Tabela">
	                <td height="20"><B>Total de Registros:</B></td>
	                <td height="20" width="40%"><?=$registros;?></td>
	            </tr>
	            <tr class="Linha2Tabela">
	                <td height="20"><B>Total de Páginas:</B></td>
	                <td height="20"><?=$paginas;?></td>
	            </tr>
	            <tr class="Linha1Tabela">
	                <td height="20"><B>Total de Registros Autorizados:</B></td>
	                <td height="20"><?//=mysql_num_rows(classAdmSQL::lst("informativo"," WHERE status = 'Autoriza recebimento'"));?></td>
	            </tr>
	            <tr class="Linha2Tabela">
	                <td height="20"><B>Total de Registros Pendentes:</B></td>
	                <td height="20"><?//=mysql_num_rows(classAdmSQL::lst("informativo"," WHERE status = 'Pendente autorização'"));?></td>
	            </tr>
	            <tr class="Linha1Tabela">
	                <td height="20"><B>Total de Registros Inativos:</B></td>
	                <td height="20"><?//=mysql_num_rows(classAdmSQL::lst("informativo"," WHERE status = 'Inativo'"));?></td>
	            </tr>
	        </table>
	    <? }
	}
?>