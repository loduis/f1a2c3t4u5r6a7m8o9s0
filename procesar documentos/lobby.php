<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/uploadfile.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>lobby</title>
</head>
<body>
<div class="container">

	<div class="row">
		    <div class="col-sm">
		      	<!-- One of three columns -->
		    </div>
		    <div class="col-sm">
		      	<!-- display de errores -->
				<section>		error	</section>
		    </div>
		    <div class="col-sm">
		      	<!-- One of three columns -->
		    </div>
	 </div>



	 <div class="row">

		    <div class="col-sm">
		      <!-- One of three columns -->
		    </div>
		    <div class="col-sm">
		     	<!-- display upload -->
				<section>	
					<div id="divfileuploader">
						<div id="fileuploader">SUBIR</div>
					</div>		
				</section>
		    </div>
		    <div class="col-sm">
		      <!-- One of three columns -->
		    </div>
 	 </div>



	 <div class="row">
		    <div class="col-sm">
		      <!-- One of three columns -->
		    </div>
		    <div class="col-sm">
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
		    </div>
		    <div class="col-sm">
		      <!-- One of three columns -->
		    </div>
 	 </div>

			<!-- <footer class="text-center"> 
			    <div class="footer-above">
			        <div class="container">
			            <div class="row">
			                <div class="footer-col col-md-4">
			                    <h3>Location</h3>
			                    <p>3481 Melrose Place<br>Beverly Hills, CA 90210</p>
			                </div>
			                <div class="footer-col col-md-4">
			                    <h3>Around the Web</h3>
			                    <ul class="list-inline">
			                    </ul>
			                </div>
			                <div class="footer-col col-md-4">
			                    <h3>About Freelancer</h3>
			                    <p>Freelance is a free to use, open source Bootstrap theme created by <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
			                </div>
			            </div>
			        </div>
			    </div>
			    <div class="footer-below">
			        <div class="container">
			            <div class="row">
			                <div class="col-lg-12">
			                    Copyright &copy; Author <?php echo date("Y"); ?>
			                </div>
			            </div>
			        </div>
			    </div>
			</footer>-->


</div>







	






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