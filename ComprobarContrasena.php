<?php
		//incluimos la clase nusoap.php
		require_once("lib/nusoap.php");
		require_once("lib/class.wsdlcache.php");
		
		//creamos el objeto de tipo soap_server
		$ns="http://atugentmansistemasweb.hol.es/LabServicios/ComprobarContrasena.php?wsdl";
		$server = new soap_server;
		$server->configureWSDL('comprobar',$ns);
		$server->wsdl->schemaTargetNamespace=$ns;
		
		//registramos la función que vamos a implementar
		$server->register('comprobar',array('x'=>'xsd:string'),array('z'=>'xsd:string'),$ns);
		
		//implementamos la función
		function comprobar ($x){
			$esta = "VALIDA";
			$archivo = fopen("toppasswords.txt","r");
			
			//no se esta haciendo bien la comparacion en el bucle
			while(!feof($archivo)){
				$linea = fgets($archivo);
				if(strcmp($x,$linea)==0){
					$esta="INVALIDA";
				}
			}
			fclose($archivo);
			return $x ;
		}
		
		//llamamos al método service de la clase nusoap
		$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
		$server->service($HTTP_RAW_POST_DATA);
?>
