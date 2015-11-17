<!DOCTYPE html>
<html>
  <head>
  	 <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
  	 <title>Prueba</title>
 </head>
  <body>	
  		<FORM NAME="datos" ID="datos" ACTION= "comprobar.php" METHOD="POST">
<input type='text' name='mail'></input>
<input type='submit' name='comprobar' value='Comprobar'></input>
</form>

<?php
//incluimos la clase nusoap.php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//creamos el objeto de tipo soapclient.
//http://www.mydomain.com/server.php se refiere a la url
//donde se encuentra el servicio SOAP que vamos a utilizar.
$soapclient = new nusoap_client( 'http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php?wsdl',false);

//Llamamos la función que habíamos implementado en el Web Service
//e imprimimos lo que nos devuelve

	if (isset($_POST['mail'])){
		echo '<h1>La comprobacion es: ' . $soapclient->call('comprobar',array( 'name'=>$_POST['mail'],)). '</h1>';
		
	}
	else {
		echo 'No se hizo la comprobacion';
	}
?>

	</body>
</html>


