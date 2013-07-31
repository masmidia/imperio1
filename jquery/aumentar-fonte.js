var tagAlvo = new Array('p'); //pega todas as tags p//
	 
	// Especificando os possíveis tamanhos de fontes, poderia ser: x-small, small...
	var tamanhos = new Array('15px','16px', '17px', '18px','19px','20px','21px','22px','23px','24px','25px','26px');
	var tamanhoInicial = 2;
	function mudar_tamanho_fonte( idAlvo,acao ){
	  if (!document.getElementById) return
	  var selecionados = null,tamanho = tamanhoInicial,i,j,tagsAlvo;
	  tamanho += acao;
	  if ( tamanho < 0 ) tamanho = 0;
	  if ( tamanho > 10 ) tamanho = 10;
	  tamanhoInicial = tamanho;
	  if ( !( selecionados = document.getElementById( idAlvo ) ) ) selecionados = document.getElementsByTagName( idAlvo )[ 0 ];
	  
	  selecionados.style.fontSize = tamanhos[ tamanho ];
	  
	  for ( i = 0; i < tagAlvo.length; i++ ){
		tagsAlvo = selecionados.getElementsByTagName( tagAlvo[ i ] );
		for ( j = 0; j < tagsAlvo.length; j++ ) tagsAlvo[ j ].style.fontSize = tamanhos[ tamanho ];
	  }
	}