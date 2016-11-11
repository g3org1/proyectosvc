<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Iniciar</title>

	<link rel="stylesheet" href="layout/styles/demo.css">
	<link rel="stylesheet" href="layout/styles/form-register.css">

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

                        <br><h1>Ingreso de usuarios</h1><br>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Rut usuario</span>
                            <input type="text" name="rut">
                        </label>
                    </div>
                    <div class="form-row">
                        <label>
                            <span>Contraseña</span>
                            <input type="password" name="clave">
                        </label>
                    </div>

                    <div class="form-row">
                        <button name="ingresar" type="submit">Ingresar</button>
                    </div>
										<p><a href="registrar-usu.php">Registrarse</a>

										</p>



        </form>

    </div>

</body>

</html>





<?php


   $conexion=mysqli_connect("localhost","root","","bd_impah");
	if(isset($_POST['ingresar']))
	{

		$rut=$_POST['rut'];
		$clave=$_POST['clave'];

		if($rut=='' or $clave=='')echo "Ingrese sus datos de acceso";

		else
		{
			$s="select count(*) from usuario where rut_usuario='".$rut."'";
			$row=mysqli_fetch_row(mysqli_query($conexion,$s));
			$row= $row[0];
			if($row==0)echo "El usuario ingresado no existe";

			else
			{
				$s="select clave from usuario where rut_usuario='".$rut."'";
				$row=mysqli_fetch_array(mysqli_query($conexion,$s));

				if($clave==$row[0])header('location: menu.html');
				else echo "Usuario y/o contraseña incorrecta";
			}
		}
	}
?>
