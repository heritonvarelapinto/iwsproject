<?
class Banner {
	public $idbanner;
	public $iddepartamento;	
	public $lado;
	public $numero;
	public $banner;
	public $width;
	public $height;
	public $url;
	public $target;
	public $click;
	public $data;
	
	function getIdbanner() {
          return $this->idbanner;
    }
    function setIdbanner($idbannerIn) {
          $this->idbanner = $idbannerIn;
    }

    function getIddepartamento() {
          return $this->iddepartamento;
    }
    function setIddepartamento($iddepartamentoIn) {
          $this->iddepartamento = $iddepartamentoIn;
    }

    function getLado() {
          return $this->lado;
    }
    function setLado($ladoIn) {
          $this->lado = $ladoIn;
    }

    function getNumero() {
          return $this->numero;
    }
    function setNumero($numeroIn) {
          $this->numero = $numeroIn;
    }

    function getBanner() {
          return $this->banner;
    }
    function setBanner($bannerIn) {
          $this->banner = $bannerIn;
    }
    
    function getDescricao() {
          return $this->descricao;
    }
    function setDescricao($descricaoIn) {
          $this->descricao = $descricaoIn;
    }

    function getWidth() {
          return $this->width;
    }
    function setWidth($widthIn) {
          $this->width = $widthIn;
    }

    function getHeight() {
          return $this->height;
    }
    function setHeight($heightIn) {
          $this->height = $heightIn;
    }

    function getUrl() {
          return $this->url;
    }
    function setUrl($urlIn) {
          $this->url = $urlIn;
    }

    function getTarget() {
          return $this->target;
    }
    function setTarget($targetIn) {
          $this->target = $targetIn;
    }

    function getClick() {
          return $this->click;
    }
    function setClick($clickIn) {
          $this->click = $clickIn;
    }

    function getData() {
          return $this->data;
    }
    function setData($dataIn) {
          $this->data = $dataIn;
    }

}
?>