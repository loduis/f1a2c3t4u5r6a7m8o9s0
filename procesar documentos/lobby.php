<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/uploadfile.css">
	<title>lobby</title>
</head>
<body>
<!-- display de errores -->
	<section>		error	</section>
<!-- display upload -->
	<section>	
		<div id="divfileuploader">
			<div id="fileuploader">SUBIR</div>
		</div>		
	</section>

	<section>
		<table border="1">
			<thead>
				<tr>
					<th>No. Factura			</th>
					<th>Facturado A			</th>
					<th>Fecha de Factura	</th>
					<th>Fecha Envio			</th>
					<th>Respuesta			</th>
					<th>Ver					</th>
					<th>Renviar				</th>
					<th>Otro				</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>No. Factura			</td>
					<td>Facturado A			</td>
					<td>Fecha de Factura	</td>
					<td>Fecha Envio			</td>
					<td>Respuesta			</td>
					<td>Ver					</td>
					<td>Renviar				</td>
					<td>Otro				</td>
				</tr>
			</tbody>
		</table>
	</section>



	<footer>		pie 	</footer>



	<!-- js	 -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.uploadfile.js"></script>
<script>
$(document).ready(function()
{
	$("#fileuploader").uploadFile
		(
			{
				url:"assets/include/get_datos.php",
				fileName:"myfile",
			    returnType: "json",
				allowedTypes:"txt",
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
			}
		);
});
</script>
	
</body>
</html>