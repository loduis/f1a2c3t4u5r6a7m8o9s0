<?php
$data = openssl_x509_parse(file_get_contents('crt.crt'));

var_dump($data);

$validFrom = date('Y-m-d H:i:s', $data['validFrom_time_t']);
$validTo = date('Y-m-d H:i:s', $data['validTo_time_t']);

echo $validFrom . "\n";
echo $validTo . "\n";

?> 