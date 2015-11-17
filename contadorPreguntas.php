
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

session_start();
$sqlMias = "select * from pregunta where autor = '".$_SESSION["email"]. "'";
$quizesMias = mysqli_query($con, $sqlMias);
$contMias = mysqli_num_rows($quizesMias);

$sqlTotales = "select * from pregunta";
$quizesTotales = mysqli_query($con, $sqlTotales);
$contTotales = mysqli_num_rows($quizesTotales);
mysqli_close($con);

echo "Mis Preguntas/Total Preguntas: " . $contMias . "/". $contTotales;
?>

