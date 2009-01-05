function abrirDestaque(id, titulo, largura, altura) {
	topW  = (screen.availHeight / 2) - (altura / 2);
	leftW = (screen.availWidth / 2) - (largura / 2);

	opcoes = 'top=' +topW+ ', left=' +leftW+ ', height=' +altura+ ', width=' +largura;	
	
	myWindow = window.open(id, '', opcoes + ', status=no, menubar=no, resizable=no, scrollbars=no, toolbar=no, location=no, directories=no');
	
	if(!myWindow) {
		alert("Verifique seu anti-popup.")
	}
}
	
	function localizacao() {
		$("#map").show();
		$("#contato").hide();
		$("#foto").hide();
	}

	function contatoAnuncio() {
		$("#map").hide();
		$("#contato").show();
		$("#foto").hide();
	}
	
	function verFoto(imagem) {
		$("#map").hide();
		$("#contato").hide();
		$("#foto").html("<img src = " + imagem + ">");
		$("#foto").show();
	}