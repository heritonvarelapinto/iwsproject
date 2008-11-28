<?php
class Administracao {
    public $idadministracao;
    public $idcliente;
    public $nome;
    public $email;
    public $ddd;
    public $telefone;
    public $usuario;
    public $senha;
    public $status;
    
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