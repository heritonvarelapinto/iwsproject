function detalhe(pagina, titulo, width, height){
	topW  = (screen.availHeight / 2) - (width / 2);
	leftW = (screen.availWidth / 2) - (height / 2);

	try{
		window.open('/anunciante.php?id='+id, '_blank','top=' + topW + ', left=' + leftW + ', height=' + height + ', width=' + width + ', status=no, menubar=no, resizable=no, scrollbars=no, toolbar=no, location=no, directories=no');
	} catch(e){	}
	
	if(!myWindow) {
		alert("Verifique seu anti-popup.")
	}
}

function abrirDestaque(id, titulo, largura, altura) {
	topW  = (screen.availHeight / 2) - (altura / 2);
	leftW = (screen.availWidth / 2) - (largura / 2);

	opcoes = 'top=' +topW+ ', left=' +leftW+ ', height=' +altura+ ', width=' +largura;
	
	alert(opcoes)
	
	
	myWindow = window.open(id, '', opcoes + ', status=no, menubar=no, resizable=no, scrollbars=no, toolbar=no, location=no, directories=no');
	
	if(!myWindow) {
		alert("Verifique seu anti-popup.")
	}
}