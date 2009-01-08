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
						case 4:
							$this->mostraMSG("E-mail adicionado com sucesso.");
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
					
					$autorizados = $informativoDAO->Registros("WHERE status = 'Autoriza Recebimento'");
					$pendentes = $informativoDAO->Registros("WHERE status = 'Pendente Autorização'");
					$inativos = $informativoDAO->Registros("WHERE status = 'Inativo'");
					
					
					
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
	                <td height="20"><?=$autorizados;?></td>
	            </tr>
	            <tr class="Linha2Tabela">
	                <td height="20"><B>Total de Registros Pendentes:</B></td>
	                <td height="20"><?=$pendentes;?></td>
	            </tr>
	            <tr class="Linha1Tabela">
	                <td height="20"><B>Total de Registros Inativos:</B></td>
	                <td height="20"><?=$inativos;?></td>
	            </tr>
	        </table>
	    <? }
	    
	    function InfomativoEmailsADD() { ?>		
			<span class="TituloPage">• Cadastro de E-Mails</span>
	        <br>
	        <br>		
	        <form method="POST" action="act/Informativo.act.php?acao=add" enctype="multipart/form-data">                
	        <table width="558" border="0" cellpadding="4" cellspacing="1" class="BordaTabela">        	           
	        	<tr class="Linha1Tabela">
	                <td width="150"><B>&nbsp;Nome</B></td>
	                <td><input type="text" size="70" name="nome" id="nome" class="FormBox" value=""></td>
	            </tr>  
	            <tr class="Linha1Tabela">
	                <td width="150"><B>&nbsp;E-Mail</B></td>
	                <td><input type="text" size="70" name="email" id="email" class="FormBox" value=""></td>
	            </tr>          
	            <tr class="Linha1Tabela">
	                <td valign="middle" colspan="2">
	                    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	                        <tr> 
	                            <td align="right"><input type="SUBMIT" value="Adicionar E-mail" class="bttn2">&nbsp;&nbsp;</td>
	                        </tr>                         
	                    </table>                              
	                </td>
	            </tr>
	        </table>
	        </form>
	        
	        <h4 align="center">OU</h4>
	        
	        <form method="POST" action="act/Informativo.act.php?acao=addlista" enctype="multipart/form-data">                
	        <table width="558" border="0" cellpadding="4" cellspacing="1" class="BordaTabela">        	           
	        	<tr class="Linha1Tabela">
	                <td width="150"><B>&nbsp;Nome Geral</B></td>
	                <td><input type="text" size="70" name="nome" id="nome" class="FormBox" value=""></td>
	            </tr>  
	            <tr class="Linha1Tabela">
	                <td width="150"><B>&nbsp;Lista em .txt</B></td>
	                <td><input type="file" size="60" name="lst" id="lst" class="FormBox" value=""></td>
	            </tr>            
	            <tr class="Linha1Tabela">
	            	<td colspan="2" align="center" width="150"><B>&nbsp;Lista</B></td>
	            </tr> 
	            <tr class="Linha1Tabela">                
	                <td colspan="2">                
						<textarea name="lista" rows="10" cols="65"></textarea><font color="Red"><br>( Coloque os e-mails separados por , (vírgula) )</font>
	                </td>
	            </tr>         
	            <tr class="Linha1Tabela">
	                <td valign="middle" colspan="2">
	                    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	                        <tr> 
	                            <td align="right"><input type="SUBMIT" value="Adicionar Lista" class="bttn2">&nbsp;&nbsp;</td>
	                        </tr>                         
	                    </table>                              
	                </td>
	            </tr>
	        </table>
	        </form>
	<?	}
	
		function EmailsTotal($menos,$n,$total) { ?>
			<table border="0" cellpadding="4" cellspacing="1" class="BordaTabela">        	           
        		<tr class="Linha2Tabela">
					<td bgcolor="#FFFFFF"><b>Maximo de E-Mails por Lista:</b></td>
					<td bgcolor="#FFFFFF"><font color="Red"><?=$menos;?></font></td>
				</tr>
				<tr class="Linha1Tabela">
					<td bgcolor="#FFFFFF"><b>Total de E-Mails:</b></td>
					<td bgcolor="#FFFFFF"><font color="Red"><?=$n;?></font></td>
				</tr>
				<tr class="Linha2Tabela">
					<td bgcolor="#FFFFFF" colspan="2"><b>Retire:</b> <font color="Red"><?=$total;?></font> <b>E-Mails</b></td>								
				</tr>
			</table>
	<?	}
	
		function InformativoModeloCriar() { ?>
			<script language="javascript" type="text/javascript" src="../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
			<script language="javascript" type="text/javascript">
			 tinyMCE.init({
		               mode : "textareas",
		               language : "pt_br",
		               theme : "advanced",
		               editor_deselector : "mceNoEditor",
		               plugins : "table,advhr,advimage,advlink,iespell,insertdatetime,searchreplace,contextmenu,xhtmlxtras,paste,fullscreen",
		               theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,pastetext,pasteword,separator,undo,redo,separator,cleanup,code",
		               theme_advanced_buttons2 :"removeformat,separator,formatselect,separator,fontselect,separator,fontsizeselect",
		   			   theme_advanced_buttons3 : "bullist,numlist,outdent,indent,separator,link,unlink,anchor,image,separator,forecolor,backcolor,separator,sub,sup,charmap,separator,search,replace,",
		   			   theme_advanced_buttons4 : "tablecontrols,separator,hr,visualaid,separator,advhr,separator,fullscreen",
		               theme_advanced_toolbar_location : "top",
		               theme_advanced_toolbar_align : "center",
		               theme_advanced_path_location : "bottom",
		               plugin_insertdate_dateFormat : "%Y-%m-%d",
		               plugin_insertdate_timeFormat : "%H:%M:%S",
		               extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",               
		            }); 
			</script>
			<span class="TituloPage">&#8226; Criar Informativo</span>
	        <br>
	        <br>
	        <form method="post" action="act/Informativo.act.php?acao=criar">
	        <table width="558" border="0" cellpadding="4" cellspacing="1" class="BordaTabela">        	
	            <!--<tr class="Linha2Tabela">
	                <td colspan="2">
	                    <table width="558" border="0" cellpadding="4" cellspacing="1" class="BordaTabela">                        
	                        <tr class="Linha1Tabela">
	                            <td align="right"><B>&nbsp;ASSUNTO</B></td>
	                            <td><input type="TEXT" name="assunto" id="assunto" size="75" class="FORMbox"></td>
	                        </tr>
	                        <tr class="Linha1Tabela">
	                            <td colspan="2">
	                                <table border="0" width="100%" cellpadding="0" cellspacing="0">
	                                    <tr> 
	                                        <td align="center"><b>TEXTO DO INFORMATIVO</b></td>
	                                    </tr>
	                                    <tr>
	                                        <td>    
	                                        	<textarea name="texto" cols="65" rows="40"></textarea>
	                                        </td>
	                                    <tr> 
	                                </table>
	                            </td>
	                        </tr>
	                    </table>
	                </td>
	            </tr>-->
	            <form>
				<p>
				    <textarea name="description" id="id_description" 
				    class="rte-zone">jQuery RTE</textarea>
				</p>
				<p>
				    <textarea name="description2" id="id_description2" 
				    class="rte-zone">jQuery RTE 2</textarea>
				</p>
				<input type="submit" />
				</form>
				<script type="text/javascript" src="../otr/script/jquery.js"></script>
				<script type="text/javascript" src="../otr/script/jquery.rte.js"></script>
				<script type="text/javascript">
				    $('.rte-zone').rte("css url");
				</script>
				</form>
	            <tr class="Linha1Tabela">
	                <td valign="middle">
	                    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	                        <tr> 
	                            <td align="right"><input type="SUBMIT" value="Salvar Informativo" class="bttn2"></td>
	                        <tr> 
	                    </table>                                
	                </td>
	            </tr>
	        </table>
	        </form>
	<?	}
	}
?>