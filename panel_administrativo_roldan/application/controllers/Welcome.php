<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() 
	{
		parent:: __construct(); // siempre crgar esta linea si deseo ejecutar librerias, bases de datos, clases, ayudador o helpers		
	    		$this->load->helper(array('form', 'url'));
	   			$this->load->library('form_validation'); // esta libreria permite formatear los valores que se pasan en un formulario
				$this->load->model(array('factura_model','login_model'));
				//ayuda de la bd o modelo
				//$this->load->model("empresa_model");
				if (!$this->session->userdata('correo'))
							{
								redirect('login');
							}
	}
	public function index()
	{
		$dato['facturas'] = $this->factura_model->get_factura();

		
		$this->load->view('welcome_message',$dato);
	}
}
