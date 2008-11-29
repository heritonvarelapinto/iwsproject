<?
	class AdministracaoHTML extends HTML {
		/**
		 * Tabela de criação de novos usuários administrativos.
		 *
		 * @param string $titulo
		 * @param string $onsubmit
		 * @param string $action
		 * @param string $name
		 * @param string $method
		 */
		public function AdministracaoADD($titulo ,$onsubmit, $action, $name, $method) {
			?>
			<span class="TituloPage">• <?=$titulo;?></span>
	        <br/>
	        <br/>
	        <form onsubmit="<?=$onsubmit;?>" action="<?=$action;?>" name="<?=$name;?>" method="<?=$method;?>">        
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
		
		/**
		 * Tabela de alteração de dados do usuario administrativo
		 *
		 * @param string $titulo
		 * @param string $onsubmit
		 * @param string $action
		 * @param string $name
		 * @param string $method
		 */
		public function AdministracaoALT($titulo ,$onsubmit, $action, $name, $method) {
			$id = $_GET["id"];
			
			$administracao = new Administracao();
			$administracaoDAO = new AdministracaoDAO();
			$pegaUsuario = $administracaoDAO->getUsuarioPorID($id);
			
			?>
		        <span class="TituloPage">• <?=$titulo;?></span>
		        <br/>
		        <br/>
		        <form onsubmit="<?=$onsubmit;?>" action="<?=$action;?>" name="altusuario" method="<?=$method;?>">        
		        <input type="hidden" value="<?=$pegaUsuario->getIdadministracao();?>" name="idadministracao"/>		        
		        <table width="558" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
			    	<tbody>
			    		<?
			    			switch ($_GET["msg"]) {
			    				case 1:
			    					$this->mostraMSG("O Usuário informado já existe cadastrado, veja os dados abaixo.");
			    				break;
			    				case 2:
			    					$this->mostraMSG("Usuário cadastrado com sucesso, dados de acesso foram enviados para o e-mail informado.");			    					
			    				break;
			    				case 3:
			    					$this->mostraMSG("Usuário alterado com sucesso.");
			    				break;
			    				case 4:
			    					$this->mostraMSG("Dados incorretos.");			    					
			    				break;
			    				case 5:
			    					$this->mostraMSG("Dados enviados com sucesso.");
			    				break;
			    			}
			    		?>	    		
			            <tr class="TituloTabela">
			                <td align="center">DADOS DO USUÁRIO <u><b><?//=strtoupper($usuarios->nome);?></b></u></td>
			            </tr>
			            <tr class="Linha1Tabela">
			                <td>
			                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
			                        <tbody><tr> 
			                            <td width="100" align="right"><b>NOME: </b></td>
			                            <td><input type="text" value="<?=$pegaUsuario->getNome();?>" class="FORMbox" size="30" name="nome"/></td>
			                        </tr> 
			                    </tbody></table>
			                </td>
			            </tr> 
			            <tr class="Linha2Tabela">
			                <td>
			                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
			                        <tbody><tr> 
			                            <td width="100" align="right"><b>E-MAIL: </b></td>
			                            <td><input type="text" value="<?=$pegaUsuario->getEmail();?>" class="FORMbox" size="30" name="email"/></td>
			                        </tr> 
			                    </tbody></table>
			                </td>
			            </tr> 
			            <tr class="Linha1Tabela">
			                <td>
			                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
			                        <tbody><tr> 
			                            <td width="100" align="right"><b>DDD/TELEFONE: </b></td>
			                            <td><input type="text" maxlength="2" onkeyup="autoTab(this, 2, event);" value="<?=$pegaUsuario->getDdd();?>" tipo="numerico" mascara="########" class="FORMbox" size="5" name="ddd"/> <input type="text" maxlength="15" value="<?=$pegaUsuario->getTelefone();?>" tipo="numerico" mascara="########" class="FORMbox" size="20" name="telefone"/></td>
			                        </tr> 
			                    </tbody></table>
			                </td>
			            </tr>	           
			            <tr class="Linha1Tabela">
			                <td>
			                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
			                        <tbody><tr> 
			                            <td height="30">
			                                <b><input type="checkbox" onclick="ativa_trocasenha();" value="sim" name="ativasenha"/> DESEJO TROCAR MINHA SENHA</b>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td disabled="" id="linhasenha">
			                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
			                                    <tbody><tr> 
			                                        <td width="130" align="right"><b>SENHA ATUAL: </b></td>
			                                        <td><input type="password" disabled="" value="" class="FORMbox" size="20" name="senha_atual"/></td>
			                                    </tr> 
			                                    <tr> 
			                                        <td width="130" align="right"><b>NOVA SENHA: </b></td>
			                                        <td><input type="password" disabled="" value="" class="FORMbox" size="20" name="nova_senha"/></td>
			                                    </tr> 
			                                    <tr> 
			                                        <td width="130" align="right"><b>CONFIRME NOVA SENHA: </b></td>
			                                        <td><input type="password" disabled="" value="" class="FORMbox" size="20" name="confirma_nova_senha"/></td>
			                                    </tr> 
			                                </tbody></table>
			                            </td>
			                        </tr> 
			                    </tbody></table>
			                </td>
			            </tr>
			            <tr class="Linha2Tabela">
			            
			                <td>
			                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
			                        <tbody>	
			                        	<? if($id != 1) { ?>                        	
				                        <tr> 
				                            <td align="right">
				                            <?=$pegaUsuario->getStatus() == 1 ? '<a href="act/Administracao.act.php?acao=block&idadministracao='.$pegaUsuario->getIdadministracao().'"><font color="#ff0000">BLOQUEAR ESTE USUÁRIO</font></a>' : '<a href="act/Administracao.act.php?acao=block&idadministracao='.$pegaUsuario->getIdadministracao().'"><font color="#ff0000">DESBLOQUEAR ESTE USUÁRIO</font></a>'; ?>	                              	                           
				                            </td>
				                        </tr>
				                        <? } ?>		                       
				                        <tr> 
				                            <td align="right"><input type="button" style="width: 200px;"  onclick="javascript: window.location='act/Administracao.act.php?acao=reenvio&idadministracao=<?=$pegaUsuario->getIdadministracao();?>';" class="bttn1" value="Re-enviar os dados de acesso" name="reenvia"/></td>
				                        </tr>
				                    </tbody>
			                    </table>
			                </td>
			                
			            </tr>
			            <tr class="Linha3Tabela">
			            
			                <td valign="middle">
			                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
			                        <tbody><tr> 
			                            <td align="right"><input type="submit" class="bttn4" value="Alterar usuário" /><? if($id != 1) { ?><input type="submit" class="bttn3" onclick="return confirma_apagar();" value="Apagar usuário" name="remover"/><? } ?></td>
			                        </tr> 
			                    </tbody></table>                                
			                </td>
			            </tr>
			            
			        </tbody>
		        </table>
		        </form> 
			<?

		}
		
		/**
		 * Mostra os usuarios administrativos cadastrados
		 *
		 * @param objeto $titulo
		 */
		public function AdministracaoMostra($titulo) {
			$administracaoDAO = new AdministracaoDAO();			
			$usuarios = $administracaoDAO->listaUsuarios();
			
			$totUsuarios = count($usuarios);
			
			?>
			<span class="TituloPage">• <?=$titulo;?></span>
		    <br/>
		    <br/>		    		   
		    <table cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
		        <tbody>
		        	<?
		    			switch ($_GET["msg"]) {
		    				case 1:
		    					$this->mostraMSG("Usuário removido com sucesso !");
		    				break;
		    				case 2:
		    					$this->mostraMSG("Status alterado com sucesso !");
		    				break;	    				
		    			}
		    		?>
			        <tr class="TituloTabela">
			            <td width="40%"><b>NOME</b></td>
			            <td width="15%"><b>USUÁRIO</b></td>
			            <td width="40%"><b>E-MAIL</b></td>
			            <td width="5%"><b>STATUS</b></td>
			        </tr>
			        <?
			        	for ($i=0;$i<$totUsuarios;$i++) { ?>
				        <tr onclick="javascript: window.location='?menu=1&act=altera&id=<?=$usuarios[$i]->getIdadministracao();?>';" onmouseout="this.style.backgroundColor='';" onmouseover="this.style.backgroundColor='#FFECEC'; this.style.cursor='hand';" class="Linha1Tabela">  
				            <td><b><?=$usuarios[$i]->getNome();?></b></td>
				            <td><?=$usuarios[$i]->getUsuario();?></td>
				            <td><?=$usuarios[$i]->getEmail();?></td>
				            <td align="center"><?=$usuarios[$i]->getStatus() == 1 ? '<img src="img/unlock.gif"/>' : '<img src="img/lock.gif"/>'; ?></td>
				        </tr>
		        	<?	} ?>
			    </tbody>
		    </table>
		    <br/>
		    <table width="400" cellspacing="1" cellpadding="4" border="0" class="BordaTabela">
		        <tbody>
			        <tr class="TituloTabela">
			            <td height="30" align="center" colspan="2">RESUMO DESTA CONSULTA</td>
			        </tr>
			        <tr class="Linha1Tabela">
			            <td height="20"><b>Total de Registros:</b></td>
			            <td width="40%" height="20"><?=$totUsuarios;?></td>
			        </tr>
			    </tbody>
		    </table>
			<?

		}
	}
?>