<?php
class Uteis {
    public $iduteis;
    public $imagem;
    public $texto;
    public $link;
    public $opcao;

    function getIduteis() {
          return $this->iduteis;
    }
    function setIduteis($iduteisIn) {
          $this->iduteis = $iduteisIn;
    }

    function getImagem() {
          return $this->imagem;
    }
    function setImagem($imagemIn) {
          $this->imagem = $imagemIn;
    }

    function getTexto() {
          return $this->texto;
    }
    function setTexto($textoIn) {
          $this->texto = $textoIn;
    }

    function getLink() {
          return $this->link;
    }
    function setLink($linkIn) {
          $this->link = $linkIn;
    }

    function getOpcao() {
          return $this->opcao;
    }
    function setOpcao($opcaoIn) {
          $this->opcao = $opcaoIn;
    }
}
?>