<?php include "../../connection/connection.php";

session_start();
	$varsession = $_SESSION['user'];
	
	$sql = "SELECT nombre FROM usuarios where user = '$varsession'";
	mysql_select_db('sirhal_web');
        $retval = mysql_query($sql);
        while($fila = mysql_fetch_array($retval)){
	  $nombre = $fila['nombre'];
	  
	  }
	  
	$sqla = "SELECT organismo FROM liquidadores where nombreApellido = '$nombre'";
	mysql_select_db('sirhal_web');
	$valor = mysql_query($sqla);
	while($row = mysql_fetch_array($valor)){
	  $organismo = $row['organismo'];
	}
		
	$query = "SELECT cod_org from organismos where descripcion = '$organismo'";
	mysql_select_db('sirhal_web');
	$res = mysql_query($query);
	while($linea = mysql_fetch_array($res)){
	  $cod = $linea['cod_org'];
	 
	}
	
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
      $id = $_GET['id'];
      $sql = "SELECT * FROM tb_dp WHERE id = '$id'";
      mysql_select_db('sirhal_web');
      $resultado = mysql_query($sql,$conn);
      $fila = mysql_fetch_assoc($resultado);
      }else{
	echo '<div class="alert alert-danger" role="alert">';
	echo 'Could not Connect: ' . mysql_error();
	echo "</div>";
      }

?>


<html><head>
	<meta charset="utf-8">
	<title>Datos Actualizados</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../../icons/actions/im-skype.png" />
	<link rel="stylesheet" href="/sirhal-web/skeleton/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/sirhal-web/skeleton/css/bootstrap-theme.css" >
	<link rel="stylesheet" href="/sirhal-web/skeleton/css/bootstrap-theme.min.css" >
	<link rel="stylesheet" href="/sirhal-web/skeleton/css/fontawesome.css">
	<link rel="stylesheet" href="/sirhal-web/skeleton/css/fontawesome.min.css" >
	<link rel="stylesheet" href="/sirhal-web/skeleton/css/jquery.dataTables.min.css" >

	<script src="/sirhal-web/skeleton/js/jquery-3.4.1.min.js"></script>
	<script src="/sirhal-web/skeleton/js/bootstrap.min.js"></script>
		
	<script src="/sirhal-web/skeleton/js/jquery.dataTables.min.js"></script>
	<script src="/sirhal-web/skeleton/js/dataTables.editor.min.js"></script>
	<script src="/sirhal-web/skeleton/js/dataTables.select.min.js"></script>
	<script src="/sirhal-web/skeleton/js/dataTables.buttons.min.js"></script>

	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet"  type="text/css" media="screen" href="login.css" />
	
	
	
</head>
<body background="../../img/main-img.png" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover; height: 100%">

<div class="container-fluid"><br>
      <div class="row">
      <div class="col-md-12 text-center">
	<button><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $nombre ?></button>
	<button><span class="glyphicon glyphicon-user"></span> Organismo: <?php echo $organismo ?></button>
	<?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-time"></span> <?php echo "Hora Actual: " . date("H:i"); ?></button>
	 <?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-calendar"></span> <?php echo "Fecha Actual: ". strftime("%d de %B del %Y"); ?> </button>
	</div>
	</div>
	</div>
	<br><hr>

    <div class="container">
    <div class="main">
    
    
    <?php
    
    if($conn){
		$id = mysql_real_escape_string($_POST["id"], $conn);
		$cod_arch = mysql_real_escape_string($_POST["cod_arch"], $conn);
		$nro_lote = mysql_real_escape_string($_POST["nro_lote"], $conn);
		$per_lote = mysql_real_escape_string($_POST["per_lote"], $conn);
		$tip_doc = mysql_real_escape_string($_POST["tip_doc"], $conn);
		$nro_dni = mysql_real_escape_string($_POST["nro_dni"], $conn);
		$nombre = mysql_real_escape_string($_POST["nombre"], $conn);
		$f_nac = mysql_real_escape_string($_POST["f_nac"], $conn);
		$sexo = mysql_real_escape_string($_POST["sexo"], $conn);
		$cod_est_civ = mysql_real_escape_string($_POST["cod_est_civ"], $conn);
		$cod_inst = mysql_real_escape_string($_POST["cod_org"], $conn);
		$f_ing = mysql_real_escape_string($_POST["f_ing"], $conn);
		$cod_nac = mysql_real_escape_string($_POST["cod_nac"], $conn);
		$cod_niv_edu = mysql_real_escape_string($_POST["cod_niv_edu"], $conn);
		$desc_tit = mysql_real_escape_string($_POST["desc_tit"], $conn);
		$cuit_cuil = mysql_real_escape_string($_POST["cuit_cuil"], $conn);
		$sist_prev = mysql_real_escape_string($_POST["sist_prev"], $conn);
		$cod_sist_prev = mysql_real_escape_string($_POST["cod_sist_prev"], $conn);
		$cod_ob_soc = mysql_real_escape_string($_POST["cod_ob_soc"], $conn);
		$nro_afi = mysql_real_escape_string($_POST["nro_afi"], $conn);
		$tip_hor = mysql_real_escape_string($_POST["tip_hor"], $conn);
			
		$sqlInsert = "UPDATE tb_dp SET cod_arch='$cod_arch',nro_lote='$nro_lote',per_lote='$per_lote',tipo_dni='$tip_doc',nro_dni='$nro_dni',
		nombreApellido='$nombre',f_nac='$f_nac',cod_sexo='$sexo',cod_est_civ='$cod_est_civ',cod_inst='$cod_inst',f_ing='$f_ing',
		cod_nac='$cod_nac',cod_niv_edu='$cod_niv_edu',desc_tit='$desc_tit',cuil_cuit='$cuit_cuil',sist_prev='$sist_prev',
		cod_sist_prev='$cod_sist_prev',cod_ob_soc='$cod_ob_soc',nro_afi='$nro_afi',tip_hor='$tip_hor' WHERE id = '$id'";
		
  			
mysql_select_db('sirhal_web');
$q = mysql_query($sqlInsert,$conn);

if(!$q)
{
	 echo '<div class="alert alert-danger" role="alert">';
         echo 'Could not enter data: ' . mysql_error();
         echo "</div>";
}

else
  {
    echo '<div class="alert alert-success" role="alert">';
    echo "Registro Actualizado Exitosamente!!";
    echo "</div>";
    echo '<hr> <a href="cargar_dp.php"><input type="button" value="Volver a Cargar DP" class="btn btn-primary"></a>';
}
}

else 
	//cerramos la conexion
	
	mysql_close($conn);

	 	
	  	
    
    ?>
    </div>
    </div>




</body>
</html>