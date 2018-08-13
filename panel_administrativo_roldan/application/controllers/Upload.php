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
		//$this->load->model("empresa_model");
	}
	//vista principal
	public function index()
		{
			$vector['titulo']= "Upload";
			$this->load->view('upload_vista',$vector);
		}
		//procesar documento
	public function upload_procesar($ruta)
		{			
$gestor = fopen($ruta, "r");//open file txt
if ($gestor)//valinadmos que halla una ruta a un documento 
{//if ini gestor
	$contador=0; //contadores
	$vector = array();
		while ($linea = fgets($gestor)) 
			{	
				$linea = explode("==",$linea);
				if ($linea['1']=='' or $linea['1']==null) 
						{ 
							echo "documento no cumple con especificaciones"; exit();
						}
					if ($linea['1'])
							{
								$linea['1'] = str_replace(' ', '', $linea['1']);
							}
						if (array_key_exists($linea['1'], $vector)) 
							{
								$detalle =[						
											'Produ_Codigo_Producto'           =>  trim($linea['27']),
											'Produ_Nombre_Producto'           =>  trim($linea['28']),
											'Produ_Presentacion'              =>  trim($linea['29']),
											'Produ_PorcentajeIVA'             =>  trim($linea['30']),
											'Produ_Precio_Unitario'           =>  trim($linea['31']),
											'Cantidad'                        =>  trim($linea['32']),
											'Dscto1'                          =>  trim($linea['33']),
											'Dscto2'                          =>  trim($linea['34']),
											'Parcial'                         =>  trim($linea['35']),
										 ];
								array_push($vector[$linea['1']]["detalle"], $detalle);
							}
						else
							{
								$vector[$linea['1']] = array(
														'Fac_Enca_Prefijo'				  =>  trim($linea['0']),
														'Fac_Enca_Numero'                 =>  trim($linea['1']),
														'Fac_Enca_Fecha'                  =>  trim($linea['2']),
														'Fac_Enca_Vencimiento'            =>  trim($linea['3']),
														'Fac_Enca_Condicion'              =>  trim($linea['4']),
														'Fac_Enca_Vendedor'               =>  trim($linea['5']),
														'Fac_Enca_Tercero_Codigo_Tercero' =>  trim($linea['6']),
														'Fac_Enca_Tercero_Nombre_Tercero' =>  trim($linea['7']),
														'Fac_Enca_Tercero_Telefono'       =>  trim($linea['8']),
														'Fac_Enca_Tercero_email'          =>  trim($linea['9']),
														'Fac_Enca_Tercero_Direccion'      =>  trim($linea['10']),
														'Fac_Enca_Direccion2'             =>  trim($linea['11']),
														'Fac_Enca_Tercero_Ciudad'         =>  trim($linea['12']),
														'Fac_Enca_Tercero_Pais'           =>  trim($linea['13']),
														'Fac_Enca_Tercero_Identificacion' =>  trim($linea['14']),
														'Fac_Enca_Emp_Codigo_Tercero'     =>  trim($linea['15']),
														'Fac_Enca_Emp_Nombre_Tercero'     =>  trim($linea['16']),
														'Fac_Enca_Emp_Telefono'           =>  trim($linea['17']),
														'Fac_Enca_Emp_Direccion'          =>  trim($linea['18']),
														'Fac_Enca_Emp_Identificacion'     =>  trim($linea['19']),
														'Fac_Enca_Resolucion'             =>  trim($linea['20']),
														'Fac_Enca_Elaborado'              =>  trim($linea['21']),
														'Fac_Enca_Pedido'                 =>  trim($linea['22']),
														'Fac_Enca_Tipo_ID'                =>  trim($linea['23']),
														'Fac_Enca_Tipo_Persona'           =>  trim($linea['24']),
														'Fac_Enca_Hora'                   =>  trim($linea['25']),
														'Fac_Enca_Clave_Tecnica'          =>  trim($linea['26']),
														'Fac_Totales_Gravado_19'          =>  trim($linea['36']),
														'Fac_Totales_Gravado_5'           =>  trim($linea['37']),
														'Fac_Totales_Exento'              =>  trim($linea['38']),
														'Fac_Totales_Antes_Impuestos'     =>  trim($linea['39']),
														'Fac_Totales_IVA_19'              =>  trim($linea['40']),
														'Fac_Totales_IVA_5'               =>  trim($linea['41']),
														'Fac_Totales_Valor_Total'         =>  trim($linea['42']),
														'Fac_Enca_Observaciones'          =>  trim($linea['43']),
														'detalle' 		 				  => [],
														);
														//'Fac_Enca_Emp_Codigo_Tercero'     =>  trim($linea['44']),

										$detalle =[
													'Produ_Codigo_Producto'           =>  trim($linea['27']),
													'Produ_Nombre_Producto'           =>  trim($linea['28']),
													'Produ_Presentacion'              =>  trim($linea['29']),
													'Produ_PorcentajeIVA'             =>  trim($linea['30']),
													'Produ_Precio_Unitario'           =>  trim($linea['31']),
													'Cantidad'                        =>  trim($linea['32']),
													'Dscto1'                          =>  trim($linea['33']),
													'Dscto2'                          =>  trim($linea['34']),
													'Parcial'                         =>  trim($linea['35']),
												 ];
								array_push($vector[$linea['1']]["detalle"], $detalle);
							}
								
/*

				$vector[$linea['1']] = array(
					'Numero_Factura'  => $linea['1'],
					'Fecha_Factura '  => $linea['2'],
					'Vencimiento   '  => $linea['3'],
					'Condicion     '  => $linea['4'],
											);*/

				$contador++;
			}
		//prefuntamos si el puntero esta en la ultima linea 
		if (!feof($gestor)) 
		{
			echo "Error: fallo inesperado de fgets()\n";
		}
		//cerramos el documento
	fclose($gestor);
}//if ini gestor	
			



			 return $ruta;
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
	                    	$data['xxx'] = $this->upload_procesar($ruta);
		                    $this->load->view('upload_success', $data);
		            }
        }
}