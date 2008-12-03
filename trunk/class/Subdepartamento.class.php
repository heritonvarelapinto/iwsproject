<?php
class Subdepartamento {
    public $idsubdepartamento;
    public $iddepartamento;
    public $subdepartamento;

    function getIdsubdepartamento() {
          return $this->idsubdepartamento;
    }
    function setIdsubdepartamento($idsubdepartamentoIn) {
          $this->idsubdepartamento = $idsubdepartamentoIn;
    }

    function getIddepartamento() {
          return $this->iddepartamento;
    }
    function setIddepartamento($iddepartamentoIn) {
          $this->iddepartamento = $iddepartamentoIn;
    }

    function getSubdepartamento() {
          return $this->subdepartamento;
    }
    function setSubdepartamento($subdepartamentoIn) {
          $this->subdepartamento = $subdepartamentoIn;
    }
}
?>