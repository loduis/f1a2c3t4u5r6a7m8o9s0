<?php
if (!$almacén_cert = file_get_contents("cert/persona_juridica_pruebas_vigente.p12")) {
    echo "Error: No se puede leer el fichero del certificado\n";
    exit;
}

if (openssl_pkcs12_read($almacén_cert, $info_cert, "persona_juridica_pruebas1")) {
    echo "Información del certificado\n";
    echo "<pre>";
    var_dump($info_cert);
    echo "</pre>";
} else {
    echo "Error: No se puede leer el almacén de certificados.\n";
    exit;
}
?>



<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


<?php 

$fp = fopen("cert/Raiz.crt", "r"); 
$cert2 = fread($fp, 8192); 
fclose($fp); 

echo "<br>**************************cer_ini**************************<br><pre>"; 
var_dump($cert2); 
echo "<br>**************************cer_fin**************************<br></pre>"; 




echo "lee<br><pre>"; 
echo openssl_x509_read($cert2); 
echo "<pre><br>"; 
echo "*********************"; 
echo "<br>"; 
echo "fin<br>"; 
print_r(openssl_x509_parse($cert2)); 
/* 
// or 
print_r(openssl_x509_parse( openssl_x509_read($cert) ) ); 
*/ 

?> 


<?php
echo "<br>**************************fechas del certificado**************************<br></pre>"; 
$data = openssl_x509_parse(file_get_contents('certs/x.cer'));

$validFrom = date('Y-m-d H:i:s', $data['validFrom_time_t']);
$validTo = date('Y-m-d H:i:s', $data['validTo_time_t']);

echo $validFrom . "\n";
echo $validTo . "\n";

?>
<br><br><br><br><br><br>
*********************___________________imprimir los datos de un certificado____________________________________________**************************
<br>



<?php


$_SERVER["CLIENT_CERT"] = openssl_x509_parse(file_get_contents('certs/x.cer'));


    $beginpem = "";
    $endpem = "";

    // Small function to print the data recursivly.
    function print_element($item, $key)
    {
        if( is_array( $item ) )
        {
            echo "$key is Array:\n";
            array_walk( $item, 'print_element' );
            echo "$key done\n";
        }
        else
            echo "$key = $item\n";
    }

    // Build the PEM string.
    $pemdata = $beginpem.$_SERVER["CLIENT_CERT"]."\n".$endpem;

    // Get a certificate resource from the PEM string.
    $cert = openssl_x509_read( $pemdata );

    // Parse the resource and print out the contents.
    $cert_data = openssl_x509_parse( $cert );
    array_walk( $cert_data, 'print_element' );

    // Free the resource
    openssl_x509_free( $cert );
?>