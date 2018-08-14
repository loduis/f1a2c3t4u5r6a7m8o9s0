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
			$this->load->helper('xml_generar'); //helper para procesar plano
			$vector = vector_plano($ruta);		//pasamos la ruta del documento vector_plano() para proceso
			$this->load->model("empresa_model");//instanciamos modelo empresa
			$empresa= $this->empresa_model->get_empresa();//datoso de configuracion de empresa desde la bd			
			$xml = xml_generar($vector,$empresa);//peticion para generar los xml	
			/*	echo "<pre>"; var_dump($xml); echo "</pre>";*/
			return $xml;
		}
	//guardar xml en bd para suposterior consulta
	public function set_xml()
	{

	}

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
                    	$data['xml'] = $this->generar_xml($ruta);

//imprimir el xml completo en web o htmlspecialchars()
//echo htmlentities($data['xml']['0']['xml']);

/*
$xml = new DomDocument('1.0', 'UTF-8');
                    	$xml->formatOutput = true;
   						 $el_xml = $xml->saveXML();
    					$xml->save('libros.xml');*/


                    	//var_dump($data);
	                    $this->load->view('upload_success', $data);
		            }
        }
}