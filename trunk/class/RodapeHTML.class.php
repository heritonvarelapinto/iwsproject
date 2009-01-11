<?php
	class RodapeHTML extends HTML {
		public function RodapeADD() {
			?>
			<span class="TituloPage">• Criar Link Rodapé</span>
	        <br/>
	        <br/>        
	        <table width="558" cellspacing="1" cellpadding="4" border="0" align="center" valign="middle" class="BordaTabela">
	        <form name="rodape" action="act/Rodape.act.php?acao=add" method="post"/>
	        	<tbody>
	        		<?
						switch ($_GET["msg"]) {
							case 1:
								$this->mostraMSG("Adicionado com sucesso !");
							break;
							case 2:
								$this->mostraMSG("Removido com sucesso !");
							break;
						}
	        		?> 
	    			<tr class="Linha2Tabela">
                        <td align="right"><b>TÍTULO:</b></td>
                        <td align="left"><input type="text" class="FORMbox" name="titulo" size="95"/></td>
                    </tr>
                    <tr align="center" class="Linha1Tabela">
                        <td colspan="3"><b>CONTEÚDO DO TEXTO</b></td>
                    </tr>
	                <tr class="Linha2Tabela">
	                	<td colspan="3">     
							<textarea name="texto" cols="65" rows="30"></textarea>
                        </td>
                    </tr>
					<tr class="Linha3Tabela">
						<td align="right" colspan="3"><input type="submit" class="bttn2" value="Criar novo link"/></td>
					</tr>                           
				</tbody>					
			</table>
	<?	}
	
		public function RodapePoliticaDeUso() {
			$rodape = new Rodape();
			$rodapeDAO = new RodapeDAO();
			
			$rodape = $rodapeDAO->getRodapePorId(1);
			?>
			<span class="TituloPage">• Rodapé Política de Uso</span>
	        <br/>
	        <br/>        
	        <table width="558" cellspacing="1" cellpadding="4" border="0" align="center" valign="middle" class="BordaTabela">
	        <form name="rodape" action="act/Rodape.act.php?acao=uso" method="post"/>              
	        <input type="hidden" name="idrodape" value="<?=$rodape->getIdrodape();?>">              
	        	<tbody>
	        		<?
						switch ($_GET["msg"]) {
							case 1:
								$this->mostraMSG("Alterado com sucesso !");
							break;
						}
	        		?>
                    <tr align="center" class="Linha1Tabela">
                        <td colspan="3"><b>CONTEÚDO DO TEXTO</b></td>
                    </tr>
	                <tr class="Linha2Tabela">
	                	<td colspan="3">     
							<textarea name="texto" cols="65" rows="30"><?=$rodape->getTexto();?></textarea>
                        </td>
                    </tr>
					<tr class="Linha3Tabela">
						<td align="right" colspan="3"><input type="submit" class="bttn4" value="Alterar Texto"/></td>
					</tr>                           
				</tbody>					
			</table>
	<?	}
	
		public function RodapePoliticaDePrivacidade() {
			$rodape = new Rodape();
			$rodapeDAO = new RodapeDAO();
			
			$rodape = $rodapeDAO->getRodapePorId(2);
			?>
			<span class="TituloPage">• Rodapé Política de Privacidade</span>
	        <br/>
	        <br/>        
	        <table width="558" cellspacing="1" cellpadding="4" border="0" align="center" valign="middle" class="BordaTabela">
	        <form name="rodape" action="act/Rodape.act.php?acao=privacidade" method="post"/>              
	        <input type="hidden" name="idrodape" value="<?=$rodape->getIdrodape();?>">              
	        	<tbody>	  
	        		<?
						switch ($_GET["msg"]) {
							case 1:
								$this->mostraMSG("Alterado com sucesso !");
							break;
						}
	        		?>  			
                    <tr align="center" class="Linha1Tabela">
                        <td colspan="3"><b>CONTEÚDO DO TEXTO</b></td>
                    </tr>
	                <tr class="Linha2Tabela">
	                	<td colspan="3">     
							<textarea name="texto" cols="65" rows="30"><?=$rodape->getTexto();?></textarea>
                        </td>
                    </tr>
					<tr class="Linha3Tabela">
						<td align="right" colspan="3"><input type="submit" class="bttn4" value="Alterar Texto"/></td>
					</tr>                           
				</tbody>					
			</table>
	<?	}
	
		public function RodapeContato() {
			$rodape = new Rodape();
			$rodapeDAO = new RodapeDAO();
			
			$rodape = $rodapeDAO->getRodapePorId(3);
			
			$contato = new Contato();
			$contatoDAO = new ContatoDAO();
			$contato = $contatoDAO->getEmail();
			?>
			<span class="TituloPage">• Rodapé <?=ucfirst($rodape->getTitulo());?></span>
	        <br/>
	        <br/>        
	        <table width="558" cellspacing="1" cellpadding="4" border="0" align="center" valign="middle" class="BordaTabela">
	        <form name="rodape" action="act/Rodape.act.php?acao=contato" method="post"/>              
	        <input type="hidden" name="idrodape" value="<?=$rodape->getIdrodape();?>">              
	        	<tbody>	  
	        		<?
						switch ($_GET["msg"]) {
							case 1:
								$this->mostraMSG("Alterado com sucesso !");
							break;
						}
	        		?>  
	        		<tr class="Linha2Tabela">
                        <td align="right"><b>TÍTULO:</b></td>
                        <td><input type="text" class="FORMbox" name="titulo" value="<?=$rodape->getTitulo();?>" size="95"/></td>
                    </tr>	        				
                    <tr align="center" class="Linha1Tabela">
                        <td colspan="3"><b>CONTEÚDO DO TEXTO</b></td>
                    </tr>
	                <tr class="Linha2Tabela">
	                	<td colspan="3">     
							<textarea name="texto" cols="65" rows="30"><?=$rodape->getTexto();?></textarea>
                        </td>
                    </tr>
                    <tr class="Linha2Tabela">
                        <td align="right"><b>E-MAIL:</b></td>
                        <td><input type="text" class="FORMbox" name="email" value="<?=$contato->getEmail();?>" size="95"/><br>E-mail para onde será enviado o contato.</td>
                    </tr>
					<tr class="Linha3Tabela">
						<td align="right" colspan="3"><input type="submit" class="bttn4" value="Alterar Texto"/></td>
					</tr>                           
				</tbody>					
			</table>
	<?	}
	
		public function Rodape($id) {
			$rodape = new Rodape();
			$rodapeDAO = new RodapeDAO();
			
			$rodape = $rodapeDAO->getRodapePorId($id);
			?>
			<span class="TituloPage">• Rodapé <?=ucfirst($rodape->getTitulo());?></span>
	        <br/>
	        <br/>        
	        <table width="558" cellspacing="1" cellpadding="4" border="0" align="center" valign="middle" class="BordaTabela">
	        <form name="rodape" action="act/Rodape.act.php?acao=alt" method="post"/>              
	        <input type="hidden" name="idrodape" value="<?=$rodape->getIdrodape();?>">              
	        	<tbody>	 
	        		<?
						switch ($_GET["msg"]) {
							case 1:
								$this->mostraMSG("Alterado com sucesso !");
							break;
						}
	        		?>  	        		
	        		<tr class="Linha2Tabela">
                        <td align="right"><b>TÍTULO:</b></td>
                        <td><input type="text" class="FORMbox" name="titulo" value="<?=$rodape->getTitulo();?>" size="95"/></td>
                    </tr>	
                    <tr align="center" class="Linha1Tabela">
                        <td colspan="3"><b>CONTEÚDO DO TEXTO</b></td>
                    </tr>
	                <tr class="Linha2Tabela">
	                	<td colspan="3">     
							<textarea name="texto" cols="65" rows="30"><?=$rodape->getTexto();?></textarea>
                        </td>
                    </tr>
					<tr class="Linha3Tabela">
						<td align="right" colspan="3"><input type="submit" class="bttn4" value="Alterar Texto"/>&nbsp;&nbsp;<input type="submit" class="bttn3" onclick="return confirma_apagar();" value="Apagar Link" name="remover"/></td>
					</tr>                           
				</tbody>					
			</table>
	<?	}
	}
?>