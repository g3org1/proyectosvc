 <?php
   $conexion=mysqli_connect("localhost","root","","bd_scv");

    if(!$conexion){
      die('Error al Conectar a la Base de Datos');
    }

		$Rut = $_POST['run'];
		$Nombre = $_POST['nombre'];
    $Correo = $_POST['correo'];
    $Telefono = $_POST['telefono'];
    $Link = $_POST['link'];
    $Pass = $_POST['pass'];
		$Region_ubicacion = $_POST['region'];
		$direccion = $_POST['direccion_ubicacion'];
		$Ciudad_ubicacion = $_POST['ciudad'];
    $Longitud = $_POST['longitud'];
    $Latitud = $_POST['latitud'];

    $DireccionC = $direccion.",".$Ciudad_ubicacion.",".$Region_ubicacion;


		$query1=mysqli_query($conexion,"select * from clinica where rut_clinica='".$Rut."'");
		$data=mysqli_num_rows($query1);

		if($data>0) echo"0";
      else{
			$sentencia="insert into clinica values ('".$Rut."','".$Nombre."','".$DireccionC."','".$Latitud."','".$Longitud."','".$Telefono."','".$Correo."','".$Link."',0,'','".$Pass."')";

			if (mysqli_query($conexion,$sentencia)){
				    echo "1";
			}else{
				    echo mysqli_errno($conexion) . ": " . mysqli_error($conexion) . "\n";
			};
		}
?>
