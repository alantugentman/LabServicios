<?php

	if (basename($_FILES["fimagen"]["name"]) != "")
	{
		$target_dir = "uploads/";
		$filename = rand() . basename($_FILES["fimagen"]["name"]);
		$target_file = $target_dir . $filename;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Verificar que sea una imagen real
		if(isset($_POST["fregistrar"])) {
		    $check = getimagesize($_FILES["fimagen"]["tmp_name"]);
		    if($check !== false) {
		        echo "<br>El archivo subido es una imagen - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "<br>El archivo no se subió ya que no es una imagen.";
		        $uploadOk = 0;
		    }
		}
		// Verificar si ya existe
		if (file_exists($target_file)) {
		    echo "<br>La imagen no se subio debido a que ya existe.";
		    $uploadOk = 0;
		}
		// Verificar tamaño
		if ($_FILES["fimagen"]["size"] > 500000) {
		    echo "<br>La imagen no se subio debido a que es demasiado grande.";
		    $uploadOk = 0;
		}
		// Verificar extension
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
		    echo "<br>La imagen no se subio debido a que el formato no es soportado, (solo JPG, JPEG, PNG & GIF permitidos).";
		    $uploadOk = 0;
		}
		// Verificar 
		if ($uploadOk == 0) {
		    echo "<br>Lamentablemente su imagen no fue guardada.";
		// Intentar guardar la imagen
		} else {
		    if (move_uploaded_file($_FILES["fimagen"]["tmp_name"], $target_file)) {
		        echo "<br>La imagen ". basename( $_FILES["fimagen"]["name"]). " ha sido guardada.";
		    } else {
		        echo "<br>Lamentablemente su imagen no fue guardada.";
		        $uploadOk = 0;
		    }
		}
	}
	else
	{
	   $uploadOk = 0;
	}

	$valido = 1;
	if (!preg_match("/[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)/", $_POST['femail'])) {
		$valido = 0;
		echo "<br>Error con el email";
	}else {
		//incluimos la clase nusoap.php
		require_once("lib/nusoap.php");
		require_once("lib/class.wsdlcache.php");
				
		//creamos el objeto de tipo soapclient.
		//donde se encuentra el servicio SOAP que vamos a utilizar.
		$soapclient = new nusoap_client( 'http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php?wsdl',true);
				
		//Llamamos la función que habíamos implementado en el Web Service
		//e imprimimos lo que nos devuelve
		$result = $soapclient->call('comprobar', array('x'=>$_POST['femail']));
		
		if($result=="NO"){
			$valido = 0;
			echo "<br>Error el email no esta matriculado";
		}
		else {
				echo "<br> contrasena correcta";
		}
	}
	
	if (!preg_match("/[0-9]{9}/", $_POST['ftelefono'])) {
		$valido = 0;
		echo "<br>Error con el telefono";
	}
	$passLen = strlen($_POST['fpassword']);
	if ($passLen < 6 || $passLen > 15) {
		$valido = 0;
		echo "<br>Error con el password";
	}
	else{
		//incluimos la clase nusoap.php
			require_once("lib/nusoap.php");
			require_once("lib/class.wsdlcache.php");
					
			//creamos el objeto de tipo soapclient.
			//donde se encuentra el servicio SOAP que vamos a utilizar.
			$soapclient = new nusoap_client( 'http://atugentmansistemasweb.hol.es/LabServicios/ComprobarContrasena.php?wsdl',true);
					
			//Llamamos la función que habíamos implementado en el Web Service
			//e imprimimos lo que nos devuelve
			$result = $soapclient->call('comprobar', array('x'=>$_POST['fpassword']));
			
			if($result=="INVALIDA"){
				echo "<br>Error la contrasena es muy sencilla, debe cambiarla";
				$valido=0;
			}
			else {
				echo "<br> contrasena correcta";
			}
			
	}
	if($_POST['fpassword'] != $_POST['fconfirmacion'])
	{
		$valido = 0;
		echo "<br>Error con la confimacion";
	}
	if($_POST['fnombre'] == "" || $_POST['fapellido1'] == "" || $_POST['fapellido2'] == "")
	{
		$valido = 0;
		echo "<br>Error con el nombre o apellidos";
	}

	$esp = $_POST['fespecialidad'];
	if($esp ==  "")
	{
		$valido = 0;
		echo "<br>Error con la especialidad";
	}
	elseif($esp == "Otra")
	{
		if ($_POST['fotraEsp'] == "")
		{
			$valido = 0;
			echo "<br>Error con la especialidad a definir";
		}
		else
		{
			$esp = $_POST['fotraEsp'];
		}
	}

	if($valido == 1)
	{
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
		
		if($uploadOk == 0)
		{
			$sql="INSERT INTO usuario(email, nombre, apellido1, apellido2, password, telefono, especialidad, comentarios) VALUES ('$_POST[femail]','$_POST[fnombre]','$_POST[fapellido1]','$_POST[fapellido2]','$_POST[fpassword]','$_POST[ftelefono]','$esp','$_POST[fcomentarios]')";
			
		}
		else
		{
			$sql="INSERT INTO usuario(email, nombre, apellido1, apellido2, password, telefono, especialidad, comentarios, imagen) VALUES ('$_POST[femail]','$_POST[fnombre]','$_POST[fapellido1]','$_POST[fapellido2]','$_POST[fpassword]','$_POST[ftelefono]','$esp','$_POST[fcomentarios]','$filename')";
		}

		if (!mysqli_query($con, $sql))
		{
			die('Error al registrar el Usuario: ' . mysqli_error($con));
		}
		else
		{
			echo "<br>Usuario registrado correctamente";
			
		}
		mysqli_close($con);
	}
	else
	{
		echo "<br>El usuario no se ha registrado.";
	}
	echo "<br><a href='verUsuarios.php'>Ver usuarios</a>";

?>
