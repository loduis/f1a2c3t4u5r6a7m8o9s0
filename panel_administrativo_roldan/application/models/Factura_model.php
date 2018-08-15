<?php
/* clase que invoca el modelo principal del CI y permite cargar todas las operaciones con una basde de datos, basado en CI MODEL Recomendacion:
a todos los script siempre colocarle el control que si no son invocados desde la raiz del framework no lo permita visualizar */
defined('BASEPATH') OR exit('No direct script access allowed');
// definir la clase que permite validar si  el usuario existe.
class Factura_model extends CI_Model 
{
	// iniciar el constructor
	public function __construct() 
	{
		// cargar del modelo central de la base de datos
		$this->load->database();
	}
	// funcio que me permite validar si el usuario existe o no en la base de datos
	/*public function validar_acceso() 
	{
		// inicializar las variables
		// proceso normal
		//$correo=$_POST['correo'];
		//$clave=$_POST['clave'];
		// proceso de setear las variables con codeigniter
		$correo=$this->input->post('correo');
		$clave=sha1($this->input->post('clave'));
		// crear la sentencia que me permite
		// buscar el usuario en la tabla correspondiente
		$sql=" select * from login ";
		$sql.=" where correo  = ?  ";
		$sql.=" and clave  = ?  ";
		// ejecutar la sentencia pasando los valores en un vector. Aclaracion: los valores se pasan de acuerdo a la cantidad de ? que hayan
		$query=$this->db->query($sql,array($correo,$clave));
		// cuando se ejecute la sentencia que devuelva los valores en un vector
		return $query->result_array();		
	}*/



	public function get_factura()
		{
			$id_empresa = $this->session->userdata('id_empresa');
			$sql  =" select * from factura";
			$sql .=" where id_empresa = ? ";
			$query =$this->db->query($sql,array($id_empresa));
			return $query->result_array();
		}		
}

?>