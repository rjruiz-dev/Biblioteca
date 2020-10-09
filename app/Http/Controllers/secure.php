<?
$host = 'http://'.$_SERVER['HTTP_HOST'];
$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$valor = explode("?","$enlace_actual"); 
if($valor[0] == "$host/modificaru.php")
{
	//echo "prueba prueba";
	session_cache_limiter('nocache');
}
else if($valor[0] == "$host/alta.php")
{
	session_cache_limiter('nocache');
}
else if($valor[0] == "$host/mostrar2.php")
{
	session_cache_limiter('nocache');
}
else if($valor[0] == "$host/prueba.php")
{
	session_cache_limiter('nocache');
}
else if($valor[0] == $host."/gestion-main.php")
{
	session_cache_limiter('nocache');
}
else if($valor[0] == $host."/configuracion.php")
{
	session_cache_limiter('nocache');
}
else if($valor[0] == $host."/estadisticas.php")
{
	session_cache_limiter('nocache');
}
else if($valor[0] == $host."/busca2.php")
{
	session_cache_limiter('nocache');
}

else
{
	//echo "gatooo";
	session_cache_limiter('public');
}


ini_set("session.use_only_cookies","1"); 
ini_set("session.use_trans_sid","0"); 


session_start(); 



session_set_cookie_params(0, "/", $_SERVER["HTTP_HOST"], 0); 


$passgestion 		= $_SESSION['passgestion'];
$usergestion 		= $_SESSION['usergestion'];




//$admin			= $_REQUEST['admin'];
//$inicio			= $_REQUEST['inicio'];

/*session_start();
 
 echo $_SESSION['username'];
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  die("location: login.php");
  exit;
}*/


if (!$admin){


if (! isset($_SESSION['loggedin_gestion']))
{

	header('Location: gestion.html');
	

}


if ($passgestion!=$passgestion2)
{

		die("<br><br><b><p class='text-center'>A esta página sólo se puede acceder mediante contraseña correcta....</p></b>");
}

}



if ($inicio)
if ($usergestion!=$usergestion2)
	die("<br><br><b><p class='text-center'>Esta página sólo se puede acceder mediante contraseña correcta</p></b>"); 

?>