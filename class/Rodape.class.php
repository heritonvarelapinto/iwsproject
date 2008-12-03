<?php
	class Rodape {
	    public $idrodape;
	    public $titulo;
	    public $texto;

	    function getIdrodape() {
	          return $this->idrodape;
	    }
	    function setIdrodape($idrodapeIn) {
	          $this->idrodape = $idrodapeIn;
	    }
	
	    function getTitulo() {
	          return $this->titulo;
	    }
	    function setTitulo($tituloIn) {
	          $this->titulo = $tituloIn;
	    }
	
	    function getTexto() {
	          return $this->texto;
	    }
	    function setTexto($textoIn) {
	          $this->texto = $textoIn;
	    }
	}
?>