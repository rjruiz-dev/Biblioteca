 <?php // session_start();?>

 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">

 <div class="row wrap-header" >
    <div class="col-sm-4 logo-header">
              <a class="navbar-brand" href='https://www.bibliotecaonline.net'
    target='_blank'>
          <img src="logo.jpg"  alt='Aqui el logo de su biblioteca, 60 píxeles de alto' class="img-fluid">
        </a>
    </div>
    <div class="col-sm-4  title-header">
     <h3><? echo $nombre_biblioteca ?></h3>
    </div>

    <div class="col-sm-4  fecha-header">
      <script language="javascript">

var fecha=new Date();
var diames=fecha.getDate();
var diasemana=fecha.getDay();
var mes=fecha.getMonth() +1 ;
var ano=fecha.getFullYear();

var textosemana = new Array (7); 
  textosemana[0]="Domingo";
  textosemana[1]="Lunes";
  textosemana[2]="Martes";
  textosemana[3]="Miércoles";
  textosemana[4]="Jueves";
  textosemana[5]="Viernes";
  textosemana[6]="Sábado";

var textomes = new Array (12);
  textomes[1]="Enero";
  textomes[2]="Febrero";
  textomes[3]="Marzo";
  textomes[4]="Abril";
  textomes[5]="Mayo";
  textomes[6]="Junio";
  textomes[7]="Julio";
  textomes[8]="Agosto";
  textomes[9]="Septiembre";
  textomes[10]="Octubre";
  textomes[11]="Noviembre";
  textomes[12]="Diciembre";

document.write(textosemana[diasemana] + ", " + diames + " de " + textomes[mes] + " de " + ano + "<br>");

</script>
    </div>
  </div>





      </div>

    </nav>
    <div style="clear: both;"></div>



















<?
function titulo($texto,$gestion=true)
{
	echo "<div class='container-fluid titulo-seccion col-md-10' style='float:left'>$texto </div>";
  echo "<div class='container-fluid titulo-seccion col-md-2' style='float:left; text-align: center'>&nbsp;"; 


if(!$gestion){

      if ($_SESSION['loggedin']==true)
    {
      echo "<a href='logout.php' style='color:white' title='Cerrar sesión'> <i class='fa fa-sign-out' aria-hidden='true'></i>Salir</a>";
    }

}

else
{
    if ($_SESSION['loggedin_gestion']==true)
    {
      echo "<a href='logout-gestion.php' style='color:white' title='Cerrar sesión'> <i class='fa fa-sign-out' aria-hidden='true'></i>Salir</a>";
    }

}

  
  echo "</div>";
  echo "<div style='clear: both; '></div>";
}

?>


