<?
	
?>
<form method="POST" action="correio.php">
	<table border="0" cellpadding="0" cellspacing="0" width="98%">
		<tr>
			<td colspan="2" class="label"><h2>Contato</h2></td>
		</tr>
		<tr>
			<td class="label">Nome:</td>
			<td><input type="text" name="nome"></td>
		</tr>
		<tr>
			<td class="label">E-mail:</td>
			<td><input type="text" name="email"></td>
		</tr>
		<tr>
			<td class="label">*Telefone:</td>
			<td><input type="text" name="telefone"></td>
		</tr>
		<tr>
			<td class="label">Assunto:</td>
			<td><input type="text" name="assunto"></td>
		</tr>
		<tr>
			<td class="label">Mensagem:</td>
			<td>
				<textarea name="mensagem" cols="30" rows="4"></textarea>
			</td>
		</tr>
		<tr>
			<td class="label"><?=utf8_encode("Qual é código");?></td>
			<td>
			<table>
				<tr>
					<td><input type="text" maxlength="5" id="captcha" style="width: 68px; height: 19px; margin: 0px; padding: 0px" name="captcha"></td>
					<td>
						<img src="<?=$layout->image_path;?>act/captcha.php?rand=<?=rand();?>">
					</td>
				</tr>
    		</table>
			</td>
		</tr>
		<tr>
			<td class="label"></td>
			<td><input style="width: 120px;" type="button" onclick="verificaForm();" value="Enviar e-mail"></td>
		</tr>
	</table>
	<input type="hidden" name="anuncio" value="<?=$_POST['id']?>">
</form>