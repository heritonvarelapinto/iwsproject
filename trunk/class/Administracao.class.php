<?php
class Administracao {

    /** 
     * Persistent Instance variables. This data is directly 
     * mapped to the columns of database table.
     */
    var $idadministracao;
    var $idcliente;
    var $nome;
    var $email;
    var $ddd;
    var $telefone;
    var $usuario;
    var $senha;
    var $status;



    /** 
     * Constructors. DaoGen generates two constructors by default.
     * The first one takes no arguments and provides the most simple
     * way to create object instance. The another one takes one
     * argument, which is the primary key of the corresponding table.
     */

    function Administracao () {

    }

    /* function Administracao ($idadministracaoIn) {

          $this->idadministracao = $idadministracaoIn;

    } */


    /** 
     * Get- and Set-methods for persistent variables. The default
     * behaviour does not make any checks against malformed data,
     * so these might require some manual additions.
     */

    /**
     * Gera uma senha automatica com 8 caracteres
     *
     * @return string
     */
    function geraSenha() {
		$CaracteresAceitos = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

		$max = strlen($CaracteresAceitos)-1;
		
		$password = null;
		
		for($i=0; $i < 8; $i++) {
		
		$password .= $CaracteresAceitos{mt_rand(0, $max)};
		
		}
		return $password;
	}
    
	/**
	 * Envia um email
	 *
	 * @param objeto $cliente
	 * @param objeto $usuarios
	 * @param objeto $senha
	 * @return unknown
	 */
	function EnviaDadosEmailAdministracao($cliente,$usuarios,$senha) {		
		$headers = "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "From: Painel Administrativo - ".$cliente->getNome()." <administracao@".$cliente->getEmail().">";
		$assunto = "Confirmação de Cadastro";
		$mensagem = '<html dir="ltr">
					    <head>
					    </head>
					    <body spellcheck="false">
					        <p><font face="Arial" color="#000000"><strong>Seu cadastro foi feito com sucesso !</strong> </font></p>
					        <p><font face="Arial" color="#ff0000">Você esta recebendo uma senha temporária para acesso,</font></p>
					        <p><font face="Arial" color="#ff0000">por favor troque a sua senha logo após logar no site.</font></p>
					        <p><strong><font face="Arial">Usuário: </font></strong><font face="Arial">'.$usuarios->getUsuario().'</font><strong><font face="Arial"><br />
					        </font></strong></p>
					        <p><strong><font face="Arial">Senha: </font></strong><font face="Arial">'.trim($senha).'</font><strong><font face="Arial"><br />
					        </font></strong></p>
					        <p><font face="Arial"><strong><font color="#ff0000">Link para acesso ao site:</font></strong> <a href="http://www.'.$cliente->getEmail().'/otr">www.'.$cliente->getEmail().'</a></font></p>
					        <p> </p>
					    </body>
					</html>';			
		if(!mail($usuarios->getEmail(),$assunto,$mensagem,$headers)) {
			$ok = true;
		}
				
		return $ok;
	}
	
    function getIdadministracao() {
          return $this->idadministracao;
    }
    function setIdadministracao($idadministracaoIn) {
          $this->idadministracao = $idadministracaoIn;
    }

    function getIdcliente() {
          return $this->idcliente;
    }
    function setIdcliente($idclienteIn) {
          $this->idcliente = $idclienteIn;
    }

    function getNome() {
          return $this->nome;
    }
    function setNome($nomeIn) {
          $this->nome = $nomeIn;
    }

    function getEmail() {
          return $this->email;
    }
    function setEmail($emailIn) {
          $this->email = $emailIn;
    }

    function getDdd() {
          return $this->ddd;
    }
    function setDdd($dddIn) {
          $this->ddd = $dddIn;
    }

    function getTelefone() {
          return $this->telefone;
    }
    function setTelefone($telefoneIn) {
          $this->telefone = $telefoneIn;
    }

    function getUsuario() {
          return $this->usuario;
    }
    function setUsuario($usuarioIn) {
          $this->usuario = $usuarioIn;
    }

    function getSenha() {
          return $this->senha;
    }
    function setSenha($senhaIn) {
          $this->senha = $senhaIn;
    }

    function getStatus() {
          return $this->status;
    }
    function setStatus($statusIn) {
          $this->status = $statusIn;
    }
}
?>