<script >
    var la;
    var lo;

</script>

<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>Ingreso Cliente</title>

  <link rel="stylesheet" href="layout/styles/demo.css">
	<link rel="stylesheet" href="layout/styles/form-register.css">

	<script src="layout/scripts/jquery-2.2.1.js"</script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>

  <link rel="stylesheet" href="layout/styles/ionicons.min.css">

</head>
  <body>
    <div class="main-content">
        <form class="form-register" >
            <div class="form-register-with-email">
                <div class="form-white-background">
                <a href="index.php">
                <?php
          echo "<img src=\"images/logotipo2.png\">";

          ?>
          <a>

            <!-- <br><br><br><br><p> NOTA: Para el Ingreso de un Nuevo Cliente son de llenado Obligatorios los campos con (*)</p></br></br></br>
-->
                    <div class="form-title-row">
                    <br><h1>Nuevo Usuario</h1>
                    <br><br>
                    <p style="font-size: 10px; color: #7ec1d2;"> NOTA: Para el Ingreso de un Nuevo Usuario son de llenado Obligatorios los campos con (*)</p>

                    </div>
                    <div class="form-row" >
                        <label>
                            <span>Rut (*)</span>
                            <input type="text" id="rut" name="rut" placeholder="Ej: 17.789.324-k" required="">
                        </label>
                    </div>

                      <div class="form-row">
                        <label>
                            <span>Nombre </span>
                            <input type="text" name="nombre" placeholder="Ej: Maria Jose" required="">
                        </label>
                    </div>

                    <div class="form-row">
                      <label>
                          <span>Apellido </span>
                          <input type="text" name="apellido" placeholder="Ej: Rivas Perez" required="">
                      </label>
                  </div>


                    <div class="form-row">
                        <label>


                            <span>Correo Electronico</span>
                            <input type="text"  name="correo" required=""  >


                        </label>
                    </div>



                    <div class="form-row">
                    <label>
                        <span>Regi&oacute;n</span>
                        <select name="region" id="region" onchange="buscar_ciudad()" required>
                            <option value="0" selected="selected" disabled="disable">Regi&oacute;n</option >
                            <option value="1">1 Tarapaca</option>
                            <option value="2">2 Antofagasta</option>
                            <option value="3">3 Atacama</option>
                            <option value="4">4 Coquimbo</option>
                            <option value="5">5 Valparaiso</option>
                            <option value="6">6 O'Higgins</option>
                            <option value="7">7 Maule</option>
                            <option value="8">8 Bio - Bio</option>
                            <option value="9">9 Araucania</option>
                            <option value="10">10 Los Lagos</option>
                            <option value="11">11 Aisen</option>
                            <option value="12">12 Magallanes Y Antartica</option>
                            <option value="13">13 Metropolitana</option>
                            <option value="14">14 Los Rios</option>
                            <option value="15">15 Arica y Parinacota</option>
                        </select>

                    </label>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Comuna</span>
                        <select name="ciudad" id="comuna" required></select>
                        </label>
                    </div>
                      <div class="form-row">
                        <label>
                            <span>Direccion</span>
                            <input type="text" id="direccion" name="direccion_ubicacion" required="">
                        </label>
                    </div>

						<div id="mapas">
						<div id="divMapa">
						</div>
						</div>
                    <script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>



                    <div class="form-row">
                        <button name="registrar">Registrarse</button>


                    </div>
                    <p><a href="ingresar-usu.php">Ingresar</a>

										</p>
                     <span id="estado"></span>

        </form>

    </div>


</body>

</html>



						<script>

                        function mapita()
                        {
                            var ciudad                   =$("#comuna").val()
                            var direccion                =$("#direccion").val()




                            var geocoder = new google.maps.Geocoder();
                            var address                  ="";
                            address                      =direccion.concat(", ",ciudad,", Chile");

                            geocoder.geocode( { 'address': address}, function(results, status) {
                            if (status                   == google.maps.GeocoderStatus.OK) {

                            var latitude                 = results[0].geometry.location.lat();

                            var  longitude               = results[0].geometry.location.lng();

                            la=latitude;
                            lo=longitude;

                            //alert('La longitud es        : ' + longitude + ', la latitud es: ' + latitude);

                            if($("#mapas").css('display') == 'none')
                            {
                                showPosition(latitude,longitude)
                            }
                            else
                            {
                                ubicar(latitude,longitude)
                            }

                        };



                        });



                        }


                        function ubicar(a,b)
                        {

                            var centro=new google.maps.LatLng(a,b)
                            map.setZoom(18);
                            map.setCenter(centro);//pedimos que centre el mapa
                            var objPunto=new google.maps.Marker
                            ({              //agregamos un tooltip al punto
                            position:   centro,  //indicamos las coordenadas del punto
                            map:        map, //este es el mapa que anteriormente creamos

                            })

                        }


						function showPosition(a,b)
						{
						$("#mapas").css("display"," block")
						punto=new google.maps.LatLng(a,b)

						var myOptions =
						{
						zoom: 15, //nivel de zoom para poder ver de cerca.
						center: punto,
						apTypeControl: false,
						streetViewControl: false,
						rotateControl: false,
						mapTypeControl: false,
						zoomControl: false,
						mapTypeId: google.maps.MapTypeId.ROADMAP
						}
						map = new google.maps.Map(document.getElementById("divMapa"), myOptions);
							var objPunto=new google.maps.Marker
							({              //agregamos un tooltip al punto
							position:   punto,  //indicamos las coordenadas del punto
							map:        map, //este es el mapa que anteriormente creamos

							})

						}





						$( "document").ready(function() {

			             $("#comuna").blur(function(event) {
                            /* Act on the event */
                            mapita()
                        });


                        $("#direccion").blur(function(event) {
                            /* Act on the event */
                            mapita()
                        });

						$(".form-register").submit(function(event) {
						/* Act on the event */
						event.preventDefault();
						var datos                    =$(".form-register").serialize();

                        datos=datos+"&latitud="+la+"&longitud="+lo;
                        alert(datos);

                        $.ajax({
                        data: datos,
                        url: 'ingreso_cl.php',
                        type: 'POST',

                        beforeSend: function () {
                          $("#estado").html("Procesando, espere por favor...");
                        },

                        success: function(response){

                        alert(response);

                        if(response==1)
                        {
                            alert("Datos de cliente ingresado correctamente.\n Sera redireccionado al menu principal.");
                            $("#estado").html("");
                            $(location).attr('href','cliente_ingresado.php');
                        }
                        else

                        {
                            if(response==0)
                            {
                                alert("El rut ingresado ya se encuentra registrado.\n Verifique.");
                                $("#rut").val('');
                                $("html, body").animate({ scrollTop: 0 }, "slow");
                            }

                        }



                        }
                    })

						});
						});












                        /*ciudades*/

ciudades_1 = new Array("Arica");
ciudades_2 = new Array("Alto Hospicio","Iquique","Pozo Almonte");
ciudades_3 = new Array("Caldera","Chanaral","Copiapo","Diego de Almagro","El Salvador","Huasco","Tierra Amarilla","Vallenar");
ciudades_4 = new Array("Andacollo","Combarbala","Coquimbo","El Palqui","Illapel","La Serena","Los Vilos","Montepatria","Ovalle","Salamanca","Vicuna");
ciudades_5 = new Array("Algarrobo","Cabildo","Calle Larga","Cartagena","Casablanca","Catemu","Concon","El Melon","El Quisco","El Tabo","Hijuelas","La Calera","La Cruz","La Ligua","Las Ventanas","Limache","Llaillay","Los Andes","Nogales","Olmue","Placilla de Penuelas","Putaendo","Quillota","Quilpue","Quintero","Rinconada","San Antonio","San Esteban","San Felipe","Santa Maria","Santo Domingo","Valparaiso","Villa Alemana","Villa Los Almendros","Vina del Mar");
ciudades_6 = new Array("Chimbarongo","Codegua","Donihue","Graneros","Gultro","Las Cabras","Lo Miranda","Machali","Nancagua","Palmilla","Peumo","Pichilemu","Punta Diamante","Quinta de Tilcoco","Rancagua","Rengo","Requinoa","San Fernando","San Francisco de Mostazal","San Vicente de Tagua Tagua","Santa Cruz");
ciudades_7 = new Array("Cauquenes","Constitucion","Curico","Hualane","Linares","Longavi","Molina","Parral","San Clemente","San Javier","Talca","Teno","Villa Alegre");
ciudades_8 = new Array("Arauco","Bulnes","Cabrero","Canete","Chiguayante","Chillan","Chillan Viejo","Coelemu","Coihueco","Concepcion","Conurbacion La Laja-San Rosendo","Coronel","Curanilahue","Hualpen","Hualqui","Huepil","Lebu","Los alamos","Los angeles","Lota","Monte aguila","Mulchen","Nacimiento","Penco","Quillon","Quirihue","San Carlos","San Pedro de la Paz","Santa Barbara","Santa Juana","Talcahuano","Tome","Yumbel","Yungay");
ciudades_9 = new Array("Angol","Carahue","Collipulli","Cunco","Curacautin","Freire","Gorbea","Labranza","Lautaro","Loncoche","Nueva Imperial","Padre Las Casas","Pitrufquen","Pucon","Puren","Renaico","Temuco","Traiguen","Victoria","Villarrica");
ciudades_10 = new Array("Futrono","La Union","Lanco","Los Lagos","Paillaco","Panguipulli","Rio Bueno","San Jose de la Mariquina","Valdivia");
ciudades_11 = new Array("Coihaique","Puerto Aisen");
ciudades_12 = new Array("Punta Arenas","Puerto Natales");
ciudades_13 = new Array("Alto Jahuel","Bajos de San Agustin","Batuco","Buin","Cerrillos","Cerro Navia","Colina","Conchali","Curacavi","El Bosque","El Monte","Estacion Central","Hospital","Huechuraba","Independencia","Isla de Maipo","La Cisterna","La Florida","La Granja","La Islita","La Pintana","La Reina","Lampa","Las Condes","Lo Barnechea","Lo Espejo","Lo Prado","Macul","Maipu","Melipilla","Nunoa","Padre Hurtado","Paine","Pedro Aguirre Cerda","Penaflor","Penalolen","Pirque","Providencia","Pudahuel","Puente Alto","Quilicura","Quinta Normal","Recoleta","Renca","San Bernardo","San Joaquin","San Jose de Maipo","San Miguel","San Ramon","Santiago","Talagante","Tiltil","Vitacura");
ciudades_14 = new Array("Ancud","Calbuco","Castro","Fresia","Frutillar","Llanquihue","Los Muermos","Osorno","Puerto Montt","Puerto Varas","Purranque","Quellon","Rio Negro");
ciudades_15 = new Array("Antofagasta","Calama","Maria Elena","Mejillones","Taltal","Tocopilla");


	function buscar_ciudad(){
    var region
    region = $('#region').val();
    $('#comuna').empty().append('whatever');
    if (region != 0)
    {
        var x = document.getElementById("comuna");
        var option = document.createElement("option");

        comunas = eval("ciudades_" + region);
        for(i=0;i <comunas.length; i++)
        {
           option = document.createElement("option");
           option.text = comunas[i];
           option.value=comunas[i];
           x.add(option, x[i]);
        }
        option.text="Comuna";
        x.add(option,x[0]);
        x.selectedIndex="0";
        x.options[0].disabled = true;
    }
}







</script>
