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
		while ($linea = fgets($gestor)) 
			{	

				echo $linea."<br><br><br><br>";
				$linea = explode(";",$linea);

				$vector = array();
				foreach ($linea as $key) 
					{
						$vector[] = trim($key);
						if ($vector['0'])
						{
							$vector['0'] = str_replace(' ', '', $vector['0']);
						}
						//var_dump($vector);
					}
				echo "<pre>";
					print_r($vector);
				echo "</pre>";

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
		//prefuntamos si el puntero esta en la ultima linea 
		if (!feof($gestor)) 
		{
			echo "Error: fallo inesperado de fgets()\n";
		}
		//cerramos el documento
	fclose($gestor);
	echo "if";
}


 ?>