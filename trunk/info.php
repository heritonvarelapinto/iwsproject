<?
	/*Editado pelo thon*/
	/*Editado pelo fernando denovo*/
	function __autoload($classe) {
		require_once "class/".$classe.".class.php";
	}
	
	$layout = new Layout();
	
	$layout->montaClimaTempo();
	
	/*for($i = 0; $i < 50; $i++)
		echo $i." | <img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/we/52/".$i.".gif\"><br>";*/
		/*echo $i." | <img src=\"http://image.weather.com/web/common/wxicons/25/".$i.".gif\" width=\"32\" height=\"32\"><br>";*/
?>