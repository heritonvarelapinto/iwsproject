<?
	/**
	 * Classe de geração de códigos html
	 * Para reutilização de objetos;
	 *
	 */
	class HTML {
		
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
		
		public function Painel($cliente, $usuario, $menu) {
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
														                            <td width="60" class="abas"><a href="?menu=perfil&act=altera&id=<?=$usuario->getIdadministracao();?>" class="abasTexto">MEU PERFIL</a></td>
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
				                    				$this->CorpoIndex($cliente);
				                    			}else{
				                    				switch ($menu) {
				                    					case 1:
				                    						$LayoutAdministracao = new LayoutAdministracao();
				                    						$LayoutAdministracao->EstruturaAdministracao();
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
		
		function CorpoIndex($cliente) {
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
		                <td valign="bottom" colspan="2"><span class="TituloLoja"><font color="#333333">Prezado <?=$cliente->getNome();?>, seja bem vindo!</font></span></td>
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
		
		public function AdministracaoCadastro() {
			?>
			<span class="TituloPage">• Criar Usuários</span>
	        <br/>
	        <br/>
	        <form onsubmit="return valida_usuario();" action="act/actUsuarios.php?acao=Adicionar" name="usuario" method="post">        
	        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
	            <tbody>
		            <tr class="Linha2Tabela">
		                <td width="100" align="right"><b>NOME: </b></td>
		                <td><input type="text" class="FORMbox" size="50" name="nome"/></td>
		            </tr>
		            <tr class="Linha1Tabela">
		                <td width="100" align="right"><b>USUÁRIO: </b></td>
		                <td><input type="text" class="FORMbox" size="50" name="usuario"/></td>
		            </tr> 
		            <tr class="Linha2Tabela">
		                <td width="100" align="right"><b>E-MAIL: </b></td>
		                <td><input type="text" class="FORMbox" size="50" name="email"/></td>
		            </tr>	            
		            <tr class="Linha1Tabela">
		                <td width="100" align="right"><b>DDD/TELEFONE: </b></td>
		                <td><input type="text" maxlength="2" onkeyup="autoTab(this, 2, event);" class="FORMbox" size="5" name="ddd"/> <input type="text" maxlength="15" class="FORMbox" size="20" name="telefone"/></td>
		            </tr> 	            
		            <tr class="Linha1Tabela">
		                <td valign="middle" align="center" colspan="2">
		                    <input type="submit" class="bttn2" value="Inserir usuário" name="adicionar"/>
		                </td>
		            </tr>	            
		        </tbody>
	        </table>
	        </form>
			<?

		}

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
		
	}
?>