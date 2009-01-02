<?
class UrlManage {
	
	public static function getUrlCategoria($idcategoria, $Categoria, $Titulo){
		$layout = new Layout();
		if( UrlManage::HabilitadoModRewrite() ){
			return $layout->image_path."categoria/$idcategoria/".UrlManage::convertStringByUrlString($Titulo).".html";
		}else{
			return "categorias.php?id=$idcategoria&titulo=$Titulo";
		}
	}
	
	public static function getUrlPagina($idpagina, $Titulo){
		$layout = new Layout();
		if( UrlManage::HabilitadoModRewrite() ){
			return $layout->image_path."pagina/$idpagina/".UrlManage::convertStringByUrlString($Titulo).".html";
		}else{
			return "paginas.php?id=$idpagina&titulo=$Titulo";
		}
	}
	
	public static function getUrlSubCategoria($idcategoria, $categoria,$idsubcategoria, $subcategoria){
		$layout = new Layout();
		if( UrlManage::HabilitadoModRewrite() ){
			//return UrlManage::convertStringByUrlString($categoria)."/".$idsubcategoria."/".UrlManage::convertStringByUrlString($subcategoria).".html";
			return $layout->image_path."categoria/$idcategoria/".UrlManage::convertStringByUrlString($categoria)."/".$idsubcategoria."/".UrlManage::convertStringByUrlString($subcategoria).".html";
		}else{
			return "categorias.php?id=$idcategoria&sub=$idsubcategoria";
		}
	}
	
	public static function getUrlCliente($idcategoria, $Categoria, $Titulo){
		if( UrlManage::HabilitadoModRewrite() ){
			return $layout->image_path."categoria/$idcategoria/".UrlManage::convertStringByUrlString($Titulo).".html";
		}else{
			return "categorias.php?id=$idcategoria&titulo=$Titulo";
		}
	}
	
	public static function convertStringByUrlString($String){
		
		$Separador = "_";
		
		$String = trim($String); //Removendo espaços do inicio e do fim da string
		$String = strtolower($String); //Convertendo a string para minúsculas
		$String = strip_tags($String); //Retirando as tags HTML e PHP da string
		$String = eregi_replace("[[:space:]]", $Separador, $String); //Substituindo todos os espaços por $Separador
		
		$String = eregi_replace("[çÇ]", "c", $String); //Substituindo caracteres especiais pela letra respectiva
		$String = eregi_replace("[áÁäÄàÀãÃâÂ]", "a", $String);
		$String = eregi_replace("[éÉëËèÈêÊ]", "e", $String);
		$String = eregi_replace("[íÍïÏìÌîÎ]", "i", $String);
		$String = eregi_replace("[óÓöÖòÒõÕôÔ]", "o", $String);
		$String = eregi_replace("[úÚüÜùÙûÛ]", "u", $String);
		
		$String = eregi_replace("(\()|(\))", $Separador, $String); //Substituindo outros caracteres por "$Separador"
		$String = eregi_replace("(\/)|(\\\)", $Separador, $String);
		$String = eregi_replace("(\[)|(\])", $Separador, $String);
		$String = eregi_replace("[@#\$%&\*\+=\|º]", $Separador, $String);
		$String = eregi_replace("[;:'\"<>,\.?!_-]", $Separador, $String);
		$String = eregi_replace("[“”]", $Separador, $String);
		$String = eregi_replace("(ª)+", $Separador, $String);
		$String = eregi_replace("[`´~^°]", $Separador, $String);
		
		$String = eregi_replace("($Separador)+", $Separador, $String); //Removendo o excesso de "$Separador" por apenas um
		
		$String = substr($String, 0, 100); //Quebrando a string para um tamanho pré-definido
		
		$String = eregi_replace("(^($Separador)+)|(($Separador)+$)", "", $String); //Removendo o "$Separador" do inicio e fim da string

		return $String;
	}		
	private static function HabilitadoModRewrite(){
		return true;
	}
}
?>