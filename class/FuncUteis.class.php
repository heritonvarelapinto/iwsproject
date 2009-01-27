<?
class FuncUteis {
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
		        
		        // Para verificar as dimensões da imagem
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
		        }
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
		        preg_match("/\.(gif|bmp|png|jpg|jpeg|swf){1}$/i", $name, $ext);
		
		        // Gera um nome único para a imagem
		        $imagem_nome = date("Ymd".rand()).$ext[0];
		        
		        // Caminho de onde a imagem ficará
		        $imagem_dir = "../../images/$pasta/".$imagem_nome;
		
		        // Faz o upload da imagem
		        move_uploaded_file($tmp_name, $imagem_dir);
		        
		        $ok = true;
		            		  
		    }
		}
		return $imagem_nome;
	}
}
?>