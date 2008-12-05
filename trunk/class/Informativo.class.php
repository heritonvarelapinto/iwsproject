<?php
class Informativo {
    public $idinformativo;
    public $nome;
    public $email;
    public $status;
    public $delay;
    public $idinfomodelo;
    public $assunto;
    public $texto;

    function getIdinformativo() {
          return $this->idinformativo;
    }
    function setIdinformativo($idinformativoIn) {
          $this->idinformativo = $idinformativoIn;
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

    function getStatus() {
          return $this->status;
    }
    function setStatus($statusIn) {
          $this->status = $statusIn;
    }

    function getDelay() {
          return $this->delay;
    }
    function setDelay($delayIn) {
          $this->delay = $delayIn;
    }

    function getIdinfomodelo() {
          return $this->idinfomodelo;
    }
    function setIdinfomodelo($idinfomodeloIn) {
          $this->idinfomodelo = $idinfomodeloIn;
    }

    function getAssunto() {
          return $this->assunto;
    }
    function setAssunto($assuntoIn) {
          $this->assunto = $assuntoIn;
    }

    function getTexto() {
          return $this->texto;
    }
    function setTexto($textoIn) {
          $this->texto = $textoIn;
    }
}

?>