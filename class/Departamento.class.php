<?php
class Departamento {
	
	public $idDepartamento;
	public $departamento;
	
	public $paginas;
    public $registros;
    public $registrosPorPagina;

	
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
    
    

    function getPaginas() {
          return $this->paginas;
    }
    function setPaginas($paginasIn) {
          $this->paginas = $paginasIn;
    }

    function getRegistros() {
          return $this->registros;
    }
    function setRegistros($registrosIn) {
          $this->registros = $registrosIn;
    }
    
    function getRegistrosPorPagina() {
          return $this->registrosPorPagina;
    }
    function setRegistrosPorPagina($registrosPorPaginaIn) {
          $this->registrosPorPagina = $registrosPorPaginaIn;
    }
}
?>

