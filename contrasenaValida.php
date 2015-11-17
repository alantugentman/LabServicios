<?php
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
			}
			else {
				echo "<br> contrasena correcta";
			}
			
			
		
			
?>


