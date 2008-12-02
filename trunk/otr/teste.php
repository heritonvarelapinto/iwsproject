<?
function __autoload($classe)
    {
        require_once "../class/".$classe.".class.php";
    }

    $departamentos = new Departamento();
    $departamentosDAO = new DepartamentoDAO();
    $departamentos = $departamentosDAO->Paginacao("ORDER BY departamento",10);
    print_r($departamentos);
    echo $registros = count($departamentos);

?>