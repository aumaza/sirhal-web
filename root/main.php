<?php  include "../functions/functions.php";
       include "../connection/connection.php";

	session_start();
	$varsession = $_SESSION['user'];
	
	
	$sql = "SELECT nombre FROM usuarios where user = '$varsession'";
	mysqli_select_db('sirhal_web');
        $retval = mysqli_query($conn,$sql);
        
        while($fila = mysqli_fetch_array($retval)){
	  $nombre = $fila['nombre'];
	  
	  }
	  
	$sqla = "SELECT organismo FROM liquidadores where nombreApellido = '$nombre'";
	mysqli_select_db('sirhal_web');
	$valor = mysqli_query($conn,$sqla);
	while($row = mysqli_fetch_array($valor)){
	  $organismo = $row['organismo'];
	}
	
	$query = "SELECT cod_org from organismos where descripcion = '$organismo'";
	mysqli_select_db('sirhal_web');
	$res = mysqli_query($conn,$query);
	while($linea = mysqli_fetch_array($res)){
	  $cod = $linea['cod_org'];
	 
	}
	
	
	
	$ql = "select file_name, user_name, upload_on from files_ok where cod_org = '$cod' order by upload_on desc limit 1";
	mysqli_select_db('sirhal_web');
	$resval = mysqli_query($conn,$ql);
	while($row = mysqli_fetch_array($resval)){
	  $archivo = $row['file_name'];
	  $user = $row['user_name'];
	  $fecha = $row['upload_on'];
	}
	
	if($varsession == null || $varsession = ''){
	echo '<div class="alert alert-danger" role="alert">';
	echo "Usuario o Contraseña Incorrecta. Reintente Por Favor...";
	echo '<br>';
	echo "O no tiene permisos o no ha iniciado sesion...";
	echo "</div>";
	echo '<a href="../logout.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
	die();
	}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <title>eSiral - Panel Usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../icons/actions/im-skype.png" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <?php skeleton(); ?>
	
	
	<!-- Data Table Script -->
<script>
 $(document).ready(function(){
      $('#myTable').DataTable({
      "order": [[1, "asc"]],
      "responsive": true,
      "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "fixedColumns": true,
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
  <!-- END Data Table Script -->
  
  <script>
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
    });
  </script>
  
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
  
  <script >
	function limitText(limitField, limitNum) {
       if (limitField.value.length > limitNum) {
          
           alert("Ha ingresado más caracteres de los requeridos, deben ser: \n" + limitNum);
            limitField.value = limitField.value.substring(0, limitNum);
       }else if(limitField.value.lenght < limitNum){
	  alert("Ha ingresado menos caracteres de los requeridos, deben ser:  \n"  + limitNum);
            limitField.value = limitField.value.substring(0, limitNum);
       }
}
</script>

<script>
function Numeros(string){
//Solo numeros
    var out = '';
    var filtro = '1234567890';//Caracteres validos
	
    //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
    for (var i=0; i<string.length; i++){
       if (filtro.indexOf(string.charAt(i)) != -1){ 
             //Se añaden a la salida los caracteres validos
              out += string.charAt(i);
	     }else{
		alert("ATENCION - Sólo se permiten Números");
	     }
	     }
	
    //Retornar valor filtrado
    return out;
} 
</script>

  
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <button class="btn btn-default navbar-btn"><img src="../icons/apps/accessories-dictionary.png"  class="img-reponsive img-rounded"> Documentación<img src="../icons/actions/arrow-right.png"  class="img-reponsive img-rounded"></button>
        <a href="../1/doc_download/download_res.php?file_name=res24-2004-sirhu.pdf"><button class="btn btn-default navbar-btn"><img src="../icons/apps/acroread.png"  class="img-reponsive img-rounded"> Res. 24/2004</button></a>
        <a href="../1/doc_download/download_res.php?file_name=res_conj_26-2019.pdf"><button class="btn btn-default navbar-btn"><img src="../icons/apps/acroread.png"  class="img-reponsive img-rounded"> Res. Conjunta 26/2019</button></a>
        <a href="../1/doc_download/download_res.php?file_name=dec_645-1995.pdf"><button class="btn btn-default navbar-btn"><img src="../icons/apps/acroread.png"  class="img-reponsive img-rounded"> Decreto 645/1995</button></a>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	<a href="../logout.php"><button class="btn btn-danger navbar-btn"><img src="../icons/actions/go-previous-view.png"  class="img-reponsive img-rounded"> Salir</button></a>
       
      </ul>
    </div>
  </div>
</nav>
 
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    <div class="btn-group-vertical">
      <form action="main.php" method="POST">
      <br>
      <button type="submit" class="btn btn-default btn-sm" name="A"><img src="../icons/actions/user-group-properties.png"  class="img-reponsive img-rounded"> Usuarios</button>
      <button type="submit" class="btn btn-default btn-sm" name="B"><img src="../icons/actions/view-bank.png"  class="img-reponsive img-rounded"> Organismos</button><hr>
      <button type="submit" class="btn btn-default btn-sm" name="C"><img src="../icons/actions/meeting-attending.png"  class="img-reponsive img-rounded"> Liquidadores</button>
      <button type="submit" class="btn btn-default btn-sm" name="D"><img src="../icons/places/server-database.png"  class="img-reponsive img-rounded"> Lotes</button><hr>
      </form>
      </div>
     </div>
    
    <div class="col-sm-8 text-left"> 
      <h1>Bienvenido/a: <?php echo $nombre;?></h1>
      <p>En la cartelera de información verá publicada información importante sobre eSiral y normativas.</p>
      <hr>
     <div class="alert alert-success" role="alert">
      <p><img src="../icons/actions/help-about.png"  class="img-reponsive img-rounded"> Para comenzar a cargar información en sus archivos de lotes, diríjase al botón "Iniciar Lotes" en la barra superior.</p>
      </div>
      <hr>
      <div class="alert alert-success" role="alert">
      <p><img src="../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> No olvide que la fecha límite para cargar lotes en el sistema SIRHU es hasta el 10 de cada mes</p>
      </div>
      <hr>
      <div class="alert alert-success" role="alert">
      <p><img src="../icons/categories/system-help.png"  class="img-reponsive img-rounded"> Ante cualquier duda consulte el "Manual del Usuario" o la normativa vigente publicada en el apartado "Documentación"</p>
     </div>
     
     <?php 
    
    
      if($conn){
      
	 
	  if(isset($_POST['A'])){
	      usuarios($conn);
	  }
	  if(isset($_POST['B'])){
	      organismos($conn);
	  }
	  if(isset($_POST['C'])){
	      liquidadores($conn);
	  }
	  if(isset($_POST['D'])){
	      lotesOk($conn);
	  }
	  if(isset($_POST['E'])){
	      cargarLH2($conn,$cod);
	  }     
      
      
      
      }
      
    ?>
    </div>

    <div class="col-sm-2 sidenav">
      <div class="well">
        <p><img src="../icons/actions/meeting-attending.png"  class="img-reponsive img-rounded"> <strong>Usuario:</strong> <?php echo $nombre ?></p>
      </div>
       <div class="well">
        <p><img src="../icons/apps/clock.png"  class="img-reponsive img-rounded"> <strong>Hora Actual:</strong> <?php echo date("H:i"); ?></p>
      </div>
      <div class="well">
        <p><img src="../icons/actions/view-calendar-day.png"  class="img-reponsive img-rounded"> <strong>Fecha Actual:</strong> <?php echo strftime("%d de %b de %Y"); ?></p>
      </div>
    </div>
        
  </div>
</div>
<br><br>
<footer class="container-fluid text-center">
  <p><strong>eSiral</strong> - <strong>Dirección de Presupuesto y Evaluación de Gastos en Personal</strong> - <strong>Ministerio de Economía de la Nación</strong></p>
</footer>


  
  <!-- Modal Delete-->
		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
					</div>

					<div class="modal-body">
						¿Desea eliminar este registro?
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
						<a class="btn btn-danger btn-ok"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
					</div>
				</div>
			</div>
		</div>

		<script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>
<!-- End Modal Delete -->

</body>
</html>
