<?
function __autoload($classe)
    {
        require_once "../class/".$classe.".class.php";
    }
	
    $acao = "altdep&iddepartamento=4";
    
    $layoutDepartamento = new LayoutDepartamento();
	$layoutDepartamento->EstruturaDepartamento($acao);
	

?>