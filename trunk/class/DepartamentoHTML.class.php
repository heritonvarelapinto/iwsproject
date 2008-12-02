<?php
	class DepartamentoHTML extends HTML  {
		function DepartamentoMostra($titulo) { ?>
		<?
			$paginacao = new Paginacao();
			$paginacaoDAO = new PaginacaoDAO();
			
			$departamento = new Departamento();
			$departamentoDAO = new DepartamentoDAO();
			
			//$paginacao = $paginacaoDAO->Paginas(5);
			
			$pagina = $_GET["pag"];
			
			if(!isset($pagina)) { $pagina = 0;}
			
			$letra = $_GET["letra"];
			
			if(isset($_GET["letra"])) {
				$order = "WHERE departamento LIKE '$letra%' ORDER BY departamento";
			}else{
				$order = "ORDER BY departamento";
			}
		
			/*$totalPorPagina = 1;
			$paginas = 10;
			$pagina = $_GET['pag'];		
			if(!isset($pagina)) { $pagina = 0;}
			$inicio = $pagina * $totalPorPagina;*/
		?>
			<span class="TituloPage">• <?=$titulo;?></span>
	        <br>
	        <br>
	                             
	        <table border="0" width="100%" border="0" cellpadding="4" cellspacing="1" class="BordaTabela"> 
	        	<?
					switch ($_GET["msg"]) {
						case 1:
							$this->mostraMSG("Departamento adicionado com sucesso.");
						break;	
						case 2:
							$this->mostraMSG("Departamento alterado com sucesso.");
						break;
						case 3:
							$this->mostraMSG("Segmento removido com sucesso.");
						break;							
					}
				?>
	            <tr class="TituloTabela">
	                <td width="10%" align="center">COD</td>
	                <td align="center">SEGMENTO</td>                                              
	            </tr>
	            <?
					$departamento = $departamentoDAO->Paginacao($order,10);
					print_r($departamento);
	            ?>
				<tr class="Linha1Tabela" onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';" onclick="javascript: window.location='?menu=2&act=altseg&idcategoria=<?//=$segmentos->idcategoria;?>';"> 
		            <td align="center"><?//=$segmentos->idcategoria;?></td>					            
		            <td><?//=$segmentos->categoria;?></td>					            					           
		        </tr>
				<tr class="Linha1Tabela"> 
		            <td align="center" colspan="4"><b>Não há nenhum segmento cadastrado.</b></td>
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
			            <td width="40%" height="20"><?//=$paginacao->getRegistrosPorPagina();?></td>
			        </tr>
			        <tr class="Linha2Tabela">
			            <td height="20"><b>Total de Páginas:</b></td>
			            <td height="20"><?//=$paginacao->getPaginas();?></td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros:</b></td>
			            <td width="40%" height="20"><?//=$paginacao->getRegistros();?></td>
			        </tr>		        
		    	</tbody>
		    </table>
	<?	}
	}
?>