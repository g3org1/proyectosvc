<?php session_start(); ?>
<?php require_once("config.inc.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="es"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="es"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="es"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="es"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<title>SCV AYUDA-MED</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="PRAGMA" content="NO-CACHE">
	<meta http-equiv="EXPIRES" content="-1">

	<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>

	<link type="text/css" rel="stylesheet" media="all" href="estilos.css">

	</head>
	<body id="top">
		<!--GEOMAP-->
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
		                                   <!-- correo -->";;
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
	                <div class="timeline" id="timeline" style="color:rgb(66, 66, 66);">
										<div id="registros2">
											<div class="calendario_ajax">
												<div class="cal"></div><div id="mask"></div>
											</div>
										</div>

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
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/localization/messages_es.js "></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-G6cXO8I8R4K-9JcitlEKPfWQMG86t5Y&callback=initMap"
	async defer></script>

	<script>
	function generar_calendario(mes,anio)
	{
		var agenda=$(".cal");
		agenda.html("<img src='images/loading.gif'>");
		$.ajax({
			type: "GET",
			url: "ajax_calendario.php",
			cache: false,
			data: { mes:mes,anio:anio,accion:"generar_calendario" }
		}).done(function( respuesta )
		{
			agenda.html(respuesta);
		});
	}

	function formatDate (input) {
		var datePart = input.match(/\d+/g),
		year = datePart[0].substring(2),
		month = datePart[1], day = datePart[2];
		return day+'-'+month+'-'+year;
	}

		$(document).ready(function()
		{
			/* GENERAMOS CALENDARIO CON FECHA DE HOY */
			generar_calendario("<?php if (isset($_GET["mes"])) echo $_GET["mes"]; ?>","<?php if (isset($_GET["anio"])) echo $_GET["anio"]; ?>");


			/* AGREGAR UN EVENTO */
			$(document).on("click",'a.add',function(e)
			{
				e.preventDefault();
				var id = $(this).data('evento');
				var fecha = $(this).attr('rel');

				$('#mask').fadeIn(1000).html("<div id='nuevo_evento' class='window' rel='"+fecha+"'>Agregar un evento el "+formatDate(fecha)+"</h2><a href='#' class='close' rel='"+fecha+"'>&nbsp;</a><div id='respuesta_form'></div><form class='formeventos'><input type='text' name='evento_titulo' id='evento_titulo' class='required'><input type='button' name='Enviar' value='Guardar' class='enviar'><input type='hidden' name='evento_fecha' id='evento_fecha' value='"+fecha+"'></form></div>");
			});

			/* LISTAR EVENTOS DEL DIA */
			$(document).on("click",'a.modal',function(e)
			{
				e.preventDefault();
				var fecha = $(this).attr('rel');

				$('#mask').fadeIn(1000).html("<div id='nuevo_evento' class='window' rel='"+fecha+"'>Eventos del "+formatDate(fecha)+"</h2><a href='#' class='close' rel='"+fecha+"'>&nbsp;</a><div id='respuesta'></div><div id='respuesta_form'></div></div>");
				$.ajax({
					type: "GET",
					url: "ajax_calendario.php",
					cache: false,
					data: { fecha:fecha,accion:"listar_evento" }
				}).done(function( respuesta )
				{
					$("#respuesta_form").html(respuesta);
				});

			});

			$(document).on("click",'.close',function (e)
			{
				e.preventDefault();
				$('#mask').fadeOut();
				setTimeout(function()
				{
					var fecha=$(".window").attr("rel");
					var fechacal=fecha.split("-");
					generar_calendario(fechacal[1],fechacal[0]);
				}, 500);
			});

			//guardar evento
			$(document).on("click",'.enviar',function (e)
			{
				e.preventDefault();
				if ($("#evento_titulo").valid()==true)
				{
					$("#respuesta_form").html("<img src='images/loading.gif'>");
					var evento=$("#evento_titulo").val();
					var fecha=$("#evento_fecha").val();
					$.ajax({
						type: "GET",
						url: "ajax_calendario.php",
						cache: false,
						data: { evento:evento,fecha:fecha,accion:"guardar_evento" }
					}).done(function( respuesta2 )
					{
						$("#respuesta_form").html(respuesta2);
						$(".formeventos,.close").hide();
						setTimeout(function()
						{
							$('#mask').fadeOut('fast');
							var fechacal=fecha.split("-");
							generar_calendario(fechacal[1],fechacal[0]);
						}, 3000);
					});
				}
			});

			//eliminar evento
			$(document).on("click",'.eliminar_evento',function (e)
			{
				e.preventDefault();
				var current_p=$(this);
				$("#respuesta").html("<img src='images/loading.gif'>");
				var id=$(this).attr("rel");
				$.ajax({
					type: "GET",
					url: "ajax_calendario.php",
					cache: false,
					data: { id:id,accion:"borrar_evento" }
				}).done(function( respuesta2 )
				{
					$("#respuesta").html(respuesta2);
					current_p.parent("p").fadeOut();
				});
			});

			$(document).on("click",".anterior,.siguiente",function(e)
			{
				e.preventDefault();
				var datos=$(this).attr("rel");
				var nueva_fecha=datos.split("-");
				generar_calendario(nueva_fecha[1],nueva_fecha[0]);
			});

		});
		</script>

	    </div>
	</body>

	</html>
