<!DOCTYPE html>
<html>
  <head>
  	 <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
  	 <title>Ver Preguntas</title>
 </head>
  <body>	
  		<div>
  		<h2>Seleccione una pregunta</h2>
  		<br>
  		<select name="pregunta">
			<?php 


			//$con = mysqli_connect("localhost","root","","quiz");
			$con = mysqli_connect("mysql.hostinger.es","u181699947_root","root1234","u181699947_quiz"); 
			//$con = mysqli_connect("localhost","ramirovi_asw2015","ABPcRBLpTXzS","ramirovi_bdsw2015"); 
			 
			if(!$con)
			{
				echo "<br>Error: No se pudo conectar a MySQL." . PHP_EOL;
		 		echo "<br>Err num de depuracion: " . mysqli_connect_errno() . PHP_EOL;
		 	    echo "<br>Error de depuracion: " . mysqli_connect_error() . PHP_EOL;
			    exit;
			}
			
			$sql = "select * from pregunta";
			$quizes = mysqli_query($con, $sql); 

			while ($row = mysqli_fetch_array($quizes)){
			?>

			<option value = <?php echo $row['id']; ?> > <?php echo $row['pregunta'] . " - Comp: " . $row['complejidad']; ?></option>

			<?php
			// cerrar while loop 
			}

			mysqli_close($con);
			?>
		</select>
		<br><br>
		<span><a href='layout.html'>Menu Principal</a></span>

		<?php
			//$con = mysqli_connect("localhost","root","","quiz");
			$con = mysqli_connect("mysql.hostinger.es","u181699947_root","root1234","u181699947_quiz"); 
			//$con = mysqli_connect("localhost","ramirovi_asw2015","ABPcRBLpTXzS","ramirovi_bdsw2015"); 
			if(!$con)
			{
				echo "<br>Error: No se pudo conectar a MySQL." . PHP_EOL;
			 	echo "<br>Err num de depuracion: " . mysqli_connect_errno() . PHP_EOL;
			 	echo "<br>Error de depuracion: " . mysqli_connect_error() . PHP_EOL;
				exit;
			}
			session_start();
			
			$tipo = "Ver";
			$hora = date("h:i:sa");
			$ip = $_SERVER['REMOTE_ADDR'];

			if(isset($_SESSION['idConexion']) && isset($_SESSION['email']))
			{
				$idConexion = $_SESSION['idConexion'];
				$email = $_SESSION['email'];
				$sql="INSERT INTO acciones(idConexion, email, tipo, hora, ip) VALUES ('$idConexion','$email', '$tipo', '$hora', '$ip')";			
			}
			else
			{
				$sql="INSERT INTO acciones(tipo, hora, ip) VALUES ('$tipo', '$hora', '$ip')";
			}
			
			if (!mysqli_query($con, $sql))
			{
				die('Error al registrar la Accion: ' . mysqli_error($con));
			}
			mysqli_close($con);
		?>
	</body>
</html>