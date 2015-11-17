<?php
		//incluimos la clase nusoap.php
		require_once("lib/nusoap.php");
		require_once("lib/class.wsdlcache.php");
		
		//creamos el objeto de tipo soap_server
		$ns="http://atugentmansistemasweb.hol.es/LabServicios/samples";
		$server = new soap_server;
		$server->configureWSDL('contrasenaValida',$ns);
		$server->wsdl->schemaTargetNamespace=$ns;
		
		//registramos la función que vamos a implementar
		$server->register('contrasenaValida',array('aprobar'=>'xsd:string'),array('z'=>'xsd:string'),$ns);
		
		//implementamos la función
		function contrasenaValida ($aprobar){
			$esta = "VALIDA";
			$myfile = fopen("toppasswords.txt","r");
			
			while(!feof($myfile)){
				$linea = fgets($myfile);
				if($aprobar==$linea){
					$esta="INVALIDA";
				}
			}			
				
			return $esta;
		}
		
		//llamamos al método service de la clase nusoap
		$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
		$server->service($HTTP_RAW_POST_DATA);
?>
