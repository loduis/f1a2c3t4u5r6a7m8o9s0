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
				$linea = explode("|",$linea);

				if ($linea['0']=='' or $linea['0']==null) 
						{ 
							echo "documento no cumple con especificaciones"; exit();
						}

					if ($linea['0'])
							{
								$linea['0'] = str_replace(' ', '', $linea['0']);
							}

						if (array_key_exists($linea['0'], $vector)) 
							{
								$detalle =[						
											'Codigo_Producto' => trim($linea['26']), 
											'Nombre_Producto' => trim($linea['27']),
											'Presentacion'    => trim($linea['28']),
											'PorcentajeIVA'   => trim($linea['29']),
											'Precio_Unitario' => trim($linea['30']),
											'Cantidad'        => trim($linea['31']),
											'Dscto1'          => trim($linea['32']),
											'Dscto2'          => trim($linea['33']),
											'Parcial'         => trim($linea['34'])
										 ];
								array_push($vector[$linea['0']]["detalle"], $detalle);
								$con_si ++;
							}
						else
							{
								$vector[$linea['0']] = array(
														'Numero_Factura'  => $linea['0'],
														'Fecha_Factura '  => $linea['2'],
														'Vencimiento   '  => $linea['3'],
														'Condicion     '  => $linea['4'],
														'detalle' 		  => [],
														);

										$detalle =[
													'Codigo_Producto' => trim($linea['26']),
													'Nombre_Producto' => trim($linea['27']),
													'Presentacion'    => trim($linea['28']),
													'PorcentajeIVA'   => trim($linea['29']),
													'Precio_Unitario' => trim($linea['30']),
													'Cantidad'        => trim($linea['31']),
													'Dscto1'          => trim($linea['32']),
													'Dscto2'          => trim($linea['33']),
													'Parcial'         => trim($linea['34'])
												 ];
								array_push($vector[$linea['0']]["detalle"], $detalle);
/*
								echo "----------------------------------------<br>";
								var_dump($vector[$linea['0']]["detalle"]);
								echo "<br>----------------------------------------";
*/
								$con_no ++;
							}
								
/*

				$vector[$linea['0']] = array(
					'Numero_Factura'  => $linea['0'],
					'Fecha_Factura '  => $linea['2'],
					'Vencimiento   '  => $linea['3'],
					'Condicion     '  => $linea['4'],
											);*/

				$contador++;
			}


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


 ?>