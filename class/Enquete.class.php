<?php 
	class Enquete {
	    public $idpergunta;
	    public $pergunta;
	    public $status;
	    public $pergdata;
	    public $idresposta;
	    public $idresppergunta;
	    public $resposta;
	    public $respdata;
	    public $voto;
	    public $id;
	    public $ip;
	
	    function getIdpergunta() {
	          return $this->idpergunta;
	    }
	    function setIdpergunta($idperguntaIn) {
	          $this->idpergunta = $idperguntaIn;
	    }
	
	    function getPergunta() {
	          return $this->pergunta;
	    }
	    function setPergunta($perguntaIn) {
	          $this->pergunta = $perguntaIn;
	    }
	
	    function getStatus() {
	          return $this->status;
	    }
	    function setStatus($statusIn) {
	          $this->status = $statusIn;
	    }
	
	    function getPergdata() {
	          return $this->pergdata;
	    }
	    function setPergdata($pergdataIn) {
	          $this->pergdata = $pergdataIn;
	    }
	
	    function getIdresposta() {
	          return $this->idresposta;
	    }
	    function setIdresposta($idrespostaIn) {
	          $this->idresposta = $idrespostaIn;
	    }
	
	    function getIdresppergunta() {
	          return $this->idresppergunta;
	    }
	    function setIdresppergunta($idrespperguntaIn) {
	          $this->idresppergunta = $idrespperguntaIn;
	    }
	
	    function getResposta() {
	          return $this->resposta;
	    }
	    function setResposta($respostaIn) {
	          $this->resposta = $respostaIn;
	    }
	
	    function getRespdata() {
	          return $this->respdata;
	    }
	    function setRespdata($respdataIn) {
	          $this->respdata = $respdataIn;
	    }
	
	    function getVoto() {
	          return $this->voto;
	    }
	    function setVoto($votoIn) {
	          $this->voto = $votoIn;
	    }
	
	    function getId() {
	          return $this->id;
	    }
	    function setId($idIn) {
	          $this->id = $idIn;
	    }
	
	    function getIp() {
	          return $this->ip;
	    }
	    function setIp($ipIn) {
	          $this->ip = $ipIn;
	    }
	}
?>