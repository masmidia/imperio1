function carrega_pagina(arquivo,limite,complemento,total,divresposta){
  	beforeSend:$("#status").fadeIn("fast");//mostra a imagem de carregando
 
	$.post(arquivo,{limite: limite, complemento: complemento}, function(resposta){
			complete:$("#status").fadeOut("fast");
			
			$(divresposta).fadeIn("slow").append(resposta);
			$(".btn_mais_posts").fadeIn("fast");//mostra a imagem de carregando
			
			
			
			var total = parseInt($("#total").val());
			
			//alert(limite+" é menor que "+total);
			
			
			if(limite < total)
			{
				$("#btn_paginacao").attr("rel",parseInt(limite) + 1);
			}
			else
			{
				$("#btn_paginacao").fadeOut("fast");
			}
			
	});
   
}