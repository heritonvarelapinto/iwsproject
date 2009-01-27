	path = "/oiterbusca/oiter/";

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
			  		alert("Esse browser não tem recursos para uso do Ajax");
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
			ajax.open("POST", path + "act/contaAcesso.php", true );
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("id=" + id);
		}
	}
	
	function insereBoletim(){
		ajax = ajaxInit();
		var erro = "";
		nome  = $("input[@type=text][@name=nome]").val();
		email = $("input[@type=text][@name=email]").val();
		
		if (email.indexOf("@")== -1 || email.indexOf(".")==-1){
			erro += 'Digite um Email válido.\n';
		}
		
		if(nome == "") {
			erro += 'Insira seu nome !';
		}
		
		if(erro != ""){
			alert(erro);
			return false;
		}else{  
			if(ajax) {
				ajax.open("POST", path + "act/boletim.php", true );
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("email="+email+"&nome="+nome);
				
				ajax.onreadystatechange = function() {     
					if(ajax.readyState == 4) {
					     if(ajax.status == 200) {
					         if(ajax.responseText) {
					         	alert(ajax.responseText);
					         	$("input[@type=text][@name=email]").val("");
					         	$("input[@type=text][@name=nome]").val("");
					     	 }
					     } else {
					     	alert(ajax.statusText);
					     }
					}
				}
			}
		}
	}

	function parcialEnquete() {
		ajax = ajaxInit();

		if(ajax) {
			ajax.open("POST", path + "act/enquete.php", true );
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("");
			
			ajax.onreadystatechange = function() {     
				if(ajax.readyState == 4) {
				     if(ajax.status == 200) {
				         if(ajax.responseText) {
				         	$("#enquetePergunta").html(ajax.responseText);
				     	 }
				     } else {
				     	alert(ajax.statusText);
				     }
				}
			}
		}
	}
	
	function votaEnquete() {
		ajax = ajaxInit();

		my_question = $("input[@type=radio][@name=opcao][@checked]").val();
				
		if(!my_question) {
			alert('Selecione uma opção!');
			return false;
		}
		
		if(ajax) {
			ajax.open("POST", path + "act/enquete.php", true );
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("id=" + my_question);
			
			ajax.onreadystatechange = function() {     
				if(ajax.readyState == 4) {
				     if(ajax.status == 200) {
				         if(ajax.responseText) {
				         	$("#enquetePergunta").html(ajax.responseText);
				     	 }
				     } else {
				     	alert(ajax.statusText);
				     }
				}
			}
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
		altura += 50;
		topW  = (screen.availHeight / 2) - (altura / 2);
		leftW = (screen.availWidth / 2) - (largura / 2);
	
		opcoes = 'top=' +topW+ ', left=' +leftW+ ', height=' +altura+ ', width=' +largura;	
		
		myWindow = window.open(id, '', opcoes + ', status=no, menubar=no, resizable=no, scrollbars=no, toolbar=no, location=no, directories=no');
		
		if(!myWindow) {
			alert("Verifique seu anti-popup.")
		}
	}
	
	function reload(id,sub,pagina,total,url) {
		ajax = ajaxInit();
				
		if(ajax) {
			ajax.open("POST", url + "act/urlParse.php", true );
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded, charset=ISO-8859-1");
			ajax.send("id=" + id + "&sub=" + sub + "&pag=" + pagina + "&totalPP=" + total);
			
			ajax.onreadystatechange = function() {     
				if(ajax.readyState == 4) {
				     if(ajax.status == 200) {
				         if(ajax.responseText) {
				         	location.href = ajax.responseText;
				     	 }
				     } else {
				     	alert(ajax.statusText);
				     }
				}
			}
		}
	}
	
	function localizacao() {
		load();
		$("#map").show();
		$("#contato").hide();
		$("#foto").hide();
		GUnload();
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

	function reloadPesquisa(pagina) {
		location.href = pagina;
	}
