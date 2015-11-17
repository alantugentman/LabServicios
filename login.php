<?php
		if (isset($_POST['femail']))
		{
			$email=$_POST['femail']; 
			$pass=$_POST['fpassword']; 

			$valido = 1;
			if (!preg_match("/[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)/", $email)) {
				$valido = 0;
			}
			$passLen = strlen($pass);
			if ($passLen < 6 || $passLen > 15) {
				$valido = 0;
			}

			if($valido)
			{
			
				//$con = mysqli_connect("localhost","root","root1234","quiz");
				$con = mysqli_connect("mysql.hostinger.es","u181699947_root","root1234","u181699947_quiz"); 
				//$con = mysqli_connect("localhost","ramirovi_asw2015","ABPcRBLpTXzS","ramirovi_bdsw2015"); 

				if(!$con)
				{
					echo "<br>Error: No se pudo conectar a MySQL." . PHP_EOL;
			 		echo "<br>Err num de depuracion: " . mysqli_connect_errno() . PHP_EOL;
			 	    echo "<br>Error de depuracion: " . mysqli_connect_error() . PHP_EOL;
				    exit;
				}
				
				$query = "select * from usuario where email ='$email' and password ='$pass'";
				$usuarios = mysqli_query($con, $query); 
				if (!$usuarios)
				{
					die('Error al buscar al Usuario: ' . mysqli_error($con));
					$valido = 0;
				}

				$cont= mysqli_num_rows($usuarios);
				
				if($cont == 0)
				{
					$valido = 0;
				}
				mysqli_close($con); 
			}

			if($valido)
			{
				//$con = mysqli_connect("localhost","root","root1234","quiz");
				$con = mysqli_connect("mysql.hostinger.es","u181699947_root","root1234","u181699947_quiz"); 
				//$con = mysqli_connect("localhost","ramirovi_asw2015","ABPcRBLpTXzS","ramirovi_bdsw2015"); 
				
				if(!$con)
				{
					echo "<br>Error: No se pudo conectar a MySQL." . PHP_EOL;
			 		echo "<br>Err num de depuracion: " . mysqli_connect_errno() . PHP_EOL;
			 	    echo "<br>Error de depuracion: " . mysqli_connect_error() . PHP_EOL;
				    exit;
				}
				
				$hora = date("h:i:sa");
				$sql="INSERT INTO conexiones(email, hora) VALUES ('$email', '$hora')";
				if (!mysqli_query($con, $sql))
				{
					die('Error al registrar la Conexion: ' . mysqli_error($con));
				}

				session_start();
				$_SESSION['idConexion'] = mysqli_insert_id($con);
				mysqli_close($con);
				$_SESSION['email'] = $email;
				$_SESSION['token'] = rand() . rand();

				setcookie("token", $_SESSION['token']);

				$extra = "insertarPregunta.html";
				header("location: $extra");
			}
			else
			{
				echo "<script> alert('Error en la combinacion Email/Contraseña'); </script>";

			}
		}
	?>

<!DOCTYPE html>
<html>
  <head>
  	 <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
  	 <title>Log In</title>
 </head>
  <body>	
	<form action="login.php"  method="post">           
		<h2>Identificación de usuario </h2>                
		<p> Email: <input type="email"  required name="femail" size="21" value="" placeholder="Ingrese Email"/>                
		<p> Password: <input type="password" required name="fpassword" size="21" value="" placeholder="Ingrese password"/>                
		<p> <input id="login" type="submit" value = "Log In" />
	</form>

	<br><br>
	<span><a href='layout.html'>Menu Principal</a></span>
	
</body>
</html>