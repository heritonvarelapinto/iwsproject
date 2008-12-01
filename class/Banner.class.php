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
	
	function upload_banners($name,$type,$tmp_name,$size,$tamanho,$largura,$altura) {	
		$erro = $config = array();
				
		// Tamanho máximo do arquivo (em bytes)
		$config["tamanho"] = $tamanho;
		// Largura máxima (pixels)
		$config["largura"] = $largura;
		// Altura máxima (pixels)
		$config["altura"]  = $altura;
		
		// Formulário postado... executa as ações
		if($name)
		{  
		    // Verifica se o mime-type do arquivo é de imagem
		    if(!eregi("^image|application\/(pjpeg|jpeg|png|gif|x-shockwave-flash)$", $type))
		    {
		        $erro[] = "<span class='imgERR'>Arquivo em formato inválido! A imagem deve ser jpg, jpeg, 
					bmp, gif , png ou swf. Envie outro arquivo</span>";
		    }
		    else
		    {
		        // Verifica tamanho do arquivo
		        if($size > $config["tamanho"])
		        {
		            $erro[] = "<span class='imgERR'>Arquivo em tamanho muito grande! 
				A imagem deve ser de no máximo " . $config["tamanho"] . " bytes. 
				Envie outro arquivo</span>";
		        }
		        
		        /*// Para verificar as dimensões da imagem
		        $tamanhos = getimagesize($tmp_name);
		        
		        // Verifica largura
		        if($tamanhos[0] > $config["largura"])
		        {
		            $erro[] = "<span class='imgERR'>Largura da imagem não deve 
						ultrapassar " . $config["largura"] . " pixels</span>";
		        }
		
		        // Verifica altura
		        if($tamanhos[1] > $config["altura"])
		        {
		            $erro[] = "<span class='imgERR'>Altura da imagem não deve 
						ultrapassar " . $config["altura"] . " pixels</span>";
		        }*/
		    }
		    
		    /// Imprime as mensagens de erro
		    if(sizeof($erro))
		    {
		        foreach($erro as $err)
		        {
		            echo " - " . $err . "<BR>";
		        }
					
		        $ok = false;
		        //echo "<a href=\"javascript:history.back();\">Fazer Upload de Outra Imagem</a>";
		    }
		
		    // Veificação de dados OK, nenhum erro ocorrido, executa então o upload...
		    else
		    {
		        // Pega extensão do arquivo
		        //preg_match("/\.(gif|bmp|png|jpg|jpeg|swf){1}$/i", $arquivo["name"], $ext);
		
		        // Gera um nome único para a imagem
		        //$imagem_nome = md5(uniqid(time())) . "." . $ext[1];
		        $imagem_nome = $name;
		        
		        //AdmBanners::addBanners($lado,$idcat,$numero,$imagem_nome,$tamanhos[0],$tamanhos[1],$url,$target,$tempo);	  
		       		       	     
		        // Caminho de onde a imagem ficará
		        $imagem_dir = "../../images/banners/".$imagem_nome;
		
		        // Faz o upload da imagem
		        move_uploaded_file($tmp_name, $imagem_dir);
		        
		        $ok = true;
		            		  
		    }
		}
		return $ok;
	}
	
	function pegaData($valor,$tempo) {
		if($valor == "") {
			if($tempo == "0") {
				echo $tempo = '0000-00-00 00:00:00';
			}else{
				$dias = $tempo;
				$dias = "+".$dias." days";			
				$timestamp = strtotime($dias);
				$tempo = date('Y-m-d G:i:s', $timestamp);
			}
		}else{
			$dias = $valor;
			$dias = "+".$dias." days";			
			$timestamp = strtotime($dias);
			$tempo = date('Y-m-d G:i:s', $timestamp);
		}
		
		return $tempo;
	}
	
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