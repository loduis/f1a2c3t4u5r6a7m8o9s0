<?php
if(isset($_FILES["myfile"])) //carga del archivo
	{
			$output_dir = "../uploads/";    //direccion donde subiran los archivos
			$fileName = $_FILES["myfile"]["name"];
			//var_dump($fileName);


			if (move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName))
				{
					$custom_error = 'entro al if;';
					return json_encode($custom_error);
				}
			else
				{
					echo 'entro al else';
					
				}
			//$ret = array();
			//$error = $_FILES["myfile"]["error"];
/*
			$custom_error= array();
			$custom_error['jquery-upload-file-error']="NO SE PUDO COPIAR EL ARCHIVO";
			echo json_encode($custom_error);


			$ret[]= $fileName;
			$fileSize = $_FILES['myfile']['size'];
			$fileName = $_FILES["myfile"]["name"];
			move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);


			$custom_error= array();
			$custom_error['jquery-upload-file-error']=$mail->ErrorInfo;
			//ob_end_clean();
			echo json_encode($custom_error);*/
	}
