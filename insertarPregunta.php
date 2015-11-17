

<?php
	if (isset($_POST['fpreg']))
	{
		session_start();
		if(isset($_SESSION['token']) && $_SESSION['token'] != "" && $_SESSION['token'] == $_COOKIE['token'])
		{
			$valido = 1;
			$pregLen = strlen($_POST['fpreg']);
			if ($pregLen < 1 || $pregLen > 50) {
				$valido = 0;
			}
			$respLen = strlen($_POST['fresp']);
			if ($respLen < 1 || $respLen > 50) {
				$valido = 0;
			}

			if ($valido)
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
				
		
				$sql="INSERT INTO pregunta(autor, pregunta, respuesta, complejidad) VALUES ('$_SESSION[email]','$_POST[fpreg]','$_POST[fresp]','$_POST[fcomp]')";
					
				if (!mysqli_query($con, $sql))
				{
					die('Error al registrar la Pregunta: ' . mysqli_error($con));
				}
				else
				{
					
					insertarXML($_POST['fpreg'], $_POST['fresp'], $_POST['fcomp'], $_POST['ftema']);
					echo "<br>Pregunta registrada correctamente";

					$tipo = "Insertar";
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
				}
				mysqli_close($con);
		
			}
			else
			{
				echo "Error al registrar la Pregunta.";
			}
		}	
		else
		{
			echo "<br>Debes estar logueado para registrar la pregunta.";
		}
	}

	function insertarXML($enun, $resp, $complejidad, $subject)
	{
		$xml = simplexml_load_file('XML/preguntas.xml');

		$pregunta = $xml->addChild('assessmentItem');
		$pregunta->addAttribute('complexity', $complejidad);
		$pregunta->addAttribute('subject', $subject);

		$enunciado = $pregunta->addChild('itemBody');
		$enunciado->addChild('p', $enun);
		
		$respuesta = $pregunta->addChild('correctResponse');
		$respuesta->addChild('value', $resp);

		$xml->asXML('XML/preguntas.xml');
	};
?>

