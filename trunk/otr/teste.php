<?
function __autoload($classe)
    {
        require_once "../class/".$classe.".class.php";
    }
	
    $acao = "altdep&iddepartamento=1";
    
    $layoutDepartamento = new LayoutDepartamento();
	$layoutDepartamento->EstruturaDepartamento($acao);
	

?>