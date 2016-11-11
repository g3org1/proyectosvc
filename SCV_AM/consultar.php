<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>SCV AYUDA-MED</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <script type='text/javascript'>
                    function enviarForm(){
                        document.nameForm.submit();
                    }
                </script>

</head>

<body id="top" onLoad='javascript:enviarForm();'>
  <!--GEOMAP-->
  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<?php
$conexion=mysqli_connect("localhost","root","","bd_scv");

 if(!$conexion){
   die('Error al Conectar a la Base de Datos');
 }


 $sentencia = "SELECT cli.* FROM clinica AS cli";
 $clinica = mysqli_query($conexion, $sentencia);

 echo " <script>var marcadores = [";
   while ($rowcli = $clinica->fetch_assoc()) {
           echo "['".$rowcli['nombre_clinica']."', ".$rowcli['latitud'].", ".$rowcli['longitud']."],";
                   }
echo "['Zero', 0, 0]];</script>";

 if (!mysqli_query($conexion, $sentencia)){

       echo mysqli_errno($conexion) . ": " . mysqli_error($conexion) . "\n";

}

?>

  <script>





  function success(position) {
   var status = document.querySelector('#status');
   status.innerHTML = "";

   var mapcanvas = document.createElement('div');
   mapcanvas.id = 'mapcanvas';
   mapcanvas.style.height = '240px';
   mapcanvas.style.width = '330px';

   document.querySelector('#map').appendChild(mapcanvas);

   var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
   var myOptions = {
   zoom: 12,
   center: latlng,
   mapTypeControl: false,
   navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
   mapTypeId: google.maps.MapTypeId.ROADMAP
   };
   var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);


   var centro = new google.maps.Marker({
   position: latlng,
   map: map,
   title:"Usted está aquí."
   });



   for (var i = 0; i < marcadores.length-1; i++){
    var marker = new google.maps.Marker({
     position: {lat: marcadores[i][1], lng: marcadores[i][2]},
     map: map,
     title:marcadores[i][0]
        });
      };


  }



  function error(msg) {
   var status = document.getElementById('status');
   status.innerHTML= "Error [" + error.code + "]: " + error.message;
  }

  if (navigator.geolocation) {
   navigator.geolocation.getCurrentPosition(success, error,{maximumAge:60000, timeout: 4000});
  } else {
   error('Su navegador no tiene soporte para su geolocalización');
  }



  </script>

<!--Fin GEOMAP-->
    <!-- Top -->
    <div class="bgded overlay principal" style="background-image:url('images/backgrounds/04.png'); height: 100vh;">
        <div class="wrapper row0">
            <!-- barra superior -->
            <div id="topbar" class="hoc clear">
                <div class="fl_left">
                    <ul>
                      <?php
                          $conexion=mysqli_connect("localhost","root","","bd_scv");

                           if(!$conexion){
                             die('Error al Conectar a la Base de Datos');
                           }

                           $Run = $_SESSION['run'];

                           $sentencia = "SELECT cli.* FROM clinica AS cli WHERE cli.rut_clinica = '".$Run."'";
                           $clinica = mysqli_query($conexion, $sentencia);

                           if(!$clinica){
                             echo "<center><h2>Error Run '".$Run."' no Existe</h2></center>";
                           }else{
                             while ($rowcli = $clinica->fetch_assoc()) {
                                     echo "
                                     <li><i class='fa fa-phone'></i>".$rowcli['telefono_clinica']."</li>
                                     <!-- telefono -->
                                     <li><i class='fa fa-envelope-o'></i>".$rowcli['correo']."</li>
                                     <!-- correo -->
                                     <li><i class='fa fa-hospital-o'></i>''".$rowcli['nombre_clinica']."''</li>
                                     <!-- correo -->";
                           }

                           if (!mysqli_query($conexion, $sentencia)){

                                 echo mysqli_errno($conexion) . ": " . mysqli_error($conexion) . "\n";

                         }
                      }
                          ?>
                    </ul>
                </div>
                <div class="fl_right">
                    <ul>
                        <li><a href="index.php"><i class="fa fa-lg fa-home"></i></a></li>
                        <!-- inicio -->
                        <li><a href="ingresar-usu.php">Ingresar</a></li>
                        <!-- formulario de ingerso -->
                        <li><a href="registrar-usu.php">Registrarse</a></li>
                        <!-- formulario de registro -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- fin barra superior-->

        <!-- barra central-->
        <div class="wrapper row1">
            <header id="header" class="hoc clear">
                <!-- logotipo -->
                <div id="logo" class="fl_left">
                    <h1><a href="index.php"><img src="images/logotipo.png" alt="logotipo"/></a></h1>
                </div>
                <!-- menu -->
                <nav id="mainav" class="fl_right">
                    <ul class="clear">
                        <li class="active"><a href="index.php">Inicio</a></li>
                        <li><a class="drop" href="#">Administración</a>
                            <ul>
                                <li><a class="drop" href="#">Gestión Pacientes</a>
                                    <ul>
                                        <li><a href="registrar-pac.php">Registrar Paciente</a></li>
                                        <li><a href="modificar-pac.php">Modificar Ficha Clínica Paciente</a></li>
                                </li>
                                <li><a href="notificar-pac.php">Notificar a Correo</a></li>

                                </ul>
                        </li>
                        <li><a class="drop" href="#">Gestion Centros Médicos</a>
                            <ul>
                                <li><a href="registrar-cen-med.php">Agregar Centro médico</a></li>
                                <li><a href="modificar-cen-med.php">Modificar Centro Médico</a></li>

                            </ul>
                        </li>
                        </ul>
                        </li>
                        <li><a class="drop" href="#">Usuarios</a>
                            <ul>
                                <li><a href="calendario.php">Calendario</a></li>
                                <li><a class="drop" href="#">Vacunas</a>
                                    <ul>
                                      <li><a href="index.php">Registro</a></li>
                                      <li><a href="vacunas.php">Informacion</a></li>
                                    </ul>
                                </li>
                                <li><a href="#publicidad">Centros Medicos Asociados</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>
        </div>
        <!-- Fin Barra Central -->

        <div id="pageintro" class="hoc clear">
            <div id="principal">
                <div class="timeline">


                  <?php

                  $conexion=mysqli_connect("localhost","root","","bd_scv");

                   if(!$conexion){
                     die('Error al Conectar a la Base de Datos');
                   }

                   if(!$_SESSION['var']){
                     $Rut = $_POST['rut'];
                     $_SESSION['var']=$Rut;
                   }else{
                     $Rut = $_SESSION['var'];
                   }



                  $sentencia = "SELECT pac.* FROM paciente AS pac WHERE pac.rut_paciente = '".$Rut."'";
                  $paciente = mysqli_query($conexion, $sentencia);

                   if(!$paciente){
                     echo "<center><h2>Error Rut '".$Rut."' no Existe</h2></center>";
                   }else{
                      while ($row = $paciente->fetch_assoc()) {
                              echo "<div id='info-paciente'>

                                        <li>
                                            <h3> Nombre:</h3>
                                            <span>".$row['nombre_paciente']."</span>
                                        </li>
                                        <li>
                                            <h3> Nacimiento:</h3>
                                            <span>".$row['fecha_nac']."</span>
                                        </li>
                                    </div>
                                    <div id='avatar-paciente'>
                                        <img src='".$row['foto']."' alt='avatar'>

                                        <nav class='one_quarter'><a class='btn btn_ficha' href='ficha-clinica.php?var=<?php echo $Rut; ?>'>Ficha</a></nav>

                                    </div>";
                          }

                      /*$data=mysqli_num_rows($Rut + $nacimiento + $foto_e);
   */

                        if (!mysqli_query($conexion, $sentencia)){

                              echo mysqli_errno($conexion) . ": " . mysqli_error($conexion) . "\n";

                      }
                   }

                   ?>










                    <div class="registros">

                        <div class="columna">
                            <h5 class="cabecera">Nacimiento</h5>
                            <div class="fila">
                                <p>BCG</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                        </div>
                        <div class="columna">
                            <h5 class="cabecera">1 meses</h5>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                        </div>
                        <div class="columna">
                            <h5 class="cabecera">2 meses</h5>
                            <div class="fila">
                                <p>PENTTAVALENTE</p>
                            </div>
                            <div class="fila">
                                <p>POLIO ORAL</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>

                        </div>
                        <div class="columna">
                            <h5 class="cabecera">4 meses</h5>
                            <div class="fila">
                                <p>PENTTAVALENTE</p>
                            </div>
                            <div class="fila">
                                <p>POLIO ORAL</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                        </div>
                        <div class="columna">
                            <h5 class="cabecera">6 meses</h5>
                            <div class="fila">
                                <p>PENTTAVALENTE</p>
                            </div>
                            <div class="fila">
                                <p>POLIO ORAL</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>

                        </div>
                        <div class="columna">
                            <h5 class="cabecera">9 meses</h5>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>

                        </div>
                        <div class="columna">
                            <h5 class="cabecera">12 meses</h5>
                            <div class="fila">
                                <p>PENTTAVALENTE</p>
                            </div>
                            <div class="fila">
                                <p>POLIO ORAL</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>
                            <div class="fila">
                                <p>NO REGISTRA</p>
                            </div>

                        </div>
                        <!--	<div class="columna">
                    <h5 class="cabecera">15 meses</h5>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                  </div>
                  <div class="columna">
                    <h5 class="cabecera">18 meses</h5>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                  </div>
                  <div class="columna">
                    <h5 class="cabecera">19 a 23 meses</h5>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                  </div>
                  <div class="columna">
                    <h5 class="cabecera">2 a 3 años</h5>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                  </div>
                  <div class="columna">
                    <h5 class="cabecera">4 a 6 años</h5>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                  </div>
                  <div class="columna">
                    <h5 class="cabecera">7 a 10 años</h5>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                  </div>
                  <div class="columna">
                    <h5 class="cabecera">11 a 12 años</h5>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                  </div>
                  <div class="columna">
                    <h5 class="cabecera">13 a 15 años</h5>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                  </div>
                  <div class="columna">
                    <h5 class="cabecera">16 a 18 años</h5>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                    <div class="fila"></div>
                  </div>
        -->



                    </div>
                </div>
                <div class="espacio-iz">
                    <!--	<div class="circulo"></div>
              </div> -->
                </div>

            </div>
        </div>
    </div>
    <!-- fin top -->
    <div class="wrapper coloured">
        <article class="hoc cta clear">
          <h6 class="three_quarter first">Informacion de Vacunas</h6>
          <footer class="two_quarter"><a class="btn" href="vacunas.html">Acceder &raquo;</a></footer>
        </article>
    </div>
    <div class="wrapper row2">
      <article class="hoc container clear">
          <div class="one_quarter tit-asociados">
              <h3 class="font-x2"><b style="color:#7ec1d2;">Clinicas Asociadas</b></h3>
          </div>
          <div class="one_quarter asociados">
            <a name=" publicidad"></a>
              <ul class="nospace group stats">
                <?php
                    $conexion=mysqli_connect("localhost","root","","bd_scv");

                     if(!$conexion){
                       die('Error al Conectar a la Base de Datos');
                     }


                     $sentencia = "SELECT * FROM clinica";
                     $clinica = mysqli_query($conexion, $sentencia);

                       while ($fila = mysqli_fetch_array($clinica)) {

                               echo "
                               <li>
                               <p><a href='http://".$fila['link']."/''><i class='fa fa-3x fa-plus-circle'></i> ".$fila['nombre_clinica']."</a></p></li>
                               ";
                     }

                     if (!mysqli_query($conexion, $sentencia)){

                           echo mysqli_errno($conexion) . ": " . mysqli_error($conexion) . "\n";

                   }

                    ?>



              </ul>
          </div>
          <div class="one_quarter geomapa">
            <p id="status" style="display:none;">Buscando su localización...</p>
            <div id="map"></div></div>
      </article>
    </div>

    <div class="wrapper row4 bgded overlay" style="background-image:url('images/backgrounds/03.png');">
        <footer id="footer" class="hoc clear">
            <center>
                <ul class="faico clear">
                    <li><a class="faicon-facebook" href="https://www.facebook.com/ucsc.concepcion/" title="UCSC Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="faicon-twitter" href="https://twitter.com/ucscconcepcion" title="UCSC Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="faicon-university" href="http://www.ucsc.cl/" title="Universidad Catolica de la Santisima Concepcion"><i class="fa fa-university"></i></a></li>
                    <li><a class="faicon-balance-scale" href="http://www.minsal.cl/" title="Ministerio de Salud"><i class="fa fa-balance-scale"></i></a></li>
                </ul>
            </center>
    </div>
    <!-- ################################################################################################ -->
    </footer>
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="wrapper row5">
        <div id="copyright" class="hoc clear">
            <!-- ################################################################################################ -->
            <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="#">Domain Name</a></p>
            <!-- ################################################################################################ -->
        </div>
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
    <!-- JAVASCRIPTS -->
    <script src="layout/scripts/jquery.min.js"></script>
    <script src="layout/scripts/jquery.backtotop.js"></script>
    <script src="layout/scripts/jquery.mobilemenu.js"></script>
    <script src="layout/scripts/jquery.flexslider-min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-G6cXO8I8R4K-9JcitlEKPfWQMG86t5Y&callback=initMap"
    async defer></script>

</body>

</html>
