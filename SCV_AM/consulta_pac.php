<?php
$conexion=mysqli_connect("localhost","root","","bd_scv");

 if(!$conexion){
   die('Error al Conectar a la Base de Datos');
 }

 $Rut = $_POST['rut'];

 $nombre = mysqli_query($conexion,"     select nombre_paciente
                                        from  paciente
                                        where rut_paciente='".$Rut."'");

$nacimiento = mysqli_query($conexion,"  select fecha_nac
                                        from  paciente
                                        where rut_paciente='".$Rut."'");
$foto_e = mysqli_query($conexion,"      select foto
                                        from  paciente
                                        where rut_paciente='".$Rut."'");
 $data=mysqli_num_rows($query1);

 if($data>0) echo"0";
   else{
   $sentencia="insert into paciente values ('".$Rut."','".$NombreC."','".$Nacimiento."','".$Sexo."','".$DireccionC."','".$Telefono."','".$Correo."','".$destino."')";

   if (mysqli_query($conexion,$sentencia)){
         echo "1";
   }else{
         echo mysqli_errno($conexion) . ": " . mysqli_error($conexion) . "\n";
   };
 }
 ?>
