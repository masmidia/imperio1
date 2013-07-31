var xmlhttp = false;
var dadosUsuario;
try 
{
	xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	
}catch(e)
 {
 	try
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		
	}catch(E)
	{
		xmlhttp = false;
	} 
 }
if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
{
	xmlhttp = new XMLHttpRequest();
	
}
function criaQueryString(form)
{
	dadosUsuario = "";
	var frm = document.getElementById(form);
	var numElementos = frm.elements.length;
	for(var i = 0; i < numElementos; i++)
	{
		if(i < numElementos - 1)
		{
			if (frm.elements[i].type == "radio" && frm.elements[i].checked)
				dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value)+"&";
			if (frm.elements[i].type != "radio")		
				dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value)+"&";
		}
		else
		{
			if (frm.elements[i].type == "radio" && frm.elements[i].checked)
				dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value);
			if (frm.elements[i].type != "radio")		
				dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value);
			
		}
		
	}
}
function enviaDados(url,form,div,div2,boll)
{
	criaQueryString(form);	
	iniciaRequisicao("POST",url,true,div,div2,boll);
}
function iniciaRequisicao(tipo,url,bool,div,div2,boll)
{
	var resposta = document.getElementById(div);
	var div_some = document.getElementById(div2);
	var obboll = document.getElementById(boll);
	div_some.className = "editar_oculto_imgs";
	obboll.className = "false";
	
	resposta.innerHTML = "<div align = 'center' style='height:50px;'><br> Carregando...<br><img src='../img/loading.gif' width='16' height='16' />";
	xmlhttp.open(tipo,url,bool);
	xmlhttp.onreadystatechange = function()
	{	
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			
				resposta.style.display = "block";
				resposta.innerHTML = xmlhttp.responseText;			
				
		}
	}
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
	xmlhttp.send(dadosUsuario);
	/*xmlhttp.send(null);
	xmlhttp.onreadystatechange = trataResposta;
	//xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
	//ajax.overrideMimeType("text/XML");*/
	
}
function mostra_oculta_editar(div,div2,boll)
{
	var obj = document.getElementById(div);
	var obj2 = document.getElementById(div2);
	var verifica = document.getElementById(boll);
	if (verifica.className == "true")
	{
		obj.className = "editar_aberto_imgs";
		verifica.className = "false";
		obj2.className = "editar_oculto_imgs";		
	}
	else
	{
		obj.className = "editar_oculto_imgs";
		verifica.className = "true";
		obj2.className = "editar_aberto_imgs";		
	}
	
}