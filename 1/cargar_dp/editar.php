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
	
      $id = $_GET['id'];
      $sql = "SELECT * FROM tb_dp WHERE id = '$id'";
      mysql_select_db('sirhal_web');
      $resultado = mysql_query($sql,$conn);
      $fila = mysql_fetch_assoc($resultado);

?>

<html><head>
	<meta charset="utf-8">
	<title>DP - Editar Registro</title>
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

	
	<script>

      $(document).ready(function(){
      $('#myTable').DataTable({
      "order": [[1, "asc"]],
      "language":{
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrada de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search": "Buscar:",
        "zeroRecords":    "No se encontraron registros coincidentes",
        "paginate": {
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
      }
    });

  });

  </script>
	
</head>
<body background="../../img/main-img.png" class="img-fluid" alt="Responsive image" style="background-repeat: no-repeat; background-position: center center; background-size: cover; height: 100%">

<!-- User and system info -->
<div class="container-fluid">
      <div class="row">
      <div class="col-md-12 text-center"><br>
	<button><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $nombre ?></button>
	<button><span class="glyphicon glyphicon-user"></span> Organismo: <?php echo $organismo ?></button>
	
	<?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-time"></span> <?php echo "Hora Actual: " . date("H:i"); ?></button>
	 <?php setlocale(LC_ALL,"es_ES"); ?>
	<button><span class="glyphicon glyphicon-calendar"></span> <?php echo "Fecha Actual: ". strftime("%d de %B del %Y"); ?> </button>
	</div>
	</div>
	</div>
<!-- end user and system info -->
	<hr>
	
<!-- main body -->
<div class="container"><br>
<div class="row">
<div class="col-sm-12">

<div class="panel panel-info" >
  <div class="panel-heading">
    <h2 class="panel-title text-center text-default "><span class="pull-center "><img src="../../icons/actions/user-group-new.png"  class="img-reponsive img-rounded"> DP - Nuevo Registro</h2>
  </div>
    <div class="panel-body">
   

    
     <form action="formUpdate.php" method="post">
     <input type="hidden" id="id" name="id" value="<?php echo $fila['id']; ?>" />
  
  <div class="input-group">
    <span class="input-group-addon" style="color: blue">Código Archivo</span>
    <input id="text" type="text" class="form-control" name="cod_arch" value="DP" readonly>
  </div><br>
  
  <div class="input-group">
    <span class="input-group-addon" style="color: blue">Lote Número</span>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#NroLote"><span class="glyphicon glyphicon-info-sign"></span> Información</button>
    <input id="text" type="text" class="form-control" name="nro_lote" placeholder="Ingrese nro. de Lote" value="<?php echo $fila['nro_lote']; ?>" required>
    </div>
    <br>
  
  <div class="input-group">
    <span class="input-group-addon" style="color: blue">Período Lote</span>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#PerLote"><span class="glyphicon glyphicon-info-sign"></span> Información</button>
    <input id="text" type="text" class="form-control" name="per_lote" placeholder="AAAAMM" value="<?php echo $fila['per_lote']; ?>" required>
  </div><br>
  
  <div class="input-group">
  <span class="input-group-addon" style="color: blue">Tipo Documento</span>
  <select class="browser-default custom-select" name="tip_doc" required>
  <option value="" disabled selected>Seleccionar</option>
  <option value="LE" <?php if($fila['tipo_dni'] == "LE") echo 'selected'; ?> >Libreta de Enrolamiento</option>
  <option value="DNI"<?php if($fila['tipo_dni'] == "DNI") echo 'selected'; ?> >DNI</option>
  <option value="LC" <?php if($fila['tipo_dni'] == "LC") echo 'selected'; ?>>Libreta Cívica</option>
  <option value="OTS" <?php if($fila['tipo_dni'] == "OTS") echo 'selected'; ?>>Otro Documento</option>
  </select>
  </div><br>
  
  <div class="input-group">
    <span class="input-group-addon" style="color: blue">Nro. DNI</span>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#NroDNI"><span class="glyphicon glyphicon-info-sign"></span> Información</button>
    <input id="text" type="text" class="form-control" name="nro_dni" placeholder="99666444" value="<?php echo $fila['nro_dni']; ?>" required>
  </div><br>
  
   <div class="input-group">
    <span class="input-group-addon" style="color: blue">Apellido y Nombre</span>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#NombreApellido"><span class="glyphicon glyphicon-info-sign"></span> Información</button>
    <input id="text" type="text" class="form-control" name="nombre" placeholder="Apellido y Nombre" value="<?php echo $fila['nombreApellido']; ?>" required>
  </div><br>
  
  <div class="input-group">
    <span class="input-group-addon" style="color: blue">Fecha Nacimiento</span>
    <input id="text" type="date" class="form-control" name="f_nac" value="<?php echo $fila['f_nac']; ?>" required>
  </div><br>
  
  <div class="input-group">
  <span class="input-group-addon" style="color: blue">Sexo</span>
  <select class="browser-default custom-select" name="sexo">
  <option value="" disabled selected>Seleccionar</option>
  <option value="FEM" <?php if($fila['cod_sexo'] == "FEM") echo 'selected'; ?>>Femenino</option>
  <option value="MASC" <?php if($fila['cod_sexo'] == "MASC") echo 'selected'; ?>>Masculino</option>
  </select>
</div><br>

<div class="input-group">
  <span class="input-group-addon" style="color: blue">Estado Civil</span>
  <select class="browser-default custom-select" name="cod_est_civ" required>
  <option value="" disabled selected>Seleccionar</option>
  <option value="CAS" <?php if($fila['cod_est_civ'] == "CAS") echo 'selected'; ?>>Casado/a</option>
  <option value="SOL" <?php if($fila['cod_est_civ'] == "SOL") echo 'selected'; ?>>Soltero/a</option>
  <option value="DIV" <?php if($fila['cod_est_civ'] == "DIV") echo 'selected'; ?>>Divorciado/a</option>
  <option value="UHE" <?php if($fila['cod_est_civ'] == "UHE") echo 'selected'; ?>>Unido/a de Hecho</option>
  <option value="VIU" <?php if($fila['cod_est_civ'] == "VIU") echo 'selected'; ?>>Viudo/a</option>
  <option value="UCI" <?php if($fila['cod_est_civ'] == "UCI") echo 'selected'; ?>>Unión Civil</option>
  <option value="OTS" <?php if($fila['cod_est_civ'] == "OTS") echo 'selected'; ?>>Otros</option>
  </select>
</div><br>

<div class="input-group">
    <span class="input-group-addon" style="color: blue" >Codigo Organismo</span>
    <input id="text" type="text" class="form-control" name="cod_org" value="<?php echo $cod ?>" readonly>
  </div><br>
  
  <div class="input-group">
    <span class="input-group-addon" style="color: blue">Fecha Ingreso</span>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#FI"><span class="glyphicon glyphicon-info-sign"></span> Información</button>
    <input id="text" type="text" class="form-control" name="f_ing" placeholder="AAAAMM" value="<?php echo $fila['f_ing']; ?>" required>
  </div><br>
  
  <div class="input-group">
  <span class="input-group-addon" style="color: blue">Código Nacionalidad</span>
  <select class="browser-default custom-select" name="cod_nac" required>
  <option value="" disabled selected>Seleccionar</option>
  <option value="01" <?php if($fila['cod_nac'] == "01") echo 'selected'; ?>>Argentino Nativo</option>
  <option value="02" <?php if($fila['cod_nac'] == "02") echo 'selected'; ?>>Argentino Naturalizado</option>
  <option value="03" <?php if($fila['cod_nac'] == "03") echo 'selected'; ?>>Extranjero</option>
  <option value="04" <?php if($fila['cod_nac'] == "04") echo 'selected'; ?>>Argentino por Opción</option>
  <option value="90" <?php if($fila['cod_nac'] == "90") echo 'selected'; ?>>Otra</option>
  </select>
</div><br>

<div class="input-group">
  <span class="input-group-addon" style="color: blue">Nivel Educativo</span>
  <select class="browser-default custom-select" name="cod_niv_edu" required>
  <option value="" disabled selected>Seleccionar</option>
  <option value="EP" <?php if($fila['cod_niv_edu'] == "EP") echo 'selected'; ?>>Educación Primaria</option>
  <option value="ES" <?php if($fila['cod_niv_edu'] == "ES") echo 'selected'; ?>>Educación Secundaria</option>
  <option value="ET" <?php if($fila['cod_niv_edu'] == "ET") echo 'selected'; ?>>Educación Terciaria</option>
  <option value="EU" <?php if($fila['cod_niv_edu'] == "EU") echo 'selected'; ?>>Educación Universitaria y Superior</option>
  <option value="OT" <?php if($fila['cod_niv_edu'] == "OT") echo 'selected'; ?>>Otra Area Educativa</option>
  </select>
</div><br>

  
  <div class="input-group">
    <span class="input-group-addon" style="color: blue">Título Obtenido</span>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#TitObtenido"><span class="glyphicon glyphicon-info-sign"></span> Información</button>
    <input id="text" type="text" class="form-control" name="desc_tit" placeholder="Describa el Título Obtenido" value="<?php echo $fila['desc_tit']; ?>" required>
  </div><br>
  
   <div class="input-group">
     <span class="input-group-addon" style="color: blue">Cuit/Cuil</span>
     <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#CUIL"><span class="glyphicon glyphicon-info-sign"></span> Información</button>
    <input  type="text" class="form-control" name="cuit_cuil" placeholder="209996664440" value="<?php echo $fila['cuil_cuit']; ?>" required>
  </div><br>
  
  
  <div class="input-group">
  <span class="input-group-addon" style="color: blue">Sistema Previsional</span>
  <select class="browser-default custom-select" name="sist_prev" required>
  <option value="" disabled selected>Seleccionar</option>
  <option value="R" <?php if($fila['sist_prev'] == "R") echo 'selected'; ?>>Reparto</option>
  <option value="C" <?php if($fila['sist_prev'] == "C") echo 'selected'; ?>>Capitalización</option>
  </select>
</div><br>

<div class="input-group">
  <span class="input-group-addon" style="color: blue">Codigo Sistema Previsonal</span>
  <select class="browser-default custom-select" name="cod_sist_prev" required>
  <option value="" disabled selected>Seleccionar</option>
  <option value="20" <?php if($fila['cod_sist_prev'] == "20") echo 'selected'; ?>>AFJP - Consolidar</option>
  <option value="21" <?php if($fila['cod_sist_prev'] == "21") echo 'selected'; ?>>AFJP - Siembra</option>
  <option value="22" <?php if($fila['cod_sist_prev'] == "22") echo 'selected'; ?>>AFJP - Orígenes</option>
  <option value="24" <?php if($fila['cod_sist_prev'] == "24") echo 'selected'; ?>>AFJP - Profsion + Auge</option>
  <option value="26" <?php if($fila['cod_sist_prev'] == "26") echo 'selected'; ?>>AFJP - Máxima</option>
  <option value="29" <?php if($fila['cod_sist_prev'] == "29") echo 'selected'; ?>>AFJP - Arauca Bit</option>
  <option value="34" <?php if($fila['cod_sist_prev'] == "34") echo 'selected'; ?>>AFJP - Futura</option>
  <option value="37" <?php if($fila['cod_sist_prev'] == "37") echo 'selected'; ?>>AFJP - Nación</option>
  <option value="39" <?php if($fila['cod_sist_prev'] == "39") echo 'selected'; ?>>AFJP - Previsol</option>
  <option value="40" <?php if($fila['cod_sist_prev'] == "40") echo 'selected'; ?>>AFJP - Pro-Renta</option>
  <option value="41" <?php if($fila['cod_sist_prev'] == "41") echo 'selected'; ?>>AFJP - MET</option>
  <option value="42" <?php if($fila['cod_sist_prev'] == "42") echo 'selected'; ?>>AFJP - Unidos</option>
  <option value="90" <?php if($fila['cod_sist_prev'] == "90") echo 'selected'; ?>>Otra Caja o AFJP</option>
  </select>
</div><br>

  <div class="input-group">
     <span class="input-group-addon" style="color: blue">Código Obra Social</span>
    <input  type="text" class="form-control" name="cod_ob_soc" value="<?php echo $fila['cod_ob_soc']; ?>" required>
  </div><br>
  
  <div class="input-group">
     <span class="input-group-addon" style="color: blue">Nro. Afiliado</span>
    <input  type="text" class="form-control" name="nro_afi" value="<?php echo $fila['nro_afi']; ?>" required>
  </div>
  <br>
  
  <div class="input-group">
  <span class="input-group-addon" style="color: blue">Tipo Horario Laboral</span>
  <select class="browser-default custom-select" name="tip_hor" required>
  <option value="" disabled selected>Seleccionar</option>
  <option value="1" <?php if($fila['tip_hor'] == "1") echo 'selected'; ?>>Jornada Legal</option>
  <option value="2" <?php if($fila['tip_hor'] == "2") echo 'selected'; ?>>Horario Reducido</option>
  <option value="3" <?php if($fila['tip_hor'] == "3") echo 'selected'; ?>>Otros Horarios Especiales</option>
  </select>
</div><br><hr>
  
  <div class="form-group">
   <div class="col-sm-offset-2 col-sm-12" align="left">
   <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>  Editar</button>
   <a href="cargar_dp.php"><input type="button" value="Volver" class="btn btn-primary"></a>
   <a href="../main.php"><input type="button" value="Volver al Menú Principal" class="btn btn-primary"></a>
  </div>
  </div>
</form> 

    
    </div>
    <br>
    
   <!-- Modal Nro. Lote-->
<div id="NroLote" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lote Número</h4>
      </div>
      <div class="modal-body">
        <p>El número de lote debe tener 3 dígitos.</p>
	<p>Si es el primer lote que carga entonces deberá ingresarlo asi: 001.</p>
	<p>Hasta llegar al número 999.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal Nro. Lote-->


<!-- Modal Periodo Lote-->
<div id="PerLote" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Período del Lote</h4>
      </div>
      <div class="modal-body" align="center">
        <p>El período está formado por el Año y el mes.</p>
	<p>Por ejemplo, si desea ingresar Enero del 2020, será: 202001</p>
	<p>Debe respetar este formato de lo contrario al ingresar los datos de otra manera, obtendrá error al procesar el lote luego.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal Periodo Lote-->

<!-- Modal Nro. DNI-->
<div id="NroDNI" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Número de DNI</h4>
      </div>
      <div class="modal-body" align="center">
        <p>No introduzca ni puntos ni comas para delimitar el dni, debe tipearlo sin espacios.</p>
	<p>Ejemplo: 20789456</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal Nro. DNI-->
    
    <!-- Modal Nombre y Apellido-->
<div id="NombreApellido" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nombre y Apellido</h4>
      </div>
      <div class="modal-body" align="center">
        <p>Deberá ingresar primero el Apellido y luego el Nombre.</p>
	<p>No separe el Apellido del nombre por comas ni guiones, solo por espacios.</p>
	<p>Ejemplo: Gonzalez Marcos</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal Nombre y Apellido-->
    
<!-- Modal Titulo Obtenido-->
<div id="TitObtenido" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Título Obtenido</h4>
      </div>
      <div class="modal-body" align="center">
        <p>Al igual que en Nombre y Apellido,</p>
	<p>No separe por comas ni guiones, solo por espacios.</p>
	<p>Ejemplo: Licenciatura en Psicología</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal Titulo Obtenido-->

<!-- Modal Cuil-->
<div id="CUIL" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CUIL-CUIT</h4>
      </div>
      <div class="modal-body" align="center">
        <p>Al igual que en el ingreso del DNI</p>
	<p>No separe por comas ni guiones,ingrese los números sin espacios.</p>
	<p>Ejemplo: 20996664440</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal Cuil-->

<!-- Modal FI-->
<div id="FI" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Fecha de Ingreso</h4>
      </div>
      <div class="modal-body" align="center">
        <p>Al igual que en el ingreso del Período del Lote,</p>
	<p>No separe por comas ni guiones,ingrese los números sin espacios, si desea ingresar Febrero de 1996</p>
	<p>Ejemplo: 199602</p>
	<p>En el caso que sea un contrato, se indicará la fecha de inicio del contrato vigente.-</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- End Modal FI-->
    

</div>
</div>
</div>
</div>


</body>
</html>