<?php
	class MenuAdmin {
    var $idmenu;
    var $titulo;

    function getIdmenu() {
          return $this->idmenu;
    }
    function setIdmenu($idmenuIn) {
          $this->idmenu = $idmenuIn;
    }

    function getTitulo() {
          return $this->titulo;
    }
    function setTitulo($tituloIn) {
          $this->titulo = $tituloIn;
    }    
}
?>