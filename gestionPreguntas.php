<!DOCTYPE html>
<html>
  <head>
  	 <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
  	 <title>Gestionar Preguntas</title>

	 <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  	 <script language="javascript">
		

		var XMLHttpRequestObject = false;  
		XMLHttpRequestObject = new XMLHttpRequest();
		var XMLHttpRequestObjectP = false; 
		XMLHttpRequestObjectP = new XMLHttpRequest();
		var XMLHttpRequestObjectC = false; 
		XMLHttpRequestObjectC = new XMLHttpRequest();

		function insertarPregunta()
		{
		 if(XMLHttpRequestObject)
		   {   
		     
		    XMLHttpRequestObject.onreadystatechange = function()
		    {
		      if (XMLHttpRequestObject.readyState==4)
		      {
		        document.getElementById('insDiv').innerHTML = XMLHttpRequestObject.responseText;
		      }
		    }
		    XMLHttpRequestObject.open("POST","insertarPregunta.php",true);
			XMLHttpRequestObject.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			XMLHttpRequestObject.send("fpreg="+document.getElementById("pregunta").value + "&fresp=" + document.getElementById("respuesta").value + 
										"&fcomp="+document.getElementById("complejidad").value + "&ftema=" + document.getElementById("tema").value );
		  } 
		} 

		function verPreguntas()
		{
		 if(XMLHttpRequestObjectP)
		   {   
		     
		    XMLHttpRequestObjectP.onreadystatechange = function()
		    {
		      if (XMLHttpRequestObjectP.readyState==4)
		      {
		        document.getElementById('pregDiv').innerHTML = XMLHttpRequestObjectP.responseText;
		      }
		    }
		    XMLHttpRequestObjectP.open("GET","verMisPreguntas.php",true);
			XMLHttpRequestObjectP.send(null);
		  } 
		} 

		function iniciarContadores()
		{
			setInterval(actualizarContadores, 5000);
			setInterval(actualizarContadoresJQ, 5000);
		}
		function actualizarContadores()
		{
		 if(XMLHttpRequestObjectC)
		   {   
		     
		    XMLHttpRequestObjectC.onreadystatechange = function()
		    {
		      if (XMLHttpRequestObjectC.readyState==4)
		      {
		        document.getElementById('contLabel').innerHTML = XMLHttpRequestObjectC.responseText;
		      
		      }
		    }
		    XMLHttpRequestObjectC.open("GET","contadorPreguntas.php",true);
			XMLHttpRequestObjectC.send(null);
		  } 
		} 


		function actualizarContadoresJQ()
		{
			var jqxhr = $.get("contadorPreguntas.php", null,
			function(datos){
			 $('#jqContLabel').html(datos);
			});
			jqxhr.fail(function(){
			    $('#jqContLabel').html('El servidor parece que no responde');
			 })
		}

		</script>
 </head>
  <body onLoad = "iniciarContadores()">	
  	<h2>Gestion Preguntas </h2>   
  	<br>    
	  	Sin jQuery: <label id="contLabel"></label><br>
	  	Con jQuery: <label id="jqContLabel"></label>
	  	<br><br>
	<form>                    
		<p> Pregunta: <input type="text"  required id="pregunta" name="fpreg" size="50" value="" placeholder="Ingrese pregunta"/>                
		<p> Respuesta: <input type="text" required id= "respuesta" name="fresp" size="50" value="" placeholder="Ingrese respuesta"/>                
		<p> Complejidad: <select id="complejidad" name = "fcomp">
								<option selected value = "0">Sin Complejidad</option>
								<option value = "1">1</option>
								<option value = "2">2</option>
								<option value = "3">3</option>
								<option value = "4">4</option>
								<option value = "5">5</option>
					 	 </select>
		<p> Tema: <input type="text" id= "tema" required name="ftema" size="50" value="" placeholder="Ingrese tema"/>        			 	
		<p> <input id="insertar" type="button" value = "Crear" onClick="insertarPregunta()"/>

	</form>
	<div id="insDiv"></div>
	<input id="verPreguntas" type="button" value = "Ver" onClick="verPreguntas()"/>
	<div id="pregDiv"></div>
	<br><br>
	<span><a href='layout.html'>Menu Principal</a></span>

  </body>
</html>



