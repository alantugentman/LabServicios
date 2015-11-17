<!DOCTYPE html>
<html>
  <head>
  	 <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
  	 <title>Ver Preguntas</title>
 </head>
  <body>	
  		<div>
  		<h2>Tabla de preguntas</h2>
  		<br>
		<?php	
		echo "<table style='width:100%'>"; 
		echo "<tr>";
		echo "<th>Enunciado</th>";
		echo "<th>Complejidad</th>";
		echo "<th>Tema</th>";
		echo "</tr>";

			$xml = simplexml_load_file('XML/preguntas.xml'); 
			foreach ($xml->xpath('//assessmentItem') as $pregunta)
			{ 

			  echo "<tr>";
			  echo "<td>". $pregunta->itemBody->p . "</td>";
			  echo "<td>". utf8_decode($pregunta['complexity']) . "</td>";
			  echo "<td>". utf8_decode($pregunta['subject']) . "</td>";
			  echo "</tr>";

			}
		echo "<br>";
		echo "</table>";

		?>
		<br><br>
		<span><a href='layout.html'>Menu Principal</a></span>

	</body>
</html>
