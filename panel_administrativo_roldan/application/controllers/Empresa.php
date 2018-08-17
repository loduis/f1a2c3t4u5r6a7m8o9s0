<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_controller
{
	
	public function __construct() 
	{
		parent:: __construct(); // siempre crgar esta linea si deseo ejecutar librerias, bases de datos, clases, ayudador o helpers		
	    		$this->load->helper(array('form', 'url'));
	   			$this->load->library('form_validation'); // esta libreria permite formatear los valores que se pasan en un formulario
				$this->load->model('empresa_model');
				//ayuda de la bd o modelo
				$this->load->model("login_model");
				//$this->load->model("empresa_model");
				if (!$this->session->userdata('correo'))
							{
								redirect('login');
							}
	}
	//vista principal
	public function index()
		{	
			$vector['get_temporal'] = $this->empresa_model->numero_factura_temporal_get();		
			$vector['get']= $this->empresa_model->get_empresa();
			$vector['titulo']= "Info Empresa";
			$this->load->view('empresa_vista',$vector);
		}

	public function set_empresa()
		{
				$vector['get']= $this->empresa_model->get_empresa();
				if(count($vector['get'])>0)
					{
						$vector['insert'] =	$this->empresa_model->update_empresa();
					}
				else
					{
						$vector['insert'] =	$this->empresa_model->set_empresa();
					}
				redirect('empresa');
				//$this->load->view('empresa_vista',$vector);		
		}
		

//////////////////////////////////////// numero de factura tempopal para yo controlar el numero de factura
	public function numero_factura_temporal()
		{
			$vector['set'] = $this->empresa_model->numero_factura_temporal_set();

			redirect('empresa'); //$this->load->view('empresa',$vector);
		}

}