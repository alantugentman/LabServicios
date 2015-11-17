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
	$usuarios = mysqli_query($con, "select * from usuario" ); 

	echo '<table border=1> <tr> <th> Email </th> <th> Nombre </th> <th> Telefono </th> <th> Especialidad </th> <th> Comentarios </th> <th> Imagen </th></tr>';
		while( $row = mysqli_fetch_array($usuarios)) {
			$imagen = "default.jpg";
			if ($row['Imagen'] != "")
			{
				$imagen = $row['Imagen'];
			}
			echo '<tr><td>' . $row['Email'] . '</td> <td>' . $row['Nombre'] . ' ' . $row['Apellido1'] . ' ' .  $row['Apellido2'] .  '</td> <td>' . $row['Telefono'] . '</td> <td>' . $row['Especialidad'] . '</td> <td>' . $row['Comentarios'] . '</td> <td> <img src="uploads/' .  $imagen . '" alt="Imagen Perfil" height="128" width="128"> </td> </tr>';
		}
	echo '</table>';
	echo "<br><a href='layout.html'>Menu Principal</a>";
	mysqli_close($con);
?>