<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
/**	Controlador que permite abrir la vista principal de acceso al a´pp  Permite cargar el proceso de validacion Permite cargar las variables de session Permite que si el usuario es valido lo mande a principal 	Si el usuario no es valido lo devuelve a login	 */
// cuando en uncontrolador se necesite cargar librerias, bases de datos, clases, ayudador o helpers
// o cualquier otro proceso que sea de uso para toda la clase o controlador, se sugiere cargarlos en el contruct o inicializados de la clase
public function __construct() 
	{
		parent:: __construct(); // siempre crgar esta linea si deseo ejecutar librerias, bases de datos, clases, ayudador o helpers		
	    $this->load->helper('form'); // este helepr o ayuda me  permite acceder a las manipulacion del form que posee el framework 
	    $this->load->library('form_validation'); // esta libreria permite formatear los valores que se pasan en un formulario
		// invocar el modelo
		//libreria o ayuda de url 
		$this->load->helper("url_helper");
		//ayuda de la bd o modelo
		$this->load->model("login_model");
		//$this->load->model("empresa_model");
	}

public function index()
	{
		$vector['titulo']= "Login";
		$this->load->view('login_vista',$vector);
	}


// funcion acceso. Esta funcion permite validar el usuario y clave que se cargan en login.php
public function acceso()
	{//acceso inici		
		// invocar la funcion del modelo que me permite validar el usuario
		$data=$this->login_model->validar_acceso();
		// en la variable saldra el vector que contenga el resultado de la funcion  validar_acceso() de bd login_model.php
		if (count($data)>0) 
			{ 
				// puede continuar 	// mandar a la vista principal del sitio o el app  	//asociar las variables de session que son basadas en el objeto vetor $data //$this->load->view('principal'); //print_r($data);
				$usuario_session=array
				(
					"correo"=>$data[0]["correo"],
					"nombre_empresa"=>$data[0]["nombre_empresa"],
					"cantidad_factura"=>$data[0]["cantidad_factura"],
					"id_empresa"=>$data[0]["id_empresa"],
					"nit"=>$data[0]["nit"],
				);
				//para crear las variables de session se usa la libreria set_userdata. este metodo pide que los valores sean enviados en un vector o array
					$this->session->set_userdata($usuario_session);
					$logo = $this->empresa_model->select_logo();
					$logo = $logo[0]["logo"];
					if ($logo <> "") 
						{
							$usuario_session["logo"]=$logo;
						}
					else
						{
							$usuario_session["logo"]= "logo.jpg";
						}
					$this->session->set_userdata($usuario_session);
				//redirect hace parte de una libreria que se llama url_helper
					redirect('factura');
			} 
		else 
			{
			// mandar a la pagina de inicio
			//con mensaje que diga "usuario o clave incorrecto"
			// los datos de salida o impresion de una vista se pasan por medio de vectores
			$vector["mensaje"]="Correo o clave incorrecto. Intente de nuevo"; 			
			$this->load->view('v_login',$vector);
			}
	}//acceso fin
}