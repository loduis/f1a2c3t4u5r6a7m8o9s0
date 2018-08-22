<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
////////////////////////////////////////////////////////////////// helper
if ( ! function_exists('firmar'))
{

    function firmar($Username,$password,$nit,$xml,$factura_fecha,$factura_numero)
    {//inicio firma

    	require_once __DIR__."/src/Facturae.php";
    	$fac = new Facturae(); // usa la 3.2

    	$firma = __DIR__."/persona_juridica_pruebas_vigente.p12";
    	//echo "<br><br>".$firma;

    	$clave = "persona_juridica_pruebas1";
    	//echo $clave;

    	$firma = $fac->sign($firma, NULL, $clave);

	    /*echo "-----------------------------------<pre>";
    	   var_dump($firma);
    	echo "</pre>-----------------------------------";*/
    	// ... y exportarlo a un archivo
    	$f = $factura_fecha;
    	$IssueDate = $f['0'].$f['1'].$f['2'].$f['3'].'-'.$f['4'].$f['5'].'-'.$f['6'].$f['7'].'T'.
    				 $f['8'].$f['9'].':'.$f['10'].$f['11'].':'.$f['12'].$f['13'];

		$retornar = $fac->export("salida3.2.2.xml",$Username,$password,$nit,$xml,$factura_numero,$IssueDate);
	////final fopen
	//retornamos vector
    return $retornar;
    }   //fin firma
}
