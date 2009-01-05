<?
	header("Content-type: text/html; charset=iso-8859-1");
	
	function __autoload($classe)
    {
        require_once $classe.".class.php";
    }
	
	$iddepartamento = $_POST['iddepartamento'];

	$subdepartamento = new Subdepartamento();
	$subdepartamentoDAO = new SubdepartamentoDAO();
	$subdepartamento = $subdepartamentoDAO->getSubdepartamentosPorIddepartamento($iddepartamento);
	$html = new HTML();
	$html->selectSubdepartamentosAdminAnuncios($subdepartamento);
					
?>