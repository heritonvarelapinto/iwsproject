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
			
			$totalPorPagina = 10;
			$inicio = $pagina * $totalPorPagina;
			
			$subdepartamento = $subdepartamentoDAO->Paginacao($order,$inicio,$totalPorPagina,$departamento->getIdDepartamento());
			$registros = $subdepartamentoDAO->Registros($order,$departamento->getIdDepartamento());
			
			$paginas = ceil($registros / $totalPorPagina);
			
			$totSubdepartamentos = count($subdepartamento);
        ?>
        	<form action="?menu=2&act=addsub" name="subdepartamento" method="post"/>
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
					<tr onclick="javascript: window.location='?menu=2&act=altsub&idsubdepartamento=<?=$subdepartamento[$i]->idsubdepartamento;?>';" onmouseout="this.style.backgroundColor='';" onmouseover="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" class="Linha1Tabela">
					  <td><b><?=$subdepartamento[$i]->subdepartamento;?></b></td>
					</tr>
			<?
				}
			?>
					<? if($totSubdepartamentos < 1) { ?>
	 				<tr class="Linha1Tabela"> 
			            <td align="center" colspan="4"><b>Não há nenhum subdepartamento cadastrado.</b></td>
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
		                <td align="right" colspan="3">                    
		                  <input type="hidden" value="<?=$departamento->getIdDepartamento();?>" name="iddepartamento"/>	                  
		                  <input type="submit" class="bttn2" value="Criar Subdepartamento" name="criar"/>
		                </td>
		            </tr>
		        </tbody>
	        </table>
	<?	}
	
		function SubdepartamentoADD($iddepartamento) { ?>
			<span class="TituloPage" >• Adicionar Subdepartamento</span>
	        <br/>
	        <br/>                         
	        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
	        <form action="act/Subdepartamento.act.php?acao=addsub" name="subdepartamento" method="post">
	        <input type="hidden" name="iddepartamento" value="<?=$iddepartamento;?>">                       
		        <tbody>		       		
		        	<tr class="Linha2Tabela">
	                    <td colspan="2">                            
	                        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
	                            <tbody>                            	                            	
	                                <tr class="Linha1Tabela">
	                                    <td align="right"><b> NOME DO SUBDEPARTAMENTO</b></td>
	                                    <td><input type="text" value="" class="FORMbox" size="75" name="subdepartamento" id="subdepartamento"/></td>
	                                </tr> 
	                            </tbody>
	                       	</table>                                
	                    </td>
	                </tr>
		            <tr class="Linha3Tabela">
		                <td align="right" colspan="2"><input type="submit" class="bttn2" value="Inserir Subdepartamento" name="alterar"/></td>
		            </tr>
	        	</tbody>
	        </table>
	        </form>
	        <script language="javascript">
				document.getElementById('subdepartamento').focus();
			</script>         	              
	<?	}
	
		function SubdepartamentoALT() { ?>
		<?
			if($_POST["idsubdepartamento"]) {
				$idsubdepartamento = $_POST["idsubdepartamento"];
			}elseif($_GET["idsubdepartamento"]) {
				$idsubdepartamento = $_GET["idsubdepartamento"];
			}
			$subdepartamento = new Subdepartamento();
			$subdepartamentoDAO = new SubdepartamentoDAO();
			
			$subdepartamento = $subdepartamentoDAO->getSubdepartamentosPorId($idsubdepartamento);
		?> 
	        <span class="TituloPage">• Altera Subdepartamento</span>
	        <div align="right"><a class="TextoPageLink" href="?menu=2&act=altdep&idsubdepartamento=">Retornar para Subdepartamentos</a></div>
	        <br/>
	        <br/>
	        <form action="act/Subdepartamento.act.php?acao=altsub" name="subdepartamento" method="post">
	        <input type="hidden" name="idsubdepartamento" value="<?=$subdepartamento->getIdsubdepartamento();?>">
	        <input type="hidden" name="iddepartamento" value="<?=$subdepartamento->getIddepartamento();?>">
	        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
	            <tbody>        		        
		        	<tr class="Linha2Tabela">
			            <td colspan="2">
			                <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
			                    <tbody>
				                    <tr class="Linha1Tabela">
				                        <td align="right"><b> SUBDEPARTAMENTO</b></td>
				                        <td><input type="text" class="FORMbox" size="70" name="subdepartamento" value="<?=$subdepartamento->getSubdepartamento();?>"/></td>
				                    </tr> 			                    
				                </tbody>
				            </table>
				        </td>
			    	</tr>
		            <tr class="Linha3Tabela">
		                <td valign="middle">
		                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
		                        <tbody><tr> 
		                            <td align="right"><input type="submit" class="bttn4" value="Alterar Subdepartamento" name="inserir"/>  <input type="submit" class="bttn3" onclick="return confirma_apagar();" value="Apagar Subdepartamento" name="remover"/></td>
		                        </tr><tr> 
		                    </tr></tbody></table>                                
		                </td>
		            </tr>
		        </tbody>
	        </table>
	        </form>
	<?	}
	}
?>