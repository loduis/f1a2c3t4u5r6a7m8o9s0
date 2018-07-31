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
		$contador=0;
		while ($linea = fgets($gestor)) 
			{	

				//echo $linea."<br><br><br><br>";
				$linea = explode(";",$linea);
				if ($linea['0'])
						{
							$linea['0'] = str_replace(' ', '', $linea['0']);
						}
				$vector= "x";
				$vector = array(
									'Numero_Factura'  => $linea['0'],
									'Fecha_Factura '  => $linea['2'],
									'Vencimiento   '  => $linea['3'],
									'Condicion     '  => $linea['4'],
								);
				var($vector);
					echo "<br><br><br><br>";
				$contador++;
			}



echo "<pre>";
				print_r($linea);
				echo "<br><br><br><br>";
echo "</pre>";				


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