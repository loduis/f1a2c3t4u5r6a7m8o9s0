<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_controller
{
	
	public function __construct() 
	{
		parent:: __construct(); // siempre crgar esta linea si deseo ejecutar librerias, bases de datos, clases, ayudador o helpers		
	    $this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation'); // esta libreria permite formatear los valores que se pasan en un formulario
		// invocar el modelo
		//libreria o ayuda de url 

		//ayuda de la bd o modelo
		$this->load->model("login_model");
		if (!$this->session->userdata('correo'))
								{
									redirect('login');
								}
	}
	//vista principal
	public function index()
		{
			$vector['titulo']= "Upload";
			$this->load->view('upload_vista',$vector);
		}

	//procesar documento
	public function generar_xml($ruta)
		{		
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
					$this->load->model('factura_model');
					//leer numero actual de la resolucion
					$numero_temporal = $this->factura_model->get_numero_temporal();
					$numero_temporal =$numero_temporal[0]["factura_inicial"];
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////

			$this->load->helper('xml_generar'); //helper para procesar plano
			$vector = vector_plano($ruta,$numero_temporal);		//pasamos la ruta del documento vector_plano() para proceso

				// echo "<pre>";
				// 	print_r($vector);
				// echo "</pre><br><br><br><br><br>";


				// $vector = array_diff($vector, array('numero_temporal_retorno'));

				// echo "<pre>";
				// 	print_r($vector);
				// echo "</pre><br><br><br><br><br>";



				// exit();
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
					$this->load->model('factura_model');
					//leer numero actual de la resolucion
					$respuesta = $this->factura_model->set_numero_temporal($vector['numero_temporal_retorno']);
					//echo  $respuesta;
					//$numero_temporal =$numero_temporal[0]["factura_inicial"];
			//exit();
			//echo $vector['numero_temporal_retorno'];		
			unset($vector['numero_temporal_retorno']);
			//exit();
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
			////////////////////////////////////////////////////
			$this->load->model("empresa_model");//instanciamos modelo empresa
			$empresa= $this->empresa_model->get_empresa();//datoso de configuracion de empresa desde la bd			
			$xml = xml_generar($vector,$empresa);//peticion para generar los xml	
			/*	echo "<pre>"; var_dump($xml); echo "</pre>";*/
			return $xml;
		}
	//guardar xml en bd para suposterior consulta
	public function set_xml($data)
		{//inicio set_xml
			$this->load->model('Upload_model');//instanciamos modelo Upload_model
			foreach ($data as $key => $value)//recorremos el vector par almacenar vectores
				{
					$count_factura_numero = count($this->Upload_model->get_xml($value["factura_numero"]));//prguntamos si existe factura
					//echo $count_factura_numero;
					if ($count_factura_numero==0) 
						{
						// xml para firmar
						$xml = $value["xml"];
							/////////////////////////////////////////////////////////////
							/////////////////////////////////////////////////////////////
							/////////////////////////////////////////////////////////////
								//firmar facturas							
								$this->load->helper('firma_helper'); //helper para procesar plano
										$Username = '79cadac2-aa74-4ed1-95b3-1af07694027c';
										$password = 'Bello2010R';
										$nit	  =  '890912995';
										//$InvoiceNumber
										//$IssueDate
										//$content

								$xml = firmar(
										$Username,
										$password ,
										$nit,
										$xml,
										$value["factura_fecha"],
										$value["factura_numero"]);
								
								// echo "<pre>";	
								// 	var_dump($xml);
								// echo "<pre>";	
								// exit();



							/////////////////////////////////////////////////////////////
							/////////////////////////////////////////////////////////////
							/////////////////////////////////////////////////////////////

							
							$factura 	= array(
											    "id_empresa"     =>  $this->session->userdata("id_empresa"),
												"factura_numero" =>  $value["factura_numero"],
												"tercero_numero" =>  $value["tercero_numero"],
												"tercero_nombre" =>  $value["tercero_nombre"],
												"factura_fecha"  =>  $value["factura_fecha"],
												"PayableAmount"  =>  $value["PayableAmount"],
												"xml"            =>  $xml,
												);


							$mensaje[] = "Factura ".$value["factura_numero"]."subida correctamente".$this->Upload_model->set_xml($factura);
							
						}
					if ($count_factura_numero>0) 
						{
							$mensaje[] = 'la factura con Número " '.$value["factura_numero"].'" ya fue subida';
						}
					
				}
				

		 	return $mensaje;
		}//fin set_xml	

	//subir documento
	public function do_upload()
        {
			//configuracion
	        $config['upload_path']          = './uploads/';
	        $config['allowed_types']        = 'txt';
	        $config['max_size']             = 100;	       
	        $this->load->library('upload', $config);//libreria uplod CI
		        if ( ! $this->upload->do_upload('userfile'))
		            {
	                    $error = array('error' => $this->upload->display_errors());
	                    $this->load->view('upload_vista', $error);
		            }
		        else
		            {
	                    $data = array('upload_data' => $this->upload->data());
	                    $ruta = $data['upload_data']['full_path'];
	                   /* echo $xx = $data['upload_data']['full_path'];
	                    echo "<pre>";
						 	print_r($ruta);
						echo "</pre>"; */
                    	$set_xml['xml'] = $this->generar_xml($ruta);                    	
                    	$data['resultado'] = $this->set_xml($set_xml['xml']);


//imprimir el xml completo en web o htmlspecialchars()
//echo htmlentities($data['xml']['0']['xml']);

/*
$xml = new DomDocument('1.0', 'UTF-8');
                    	$xml->formatOutput = true;
   						 $el_xml = $xml->saveXML();
    					$xml->save('libros.xml');*/


                    	//var_dump($data);
						$vector['titulo']= "results upload";
	                    $this->load->view('upload_success', $data);
		            }
        }
}