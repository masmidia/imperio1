function mainmenu()
{
	$("#respostas").css({display: "none"}); // Opera Fix
	$("#subrepostas").hover(function(){
			
			$('#respostas').css({
				visibility: "visible",display: "none"}).fadeIn(300);
				
			},function(){
				$('#respostas').css({visibility: "hidden"
			});
	});
	
	$(" .menu ul li ul ").css({display: "none"}); // Opera Fix
	$(" .menu li").hover(function(){
			$(this).find('ul').css({visibility: "visible",display: "none"}).fadeIn(300);
			},function(){
			$(this).find('ul').css({visibility: "hidden"});
	});
}

 
$(document).ready(function(){					
	mainmenu();
 
	
		$("#submenucirurgias").hover(function(){
			$("#cirurgias").addClass('menu-cirurgias-select');
			},function(){
				$("#cirurgias").removeClass();
				$("#cirurgias").addClass('menu-cirurgias');
		} );

		
});























