<?php
require_once("../class/Include.class.php");
require_once("login/Login_Model.php");
$obj_login = new Login_Model();



if(isset($_POST['action']) and $_POST['action'] == "recuperar")
{
	if($obj_login->recupera_senha($_POST['email']) == true)
	{
		Util::script_msg("Sua nova senha foi enviado para o e-mail cadastrado."); // se nao retornou mostra isso
		Util::script_location("./");
		//header("location: index.php");	
	}
	else
	{
		Util::script_msg("Não foi possível recuperar sua senha. ERRO: E-mail não encontrado.");
	}
	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
<title>Admin - <?php echo $_SERVER['SERVER_NAME'] ?></title>
</head>

<body class="bg-login">
<div id="container-login">
	<form action="" method="post" name="form">
    	
        

        

        
        <div id="container-login-email">
        	
            <h1>Recuperar senha</h1>
			<p>Informe o dado solicitado e clique em enviar para receber uma nova senha.</p>
        
        	<label for="email">E-mail: </label>
        	<input type="text" name="email" id="email" />
        </div>
        
     
        <div id="container-login-btn">
        
        	
        	<input type="image" name="btn" id="btn" src="imgs/btn-enviar.png" />
    	</div>  
        
   
        
        
        <input type="hidden" name="action" id="action" value="recuperar" />
          
    </form>

</div>
</body>
</html>