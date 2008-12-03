<?
function __autoload($classe)
    {
        require_once "../class/".$classe.".class.php";
    }
	
    $acao = "uso";
    
    $layoutRodape = new LayoutRodape();
	$layoutRodape->EstruturaRodape($acao);
	

?>