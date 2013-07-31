<?php
require_once("config.php");




function __autoload($class) 
{
	$diretorio = $_SERVER['DOCUMENT_ROOT'] . PASTA_PROJETO . "/class";
	
	
	if(!__findClass($class, $diretorio)) 
	{
		echo "<h1>Class Not Found: $class !!</h1>";
		exit(0);
	}
}





function __findClass($class,$dir) 
{
	$ponteiro = opendir($dir);
	
	
	while($file = readdir($ponteiro)) {
		
		$file_path = $dir."/".$file ;
		
		if($file == "." or $file == "..") 
		{
			continue ;
		}
		elseif(is_dir($file_path)) 
		{
			if(__findClass($class,$file_path)) 
			{
				return true ;
				
			}
		}
		elseif($file == $class.".class.php")
		{
			require_once($file_path);
			return true ;
		}
		elseif($file == $class.".php")
		{
			require_once($file_path);
			return true ;
		}
		elseif($file == $class.".php")
		{
			require_once($file_path);
			return true ;
		}
		
	}
	return false ;
}
?>