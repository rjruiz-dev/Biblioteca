<?
include ("config.php");
include('opciones.php');
//LIBRERIA DE FUNCIONES VARIADAS PARA php/MySQL
//© 2000 Karontek S.L.
//Comentarios y sugerencias a koas@karontek.com

//***************************CONEXIÓN A LA BASE DE DATOS*****************
//Conexión a la base de datos. Esta es en teoría la única línea que se debe 
//modificar en cada proyecto, sustituyendo la dirección IP y el login y el
//password. Todas las demás funciones deberían ser 'Project-Independent'
//Si se desea se puede modificar el mensaje de error.
//	     <input type=\"button\" value=\"Volver\" onClick=\"history.go(-1)\"></center>";
//$conexion=mysql_connect("localhost", "bibliote_carmelo", "7p%kvC3hlm1{");

//$conexion=mysql_connect("localhost", "root", "");

foreach ($_REQUEST as $var=>$value) {
	$_REQUEST[$var] = preg_replace('#[<>\\\"\'\`;]|&3C|%3E|&lt;|&gt;|0x|select|insert|update|delete#', '', $value);
	$$var = $_REQUEST[$var];
}

$conexion = mysqli_connect($bd_Host, $bd_User, $bd_Pass, $bdatos);




if (!$conexion) 
{
	echo "<br><br><center>No se pudo conectar a la base de datos.<br><br>
	     <a href=javascript:history.go(-1)><font face='Arial, Helvetica, sans-serif' size='2'>Volver</Font></a> </center>";

	die ();
}

mysqli_set_charset($conexion, "utf8");
//*********************************crea_tabla()*********************************

// Param. 1 -> Nombre de la tabla a crear. Automáticamente creará un 
// campo llamado ID de tipo INTEGER PRIMARY KEY NOT NULL, dado que en este
// campo se apoyarán otras funciones de la librería.

// Param. N -> Nombre y tipo del campo a crear

// Devuelve -> 0 si hubo algún error o 1 si todo ha ido bien.

// Ejemplo -> crea_tabla (array ("basedatos.tabla", "ARTICULO CHAR(40) NOT NULL", "PRECIO INTEGER NOT NULL"));
// Ejemplo -> crea_tabla (array ("basedatos.tabla", "ARTICULO CHAR(40) NOT NULL, PRECIO INTEGER NOT NULL"));

function crea_tabla ($input)
{
	global $conexion;
	$query = "CREATE TABLE $input[0] (ID INTEGER PRIMARY KEY NOT NULL";
	for ($x=1; $x<count($input); $x++)
		$query = $query . ", " . $input[$x];
	$query = $query . ")";
	$res = @mysqli_query ($conexion,$query);
	if (!$res)
		return 0;
	else 
		return 1;
}

//*****************************existe_valor()****************************

//Param. 1 -> Nombre de la tabla en la que se busca
//Param. 2 -> Nombre del campo en el que se buscará el valor
//Param. 3 -> Valor a buscar (texto)

//Devuelve -> 0 si no hay ningún elemento en el campo con ese valor, 1 si lo hay
//		echo "<center><input type=\"button\" value=\"Volver\" onClick=\"history.go(-1)\"></center>";

function existe_valor($tabla, $campo, $valor)
{
	global $conexion;
	if (!($res=@mysqli_query ($conexion,"SELECT * FROM $tabla WHERE $campo=\"$valor\"" )))
	{
		echo "Error al ejecutar sentencia SQL";
		echo mysqli_errno($conexion).": ".mysqli_error($conexion)."<br>";
		echo "<center><a href=javascript:history.go(-1)><font face='Arial, Helvetica, sans-serif' size='2'>Volver</Font></a> </center>";
	}
	if (mysqli_num_rows($res)&&$res)
		return 1;
	return 0;
}

//*****************************existen_valores()****************************

//Como la anterior, pero busca pares de valores

//Devuelve -> 0 si no hay ningún elemento en el campo con ese valor, 1 si lo hay
//		echo "<center><input type=\"button\" value=\"Volver\" onClick=\"history.go(-1)\"></center>";


function existen_valores($tabla, $campo1, $valor1, $campo2, $valor2)
{
	global $conexion;
	if (!($res=@mysqli_query ($conexion, "SELECT * FROM $tabla WHERE $campo1=\"$valor1\" AND $campo2=\"$valor2\"")))
	{
		echo "Error al ejecutar sentencia SQL";
		echo mysqli_errno($conexion).": ".mysqli_error($conexion)."<br>";
		echo "<center><a href=javascript:history.go(-1)><font face='Arial, Helvetica, sans-serif' size='2'>Volver</Font></a> </center>";
	}
	if (mysqli_num_rows($res)&&$res)
		return 1;
	return 0;
}

//***************************obten_max()********************************
//Param. 1 -> Nombre de la tabla en la que se busca
//Param. 2 -> Nombre del campo del que se desea el valor máximo
//		echo "<center><input type=\"button\" value=\"Volver\" onClick=\"history.go(-1)\"></center>";

//Devuelve -> Máximo de esa columna

function obten_max($tabla, $campo)
{
	global $conexion;
	if(!($res=@mysqli_query ($conexion,"SELECT MAX($campo) FROM $tabla")))
        	{
   		echo "Error al ejecutar sentencia SQL";       		
		echo mysqli_errno($conexion).": ".mysqli_error($conexion)."<br>";
  		echo "<center><a href=javascript:history.go(-1)><font face='Arial, Helvetica, sans-serif' size='2'>Volver</Font></a> </center>";
        	}
        	$arra=mysqli_fetch_row ($res);
	return ceil($arra[0]);
}

//***************************obten_min()********************************
//Param. 1 -> Nombre de la tabla en la que se busca
//Param. 2 -> Nombre del campo del que se desea el valor mínimo
//		echo "<center><input type=\"button\" value=\"Volver\" onClick=\"history.go(-1)\"></center>";

//Devuelve -> Mínimo de esa columna

function obten_min($tabla, $campo)
{
	global $conexion;
	if(!($res=@mysqli_query ($conexion,"SELECT MIN($campo) FROM $tabla")))
        	{
   		echo "Error al ejecutar sentencia SQL";       		
		echo mysqli_errno($conexion).": ".mysqli_error($conexion)."<br>";
  		echo "<center><a href=javascript:history.go(-1)><font face='Arial, Helvetica, sans-serif' size='2'>Volver</Font></a> </center>";
        	}
        	$arra=mysqli_fetch_row($res);
	return ceil($arra[0]);
}

//*************************haz_query()***********************************
//Param. 1 -> Sentencia SQL a ejecutar
//		echo "<center><input type=\"button\" value=\"Volver\" onClick=\"history.go(-1)\"></center>";

//Devuelve -> Resultado de la sentencia

function haz_query ($sentencia)
{
	global $conexion;

	if(!($res=@mysqli_query ($conexion,$sentencia)))
        	{
   		echo "Error al ejecutar sentencia SQL<br>";       		
		echo mysqli_errno($conexion).": ".mysqli_error($conexion)."<br>";
  		echo "<center><a href=javascript:history.go(-1)><font face='Arial, Helvetica, sans-serif' size='2'>Volver</Font></a> </center>";
        	}
	return $res;
}

//*************************sal_error()***********************************
//Sale del script mostrando un mensaje de error a la conexión de base de datos
//Param. 1 -> 0 si no se desea info sobre el error, 1 si se desea.

function sal_error ($info,$conexion=false)
{
	global $conexion;
	if ($info)
		echo mysqli_errno($conexion).": ".mysqli_error($conexion)."<br>";
	die ("<br>Se produjo un error al conectar a la base de datos. <br>Por favor, inténtelo más tarde.<br><br><center><a href=javascript:history.go(-1)><font face='Arial, Helvetica, sans-serif' size='2'>Volver</Font></a> </center>");
}


//************************elimina_hora()*********************************
//Elimina la información de hora de una string tipo datetime en formato AAAA-MM-DD HH:MM:SS
//Param. 1 -> String datetime

function elimina_hora ($str)
{
	$str=substr($str,0,strlen($str)-9);
	return $str;
}

//************************convierte_fecha()****************************
//Convierte una fecha del formato yanki (AÑO-MES-DIA) al de aquí (DIA-MES-AÑO)
//Param. 1 -> String conteniendo la fecha en formato bebedor-de-Coca-cola. Ojo, que el mes y el dia
//deben ser de dos numeros (01-12 y 01-31)

function convierte_fecha($fecha)
{
	$arra=explode("-",$fecha);
	$dia=$arra[2];	
	$mes=$arra[1];	
	$ano=$arra[0];
	$fecha=$dia . "-" . $mes . "-" . $ano;
	return $fecha;
}

//************************convierte_fecha2()****************************
//Convierte una fecha del formato de aquí (DIA-MES-AÑO) al yanki (AÑO-MES-DIA) 
//Param. 1 -> String conteniendo la fecha en formato de aquí. 


function convierte_fecha2($fecha)
{
	$arra=explode("-",$fecha);
	$dia=$arra[0];
	$mes=$arra[1];
	$ano=$arra[2];
	$fecha=$ano . "-" . $mes . "-" . $dia;
	return $fecha;
}

//***********************aumenta_fecha()*******************************
//Dada una fecha (en formato de aquí, DD-MM-AAAA), nos devuelve la fecha
//de N días despues
//Param. 1 -> String con una fecha en formato DD-MM-AAAA

function aumenta_fecha($fecha,$N)
{
	$arra=explode("-",$fecha);
	$dia=$arra[0];
	$mes=$arra[1];
	$ano=$arra[2];
	if($N>31)
	{
		$m=ceil($N / 31);
		$mes+=$m;
		$N=0;
	}
	if ($mes>12)
	{
		$m=ceil($mes / 12);
		$ano+=$m;
		$mes=1;
	}
	$dia+=$N;
	if ($dia>31) 
	{
		$dia-=31;
		if ($mes!="12")
			$mes++;
		else 
		{
			$mes="01";
			$ano++;
		}
	}
	$fecha=$dia."-".$mes."-".$ano;
	return $fecha;
}	


function derecha($cadena)
{
$pieces = explode("_", $cadena);
if ($pieces[1]=="libros")
{
return "Documentos";
}
if ($pieces[1]=="socios")
{
return "Socios de la bibioteca";
}
if ($pieces[1]=="referenc")
{
return "Maestro de Referencias";
}
if ($pieces[1]=="cl")
{
return "Referencias en documentos";
}
if ($pieces[1]=="alumnos")
{
return "Préstamos";
}
if ($pieces[1]=="archpres")
{
return "Histórico de Préstamos";
}
if ($pieces[1]=="cdu")
{
return "Materias";
}
if ($pieces[1]=="genecine")
{
return "Géneros";
}

if ($pieces[1]=="formatos")
{
return "Formatos";
}
if ($pieces[1]=="socios2")
{
return "Altas socios Web";
}
if ($pieces[1]=="alumnos2")
{
return "Reservas desde Web";
}
if ($pieces[1]=="calificacion")
{
return "Público adecuado";
}
if ($pieces[1]=="cursos")
{
return "Cursos";
}
if ($pieces[1]=="idiomas")
{
return "Idiomas";
}
if ($pieces[1]=="contenido")
{
return "Documentos con Sinopsis";
}
if ($pieces[1]=="modelo")
{
return "Modelos de correspondencia";
}

}

//************************boton_consultas()********************************
//Pone un enlace que vuelve a la pantalla de consultas

function boton_consultas()
{
//	echo "<br><center><input type=\"button\" value=\"Página Principal\" onClick=\"window.location.href='index.htm'\"></center>";



echo "<br><br><p class='text-center ' style='width:100%'><input type='button' class='btn btn-secundary' value='P&aacute;gina Principal' onClick=\"window.location.href='index.html'\"></p>";





//	echo "<br><center><input type=\"button\" value=\"Página Principal\" onClick=\"window.location.href='index.htm'\"></center>";
	


//echo "<br><br><p class='text-center ' style='width:100%'><input type='button' class='btn btn-secundary' value='P&aacute;gina Principal' onClick=\"window.location.href='$server'\"></p>";



}

//************************boton_cerrarventana()********************************
//Cierra la página que se está visualizando

function boton_cerrar()
{
echo "<br>
<center><a href=javascript:close()>Cerrar</a> </center>
";
}


//************************boton_imprimir()********************************
//Imprime la ventana que se está visualizando



function boton_imprimir()
{
echo "<BR><CENTER><A title='Imprimir' href=javascript:window.print()><IMG SRC='images/impresora.png' border='0'></A> 
</CENTER>";
}


//************************boton_gestion()********************************
//Pone un enlace que vuelve a la pantalla de gestión

function boton_gestion()
{
	echo "<br><center><a href='gestion.php'><font face='Arial, Helvetica, sans-serif' size='2'>Gestión de la Biblioteca</Font></a> </center>";
}


//************************boton_volver()********************************
//Coloca un botón con valor "Volver" equivalente al botón de BACK del navegador

function boton_volver()
{
	echo "<br><p class='text-center ' style='width:100%'><input type='button' class='btn btn-secundary' value='Volver' onClick='history.go(-1)'></p>";
	//echo "<br><p class='text-center btn btn-secundary' style='width:100%'><a href=javascript:history.go(-1)>Volver xx</a></p> </center>";
}
?>
