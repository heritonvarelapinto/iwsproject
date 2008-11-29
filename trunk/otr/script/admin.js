function buscaCep(cep_dst) {
		
		if(cep_dst != '') {
			ajax = ajaxInit();
			if(ajax) {
			    ajax.open("POST", "../buscaCep.php", true );
			    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");		    
			    ajax.send("cep="+cep_dst);
			    
			    document.getElementById("endereco").value = 'Aguarde localizando CEP.';
			    			    
			    ajax.onreadystatechange = function() {     
			       if(ajax.readyState == 4) {
			       	
					     if(ajax.status == 200) {
					     		 var resposta = ajax.responseText;
              					 var aDados=resposta.split(';');
              					 if(aDados[4] == '') {
              					 	document.anuncios.endereco.value = aDados[0];
              					 	document.anuncios.bairro.value = aDados[1];
              					 	document.anuncios.cidade.value = aDados[2];
              					 	document.anuncios.estado.value = aDados[3];
              					 } else {
              					 	document.anuncios.endereco.value = "";
              					 	document.anuncios.bairro.value = "";
              					 	document.anuncios.cidade.value = "";
              					 	document.anuncios.estado.value = "";
              					 	alert(aDados[4])
              					 }
						       } else {
						         alert(ajax.statusText);
						       }
					     }
				   }
			}
		}else{
			alert("Favor informar o CEP.");
			document.getElementById("cep").focus();
		}
}

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


function servicosDisponiveis(idcategoria,div) {
	if(idcategoria != "") {
	ajax = ajaxInit();
	if(ajax) {
		ajax.open("POST", "servicos.php", true );
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");		    
		ajax.send("idcategoria=" + idcategoria + "&div=" +div);
		
		div = "div_"+div;
		document.getElementById(div).innerHTML = "<select><option>Carregando...</option></select>";			
		
		ajax.onreadystatechange = function() {     
		if(ajax.readyState == 4) {
		     if(ajax.status == 200) {
			         document.getElementById(div).innerHTML = ajax.responseText;
			       } else {
			         alert(ajax.statusText);
			       }
		     }
		}
	}
	} else {
		alert('Favor selecionar um valor.');
		return false;
	}
}

function servicos(idcategoria) {
	document.location="principal.php?menu=3&act=addgold&idcategoria="+idcategoria;
}

function addBanner(idcat,lado,numero,largura,altura) {
	document.location="principal.php?menu=6&act=add&idcat="+idcat+"&lado="+lado+"&numero="+numero+"&w="+largura+"&h="+altura;
}

function altBanner(idbanner,largura,altura) {
	document.location="principal.php?menu=6&act=add&idbanner="+idbanner+"&w="+largura+"&h="+altura;
}

function delBanner(idcat,idbanner) {
	if(window.confirm("Deseja realmente excluir este Banner ?")) {
		location.href = "act/actBanners.php?acao=Deletar&idcat="+idcat+"&idbanner="+idbanner;
	}
}
//##################################################################################
function popup(url, name, width, height)
{
   var str = "height=" + height + ",innerHeight=" + height;
		str += ",width=" + width + ",innerWidth=" + width;
		str += ",status=yes,scrollbars=yes,resizable=yes";
		  if (window.screen)
		{
				var ah = screen.availHeight - 30;
				var aw = screen.availWidth - 10;
				var xc = (aw - width) / 2;
				var yc = (ah - height) / 2;

				str += ",left=" + xc + ",screenX=" + xc;
				str += ",top=" + yc + ",screenY=" + yc;
		}
		var win = window.open(url, name, str);
		
}

//###################################################################################
function valida_relatorio() {
    var Form, precoStr;
    Form = document.relatorio;
    checado = 0;
    if (Form.codigo_pedido.checked == false &&
        Form.data_pedido.checked == false &&
        Form.nome_pedido.checked == false &&
        Form.cidade_pedido.checked == false &&
        Form.estado_pedido.checked == false &&
        Form.cbTotal.checked == false &&
        Form.pago_pedido.checked == false && Form.atendido_pedido.checked == false) {
        alert("Pesquisa inv\xE1lida !");
        return false;
    }
    if (!Form.ini.value && Form.data_pedido.checked == true) {
        alert("Data inv\xE1lida");
        Form.ini.focus();
        return false;
    }
    if (!Form.fim.value && Form.data_pedido.checked == true) {
        alert("Data inv\xE1lida");
        Form.fim.focus();
        return false;
    }
    if (Form.codigo_pedido.checked == true &&
        Form.idpedido.value.length == 0) {
        alert("N\xFAmero do pedido inv\xE1lido !");
        Form.idpedido.focus();
        return false;
    }
    if (Form.nome_pedido.checked == true && Form.nome.value.length == 0) {
        alert("Nome inv\xE1lido !");
        Form.nome.focus();
        return false;
    }
    if (Form.cbTotal.checked == true && Form.edtTotal.value.length == 0) {
        alert("Total Inv\xE1lido !");
        Form.edtTotal.focus();
        return false;
    } else if (Form.cbTotal.checked == true) {
        precoStr = strReplaceAll(Form.edtTotal.value, ",", ".");
        Form.edtTotal.value = precoStr;
        if (isNaN(precoStr)) {
            alert("O preco deve ser num\xE9rico !");
            Form.edtTotal.focus();
            return false;
        }
    }
    return true;
}

//###################################################################################
function JanelaNova(URLBoleto) {
    window.open(URLBoleto, "NOME", "width=680,height=400,menubar,scrollbars,resizable", "NOME", "width=600,height=400,menubar,scrollbars,resizable");
}

//###################################################################################
function mostraimg(img,src_img) {
 var img = document.getElementById(img);
 var src_img = document.getElementById(src_img);
 if (src_img.value != '') {
 img.style.display='';
 }else {
 img.style.display='none';
 }
}

//###################################################################################
function valida_cor() {
    Form = document.cor;
    if (Form.nome.value.length == 0) {
        alert("O nome da cor \xE9 um campo obrigat\xF3rio !");
        Form.nome.focus();
        return false;
    }
    return true;
}

//###################################################################################
function valida_enviarinfo() {
    Form = document.informativo;
    if (Form.infomodelo.value.length == "") {
        alert("O modelo \xE9 um campo obrigat\xF3rio !");
        Form.infomodelo.focus();
        return false;
    }
    return true;
}

//###################################################################################
function valida_enquete_resp() {
    Form = document.enquete;
    if (Form.resposta.value.length == "") {
        alert("A resposta \xE9 um campo obrigat\xF3rio !");
        Form.resposta.focus();
        return false;
    }
    return true;
}

//###################################################################################
function valida_enquete_perg() {
    Form = document.enquete;
    if (Form.pergunta.value.length == "") {
        alert("A pergunta \xE9 um campo obrigat\xF3rio !");
        Form.pergunta.focus();
        return false;
    }
    return true;
}

//###################################################################################
function VerImagem(campo, img) {
    img.src = campo.value;
}
//###################################################################################
function valida_noticia() {
    Form = document.noticia;
    if (Form.categoria.value == "") {
        alert("A categoria \xE9 um campo obrigat\xF3rio !");
        Form.categoria.focus();
        return false;
    }
    if (Form.titulo.value == "") {
        alert("O título da notícia \xE9 um campo obrigat\xF3rio !"); 
        Form.titulo.focus();       
        return false;
    }          
	return true;
}

//###################################################################################
function valida_opcionais() {
    Form = document.opcionais;
    if (Form.opcional.value == "") {
        alert("O nome do item \xE9 um campo obrigat\xF3rio !");
        Form.opcional.focus();
        return false;
    }       
	return true;
}

//###################################################################################
function valida_links_cat() {
    Form = document.links_cat;
    if (Form.categoria.value == "") {
        alert("O nome do categoria \xE9 um campo obrigat\xF3rio !");
        Form.categoria.focus();
        return false;
    }       
	return true;
}


//###################################################################################
function valida_acessorios_cat() {
    Form = document.acessorios_cat;
    if (Form.categoria.value == "") {
        alert("O nome do categoria \xE9 um campo obrigat\xF3rio !");
        Form.categoria.focus();
        return false;
    }       
	return true;
}

//###################################################################################
function valida_planos() {
    Form = document.planos;
    if (Form.nome.value == "") {
        alert("O nome do plano \xE9 um campo obrigat\xF3rio !");
        Form.nome.focus();
        return false;
    }
    if (Form.anunciante.value == "") {
        alert("O Anunciante \xE9 um campo obrigat\xF3rio !");
        Form.anunciante.focus();
        return false;
    }
    if (Form.dias.value == "") {
        alert("Os dias \xE9 um campo obrigat\xF3rio !");
        Form.dias.focus();
        return false;
    }
    if (Form.veiculos.value == "") {
        alert("Os Veículos \xE9 um campo obrigat\xF3rio !");
        Form.veiculos.focus();
        return false;
    }
    if (Form.fotos.value == "") {
        alert("As Fotos \xE9 um campo obrigat\xF3rio !");
        Form.fotos.focus();
        return false;
    }
    if (Form.destaque.value == "") {
        alert("O Destaque \xE9 um campo obrigat\xF3rio !");
        Form.destaque.focus();
        return false;
    }       
	return true;
}
//###################################################################################
function valida_links() {
    Form = document.links;
    if (Form.idlinkscategoria.value == "") {
        alert("O nome do categoria \xE9 um campo obrigat\xF3rio !");
        Form.idlinkscategoria.focus();
        return false;
    }
    if (Form.titulo.value == "") {
        alert("O Título \xE9 um campo obrigat\xF3rio !");
        Form.titulo.focus();
        return false;
    }
    if (Form.descricao.value == "") {
        alert("A Descrição \xE9 um campo obrigat\xF3rio !");
        Form.descricao.focus();
        return false;
    }
    if (Form.link.value == "") {
        alert("O Link \xE9 um campo obrigat\xF3rio !");
        Form.link.focus();
        return false;
    }       
	return true;
}

//###################################################################################
function valida_noticia_cat() {
    Form = document.noticia_cat;
    if (Form.categoria.value == "") {
        alert("O nome do categoria \xE9 um campo obrigat\xF3rio !");
        Form.categoria.focus();
        return false;
    }       
	return true;
}
//###################################################################################
function valida_produto(acao) {
    Form = document.produto;
    if (Form.nome_produto_pt_BR.value == "") {
        alert("O nome do produto \xE9 um campo obrigat\xF3rio !");        
        return false;
    }
    if (Form.idsubcategoria.value == "") {
        alert("A subcategoria \xE9 um campo obrigat\xF3rio !");
        Form.idsubcategoria.focus();
        return false;
    }
    if (Form.preco_unitario.value.length == 0) {
        alert("O pre\xE7o do produto \xE9 um campo obrigat\xF3rio !");
        Form.preco_unitario.focus();
        return false;
    }
    if (Form.peso_produto.value.length == 0) {
        alert("O peso do produto \xE9 um campo obrigat\xF3rio !");
        Form.peso_produto.focus();
        return false;
    } 
    if (Form.quantidade_produto.value.length == 0) {
        alert("A quantidade do produto \xE9 um campo obrigat\xF3rio !");
        Form.quantidade_produto.focus();
        return false;
    }
    
    if (Form.prazo_produto.value.length == 0) {
        alert("O prazo do produto \xE9 um campo obrigat\xF3rio !");
        Form.prazo_produto.focus();
        return false;
    }
    if (Form.img_produto.value.length != 0) {
        if (Form.img_produto.value.indexOf("http://") >= 0 ||
            Form.img_produto.value.indexOf("https://") >= 0) {
            alert("N\xE3o \xE9 poss\xEDvel o cadastro de URLs para imagem do produto !");
            Form.img_produto.focus();
            return false;
        }
    }
    if (Form.img_produto_adic01.value.length != 0) {
        if (Form.img_produto_adic01.value.indexOf("http://") >= 0 ||
            Form.img_produto_adic01.value.indexOf("https://") >= 0) {
            alert("N\xE3o \xE9 poss\xEDvel o cadastro de URLs para imagem do produto !");
            Form.img_produto_adic01.focus();
            return false;
        }
    }
    if (Form.img_produto_adic02.value.length != 0) {
        if (Form.img_produto_adic02.value.indexOf("http://") >= 0 ||
            Form.img_produto_adic02.value.indexOf("https://") >= 0) {
            alert("N\xE3o \xE9 poss\xEDvel o cadastro de URLs para imagem do produto !");
            Form.img_produto_adic02.focus();
            return false;
        }
    }
    if (Form.img_produto_adic03.value.length != 0) {
        if (Form.img_produto_adic03.value.indexOf("http://") >= 0 ||
            Form.img_produto_adic03.value.indexOf("https://") >= 0) {
            alert("N\xE3o \xE9 poss\xEDvel o cadastro de URLs para imagem do produto !");
            Form.img_produto_adic03.focus();
            return false;
        }
    }
    if (Form.promocao.checked == true) {
        if (Form.desconto.value.length == 0) {
            alert("O porcentual de desconto \xE9 obrigat\xF3rio !");
            Form.desconto.focus();
            return false;
        }
        if (Form.desconto.value >= 101) {
            alert("Informe um porcentual de desconto correto! (at\xE9 100%)");
            Form.desconto.focus();
            return false;
        }
        if (Form.dataInicio.value.length == 0) {
            alert("A data inicial da promo\xE7\xE3o \xE9 obrigat\xF3ria !");
            Form.dataInicio.focus();
            return false;
        }
        if (Form.dataFim.value.length == 0) {
            alert("A data final da promo\xE7\xE3o \xE9 obrigat\xF3ria !");
            Form.dataFim.focus();
            return false;
        }
    }
    return true;
}

//###################################################################################
function valida_veiculo(acao) {
    Form = document.veiculos;   
    if (Form.tipo.value == "") {
        alert("O Tipo \xE9 um campo obrigat\xF3rio !"); 
        Form.tipo.focus();       
        return false;
    }    
    if (Form.modelo.value == "") {
        alert("O Modelo \xE9 um campo obrigat\xF3rio !"); 
        Form.modelo.focus();       
        return false;
    }
    if (Form.cor.value == "") {
        alert("A Cor \xE9 um campo obrigat\xF3rio !"); 
        Form.cor.focus();       
        return false;
    }
    if (Form.combustivel.value == "") {
        alert("O Combustível \xE9 um campo obrigat\xF3rio !"); 
        Form.combustivel.focus();       
        return false;
    }
    if (Form.km.value == "") {
        alert("A Kilometragem \xE9 um campo obrigat\xF3rio !"); 
        Form.km.focus();       
        return false;
    }
    if (Form.ano.value == "") {
        alert("O Ano \xE9 um campo obrigat\xF3rio !"); 
        Form.ano.focus();       
        return false;
    }
    if (Form.valor.value == "") {
        alert("O Valor \xE9 um campo obrigat\xF3rio !"); 
        Form.valor.focus();       
        return false;
    }
    if (Form.status.value == "") {
        alert("O Estado \xE9 um campo obrigat\xF3rio !"); 
        Form.status.focus();       
        return false;
    }
    if (Form.publicado.value == "") {
        alert("O Publicado \xE9 um campo obrigat\xF3rio !"); 
        Form.publicado.focus();       
        return false;
    }
    if (Form.destaque.value == "") {
        alert("O Destaque \xE9 um campo obrigat\xF3rio !"); 
        Form.destaque.focus();       
        return false;
    }
   
}
//###################################################################################
function valida_dropmenu(campo, valor) {
    if (campo.value == "") {
        alert("Escolha uma " + valor + " !");
        campo.focus();
        return false;
    }
    return true;
}

//###################################################################################
function valida_input(campo, valor) {
    if (campo.value == "") {
        alert( valor + " !");
        campo.focus();
        return false;
    }
    return true;
}

//###################################################################################
function alteraiframe(linha, dlinha) {
    var objlinha = document.getElementById(linha);
    objlinha.style.display = "";
    var abaON = "aba_" + linha;
    document.getElementById(abaON).className = "abasON";
    var array_dlinha = dlinha.split(",");
    var part_num = 0;
    var objdlinha;
    while (part_num < array_dlinha.length) {
        if (array_dlinha[part_num] != linha) {
            objdlinha = document.getElementById(array_dlinha[part_num]);
            objdlinha.style.display = "none";
            var abaOFF = "aba_" + array_dlinha[part_num];
            document.getElementById(abaOFF).className = "abas";
        }
        part_num += 1;
    }
}

//###################################################################################
function mostrahelp(linha, img) {
    var linha = document.getElementById(linha);
    if (linha.style.display == "none") {
        linha.style.display = "";
        if (img != null) {
            img.src = "img/ball_glass_redS.gif";
        }
    } else {
        linha.style.display = "none";
        if (img != null) {
            img.src = "img/duvida.gif";
        }
    }
}

//###################################################################################
function mostraiframe(linha) {
    var linha = document.getElementById(linha);
    if (linha.style.display == "none") {
        linha.style.display = "";
    } else {
        linha.style.display = "none";
    }
}

//###################################################################################
function perfil_usuarioadm(nome) {
    var fr = document.usuario;
    var ativo = false;
    if (fr.ADMGeral.checked == true) {
        ativo = true;
    }
    for (a = 0; a < fr.elements.length; a++) {
        if (fr.elements[a].name == nome) {
            if (ativo == true) {
                fr.elements[a].checked = true;
                fr.elements[a].disabled = true;               
            } else {
                fr.elements[a].checked = false;
                fr.elements[a].disabled = false;               
            }
        }
    }
}

//###################################################################################
function ativa_trocasenha() {
    Form = document.altusuario;
    if (Form.ativasenha.checked == true) {
        Form.senha_atual.disabled = false;
        Form.nova_senha.disabled = false;
        Form.confirma_nova_senha.disabled = false;
        document.getElementById("linhasenha").disabled = false;
    } else {
        Form.senha_atual.disabled = true;
        Form.nova_senha.disabled = true;
        Form.confirma_nova_senha.disabled = true;
        document.getElementById("linhasenha").disabled = true;
    }
}

//###################################################################################
function ativa_ativaalt() {
    Form = document.informativo;
    if (Form.troca.checked == true) {  
    	Form.email.disabled = false;      
        document.getElementById("emailid").disabled = false;
    } else {
       	Form.email.disabled = true;
        document.getElementById("emailid").disabled = true;
    }
}


//###################################################################################
function ativa_gerasenha() {
    Form = document.usuario;
    if (Form.ativasenha.checked == true) {
        Form.senha.disabled = false;        
        document.getElementById("linhasenha").disabled = true;
    } else {
        Form.senha.disabled = true;        
        document.getElementById("linhasenha").disabled = false;
    }
}
//###################################################################################
function MM_jumpMenu(targ, selObj, restore) {
    eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
    if (restore) {
        selObj.selectedIndex = 0;
    }
}

//###################################################################################
var isNN = (navigator.appName.indexOf("Netscape")!=-1);

function autoTab(input, len, e) {
    var keyCode = isNN ? e.which : e.keyCode;
    var filter = isNN ? [0, 8, 9] : [0, 8, 9, 16, 17, 18, 37, 38, 39, 40, 46];
    if (input.value.length >= len && !containsElement(filter, keyCode)) {
        input.value = input.value.slice(0, len);
        input.form[(getIndex(input) + 1) % input.form.length].focus();
    }

    function containsElement(arr, ele) {
        var found = false, index = 0;
        while (!found && index < arr.length) {
            if (arr[index] == ele) {
                found = true;
            } else {
                index++;
            }
        }
        return found;
    }


    function getIndex(input) {
        var index = -1, i = 0, found = false;
        while (i < input.form.length && index == -1) {
            if (input.form[i] == input) {
                index = i;
            } else {
                i++;
            }
        }
        return index;
    }

    return true;
}

//###################################################################################
function valida_usuario() {
    Form = document.usuario;
    if (Form.nome.value.length == 0) {
        alert("O nome do usu\xE1rio \xE9 um campo obrigat\xF3rio !");
        Form.nome.focus();
        return false;
    }
   	if (Form.usuario.value.length == 0) {
        alert("O usu\xE1rio \xE9 um campo obrigat\xF3rio !");
        Form.usuario.focus();
        return false;
    }
    if (Form.email.value.length == 0) {
        alert("O e-mail do usu\xE1rio \xE9 um campo obrigat\xF3rio !");
        Form.email.focus();
        return false;
    }
    if (Form.email.value.indexOf("@", 0) == -1 ||
        Form.email.value.indexOf(".", 0) == -1) {
        alert("Por favor, preencha corretamente o campo e-mail.");
        Form.email.focus();
        return false;
    }
    
    padrao = /^[a-zA-Z0-9]+$/;
    campoValue = Form.usuario.value;
    var campoVerify = campoValue.indexOf(" ");
    if (campoVerify >= 0) {
        var campoArray = campoValue.split(" ");
        for (part_num = 0; part_num < campoArray.length; part_num++) {
            OK = padrao.exec(campoArray[part_num]);
            if (!OK) {
                window.alert("Por favor, preencha corretamente o nome do Administrador. N\xE3o s\xE3o aceito caracteres especiais.");
                return false;
                break;
            }
        }
    } else {
        OK = padrao.exec(campoValue);
        if (!OK) {
            window.alert("Por favor, preencha corretamente o nome do Administrador. N\xE3o s\xE3o aceito caracteres especiais.");
            return false;
        }
    }
}

//###################################################################################
function valida_altusuario() {
    Form = document.altusuario;
    if (Form.nome.value.length == 0) {
        alert("O nome do usu\xE1rio \xE9 um campo obrigat\xF3rio !");
        Form.nome.focus();
        return false;
    }    
    if (Form.email.value.length == 0) {
        alert("O e-mail do usu\xE1rio \xE9 um campo obrigat\xF3rio !");
        Form.email.focus();
        return false;
    }
    if (Form.email.value.indexOf("@", 0) == -1 ||
        Form.email.value.indexOf(".", 0) == -1) {
        alert("Por favor, preencha corretamente o campo e-mail.");
        Form.email.focus();
        return false;
    }
    if(Form.ativasenha.checked == true) {
    	if (Form.senha_atual.value.length == 0) {
	        alert("A senha atual \xE9 um campo obrigat\xF3rio !");
	        Form.senha_atual.focus();
	        return false;
	    }
	    if (Form.nova_senha.value.length == 0) {
	        alert("A nova senha \xE9 um campo obrigat\xF3rio !");
	        Form.nova_senha.focus();
	        return false;
	    }
	    if (Form.confirma_nova_senha.value.length == 0) {
	        alert("Confirma nova senha \xE9 um campo obrigat\xF3rio !");
	        Form.confirma_nova_senha.focus();
	        return false;
	    }
    }
    
}

//###################################################################################
function valida_contato() {
    Form = document.contato;
    if (Form.nome.value.length == 0) {
        alert("O seu nome \xE9 obrigat\xF3rio !");
        Form.nome.focus();
        return false;
    }
    if (Form.email.value.length == 0) {
        alert("O e-mail \xE9 um campo obrigat\xF3rio !");
        Form.email.focus();
        return false;
    }
    if (Form.email.value.indexOf("@", 0) == -1 ||
        Form.email.value.indexOf(".", 0) == -1) {
        alert("Por favor, preencha corretamente o campo e-mail.");
        Form.email.focus();
        return false;
    }
    if (Form.mensagem.value.length == 0) {
        alert("A mensagem \xE9 obrigat\xF3ria !");
        Form.mensagem.focus();
        return false;
    }
}

//###################################################################################
function confirma_apagar() {
    var resposta;
    resposta = confirm("Tem certeza que deseja apagar ?");
    if (resposta == true) {
        return true;
    } else {
        return false;
    }
}

//###################################################################################
function confirma_autorizacao() {
    var resposta;
    resposta = confirm("Tem certeza que deseja enviar o pedido de autorização ?");
    if (resposta == true) {
        return true;
    } else {
        return false;
    }
}

//###################################################################################
function valida_login() {
    Form = document.admin;
    if (Form.usuario.value.length == 0) {
        alert("Por favor, informe o usu\xE1rio !");
        Form.usuario.focus();
        return false;
    }
    if (Form.acao.checked == false) {
        if (Form.senha.value.length == 0) {
            alert("Por favor, informe a senha !");
            Form.senha.focus();
            return false;
        }
    }
    return true;
}

/*
<input type="text" tipo="numerico"> aqui so da para digitar numeros<br>

<input type="text" tipo="numerico" negativo=true> aqui so da para digitar numeros e no caso de precionar "-" umsinal de negativo vai aparecer<br>

<input type="text" tipo="decimal" negativo=true casasdecimais=2><br>

<input type="text" tipo="numerico" mascara="##/##/####"> data<br>

<input type="text" tipo="numerico" mascara="###.###.###-##"> cpf<br>
*/

Mascaras = {
IsIE: navigator.appName.toLowerCase().indexOf('microsoft')!=-1,
AZ: /[A-Z]/i,
Acentos: /[À-ÿ]/i,
Num: /[0-9]/,
carregar: function(parte){
 var Tags = ['input','textarea'];
 if (typeof parte == "undefined") parte = document;
 for(var z=0;z<Tags.length;z++){
  Inputs=parte.getElementsByTagName(Tags[z]);
  for(var i=0;i<Inputs.length;i++)
   if(('button,image,hidden,submit,reset').indexOf(Inputs[i].type.toLowerCase())==-1)
    this.aplicar(Inputs[i]);
 }
},
aplicar: function(campo){
 tipo = campo.getAttribute('tipo');
 if (!tipo || campo.type == "select-one") return;
 orientacao = campo.getAttribute('orientacao');
 mascara = campo.getAttribute('mascara');
 if (tipo.toLowerCase() == "decimal"){
  orientacao = "esquerda";
  casasdecimais = campo.getAttribute('casasdecimais');
  tamanho = campo.getAttribute('maxLength');
  if (!tamanho || tamanho > 50)
   tamanho = 10;
  if (!casasdecimais)
   casasdecimais = 2;
  campo.setAttribute("mascara", this.geraMascaraDecimal(tamanho, casasdecimais));
  campo.setAttribute("tipo", "numerico");
  campo.setAttribute("orientacao", orientacao);
 }
 if (orientacao && orientacao.toLowerCase() == "esquerda") campo.style.textAlign = "right";
 if (mascara) campo.setAttribute("maxLength", mascara.length);
 if (tipo){
  campo.onkeypress = function(e){ return Mascaras.onkeypress(e?e:event); };
  campo.onkeyup = function(e){ Mascaras.onkeyup(e?e:event, campo) };
 }
 campo.setAttribute("snegativo", ((campo.value).substr(0,1) == "-" ? "s" : "n"));
},
onkeypress: function(e){
 KeyCode = this.IsIE ? event.keyCode : e.which;
 campo =  this.IsIE ? event.srcElement : e.target;
 readonly = campo.getAttribute('readonly');
 if (readonly) return;
 maxlength = campo.getAttribute('maxlength');
 pt = campo.getAttribute('pt');
 selecao = this.selecao(campo);
 if (selecao.length > 0 && KeyCode != 0){
  campo.value = ""; return true;
 }
 if (KeyCode == 0) return true;
 Char = String.fromCharCode(KeyCode);
 valor = campo.value;
 mascara = campo.getAttribute('mascara');
 if (KeyCode != 8){
  tipo = campo.getAttribute('tipo').toLowerCase();
  negativo = campo.getAttribute('negativo');
  if(negativo && KeyCode == 45){
   snegativo = campo.getAttribute('snegativo');
   snegativo = (snegativo == "s" ? "n" : "s");
   campo.setAttribute("snegativo", snegativo);
  }else{
   valor += Char
   if (tipo == "numerico" && Char.search(this.Num) == -1) return false;
   if (KeyCode != 32 && tipo == "caracter" && Char.search(this.AZ) == -1 && Char.search(this.Acentos) == -1) return false;
  }
 }
 if (mascara){
  this.aplicarMascara(campo, valor);
  return false;
 }
 return true;
},
onkeyup: function(e, campo){
 KeyCode = this.IsIE ? event.keyCode : e.which;
 if (KeyCode != 9 && KeyCode != 16 && KeyCode != 109){
  valor = campo.value;
  if (KeyCode == 8 && !this.IsIE) valor = valor.substr(0,valor.length-1);
  this.aplicarMascara(campo, valor);
 }
},
aplicarMascara: function(campo, valor){
 mascara = campo.getAttribute('mascara');
 if (!mascara) return;
 negativo = campo.getAttribute('negativo');
 snegativo = campo.getAttribute('snegativo');
 if (negativo && valor.substr(0,1) == "-")
  valor = valor.substr(1,valor.length-1);
 orientacao = campo.getAttribute('orientacao');
 var i = 0;
 for(i=0;i<mascara.length;i++){
  caracter = mascara.substr(i,1);
  if (caracter != "#") valor = valor.replace(caracter, "");
 }
 retorno = "";
 if (orientacao != "esquerda"){
  contador = 0;
  for(i=0;i<mascara.length;i++){
   caracter = mascara.substr(i,1);
   if (caracter == "#"){
    retorno += valor.substr(contador,1);
    contador++;
   }else
    retorno += caracter;
   if(contador >= valor.length) break;
  }
 }else{
  contador = valor.length-1;
  for(i=mascara.length-1;i>=0;i--){
   if(contador < 0) break;
   caracter = mascara.substr(i,1);
   if (caracter == "#"){
    retorno = valor.substr(contador,1) + retorno;
    contador--;
   }else
    retorno = caracter + retorno;
  }
 }
 if (negativo && snegativo == "s")
  retorno = "-" + retorno;
 campo.value = retorno;
},
geraMascaraDecimal: function(tam, decimais){
 var retorno = ""; var contador = 0; var i = 0;
 decimais = parseInt(decimais);
 for (i=0;i<(tam-(decimais+1));i++){
  retorno = "#" + retorno;
  contador++;
  if (contador == 3){
   retorno = "." + retorno;
   contador=0;
  }
 }
 retorno = retorno + ",";
 for (i=0;i<decimais;i++) retorno += "#";
 return retorno;
},
selecao: function(campo){
 if (this.IsIE)
  return document.selection.createRange().text;
 else
  return (campo.value).substr(campo.selectionStart, (campo.selectionEnd - campo.selectionStart));
},
formataValor: function (valor, decimais){
 valor = valor.split('.');
 if (valor.length == 1) valor[1] = "";
 for(var i=valor[1].length;i<decimais;i++)
  valor[1] += "0";
 valor[1] = valor[1].substr(0,2);
 return (valor[0] + "." + valor[1]);
}
};

function tipoplano(plano) {
	if(plano == 1){
 		document.getElementById("avancado").style.display = "none";
 		document.getElementById("gold").style.display = "none";
	}
	if(plano == 2){
 		document.getElementById("avancado").style.display = "";
 		document.getElementById("gold").style.display = "none";
	}
	if(plano == 3){
 		document.getElementById("avancado").style.display = "";
 		document.getElementById("gold").style.display = "";
	}
}

function dest(opcao) {
	if(opcao == 1){
 		document.getElementById("pagina").style.display = "";
	}
	if(opcao == 2){
 		document.getElementById("pagina").style.display = "none";
	}	
}