<?php
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
				echo "<br>Error el email no esta matriculado";
			}
			else {
				echo "<br> Este mail esta matriculado";
			}
			
			
			
			
?>


