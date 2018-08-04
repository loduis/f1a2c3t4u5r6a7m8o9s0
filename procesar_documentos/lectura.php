<?php 

// Cambiar el puntero leyendo un archivo:
$file ="Prueba.txt";
/*
	if (!$fp = fopen($file, "r"))
		{
		    echo "No se ha podido abrir el archivo";
		}
	$datos = fread($fp,filesize($file));
fclose($fp);
	echo "<pre>";
		var_dump($datos);
	echo "</pre>";
*/


$gestor = fopen($file, "r");
//valinadmos que halla una ruta a un documento
if ($gestor) 
{		//recorremos linea a linea el documento
		$con_si = '0';
		$con_no = '0';
		$contador=0;
		$vector = array();
		while ($linea = fgets($gestor)) 
			{	
				$linea = explode("¬",$linea);

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
								$con_si ++;
							}
						else
							{
								$vector[$linea['1']] = array(
														'Fac_Enc_PrefijoF'				  =>  trim($linea['0']),
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
														'Fac_Enca_Emp_Codigo_Tercero'     =>  trim($linea['44']),
														'detalle' 		 				  => [],
														);

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
/*
								echo "----------------------------------------<br>";
								var_dump($vector[$linea['1']]["detalle"]);
								echo "<br>----------------------------------------";
*/
								$con_no ++;
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
	//echo "if";
				/*
				if (substr($linea,0,1) <> 'C') 
				{
					$array[substr($linea,0,3)]= trim(substr($linea,3));
				}
				else {
					$array2[][substr($linea,0,3)]= trim(substr($linea,3));
				}
				//$array[substr($linea,0,3)]= substr($linea,3);   */ 
}


//////////salida de datos 

echo "entro".$con_si."<br>";
echo "entro".$con_no."<br>";
echo "vueltas".$contador."<br>";
//impresion del vetor
		echo "<pre>";
			//print_r($vector_detalle);
		echo "</pre>";
echo "----------------vector -----------------";
		echo "<pre>";
			print_r($vector);
		echo "</pre>";	
echo "----------------foreach -----------------";
foreach ($vector as $key) 
		{
			echo "<pre>";
				//	print_r($vector);
				var_dump( $key);
			echo "</pre>";

				if (isset($key["detalle"])) 
				{exit();
					foreach ($key["detalle"] as $detalles) 
					{
						echo "<pre>";
							//	print_r($vector);
							print "$detalles";
						echo "</pre>";	
						echo "<br>___otra detalle___<br>";
					}
				}
				

			echo "<br>___otra factura_____<br>";
		}		


 ?>