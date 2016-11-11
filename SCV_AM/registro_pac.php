 <?php
   $conexion=mysqli_connect("localhost","root","","bd_scv");



    if(!$conexion){
      die('Error al Conectar a la Base de Datos');
    }

		$Rut = $_POST['rut'];
		$Nombre = $_POST['nombre'];
    $Apellido = $_POST['apellido'];
		$Nacimiento = $_POST['nacimiento'];
    $Sexo = $_POST['sexo'];
    $Telefono = $_POST['telefono'];
    $Correo = $_POST['correo'];
    $Foto = $_POST['foto'];
		$Region_ubicacion = $_POST['region'];
		$direccion = $_POST['direccion_ubicacion'];
		$Ciudad_ubicacion = $_POST['ciudad'];

    $NombreC = $Nombre." ".$Apellido;
    $DireccionC = $direccion."-".$Ciudad_ubicacion;

  /*  $ruta = "tmp/".$Foto;*/
    $destino = "fotos/".$Foto;
    echo "$destino";
  /*  move_uploaded_file($ruta,"foto/");*/


		$query1=mysqli_query($conexion,"select * from paciente where rut_paciente='".$Rut."'");
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
