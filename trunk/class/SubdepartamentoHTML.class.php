<?
	class SubdepartamentoHTML extends HTML {
		function SubdepartamentoMostra($departamento) {
        	$subdepartamento = new Subdepartamento();
			$subdepartamentoDAO = new SubdepartamentoDAO();
        
        	$pagina = $_GET["pag"];
			if(!isset($pagina)) { $pagina = 0;}
			
			$letra = $_GET["letra"];
			if(isset($_GET["letra"])) {
				$order = "AND subdepartamento LIKE '$letra%' ORDER BY subdepartamento";
			}else{
				$order = "ORDER BY subdepartamento";
			}
			
			$totalPorPagina = 1;
			$inicio = $pagina * $totalPorPagina;
			
			$subdepartamento = $subdepartamentoDAO->Paginacao($order,$inicio,$totalPorPagina,$departamento->getIdDepartamento());
			$registros = $subdepartamentoDAO->Registros($order,$departamento->getIdDepartamento());
			
			$paginas = ceil($registros / $totalPorPagina);
			
			$totSubdepartamentos = count($subdepartamento);
        ?>
	        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
	            <tbody>
		            <tr class="TituloTabela"> 
		                <td colspan="3"><div align="center"><b>SUBDEPARTAMENTOS RELACIONADOS</b></div></td>
		            </tr>	            
		            <tr class="TituloTabela"> 
		                <td><div align="center"><b>SUBDEPARTAMENTOS</b></div></td>	                	    
		            </tr>
		     <?
				for ($i=0;$i<$totSubdepartamentos;$i++) {
		     ?>
					<tr onclick="javascript: window.location='?menu=2&act=altsub&idsubdepartamento=<?=$subdepartamento[$i]->idsubdepartamento;?>&iddepartamento=<?=$subdepartamento[$i]->iddepartamento;?>';" onmouseout="this.style.backgroundColor='';" onmouseover="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" class="Linha1Tabela">
					  <td><b><?=$subdepartamento[$i]->subdepartamento;?></b></td>
					</tr>
			<?
				}
			?>
					<? if($totSubdepartamentos < 1) { ?>
	 				<tr class="Linha1Tabela"> 
			            <td align="center" colspan="4"><b>Não há nenhum departamento cadastrado.</b></td>
			        </tr>
			        <? } ?>
			        <? 
			        	$iddep = $departamento->getIdDepartamento();
			        	if(isset($_GET["letra"])) {
			        		$this->mostraPaginacao($paginas,$pagina,"menu=2&act=altdep&iddepartamento=$iddep&letra=$letra");
			        	}else{
			        		$this->mostraPaginacao($paginas,$pagina,"menu=2&act=altdep&iddepartamento=$iddep");
			        	}
			        	$this->mostraPaginacaoLetras("menu=2&act=altdep&iddepartamento=$iddep",$letra);
			        	
			        ?>
		            <tr class="Linha3Tabela">
		                <form action="?menu=2&act=addservico" method="post"/>
		                <td align="right" colspan="3">                    
		                  <input type="hidden" value="<?=$subdepartamento[$i]->iddepartamento;?>" name="iddepartamento"/>	                  
		                  <input type="submit" class="bttn2" value="Criar Subdepartamento" name="criar"/>
		                </td>
		            </tr>
		        </tbody>
	        </table>
	<?	}
	}
?>