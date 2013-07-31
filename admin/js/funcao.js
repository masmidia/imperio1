// JavaScript Document
var ajax;
var dadosUsuario;

function requisicaoHTTP(tipo,url,assinc,campo)
{
	if (window.XMLHttpRequest)
	{
		ajax = new XMLHttpRequest();	
	}
	else if (window.ActiveXObject)
	{
		ajax = new ActiveXObject("Msxml2.XMLHTTP");
		if (!ajax)
		{
			ajax = new ActiveXObject("Microsoft.XMLHTTP");	
		}
	}
	if (ajax)
	{
		iniciaRequisicao(tipo,url,assinc,campo);
	}
	else
		alert("Seu navegador não possui suporte");
	
}
function iniciaRequisicao(tipo,url,bool,campo)
{
	
	ajax.open(tipo,url,bool);
	var camada = document.getElementById(campo);
	limpa(camada);	
	ajax.onreadystatechange = function()
	{
		
		if (ajax.readyState == 4)
		{
			if (ajax.status == 200)
			{
				var info = ajax.responseText;
				var arrayOpcoes = eval(info);
				var listaNova = document.getElementById(campo);
				listaNova.setAttribute("name",campo);
				criaOpcoes(listaNova,arrayOpcoes);				
			}
			else
			{
				alert("Problema na comnicação com o objeto");
			}
		}
	  }
	
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
	//ajax.overrideMimeType("text/XML");
	ajax.send(dadosUsuario);
}
function enviaDados(url)
{
	criaQueryString();
	requisicaoHTTP("POST",url,true);
}
function criaQueryString()
{
	dadosUsuario = "";
	var frm = document.forms[0];
	var numElementos = frm.elements.lenght;
	for(var i = 0; i < numElementos; i++)
	{
		if(i < numElementos - 1)
		{
			dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value)+"&";
		}
		else
		{
			dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value);
		}
	}
}

function mostraModelos(valor,campo)
{
	if (valor == null)
	{
		return;	
	}
	//var escolhida = idselect.options[idselect.selectedIndex].value;
	var escolhida = valor;
	var url = campo+".php?marca="+encodeURIComponent(escolhida);
	requisicaoHTTP("GET",url,true,campo);
		
}

function criaOpcoes(lista,opcoes)
{
	lista.options.length = 0;
	if (opcoes == null || opcoes.length == 0 )
	{
		return ;
	}
	var op = null;
	for (var i = 0 ; i < opcoes.length ; i++)
	{
		
		op = document.createElement("option");
		var op2 = opcoes[i].split(",");
		op.setAttribute("value",op2[0]);
		op.appendChild(document.createTextNode(op2[1]));
		lista.appendChild(op);
	}
}
function limpa(elemento)
{
	elemento.options.length = 0;
	op = document.createElement("option");
	op.appendChild(document.createTextNode('Carregando....'));
	elemento.appendChild(op);

}