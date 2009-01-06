	function ajaxInit() {
		var req;
		try {
			req = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			try {
				req = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(ex) {
				try {
			   		req = new XMLHttpRequest();
				} catch(exc) {
			  		alert("Esse browser n�o tem recursos para uso do Ajax");
			   		req = null;
				}
			}
		}
		
		return req;
	}
	
	function abrirSite(url) {
		newWindow = window.open(url,'_blank');
		
		if(!newWindow) {
			alert("Verifique o ANTI-POPUP");
		}
	}
	
	function contaAcesso(id) {
		ajax = ajaxInit();
				
		if(ajax) {
			alert("acesso + 1" + id);
			/*ajax.open("POST", "act/contaAcesso.php", true );
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("id=" + id);
			
			$("#contato").html("");
			
			ajax.onreadystatechange = function() {     
			if(ajax.readyState == 4) {
			     if(ajax.status == 200) {
				         $("#contato").html(ajax.responseText);
				       } else {
				         $("#contato").html(ajax.statusText);
				       }
			     }
			}*/
		}
	}
	
	function carregaForm(id) {
		ajax = ajaxInit();
				
		if(ajax) {
			ajax.open("POST", "class/Captcha.class.php", true );
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("id=" + id);
			
			$("#contato").html("");
			
			ajax.onreadystatechange = function() {     
			if(ajax.readyState == 4) {
			     if(ajax.status == 200) {
				         $("#contato").html(ajax.responseText);
				       } else {
				         $("#contato").html(ajax.statusText);
				       }
			     }
			}
		}
	}

	function verificaForm() {
		ajax = ajaxInit();
		erro = "";
		
		nome 	= $("input[name='nome']").val();
		email 	= $("input[name='email']").val();
		assunto = $("input[name='assunto']").val();
		mensagem = $("textarea[name='mensagem']").val();
		captcha = $("input[name='captcha']").val();
		
		id = $("input[name='anuncio']").val();
		
		if(nome == "") erro += " - Insira o seu Nome\n";
		if(email == "") erro += " - E-mail para contato\n";
		if(assunto == "") erro += " - Assunto da mensagem\n";
		if(mensagem == "") erro += " - Mensagem\n";
		if(captcha == "") erro += " - O c\u00F3digo de vefica\u00E7\u00E3o\n";
		
		if(erro == "") {
			telefone = $("input[name='telefone']").val();
			
			
			if(ajax) {
				ajax.open("POST", "act/correio.php", true );
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded, charset=ISO-8859-1");
				ajax.send("unid=" + captcha + "&nome=" + nome + "&email=" + email + "&assunto=" + assunto +	"&mensagem=" + mensagem + "&telefone=" + telefone + "&id="+id);
						
				ajax.onreadystatechange = function() {     
				if(ajax.readyState == 4) {
				     if(ajax.status == 200) {
					         if(ajax.responseText) {
					         	alert('Enviado com sucesso!');
					         	carregaForm(id);
					         } else {
					         	alert('Campo c\u00F3digo inv\u00E1lido');
					         	carregaForm(id);
					         }
					       } else {
					         $("#contato").html(ajax.statusText);
					       }
				     }
				}
			}
		} else {
			alert("Existem campos que n\u00E3o foram preenchidos!\n\n" + erro);
		}

	}
	

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
		load();
		$("#map").show();
		$("#contato").hide();
		$("#foto").hide();
	}

	function contatoAnuncio(id) {
		carregaForm(id);
		$("#map").hide();
		$("#contato").show();
		$("#foto").hide();
	}
	
	function enviarAnuncio(id) {
		carregaForm(id);
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