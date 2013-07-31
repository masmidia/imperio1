<?php
require_once("../class/Include.class.php");
require_once("login/Login_Model.php");
$obj_login = new Login_Model();

@session_start();
if(isset($_SESSION['login']))
{
	header("location: inicial.php");	
}


if(isset($_POST['email']))
{
	if($obj_login->efetuar_login($_POST[email], $_POST[senha]) == true)
	{
		header("location: inicial.php");	
	}
	else
	{
		Util::script_msg("Usuário ou senha incorreto.");
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
        	<label for="email">E-mail: </label>
        	<input type="text" name="email" id="email" />
        </div>
        
        <div id="container-login-senha">
        	<label for="senha">Senha: </label>
        	<input type="password" name="senha" id="senha" />
        </div>
        
        <div id="container-login-btn">
        
        	<a href="recupera-senha.php" style="margin: 310px 0px 0px 308px; position:absolute;">esqueci minha senha &raquo;</a>
            
        	<input type="image" name="btn" id="btn" src="imgs/btn-entrar.png" />
    	</div>  
        
   
        
        
        <input type="hidden" name="action" value="efetuar_login" />
          
    </form>

</div>
</body>
</html>