<?php
/* clase que invoca el modelo principal del CI y permite cargar todas las operaciones con una basde de datos, basado en CI MODEL Recomendacion:
a todos los script siempre colocarle el control que si no son invocados desde la raiz del framework no lo permita visualizar */
defined('BASEPATH') OR exit('No direct script access allowed');
// definir la clase que permite validar si  el usuario existe.
class Upload_model extends CI_Model 
{
	// iniciar el constructor
	public function __construct() 
	{
		// cargar del modelo central de la base de datos
		$this->load->database();
	}

	public function get_xml($factura_numero)
		{
			$sql=" select factura_numero from factura ";
			$sql.=" where factura_numero  = ?  ";
			$query=$this->db->query($sql,array($factura_numero));
			return $query->result_array();		
		}

	public function set_xml($factura)
		{
				/*foreach ($data as $key => $value)//recorremos el vector para almacenar los xml
				{
					$factura 	= array(
									    "id_empresa"     =>  $this->session->userdata("id_empresa"),
										"factura_numero" =>  $value["factura_numero"],
										"tercero_numero" =>  $value["tercero_numero"],
										"tercero_nombre" =>  $value["tercero_nombre"],
										"factura_fecha"  =>  $value["factura_fecha"],
										"PayableAmount"  =>  $value["PayableAmount"],
										"xml"            =>  $value["xml"],
										);
				}*/
			return $this->db->insert("factura",$factura);//inser en la bd
		}

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
	/*public function set_empresa()
		{
			$id_empresa =$this->session->userdata("id_empresa");
			$empresa 	= array(
								"Prefix"              => $this->input->post('Prefix'),
								"From"                => $this->input->post('From'),
								"To"                  => $this->input->post('To'),
								"InvoiceAuthorization"=> $this->input->post('InvoiceAuthorization'),
								"StartDate"           => $this->input->post('StartDate'),
								"EndDate"             => $this->input->post('EndDate'),
								"SoftwareID"          => $this->input->post('SoftwareID'),
								"ClTec"               => $this->input->post('ClTec'),
								"Pin"                 => $this->input->post('Pin'),
								);
			$this->db->where("id_empresa",$id_empresa);
			return $this->db->insert("empresa",$empresa); 
		}
	public function update_empresa()
		{
			$id_empresa =$this->session->userdata("id_empresa");
			$empresa 	= array(
								"Prefix"              => $this->input->post('Prefix'),
								"From"                => $this->input->post('From'),
								"To"                  => $this->input->post('To'),
								"InvoiceAuthorization"=> $this->input->post('InvoiceAuthorization'),
								"StartDate"           => $this->input->post('StartDate'),
								"EndDate"             => $this->input->post('EndDate'),
								"SoftwareID"          => $this->input->post('SoftwareID'),
								"ClTec"               => $this->input->post('ClTec'),
								"Pin"                 => $this->input->post('Pin'),
								);
			$this->db->where("id_empresa",$id_empresa);
			return $this->db->update("empresa",$empresa); 
		}


	public function get_empresa()
		{
			$id_empresa = $this->session->userdata('id_empresa');
			$sql  =" select * from empresa";
			$sql .=" where id_empresa = ? ";
			$query =$this->db->query($sql,array($id_empresa));
			return $query->result_array();
		}	
		*/	
}

