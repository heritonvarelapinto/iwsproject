<?php
	class DepartamentoHTML extends HTML  {
		function DepartamentoMostra($titulo) { ?>
		<?
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
			
			$totalPorPagina = 10;
			$inicio = $pagina * $totalPorPagina;
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
							$this->mostraMSG("Departamento removido com sucesso.");
						break;							
					}
				?>
	            <tr class="TituloTabela">
	                <td width="10%" align="center">COD</td>
	                <td align="center">DEPARTAMENTO</td>                                              
	            </tr>
	            <?
	            	
					$departamento = $departamentoDAO->Paginacao($order,$inicio,$totalPorPagina);
					$registros = $departamentoDAO->Registros($order);
					
					$paginas = ceil($registros / 10);
					
					$totDepartamentos = count($departamento);

					for ($i=0;$i<$totDepartamentos;$i++) {
	            ?>
					<tr class="Linha1Tabela" onMouseOver="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='';" onclick="javascript: window.location='?menu=2&act=altdep&iddepartamento=<?=$departamento[$i]->getIdDepartamento();?>';"> 
			            <td align="center"><?=$departamento[$i]->getIdDepartamento();?></td>					            
			            <td><?=$departamento[$i]->getDepartamento();?></td>					            					           
			        </tr>
		        <?
					}
		        ?>
		        <? if($totDepartamentos < 1) { ?>
 				<tr class="Linha1Tabela"> 
		            <td align="center" colspan="4"><b>Não há nenhum departamento cadastrado.</b></td>
		        </tr>
		        <? } ?>
		        <? 
		        	if(isset($_GET["letra"])) {
		        		$this->mostraPaginacao($paginas,$pagina,"menu=2&act=mostra&letra=$letra");
		        	}else{
		        		$this->mostraPaginacao($paginas,$pagina,"menu=2&act=mostra");
		        	}
		        	if(isset($pagina)) {
		        		$this->mostraPaginacaoLetras("menu=2&act=mostra",$letra);
		        	}
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
			            <td width="40%" height="20"><?=$totDepartamentos;?></td>
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
	}
?>