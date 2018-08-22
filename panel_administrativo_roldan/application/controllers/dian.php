<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dian extends CI_controller
	{
		public function __construct()
			{
				parent:: __construct();
				$this->load->helper(array('form', 'url'));
				if (!$this->session->userdata('correo'))
								{
									redirect('login');
								}

			}
		public function index()
			{
				//redirect('welcome');
				$this->load->view('dian_vista');
			}

		public function dian($vector)
			{
				echo "<pre>";
				var_dump($vector);
				echo "</pre>";
			}

	}



/*
public function __construct() 
	{
		parent:: __construct(); // siempre crgar esta linea si deseo ejecutar librerias, bases de datos, clases, ayudador o helpers		
		//ayuda de la bd o modelo
		if (!$this->session->userdata('correo'))
								{
									redirect('login');
								}
		$this->load->model("login_model");
	    $this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation'); // esta libreria permite formatear los valores que se pasan en un formulario
		// invocar el modelo
		//libreria o ayuda de url 

	}*/