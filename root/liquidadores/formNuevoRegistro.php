<?php include "../../connection/connection.php";
      include "../../functions/functions.php";

	session_start();
	$varsession = $_SESSION['user'];
	
	if($varsession == null || $varsession = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../../index.html"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}

if($conn){

		createTableLiquidadores($conn);
		$nombre = mysqli_real_escape_string($conn,$_POST["nombre"]);
		$sexo = mysqli_real_escape_string($conn,$_POST["sexo"]);
		$dni = mysqli_real_escape_string($conn,$_POST["dni"]);
		$email = mysqli_real_escape_string($conn,$_POST["email"]);
		$telefono = mysqli_real_escape_string($conn,$_POST["telefono"]);    
		$organismo = mysqli_real_escape_string($conn,$_POST["organismo"]);
	
$sqlInsert = "INSERT INTO liquidadores ".
"(nombreApellido,sexo,dni,email,telefono,organismo)".
"VALUES ".
"('$nombre','$sexo','$dni','$email','$telefono','$organismo')";


$q = mysqli_query($conn,$sqlInsert);
}else{
 echo '<div class="alert alert-danger" role="alert">';
  echo 'Could not Connect to Database: ' . mysqli_error($conn);
  echo "</div>";
}

?>

<html><head>
	<meta charset="utf-8">
	<title>Liquidador Guardado</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../../icons/actions/im-skype.png" />
	<?php skeleton();?>
	
	<!-- block mouse left-button   -->
  <script>
      $(document).bind("contextmenu",function(e) {
    e.preventDefault();
    });
  </script>
<!-- block F12 development mode -->
  <script>
      $(document).keydown(function(e){
	if(e.which === 123){
	  return false;
	}
    });
  </script>
	
	
</head>
<body background="../../img/main-img.png" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover; height: 100%">

<div class="container-fluid"><br>
      <div class="row">
      <div class="col-md-12 text-center">
	<button><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $_SESSION['user'] ?></button>
	<?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-time"></span> <?php echo "Hora Actual: " . date("H:i"); ?></button>
	 <?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-calendar"></span> <?php echo "Fecha Actual: ". strftime("%d de %B del %Y"); ?> </button>
	</div>
	</div>
	</div>
	<br><hr>


            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        

<?php



if(!$q)
{
 
  echo '<div class="alert alert-danger" role="alert">';
  echo 'Could not enter data: ' . mysqli_error($conn);
  echo "</div>";
  echo '<meta http-equiv="refresh" content="5;URL=http:../main.php "/>';
  //echo '<hr> <a href="liquidadores.php"><input type="button" value="Volver a Liquidadores" class="btn btn-primary"></a>';
 
}

else
{
   
    echo '<div class="alert alert-success" role="alert">';
    echo "Registro Guardado Exitosamente!! Espere que será redirigido";
    echo "</div>";
    echo '<meta http-equiv="refresh" content="5;URL=http:../main.php "/>';
    //echo '<hr> <a href="liquidadores.php"><input type="button" value="Volver a Liquidadores" class="btn btn-primary"></a>';
}



	//cerramos la conexion
	
	mysqli_close($conn);

    
?>
</div>
</div>
</div>




</body>
</html>

