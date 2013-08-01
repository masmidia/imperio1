<?php
require_once("./class/Include.class.php"); 
$obj_site = new Site(); 


#	==============================================================	#
#	TITLE, DESCRIPTION, KEYWORDS	#
#	==============================================================	#
$title = "";
$description = "";
$keywords = "";
 



?>
<!doctype html>
<html>
<head>
<?php require_once('./includes/head.php'); ?>



<!--	====================================================================================================	 -->	
<!--	SLIDER	 -->
<!--	====================================================================================================	 -->
<script type="text/javascript">
$(function() {
    $('#banner_slider').cycle({
        fx:     'fade',
        speed:  1000,
        timeout: 3000,
        pager:  '#nav',
		slideExpr: 'img'
    });
});
</script>


</head>

<body>



<div class="container">

 
	<div id="menu_logo">
    	
        <div id="logo">
        	
            <a href="<?php echo Util::caminho_projeto() ?>" title="Home">
            	<img src="<?php echo Util::caminho_projeto() ?>/imgs/logo.png" alt="Home">
            </a>
            
        </div>
        
        
        <div id="menu" class="helvetica_700">
        	
            <ul>
            	<li class="select">
                	<a href="<?php echo Util::caminho_projeto() ?>" title="HOME">
                    	HOME
                    </a>
                </li>
                <li>
                	<a href="<?php echo Util::caminho_projeto() ?>/a-empresa" title="A EMPRESA">
                    	A EMPRESA
                    </a>
                </li>
                <li>
                	<a href="<?php echo Util::caminho_projeto() ?>/perfil" title="PERFIL">
                    	PERFIL
                    </a>
                </li>
                <li>
                	<a href="<?php echo Util::caminho_projeto() ?>/produtos" title="PRODUTOS">
                    	PRODUTOS
                    </a>
                </li>
                <li>
                	<a href="<?php echo Util::caminho_projeto() ?>/servicos" title="SERVIÇOS">
                    	SERVIÇOS
                    </a>
                </li>
                <li>
                	<a href="<?php echo Util::caminho_projeto() ?>/dicas" title="DICAS">
                    	DICAS
                    </a>
                </li>
                <li>
                	<a href="<?php echo Util::caminho_projeto() ?>/fale-conosco" title="FALE CONOSCO">
                    	FALE CONOSCO
                    </a>
                </li>
            </ul>
            
            
        </div>
    
    
    
    	<div id="topo_telefone">
	
            <h1> (61) 3597-5547 / 3382-1497 / 3397-4281</h1>
        
        </div>
        
    </div>


	
    <div id="banner">
    
    	<div id="banner_slider">
            	
            <img src="imgs/banners_1.jpg" alt="">
            <img src="imgs/banners_2.jpg" alt="">
            <img src="imgs/banners_3.jpg" alt="">
             
        </div>
        
        <div id="nav"></div>
    
    </div>
    
    
   
   <div class="title_home">
   		
        <h1 class="helvetica_700">PRODUTOS EM DESTAQUE</h1>
    
   </div>
   
   
   
   <div class="lista_produtos_home">
   	
    	<ul class="lista_produtos">
        	
            <li>
                <a href="#" title="">
                
                    <div class="produtos_image">
                        
                        <span class="produtos_image_sombra"></span>
                    
                        <img src="imgs/exemplo_produto.jpg" alt="" >
                        
                    </div>
                    
                    <h1>FURADEIRA DE IMPACTO</h1>		
                       
                </a>
            </li>
            <li>
                <a href="#" title="">
                
                    <div class="produtos_image">
                        
                        <span class="produtos_image_sombra"></span>
                    
                        <img src="imgs/exemplo_produto.jpg" alt="" >
                        
                    </div>
                    
                    <h1>CONTADORES PARA MONOBRA DE CAPACITORES</h1>		
                       
                </a>
            </li>
            <li>
                <a href="#" title="">
                
                    <div class="produtos_image">
                        
                        <span class="produtos_image_sombra"></span>
                    
                        <img src="imgs/exemplo_produto.jpg" alt="" >
                        
                    </div>
                    
                    <h1>FURADEIRA DE IMPACTO</h1>		
                       
                </a>
            </li>
            <li>
                <a href="#" title="">
                
                    <div class="produtos_image">
                        
                        <span class="produtos_image_sombra"></span>
                    
                        <img src="imgs/exemplo_produto.jpg" alt="" >
                        
                    </div>
                    
                    <h1>CONTADORES PARA MONOBRA DE CAPACITORES</h1>		
                       
                </a>
            </li>
            <li>
                <a href="#" title="">
                
                    <div class="produtos_image">
                        
                        <span class="produtos_image_sombra"></span>
                    
                        <img src="imgs/exemplo_produto.jpg" alt="" >
                        
                    </div>
                    
                    <h1>FURADEIRA DE IMPACTO</h1>		
                       
                </a>
            </li>
            <li>
                <a href="#" title="">
                
                    <div class="produtos_image">
                        
                        <span class="produtos_image_sombra"></span>
                    
                        <img src="imgs/exemplo_produto.jpg" alt="" >
                        
                    </div>
                    
                    <h1>CONTADORES PARA MONOBRA DE CAPACITORES</h1>		
                       
                </a>
            </li>
            <li>
                <a href="#" title="">
                
                    <div class="produtos_image">
                        
                        <span class="produtos_image_sombra"></span>
                    
                        <img src="imgs/exemplo_produto.jpg" alt="" >
                        
                    </div>
                    
                    <h1>FURADEIRA DE IMPACTO</h1>		
                       
                </a>
            </li>
            <li>
                <a href="#" title="">
                
                    <div class="produtos_image">
                        
                        <span class="produtos_image_sombra"></span>
                    
                        <img src="imgs/exemplo_produto.jpg" alt="" >
                        
                    </div>
                    
                    <h1>CONTADORES PARA MONOBRA DE CAPACITORES</h1>		
                       
                </a>
            </li>
            
        </ul>
    
   </div>
   
   
   <div class="lista_empresa_servicos_dicas">
   		
        <ul>
        	
            <li>
            	<div class="title_home">
                    <h1 class="helvetica_700">A EMPRESA</h1>
               </div>
              
               <img src="imgs/img_empresa.jpg" alt="A Empresa" class="img" >
               	
               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
               
               <div class="btn_mais"> 
                   <a href="#" title="Saiba Mais" class="botao">
                        SAIBA MAIS
                   </a> 
               </div>
                
            </li>
            
            <li>
            	<div class="title_home">
                    <h1 class="helvetica_700">SERVIÇOS</h1>
               </div>
              
               <img src="imgs/img_servicos.jpg" alt="Serviços" class="img" >
               	
               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                
               <div class="btn_mais"> 
                   <a href="#" title="Saiba Mais" class="botao">
                        SAIBA MAIS
                   </a> 
               </div>
                
            </li>
            
            <li>
            	<div class="title_home">
                    <h1 class="helvetica_700">DICAS</h1>
               </div>
              	
               <div class="lista_dicas_home">
               		<div>
               			<a href="#" title="">
                             <img src="imgs/exemplo_dicas.jpg" alt="" class="lista_dicas_home_img">
                            <h1>Lorem Ipsum is simply dummy text the printing an</h1>
                    	</a>
                    </div>
                    <div>
               			<a href="#" title="">
                             <img src="imgs/exemplo_dicas.jpg" alt="" class="lista_dicas_home_img">
                            <h1>Lorem Ipsum is simply dummy text the printing an</h1>
                    	</a>
                    </div>
                    <div>
               			<a href="#" title="">
                             <img src="imgs/exemplo_dicas.jpg" alt="" class="lista_dicas_home_img">
                            <h1>Lorem Ipsum is simply dummy text the printing an</h1>
                    	</a>
                    </div>
                    <div>
               			<a href="#" title="">
                             <img src="imgs/exemplo_dicas.jpg" alt="" class="lista_dicas_home_img">
                            <h1>Lorem Ipsum is simply dummy text the printing an</h1>
                    	</a>
                    </div>
               </div>	
                
            </li>
            
            
            
            
        </ul>
   
   </div>
   
   
    

</div>






<div id="rodape">

	<div class="container">
    	
    	<ul id="rodape_menu">
        	<li>
                <a href="<?php echo Util::caminho_projeto() ?>" title="HOME">
                    HOME
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo Util::caminho_projeto() ?>/a-empresa" title="A EMPRESA">
                    A EMPRESA
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo Util::caminho_projeto() ?>/perfil" title="PERFIL">
                    PERFIL
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo Util::caminho_projeto() ?>/produtos" title="PRODUTOS">
                    PRODUTOS
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo Util::caminho_projeto() ?>/servicos" title="SERVIÇOS">
                    SERVIÇOS
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo Util::caminho_projeto() ?>/dicas" title="DICAS">
                    DICAS
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="<?php echo Util::caminho_projeto() ?>/fale-conosco" title="FALE CONOSCO">
                    FALE CONOSCO
                </a>
            </li>
        </ul>
        
        
        <div id="rodape_menu_endereco">
        	<p>Rua 09 N° 848, St. Oeste - Goiânia/GO</p>
        </div>
        
        <div id="rodape_menu_telefone">
        	<p>(62) 3931-9400  </p>
        </div>
        
        
        <div id="rodape_menu_homeweb">
        	
            <a href="http://www.homewebbrasil.com.br" title="HomeWebBrasil" target="_blank">
            	<img src="<?php echo Util::caminho_projeto() ?>/imgs/logo_home_web.jpg" alt="HomeWebBrasil">
            </a>
            
        </div>
        
    </div>
    
    
  	<div id="rodape_direitos">
    	<h2>TODOS OS DIREITOS RESERVADOS</h2>
    </div>  
	
</div>



</body>
</html>