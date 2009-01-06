<?
	session_start();
	
	if($_POST['unid'] == $_SESSION['sid_textoCaptcha']) {
		echo true;
	} else {
		echo false;
	}
?>