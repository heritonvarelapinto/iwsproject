<?php
class Departamento {
	
	public $idDepartamento;
	public $departamento;
	
    function getIdDepartamento() {
          return $this->idDepartamento;
    }
    function setIdDepartamento($idDepartamentoIn) {
          $this->idDepartamento = $idDepartamentoIn;
    }

    function getDepartamento() {
          return $this->departamento;
    }
    function setDepartamento($departamentoIn) {
          $this->departamento = $departamentoIn;
    }

}
?>

