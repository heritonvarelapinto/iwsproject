<?
	/**
	 * Classe de geração de códigos html
	 * Para reutilização de objetos;
	 *
	 */
	class HTML {
		
		function mostraPaginacao($paginas,$pagina,$menu) {
			if($paginas > 1) { ?>
			<tr class="Linha3Tabela">
	            <td align="right" colspan="5">
		<?	//Monta as paginas em baixo
				for($i=0; $i < $paginas; $i++) {
		  			if($i == $pagina) {	?>
						<b><?=$i+1;?></b>&nbsp;<b>.</b>
			 	 	<? } else {	?>
			 			<a href="?<?=$menu;?>&pag=<?=$i;?>"><b><?=$i+1;?></b></a>&nbsp;<b>.</b> 
					<?
					}
				}
			}	?>
				</td>
	        </tr>
	<?	}
	
		function mostraPaginacaoLetras($menu,$letra) { ?>
			<tr class="Linha3Tabela">
	    		<td align="right" colspan="2">
	    			<? if($letra != 'a') { ?>
	    				<a href="?<?=$menu;?>&letra=a"><b>A</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>A</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'b') { ?>
	    				<a href="?<?=$menu;?>&letra=b"><b>B</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>B</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'c') { ?>
	    				<a href="?<?=$menu;?>&letra=c"><b>C</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>C</b>&nbsp;<b>.</b> 
	    			<? } ?> 
	    			
	    			<? if($letra != 'd') { ?>
	    				<a href="?<?=$menu;?>&letra=d"><b>D</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>D</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'e') { ?>
	    				<a href="?<?=$menu;?>&letra=e"><b>E</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>E</b>&nbsp;<b>.</b> 
	    			<? } ?>  
	    			
	    			<? if($letra != 'f') { ?>
	    				<a href="?<?=$menu;?>&letra=f"><b>F</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>F</b>&nbsp;<b>.</b> 
	    			<? } ?>	
	    			
	    			<? if($letra != 'g') { ?>
	    				<a href="?<?=$menu;?>&letra=g"><b>G</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>G</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'h') { ?>
	    				<a href="?<?=$menu;?>&letra=h"><b>H</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>H</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'i') { ?>
	    				<a href="?<?=$menu;?>&letra=i"><b>I</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>I</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'j') { ?>
	    				<a href="?<?=$menu;?>&letra=j"><b>J</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>J</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'k') { ?>
	    				<a href="?<?=$menu;?>&letra=k"><b>K</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>K</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'l') { ?>
	    				<a href="?<?=$menu;?>&letra=l"><b>L</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>L</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'm') { ?>
	    				<a href="?<?=$menu;?>&letra=m"><b>M</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>M</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'n') { ?>
	    				<a href="?<?=$menu;?>&letra=n"><b>N</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>N</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'o') { ?>
	    				<a href="?<?=$menu;?>&letra=o"><b>O</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>O</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'p') { ?>
	    				<a href="?<?=$menu;?>&letra=p"><b>P</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>P</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'q') { ?>
	    				<a href="?<?=$menu;?>&letra=q"><b>Q</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>Q</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'r') { ?>
	    				<a href="?<?=$menu;?>&letra=r"><b>R</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>R</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 's') { ?>
	    				<a href="?<?=$menu;?>&letra=s"><b>S</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>S</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 't') { ?>
	    				<a href="?<?=$menu;?>&letra=t"><b>T</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>T</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'u') { ?>
	    				<a href="?<?=$menu;?>&letra=u"><b>U</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>U</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'v') { ?>
	    				<a href="?<?=$menu;?>&letra=v"><b>V</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>V</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'w') { ?>
	    				<a href="?<?=$menu;?>&letra=w"><b>W</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>W</b>&nbsp;<b>.</b> 
	    			<? } ?>
	    			
	    			<? if($letra != 'x') { ?>
	    				<a href="?<?=$menu;?>&letra=x"><b>X</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>X</b>&nbsp;<b>.</b> 
	    			<? } ?>	
	    			
	    			<? if($letra != 'y') { ?>
	    				<a href="?<?=$menu;?>&letra=y"><b>Y</b></a>&nbsp;<b>.</b>
	    			<? }else{ ?> 
	    				<b>Y</b>&nbsp;<b>.</b> 
	    			<? } ?>	
	    			
	    			<? if($letra != 'z') { ?>
	    				<a href="?<?=$menu;?>&letra=z"><b>Z</b></a>&nbsp;
	    			<? }else{ ?> 
	    				<b>Z</b>&nbsp; 
	    			<? } ?>		
	    	</tr>
	<?	}
		
		/**
		 * Retorna uma tabela com os itens do objeto
		 *
		 * @param Array $objLista
		 */
		public function listaItensTabela($objLista) {
			?><table border="1" cellpadding="1" cellspacing="1"><?
			for($i = 0; $i < count($objLista); $i++) {
				if($i % 2) { $cor = "#EFEFEF"; } else { $cor = "#FFFFFF"; }
				?><tr style="background-color: <?=$cor?>"><?
				foreach ($objLista[$i] as $atributo => $value) {
					?><td><?
					echo $value;
					?></td><?
				}
				?></tr><?
			}
			?></table><?
		}
		
		/**
		 * HTML do layout do Login ao painel Adm.
		 *
		 * @param objeto $cliente
		 */
		public function Login($cliente) {
			?>
			<HTML>
			<HEAD>
			<TITLE> Administração - <?=$cliente->getNome();?></TITLE>
			</HEAD>
			<body bgcolor="#EFEFEF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
			<table width="778" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			  <tr>
			    <td width="1" bgcolor="#CCCCCC"><img src="img/regua1x1.gif" height="1"></td>
			        <td valign="top">
						<!--##################################################################################-->
			            <table width="778" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			
							<tr>
								<td height="45">
								<script src="script/admin.js" language="JavaScript"/></script>
								<link rel="stylesheet" href="css/admin.css" type="text/css">						
								<TABLE cellspacing="0" cellpadding="0" width="100%" border="0">
								    <TBODY>
								    <TR>
								        <TD width="180" height="70" align="center" style="PADDING-BOTTOM: 10px; PADDING-TOP: 10px">
								            <img src="img/<?=$cliente->getLogo();?>" height="75">
								        </TD>
								        <td>							        
								        </td>
								        <TD>
								            <table cellspacing="0" cellpadding="0" width="100%" height="100%" border="0">
								                <tr>
								
								                    <td align="right" style="PADDING:10px;"><STRONG><FONT color="#666666"><?=$cliente->getNome()." - ".$cliente->getVersao();?><br></FONT><FONT color="#666" size="2">Sistema de Administra&ccedil;&atilde;o</FONT></STRONG><td>
								                </tr>
								                
								            </table>
								        </TD>
								    </TR>
								    </TBODY>
								</TABLE></td>
							</tr>
			                <tr>
								<td height="1" bgcolor="#CCCCCC"><img src="img/regua1x1.gif" height="1"></td>
							</tr>
							<tr>
								<td width="100%" bgcolor="#FFFFFF" valign="top" style="padding:10px;" align="center">
			                    <!--##################################################################################-->
			                        <p>&nbsp;</p>
			                        <p>&nbsp;</p>
			                        <table width="300" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
									
			                            <tr>
			                                <td bgcolor="#FFFFFF">
			                                    <table width="100%" border="0" align="center">
			                                    <form method="POST" action="../otr/act/Autenticar.act.php" name="admin" onsubmit="return valida_login();">
			                                        <tr bgcolor="#EFEFEF" class="Linha2Tabela">
			                                            <td colspan="2" align="center">
			                                                <table border="0">
			                                                    <tr>
			                                                        <td><i><b><font color="#CC0000"><img src="img/locked.gif" width="24" height="24"></font></b></i></td>
			
			                                                        <td><i><b><font size="2" color="#666">&Aacute;rea de acesso restrito.</font></b></i></td>
			                                                    </tr>
			                                                </table>
			                                            </td>
			                                        </tr>
			                                        <tr class="Linha3Tabela">
			                                            <td align="center" colspan="2"><p><br>Por gentileza identifique-se:</p></td>
			                                        </tr>
			                                        <tr class="Linha3Tabela">
			                                            <td align="right"><B>USU&Aacute;RIO:</B></td>
			                                            <td><input type="TEXT" id="usuario" name="usuario" class="FORMbox"></td>
			                                        </tr>
			                                        <tr class="Linha3Tabela">
			                                            <td align="right"><B>SENHA:</B></td>
			                                            <td><input type="PASSWORD" name="senha" class="FORMbox"></td>
			                                        </tr>
			                                        <tr class="Linha3Tabela">
			                                            <td align="center" colspan="2"><input type="checkbox" name="acao" value="esquecisenha">Esqueci a senha e desejo receb&ecirc;-la<br> por e-mail.(Informe seu Usu&aacute;rio).<input type="HIDDEN" name="url_redirect" value=""></td>
			                                        </tr>
			                                        <?
			                                        	switch ($_GET["msg"]) {
			                                        		case 1:
			                                        			print '
			                                        			<tr class="TituloTabela"> 
			                                            			<td height="20" align="center" colspan="2"><font color="red">Dados Inválidos.</font></td>
			                                        			</tr>';
			                                        		break;
			                                        		case 2:
			                                        			print '
			                                        			<tr class="TituloTabela"> 
						                                            <td height="20" align="center" colspan="2"><font color="red">USUÁRIO NÃO CADASTRADO.</font></td>
						                                        </tr>';
			                                        		break;
			                                        		case 3:
			                                        			print '
			                                        			<tr class="TituloTabela"> 
						                                            <td height="20" align="center" colspan="2"><font color="red">Dados de acesso enviados para o seu e-mail!</font></td>
						                                        </tr>';
			                                        		break;
			                                        		case 4:
			                                        			print '
			                                        			<tr class="TituloTabela"> 
						                                            <td height="20" align="center" colspan="2"><font color="red">Usuário Bloqueado.</font></td>
						                                        </tr>';
			                                        		break;
			                                        	}
			                                        ?>				                                       		                                                                              		                                 
			                                        <tr class="Linha3Tabela">
			                                            <td height="35" colspan="2" align="center"><input type="SUBMIT" name="submit" value="Entrar" class="bttn1"></td>														
			                                        </tr>
			                                    </form>
			                                    </table>
			                                </td>
			                            </tr>
			                        </table>
			                    <!--##################################################################################-->
			                    </td>
							</tr>
							<tr>
								<td height="1" bgcolor="#CCCCCC"><img src="img/regua1x1.gif" height="1"></td>
							</tr>
			                <tr>
								<td align="center" height="20" bgcolor="#F2F2F2"><?=$cliente->getNome()." - ".$cliente->getVersao();?></td>
							</tr>
						</table>
			            <!--##################################################################################-->
			        </td>
			    <td width="1" bgcolor="#CCCCCC"><img src="img/regua1x1.gif" height="1"></td>
			  </tr>
			</table>
			</BODY>
			</HTML>
			<script language="javascript">
				document.getElementById('usuario').focus();
			</script>	
			<?
		}
		
		/**
		 * HTML do layout do painel
		 *
		 * @param $objeto $cliente
		 * @param $objeto $usuario
		 * @param $objeto $menu
		 * @param $objeto $acao
		 */
		public function Painel($cliente, $usuario, $menu, $acao) {			
			?>
			<HTML>
			<HEAD>
			<TITLE> Administração - <?=$cliente->getNome();?></TITLE>
			<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
			<link rel="stylesheet" href="css/admin.css" type="text/css">
			<script src="script/admin.js" language="JavaScript"/></script>
			</HEAD>
			<body bgcolor="#EFEFEF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="Mascaras.carregar();">
			<table width="778" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">			
				<tbody>
					<tr>
						<td width="1" bgcolor="#CCCCCC"><img src="img/regua1x1.gif" height="1"></td>
						<td valign="top">
						<!--##################################################################################-->
			            	<table width="778" height="100%" cellspacing="0" cellpadding="0" border="0" align="center">
								<tbody>
									<tr>
										<td height="45" colspan="2">																				
											<table width="100%" cellspacing="0" cellpadding="0" border="0">
											    <tbody>
											    <tr>
											        <td width="180" height="70" align="center" style="padding-bottom: 10px; padding-top: 10px;">
											            <img src="img/<?=$cliente->getLogo();?>" width="75" height="50"/>
											        </td>
											        <td>		        
											        </td>
											        <td>
											            <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
											                <tbody>
												                <tr>
												                    <td align="right" style="padding: 10px;"><strong><font color="#666666"><?=$cliente->getNome()." - ".$cliente->getVersao();?><br/></font><font size="2" color="#666">Sistema de Administração</font></strong></td>
												                    <td></td>
											                	</tr>
												                <tr>
												                    <td valign="bottom" align="right" style="padding-right: 10px;">
												                        <table cellspacing="0" cellpadding="4" border="0">
													                    	<tbody>
													                            <tr align="center">
														                            <td width="60" class="abas"><a href="principal.php" class="abasTexto">HOME</a></td>
														                            <td width="60" class="abas"><a href="?menu=1&act=altera&id=<?=$usuario->getIdadministracao();?>" class="abasTexto">MEU PERFIL</a></td>
														                            <td width="60" class="abas"><a href="logout.php" class="abasTexto">SAIR</a></td>
													                            </tr>
													                        </tbody>
												                        </table>                    
												                    </td>
												                </tr>
											            	</tbody>
											            </table>
											        </td>
											    </tr>
											    </tbody>
											</table>
										</td>
									</tr>
					                <tr>
										<td height="1" bgcolor="#cccccc" colspan="2"><img height="1" src="img/regua1x1.gif"/></td>
									</tr>
									<tr>
										<td width="180" valign="top" bgcolor="#f9f9f9" align="center">
											<table width="180" cellspacing="0" cellpadding="0" border="0">
				    							<tbody>
				    								<tr>
				        								<td valign="center" style="padding-left: 6px; padding-right: 6px;"><br/>
												            <? $this->Menu(); ?>
				        								</td>
				   									</tr>
												</tbody>
											</table>
										</td>
								  		<td width="596" valign="top" bgcolor="#ffffff" style="padding: 10px;">
				                    		<? 
				                    			if(!isset($menu)) {
				                    				$this->CorpoIndex($usuario);
				                    			}else{
				                    				switch ($menu) {
				                    					//Administracao
				                    					case 1:
				                    						$layoutAdministracao = new LayoutAdministracao();
				                    						$layoutAdministracao->EstruturaAdministracao($acao);
				                    					break;
				                    					//Departamento
				                    					case 2:
				                    						$layoutDepartamento = new LayoutDepartamento();
				                    						$layoutDepartamento->EstruturaDepartamento($acao);
				                    					break;
				                    					//Banner
				                    					case 3:
				                    						$layoutBanner = new LayoutBanner();
				                    						$layoutBanner->EstruturaBanner($acao);
				                    					break;
				                    				}
				                    			}
				                    		?>
				                    	</td>
					                </tr>
					                <tr>
					                    <td height="1" bgcolor="#cccccc" colspan="2"><img height="1" src="img/regua1x1.gif"/></td>
					                </tr>
					                <tr>
					                    <td height="20" bgcolor="#f2f2f2" align="center" colspan="2"><?=$cliente->getNome()." - ".$cliente->getVersao();?></td>
					                </tr>
					            </tbody>
					        </table>
			            <!--##################################################################################-->
			        	</td>
			    		<td width="1" bgcolor="#cccccc"><img height="1" src="img/regua1x1.gif"/></td>
			  		</tr>
				</tbody>
			</table>
			<?
		}
		
		/**
		 * Tabela que controla o corpo index do painel adm.
		 *
		 * @param objeto $usuario
		 */
		function CorpoIndex($usuario) {
			?>
			<table width="100%" cellspacing="0" cellpadding="4" border="0" bgcolor="#f9f9f9">
		        <tbody>	        
		            <tr>
		                <td colspan="2">
		                    <font color="#666666">
		                        <script type="text/javascript">
		                        var d=new Date()
		                        var weekday=new Array("Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado")
		                        var monthname=new Array("Janeiro","Fevereiro","Março","Abril","Março","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro")
		                        document.write(weekday[d.getDay()] + ", ")
		                        document.write(d.getDate() + " de ")
		                        document.write(monthname[d.getMonth()] + " de ")
		                        document.write(d.getFullYear())
		                       </script>
		                    </font>
		                </td>
		                <td width="32%"><font color="#666666"><b>IP de acesso: </b><?=$_SERVER[REMOTE_ADDR];?></font></td>
		            </tr>
		            <tr>
		                <td width="6%"><img src="img/locked.gif"/></td>
		                <td valign="bottom" colspan="2"><span class="TituloLoja"><font color="#333333">Prezado <?=$usuario->getNome();?>, seja bem vindo!</font></span></td>
		            </tr>
		        </tbody>
		    </table>										    
		    <table width="100%" cellspacing="0" cellpadding="0" border="0">
		        <tbody>
			        <tr>
			            <td height="3" background="img/dot.gif"/>
			        </tr>
			        <tr>
			            <td height="3"><img height="20" src="img/regua1x1.gif"/></td>
			        </tr>
			    </tbody>
			</table>
			<?
		}
		
		
		
		/**
		 * Lista menus do painel Administrativo
		 *
		 */
		function Menu() {
			?>
			<table width="180" cellspacing="0" cellpadding="2" border="0">	
	            <tbody>
            	<?
					$menus = new MenuAdmin();																	
					$menusDAO = new MenuAdminDAO();
					$listaMenus = $menusDAO->listaMenus();
										
					$title = "";
					$totMenus = count($listaMenus);
            	?>							                
	            <? 
	            	for ($i=0; $i < $totMenus; $i++) { 
	            		if($title != $listaMenus[$i]->getTitulo()) { ?>
				<?			if($title != "") {
								?><tr><td height="3" background="img/dot.gif"/></tr><?
							} 
							?><tr><td valign="center"><b><font color="#666"><?=strtoupper($listaMenus[$i]->getTitulo());?></font></b></td></tr><?
						}?>
			        <tr>
			        	<td>
							<a class="TextoPageLink" href="?menu=<?=$listaMenus[$i]->getIdmenu();?>&act=<?=$listaMenus[$i]->getAcao();?>"><?=ucwords($listaMenus[$i]->getTituloLink());?></a><br/>
			            </td>
			        </tr>
				<?  $title = $listaMenus[$i]->getTitulo();
	            	} ?>
	            	<tr>
				        <td>
				            <table width="100%" cellspacing="0" cellpadding="0" border="0">
				                <tbody>
				                    <tr>
				                        <td height="3" background="img/dot.gif"/>
				                    </tr>
				                </tbody>
				            </table>
				        </td>
				    </tr>													            	
				</tbody>
			</table>
			<?
		}
		
		/**
		 * Mostra msg de ações nas tabelas
		 *
		 * @param string $msg
		 */
		function mostraMSG($msg) {
			print '
				<tr class="Linha3Tabela">
                    <td colspan="4">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fbeded">
                            <tbody><tr> 
                                <td height="30" align="center"><font color="#ff0000"><b>'.$msg.'</b></font></td>
                            </tr> 
                        </tbody></table>
                    </td>
                </tr>
			';
		}
		
		function selectDepartamentosAdmin($departamentos) {
			$totDepartamentos = count($departamentos);
			
			echo "<select name=\"iddepartamento\" class=\"FORMBox\">";
			echo "<option value=\"\">--Selecione--</option>";
			echo "<option value=\"inicial\">Pagina Inicial</option>";
			
			for($i = 0; $i < $totDepartamentos; $i++) {
				?><option value="<?=$departamentos[$i]->getIdDepartamento(); ?>"><?=$departamentos[$i]->getDepartamento(); ?></option><?
			}
			echo "</select>";
		}
		
			
		function selectDepartamentos($departamentos) {
			$totDepartamentos = count($departamentos);
			
			echo "<select name=\"selDepartamentos\">";
			echo "<option value=\"\">Departamentos</option>";
			
			for($i = 0; $i < $totDepartamentos; $i++) {
				?><option value="<?=$departamentos[$i]->getIdDepartamento(); ?>"><?=$departamentos[$i]->getDepartamento(); ?></option><?
			}
			echo "</select>";
		}
		
		/**
		 * Gera um campo input 
		 *
		 * @param $nome
		 * @param $classe
		 */
		function input($nome,$classe) {
			echo "<input type=\"text\" id=\"".$nome."\" name=\"".$nome."\" class=\"".$classe."\">";
		}
		
		/**
		 * Gera um botao 
		 *
		 * @param $nome
		 * @param $classe
		 */
		function button($nome,$classe,$texto) {
			echo "<button type=\"submit\" name=\"".$nome."\" class=\"".$classe."\"><a>";
			echo "<div class=\"botao\"><div><div>".$texto."</div></div></div>";
			echo "</a></button>";
			/*echo "<input type=\"submit\" value=\"".$texto."\" id=\"".$nome."\" name=\"".$nome."\" class=\"".$classe."\">";*/
		}
		
	}
?>