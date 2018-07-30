<!-- Permisos de acceso-->
<?php 

	//ini_set('max_execution_time', 0); 
	include "base/permisosadmin.php"; 
?>
<!-- ENDS Permisos de acceso -->

<!doctype html>
<html class="no-js">
<head>
	<!-- LibreriasElementales-->
	<?php 
		include "base/librerias.php"; 
	?>
	<!-- ENDS LibreriasElementales -->

	<!-- librerias para estilo de tabla de consulta -->
	<?php 
		include "base/librerias-tabla.php"; 

	?>
		
	<link href="multiupload/css/uploadfile.css" rel="stylesheet">
	<script src="multiupload/js/jquery.min.js"></script>
	<script src="multiupload/js/jquery.uploadfile.js"></script>
	<script>
$(document).ready(function()
{

	$("#fileuploader").uploadFile({
	url:"multiupload/php/upload.php",
	fileName:"myfile",
    returnType: "json",
	allowedTypes:"pdf",
	showProgress:true,
	showAbort: true,
	dragDropStr: "<span><b>Arrastra aquì los archivos</b></span>",
	abortStr: "Abortar",
    cancelStr: "Cancelar",
    deletelStr: "Eliminar",
    doneStr: "Subido",
    multiDragErrorStr: "NO ESTA DISPONIBLE.",
    extErrorStr: "is not allowed. Allowed extensions: ",
    sizeErrorStr: "is not allowed. Allowed Max size: ",
    uploadErrorStr: "Upload is not allowed",
    maxFileSize:-1,
    maxFileCountErrorStr: " is not allowed. Maximum allowed files are:",
    error: function (xhr, status, errMsg) {}
	});

	$("#fileuploader2").uploadFile({
	url:"multiupload/php/upload2.php",
	fileName:"myfile",
	allowedTypes:"pdf",
	showProgress:true,
	showAbort: false,
	dragDropStr: "<span><b>Arrastra aquì los archivos</b></span>",
	abortStr: "Abortar",
    cancelStr: "Cancelar",
    deletelStr: "Eliminar",
    doneStr: "Subido",
    multiDragErrorStr: "NO ESTA DISPONIBLE.",
    extErrorStr: "is not allowed. Allowed extensions: ",
    sizeErrorStr: "is not allowed. Allowed Max size: ",
    uploadErrorStr: "Upload is not allowed",
    maxFileSize: -1,
    maxFileCountErrorStr: " is not allowed. Maximum allowed files are:"


	});
});
</script>
</head>

<body lang="es">
	<!-- Encabezado-->
	<?php 
		include "base/menu.php"; 
	?>
	<!-- ENDS Encabezado -->

	<!-- Tabla que muestra el unicio de Sesion -->
	<?php 
		include "base/tablasesion.php"; 
	?>
	<!-- ENDS Tabla que muestra el unicio de Sesion -->

		<!-- MAIN -->
		<div id="main">	
			<!-- wrapper clearfix" -->
			<div class="wrapper clearfix">
	        	
				<!-- page content -->
	        	<div id="page-content" class="clearfix">
					
					<!-- fullwidth content -->
					<div class="fullwidth-content">
							<h2 class="page-heading">
								<!-- Titulo Pagina -->
									<span>SUBIR DOCUMENTO</span>
								<!-- ENDS Titulo Pagina -->
							</h2>
						
						<!-- Contenido -->
								<div class="centro">
									<div id="divfileuploader">
										<table>
											<tr>
												<td><div id="fileuploader">SUBIR</div></div></td>
												<td> . . . </td>
												<td><div id="fileuploader2" style="position:relative;right:80%">SUBIR PARA TODOS</div></td>
											</tr>
										</table>			
									
									
								</div>
						</div>
						<!-- ENDS Contenido -->
					</div>	        	
	        		<!-- ends fullwidth content -->
				</div>
				<!--  page content-->
			</div>
			<!-- ENDS wrapper clearfix" -->
		</div>
		<!-- ENDS MAIN -->
		
		<!-- Encabezado-->
		<?php 
			include "base/footer.php"; 
		?>
		<!-- ENDS Encabezado -->
		
				
	</body>
	
</html>
	
</html>