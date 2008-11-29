<?
$headers = "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: Painel Administrativo - Oiter Busca <administracao@oiterbusca.com.br>";
$assunto = "Confirmação de Cadastro";
$mensagem = '<html dir="ltr">
			    <head>
			    </head>
			    <body spellcheck="false">
			        <p><font face="Arial" color="#000000"><strong>Seu cadastro foi feito com sucesso !</strong> </font></p>
			        <p><font face="Arial" color="#ff0000">Você esta recebendo uma senha temporária para acesso,</font></p>
			        <p><font face="Arial" color="#ff0000">por favor troque a sua senha logo após logar no site.</font></p>
			        <p><strong><font face="Arial">Usuário: </font></strong><font face="Arial">USUARIO</font><strong><font face="Arial"><br />
			        </font></strong></p>
			        <p><strong><font face="Arial">Senha: </font></strong><font face="Arial">senha</font><strong><font face="Arial"><br />
			        </font></strong></p>
			        <p><font face="Arial"><strong><font color="#ff0000">Link para acesso ao site:</font></strong> <a href="http://www.clicknobairro.com.br/xybr">www.clicknobairro.com.br</a></font></p>
			        <p> </p>
			    </body>
			</html>';		
echo $mensagem;	
//ini_set('SMTP','smtp.clicknobairro.com.br');
//ini_set('smtp_port',587);
//ini_set('sendmail_from', 'administracao@oiterbusca.com.br');
mail("colnaghithon@gmail.com",$assunto,$mensagem,$headers);
?>

<?/*
// Destinatário 
$to = "colnaghithon@hotmail.com" . ", " ;
$to .= "colnaghithon@hotmail.com";

// Assunto 
$subject = "Teste Locaweb!";

// Mensagem 
$message = '
<html>
<head><title>http://www.LOCAWEB.com.br!</title></head>
<body>
<p>Esse email é um teste enviado no formato HTML via PHP mail();!</p>
<table>
<tr>
<th bgcolor="#FF6666">Locaweb</th><th bgcolor="#0099FF">Locavoz</th><th bgcolor="#FFFFCC">Locamail</th>
</tr>
<tr>
<td align="center">Sites!</td><td align="center">Voz!</td><td align="center">Emails!</td>
</tr>
</table>
</body>
</html>
';

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: erinthon@clicknobairro.com.br\n";
$headers .= "Cc: erinthonc@gmail.com\n";
$headers .= "Bcc: erinthonc@gmail.com\n";
$headers .= "Return-Path: erinthon@clicknobairro.com.br\n";

// Enviando a mensagem  

mail($to, $subject, $message, $headers);
print "Mensagem Enviada com Sucesso!";*/
?> 