<?php
session_start();				//inicio de sesion
include '../../conexion/conection.php'; // incluye conexion
$output_dir = "../../uploads/";    //direccion donde subiran los archivos

if(isset($_FILES["myfile"])) //carga del archivo
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
	 	$fileName = $_FILES["myfile"]["name"];
	 	if (!move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName)) {
	 		$custom_error= array();
			$custom_error['jquery-upload-file-error']="NO SE PUDO COPIAR EL ARCHIVO";
			echo json_encode($custom_error);
			die();
	 	}
		$ret[]= $fileName;
		$fileSize = $_FILES['myfile']['size'];
		$Fecha = date("d/m/Y"); 


		$fileName2  = substr($fileName , strpos($fileName,'-')+1,strlen($fileName));
		$nituser = substr($fileName2 , 0,strpos($fileName2,'-'));
	  	/*
		  	$query = "INSERT INTO docs(id_Doc, Nom_Doc, kb_Doc, Fecha_Doc, tipo_Doc, tipo_Pdf, ano, periodo, Nit_user)".
		    "VALUES ('', '$fileName', '$fileSize','$Fecha',1,'1','','','')";      
		     mysql_query($query); 
	     */

		$resultcount = mysql_query("SELECT count(id_user) contar FROM user WHERE Nit_user = '$nituser';");
		$rowcount = mysql_fetch_array($resultcount);
		$contar = $rowcount['contar'];

	    $result = mysql_query("SELECT email_user,email_user2,email_user3,Nombre_user,estado,sx,sd,bod FROM user WHERE Nit_user = '$nituser';");
		$row = mysql_fetch_array($result);

		$estado = $row['estado'];
		$emailuser  = $row['email_user'];
		$emailuser2 = $row['email_user2'];
		$emailuser3 = $row['email_user3'];
		$nombreuser = $row['Nombre_user'];
		$sx			= $row['sx'];   
		$sd			= $row['sd']; 
		$bod			= $row['bod'];  

		switch ($sx) {
		   	case 0:
		   			$x = 'Señora';
		   		break;
		   	case 1:
		   			$x = 'Señor';
		   		break;
		   	case 2:
		   			$x = 'Señores';
		   		break;
		   	
		   	default:
		   			$x=" ";
		   		# code...
		   		break;
		   }     
		
		$resultayc = mysql_query("SELECT asunto,contenido,nombrecorreo FROM asuntoycontenido");
		$rowayc = mysql_fetch_array($resultayc);
		$asunto    = $rowayc["asunto"];
		$contenido = $rowayc["contenido"];
		$nombrecorreo  = $rowayc["nombrecorreo"];
		//echo " a: ".$asunto." c: ".$contenido . " nc: ".$nombrecorreo ;

		if($contar == 0)
		{
			$custom_error= array();
			$custom_error['jquery-upload-file-error']="Correo No Existe";
			//ob_end_clean();
			echo json_encode($custom_error);
			die();
		}

		if($estado == 0)
		{
			$custom_error= array();
			$custom_error['jquery-upload-file-error']="Correo Deshabilitado";
			//ob_end_clean();
			echo json_encode($custom_error);
			die();
		}
		//Numero para saber si hay mas en la base de datos con ese NIT

 /*MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMAAAAAAAAAAAAAAIIIIIIIIIIIILLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL*/

		
		/**
		 * This example shows settings to use when sending via Google's Gmail servers.
		 */

		//SMTP needs accurate times, and the PHP time zone MUST be set
		//This should be done in your php.ini, but this is how to do it if you don't have access to that
		date_default_timezone_set('Etc/UTC');

		require '../../PHPMailer-master/PHPMailerAutoload.php';

		//Create a new PHPMailer instance
		$mail = new PHPMailer;

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		$mail->SetLanguage("es","");

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;
		$mail->CharSet = 'UTF-8';

		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		//Set the hostname of the mail server
		$mail->Host = 'smtp-mail.outlook.com';

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		$resultmail = mysql_query("SELECT usuario,contrasena FROM correo");
		$rowmail = mysql_fetch_array($resultmail);
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = $rowmail['usuario'];

		//Password to use for SMTP authentication
		$mail->Password = $rowmail['contrasena'];
		//Set who the message is to be sent from
		$mail->setFrom($rowmail['usuario'], $nombrecorreo);

		//Set an alternative reply-to address
		//$mail->addReplyTo('ztibenbarrera@gmail.com', 'First Last');
		//$mail->ConfirmReadingTo = $rowmail['usuario'];
		//Set who the message is to be sent to
		$mail->ClearAllRecipients(); // clear all
		$mail->addAddress($emailuser);

		if (!empty($emailuser))
		{
			$mail->addAddress($emailuser);
		}

		if (!empty($emailuser2))
		{
			$mail->addAddress($emailuser2);
		}
		if (!empty($emailuser3))
		{
			$mail->addAddress($emailuser3);
		}

		//Set the subject line
		//$mail->Subject = $asunto."  Sede:  ".$sd.", "." Bodega:  ".$bod;
		$mail->Subject = $asunto;

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML("<html xmlns='http://www.w3.org/1999/xhtml'>
				<head>
				<meta charset='utf-8' />
				<title>Elemental</title>
				</head>
<body>
<div style='width:100%;' align='center'>
	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
		<tr>
			<td align='center' valign='top' style='background-color:#eeeeee;' bgcolor='#eeeeee;'>
				<br>
				<br>
					<table width='583' border='0' cellspacing='0' cellpadding='0' style='box-shadow: 4px 6px 16px -5px rgba(0,0,0,0.77);'>
						<tr>
							<td align='left' valign='top' bgcolor='#FFFFFF' style='background-color:#FFFFFF;'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
				 		<tr>
					   			 <td width='35' align='left' valign='top'>            
								 </td>
				   				 <td align='left' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
				    				<tr><img src='http://grupoelemental.com.co/img/mail/el_castillo.jpg' width='100%' height='100%' vspace='10'></tr>
				    				<tr>
				        				<td align='center' valign='top'>
				           					<div style='color:#111111;; font-size:18px;'>$x $nombreuser<br></div>
				        					<div style='color:#2266A6; font-size:48px;'></div>
  				      </tr>
				 
				      <tr>
					     <td align='left' valign='top' style='font-size:12px; color:#525252;'>
					        
					        <div style='color:#525252; font-size:19px;'></div>
					        <br>
					        	<p style='color:#525252; font-size:18px;'>$contenido</p>
					        <br>
							<br>
					    	<br>
					    	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
				      <tr>
				        <td width='13%'><b></b></td>
				        <td width='100%' style='font-size:11px; color:#525252;'>

			        </b></td>
				      </tr>
				    </table></td>
				      </tr>
				      <tr>
				        <td align='left' valign='top' style='font-size:12px; color:#525252;'>&nbsp;</td>
				      </tr>
				    </table></td>
				    <td width='35' align='left' valign='top'>&nbsp;</td>
				  </tr>


				
				</table>
				</td> 
				</tr>

				<!-- modificacion informacion footer -->
				<tr>
				<td align='left' valign='top' style='background-color:#00923f'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <!-- MODIFICAR BG-COLOR FONDO DEL FOOTER-->
				  <tr>
				    <td width='10'>&nbsp;</td>

				     <!-- modificacion informacion web-->  
				    <td height='50' valign='middle' style='color:#FFF; font-size:12px;'><b>Web:</b><br> <a  style='color:#FFF;  font-size: 16px'  href='http://www.arrendamientoselcastillo.co/'>www.arrendamientoselcastillo.co</a></td><!-- COLOR color de la fuente-->
				    <!-- fin--> 

				     <!-- modificacion informacion de contato inicio-->  
				    <td height='50' valign='middle' style='color:#FFF'><b>Contacto:</b><br>cartera@arrendamientoselcastillo.co</td><!-- COLOR color de la fuente-->
				    <!-- fin--> 

				    
				    <!-- modificacion informacion de contato inicio--> 
				    <td height='50' valign='middle' style='color:#FFF; font-size:12px;'><b>TEL:</b><br>(4)238 5343</td> 
					<!-- fin-->  
				    

				    				    				    
				    <td width='10'>&nbsp;</td>
				 <!-- fin--> 
				    
				  </tr>
				</table>
				</td>
				</tr>
				</table>
				<br>
				<br>
			</td>
			</tr>
	</table>
</div>
</body>
</html>");
		//$mail->msgHTML(file_get_contents('../../mailer.html'), dirname(__FILE__));

		//Replace the plain text body with one created manually
		$mail->AltBody = '';

		//Attach an image file
		$mail->addAttachment("../../uploads/".$fileName);

		//send the message, check for errors
		if (!$mail->send()) {
			$fileCount = count($_FILES["myfile"]["name"]);
			  for($i=0; $i < $fileCount; $i++)
			  {
			  	sleep(8);
			  	$fileName = $_FILES["myfile"]["name"][$i];
				move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
			  	$ret[]= $fileName;

			  }

			$custom_error= array();
			$custom_error['jquery-upload-file-error']=$mail->ErrorInfo;
			//ob_end_clean();
			echo json_encode($custom_error);
			//die();

		    //echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			//ob_clean();
		    //echo "Message sent!";
		}
		//unlink("../../uploads/".$fileName);
		
/*MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMAAAAAAAAAAAAAAIIIIIIIIIIIIILLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL*/
	}
   // echo "../../uploads/".$fileName;
 }
// ob_end_clean();
 ?>
