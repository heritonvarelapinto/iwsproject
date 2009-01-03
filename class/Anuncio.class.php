<?php
class Anuncio {
    public $idanuncio;
    public $iddepartamento;
    public $idsubdepartamento;
    public $nome;
    public $endereco;
    public $numero;
    public $complemento;
    public $bairro;
    public $cidade;
    public $estado;
    public $cep;
    public $telefones;
    public $site;
    public $email;
    public $logo;
    public $imagem1;
    public $imagem2;
    public $imagem3;
    public $imagem4;
    public $texto;
    public $de;
    public $ate;
    
    function FormataData($data) {
		$data = explode("/",$data);
		$data = $data[2]."-".$data[1]."-".$data[0];
		
		return $data;
	}
    
    function upload_imagem($name,$type,$tmp_name,$size,$tamanho,$largura,$altura,$pasta) {	
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
		        $imagem_dir = "../../images/$pasta/".$imagem_nome;
		
		        // Faz o upload da imagem
		        move_uploaded_file($tmp_name, $imagem_dir);
		        
		        $ok = true;
		            		  
		    }
		}
		return $ok;
	}
    
    function getIdanuncio() {
          return $this->idanuncio;
    }
    function setIdanuncio($idanuncioIn) {
          $this->idanuncio = $idanuncioIn;
    }

    function getIddepartamento() {
          return $this->iddepartamento;
    }
    function setIddepartamento($iddepartamentoIn) {
          $this->iddepartamento = $iddepartamentoIn;
    }

    function getIdsubdepartamento() {
          return $this->idsubdepartamento;
    }
    function setIdsubdepartamento($idsubdepartamentoIn) {
          $this->idsubdepartamento = $idsubdepartamentoIn;
    }

    function getNome() {
          return $this->nome;
    }
    function setNome($nomeIn) {
          $this->nome = $nomeIn;
    }

    function getEndereco() {
          return $this->endereco;
    }
    function setEndereco($enderecoIn) {
          $this->endereco = $enderecoIn;
    }

    function getNumero() {
          return $this->numero;
    }
    function setNumero($numeroIn) {
          $this->numero = $numeroIn;
    }

    function getComplemento() {
          return $this->complemento;
    }
    function setComplemento($complementoIn) {
          $this->complemento = $complementoIn;
    }

    function getCidade() {
          return $this->cidade;
    }
    function setCidade($cidadeIn) {
          $this->cidade = $cidadeIn;
    }

    function getEstado() {
          return $this->estado;
    }
    function setEstado($estadoIn) {
          $this->estado = $estadoIn;
    }

    function getCep() {
          return $this->cep;
    }
    function setCep($cepIn) {
          $this->cep = $cepIn;
    }

    function getTelefones() {
          return $this->telefones;
    }
    function setTelefones($telefonesIn) {
          $this->telefones = $telefonesIn;
    }

    function getSite() {
          return $this->site;
    }
    function setSite($siteIn) {
          $this->site = $siteIn;
    }

    function getEmail() {
          return $this->email;
    }
    function setEmail($emailIn) {
          $this->email = $emailIn;
    }

    function getLogo() {
          return $this->logo;
    }
    function setLogo($logoIn) {
          $this->logo = $logoIn;
    }

    function getTexto() {
          return $this->texto;
    }
    function setTexto($textoIn) {
          $this->texto = $textoIn;
    }

    function getDe() {
          return $this->de;
    }
    function setDe($deIn) {
          $this->de = $deIn;
    }

    function getAte() {
          return $this->ate;
    }
    function setAte($ateIn) {
          $this->ate = $ateIn;
    }
  
    function getBairro() {
          return $this->bairro;
    }
    function setBairro($bairroIn) {
          $this->bairro = $bairroIn;
    }
    
    function getImagem1() {
          return $this->imagem1;
    }
    function setImagem1($imagem1In) {
          $this->imagem1 = $imagem1In;
    }
    
     function getImagem2() {
          return $this->imagem2;
    }
    function setImagem2($imagem2In) {
          $this->imagem2 = $imagem2In;
    }
    
     function getImagem3() {
          return $this->imagem3;
    }
    function setImagem3($imagem3In) {
          $this->imagem3 = $imagem3In;
    }
    
     function getImagem4() {
          return $this->imagem4;
    }
    function setImagem4($imagem4In) {
          $this->imagem4 = $imagem4In;
    }
}
?>