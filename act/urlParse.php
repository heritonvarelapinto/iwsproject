<?
	function __autoload($classe) {
		require_once "../class/".$classe.".class.php";
	}
	
	echo UrlManage::getUrlPaginacao($_POST['id'],$_POST['sub'],0,$_POST['totalPP']);
?>