<?php
class TituloLinks extends MenuAdmin {
    public $idtitulo;
    public $titulolink;
    public $acao;

    function getIdtitulo() {
          return $this->idtitulo;
    }
    function setIdtitulo($idtituloIn) {
          $this->idtitulo = $idtituloIn;
    }

    function getTituloLink() {
          return $this->titulolink;
    }
    function setTituloLink($titulolinkIn) {
          $this->titulolink = $titulolinkIn;
    }
    
     function getAcao() {
          return $this->acao;
    }
    function setAcao($acaoIn) {
          $this->acao = $acaoIn;
    }
}
?>