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
    <script src="layout/scripts/jquery-2.2.1.js"</script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
	<title>Modificar Ficha Clínica Paciente</title>

  <link rel="stylesheet" href="layout/styles/demo.css">
  <link rel="stylesheet" href="layout/styles/form-register.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

	<style type="text/css">
	body,td,th {
	font-size: 10px;
}
    </style>
</head>

  <body background="fondo4.jpg">


    <div class="main-content" background="fondo4.jpg">



        <form class="form-register" method="post" action="#">

            <div class="form-register-with-email">

                <div class="form-white-background">
                <a href="index.php">
                <?php
					echo "<img src=\"images/logotipo2.png\">";

					?>
					<a>
              <div class="form-title-row">

                        <br><h1>Modificar Ficha Clínica</h1>
                    </div>

                    <p style="font-size: 10px; color: #7ec1d2;"> NOTA: Para modificar la ficha de un paciente son de llenado Obligatorios los campos con (*)</p>
                    <br>

                      <div id="num" class="form-row">
                        <label>
                            <span>RUT (*)</span>
               					<input type="text" name="rut" required="">

                        </label>
                    </div>

                    <div id="buscar" class="form-row">
                        <button name="aceptar" type="submit">Buscar</button>
                    </div>

                    <span id="estado"></span>
                    <a id="home" href="consulta.html" class="icon ion-ios-home" style="color:#7ec1d2"></a>

























<?php

if(isset($_POST['aceptar']))
 {

    $conexion=mysqli_connect("localhost","root","","sinamed");
    $sentencia="select *from cliente where rut='".$_POST['rut']."'";
    $query=mysqli_query($conexion,$sentencia);
    $filas=mysqli_num_rows($query);
    if($filas==0)
    {
       echo"<script>alert('Consulta Erronea ')</script>";

    }
    else
    {
         $row=mysqli_fetch_array($query);

        echo "<script>
                $('#num').css('display','none')
                $('#buscar').css('display','none')


         </script>";



                    echo ' <div class="form-row"><label>
                        <span>Regi&oacute;n</span>
                        <select name="region" id="region" onchange="buscar_ciudad()" required>
                            <option value="0" selected="selected" disabled="disable">Regi&oacute;n</option >
                            <option value="1">1 Tarapaca</option>
                            <option value="2">2 Antofagasta</option>
                            <option value="3">3 Atacama</option>
                            <option value="4">4 Coquimbo</option>
                            <option value="5">5 Valparaiso</option>
                            <option value="6">6 OHiggins</option>
                            <option value="7">7 Maule</option>
                            <option value="8">8 Bio - Bio</option>
                            <option value="9">9 Araucania</option>
                            <option value="10">10 Los Lagos</option>
                            <option value="11">11 Aisen</option>
                            <option value="12">12 Magallanes Y Antartica</option>
                            <option value="13">13 Metropolitana</option>
                            <option value="14">14 Los Rios</option>
                            <option value="15">15 Arica y Parinacota</option>
                            <option value='.$row[3].'  selected="selected">'.$row[3].'</option>
                        </select>

                    </label>
                    </div>';

                    $dir =$row['direccion'];
                    $dir = '"'.$dir.'"';

                    echo '<div class="form-row">
                        <label>
                            <span>Comuna</span>
                        <select name="ciudad" id="comuna" required>
                        <option value='.$row[4].'  selected="selected">'.$row[4].'</option></select>
                        </label>
                    </div>
                      <div class="form-row">
                        <label>
                            <span>Direccion</span>
                            <input type="text" id="direccion" name="direccion_ubicacion" value='.$dir.' required="">
                        </label>
                    </div>


                        <div id="mapas">
                        <div id="divMapa">
                        </div>
                        </div>
                    <script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>

                    <div id="mod" class="form-row">
                        <button id="a1" onclick="modificar('.$row[0].')" name="aceptar1" type="">Modificar</button>
                    </div> ';










    }
}


?>



     </div>
        </div>

      </form>

    </div>








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




                         $("#comuna").blur(function(event) {
                            /* Act on the event */
                            mapita()
                        });


                        $("#direccion").blur(function(event) {
                            /* Act on the event */
                            mapita()
                        });

</script>







<script type="text/javascript">




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


function modificar(num)
{



        region=$("#region").val();
        comuna=$("#comuna").val();
        direccion=$("#direccion").val();

        if(direccion=='')alert("faltan datos por ingresar.");

        else
        {


             data=new FormData();

            data.append('rut',num);

            data.append('region',region);
            data.append('comuna',comuna);
            data.append('direccion',direccion);
            data.append('latitud',la);
           data.append('longitud',lo);

            $.ajax({
            data: data,
            url: 'mod_client.php',
            processData: false,
            type: 'POST',
            contentType: false,
            success: function(resp){

             if(resp==1)
             {
                alert("Datos de cliente modificado correctamente.\n Sera redireccionado al menu principal.");
                $(location).attr('href','menu.html');
             }
             else
             {
                alert("Vuelva a intentarlo");
             }
            }
        })
        }


}





</script>

</body>

</html>
