<?php
class Anuncio {
    public $idanuncio;
    public $iddepartamento;
    public $idsubdepartamento;
    public $nome;
    public $endereco;
    public $numero;
    public $complemento;
    public $cidade;
    public $estado;
    public $cep;
    public $telefones;
    public $site;
    public $email;
    public $logo;
    public $texto;
    public $de;
    public $ate;
    public $status;

    function getIdanuncio() {
          return $this->idanuncio;
    }
    function setIdanuncio($idanuncioIn) {
          $this->idanuncio = $idanuncioIn;
    }

    function getIddepartamento() {
          return $this->iddepartamento;
    }
    function setIddepartamento($iddepartamentoIn) {
          $this->iddepartamento = $iddepartamentoIn;
    }

    function getIdsubdepartamento() {
          return $this->idsubdepartamento;
    }
    function setIdsubdepartamento($idsubdepartamentoIn) {
          $this->idsubdepartamento = $idsubdepartamentoIn;
    }

    function getNome() {
          return $this->nome;
    }
    function setNome($nomeIn) {
          $this->nome = $nomeIn;
    }

    function getEndereco() {
          return $this->endereco;
    }
    function setEndereco($enderecoIn) {
          $this->endereco = $enderecoIn;
    }

    function getNumero() {
          return $this->numero;
    }
    function setNumero($numeroIn) {
          $this->numero = $numeroIn;
    }

    function getComplemento() {
          return $this->complemento;
    }
    function setComplemento($complementoIn) {
          $this->complemento = $complementoIn;
    }

    function getCidade() {
          return $this->cidade;
    }
    function setCidade($cidadeIn) {
          $this->cidade = $cidadeIn;
    }

    function getEstado() {
          return $this->estado;
    }
    function setEstado($estadoIn) {
          $this->estado = $estadoIn;
    }

    function getCep() {
          return $this->cep;
    }
    function setCep($cepIn) {
          $this->cep = $cepIn;
    }

    function getTelefones() {
          return $this->telefones;
    }
    function setTelefones($telefonesIn) {
          $this->telefones = $telefonesIn;
    }

    function getSite() {
          return $this->site;
    }
    function setSite($siteIn) {
          $this->site = $siteIn;
    }

    function getEmail() {
          return $this->email;
    }
    function setEmail($emailIn) {
          $this->email = $emailIn;
    }

    function getLogo() {
          return $this->logo;
    }
    function setLogo($logoIn) {
          $this->logo = $logoIn;
    }

    function getTexto() {
          return $this->texto;
    }
    function setTexto($textoIn) {
          $this->texto = $textoIn;
    }

    function getDe() {
          return $this->de;
    }
    function setDe($deIn) {
          $this->de = $deIn;
    }

    function getAte() {
          return $this->ate;
    }
    function setAte($ateIn) {
          $this->ate = $ateIn;
    }

    function getStatus() {
          return $this->status;
    }
    function setStatus($statusIn) {
          $this->status = $statusIn;
    }
}
?>