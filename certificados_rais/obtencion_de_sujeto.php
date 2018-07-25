<?php 

/*
$publicKey = NULL;

$pfx              = file_get_contents('persona_juridica_pruebas_vigente.p12');
$clavecertificado = 'persona_juridica_pruebas1';
//$pkcs12_read = openssl_pkcs12_read($pfx, $key, $clavecertificado);


openssl_pkcs12_read($pfx, $key, $clavecertificado);


*/


$publicKey2  = "-----BEGIN CERTIFICATE-----
MIIIODCCBiCgAwIBAgIIbAsHYmJtoOIwDQYJKoZIhvcNAQELBQAwgbQxIzAhBgkq
hkiG9w0BCQEWFGluZm9AYW5kZXNzY2QuY29tLmNvMSMwIQYDVQQDExpDQSBBTkRF
UyBTQ0QgUy5BLiBDbGFzZSBJSTEwMC4GA1UECxMnRGl2aXNpb24gZGUgY2VydGlm
aWNhY2lvbiBlbnRpZGFkIGZpbmFsMRMwEQYDVQQKEwpBbmRlcyBTQ0QuMRQwEgYD
VQQHEwtCb2dvdGEgRC5DLjELMAkGA1UEBhMCQ08wHhcNMTcwOTE2MTM0ODE5WhcN
MjAwOTE1MTM0ODE5WjCCARQxHTAbBgNVBAkTFENhbGxlIEZhbHNhIE5vIDEyIDM0
MTgwNgYJKoZIhvcNAQkBFilwZXJzb25hX2p1cmlkaWNhX3BydWViYXMxQGFuZGVz
c2NkLmNvbS5jbzEsMCoGA1UEAxMjVXN1YXJpbyBkZSBQcnVlYmFzIFBlcnNvbmEg
SnVyaWRpY2ExETAPBgNVBAUTCDExMTExMTExMRkwFwYDVQQMExBQZXJzb25hIEp1
cmlkaWNhMSgwJgYDVQQLEx9DZXJ0aWZpY2FkbyBkZSBQZXJzb25hIEp1cmlkaWNh
MQ8wDQYDVQQHEwZCb2dvdGExFTATBgNVBAgTDEN1bmRpbmFtYXJjYTELMAkGA1UE
BhMCQ08wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQC0Dn8toZ2CXun+
63zwYecJ7vNmEmS+YouH985xDek7ImeE9lMBHXE1M5KDo7iT/tUrcFwKj717PeVL
52NtB6WU4+KBt+nrK+R+OSTpTno5EvpzfIoS9pLI74hHc017rY0wqjl0lw+8m7fy
Lfi/JO7AtX/dthS+MKHIcZ1STPlkcHqmbQO6nhhr/CGl+tKkCMrgfEFIm1kv3bdW
qk3qHrnFJ6s2GoVNZVCTZW/mOzPCNnnUW12LDd/Kd+MjN6aWbP0D/IJbB42Npqv8
+/oIwgCrbt0sS1bysUgdT4im9bBhb00MWVmNRBBe3pH5knzkBid0T7TZsPCyiMBs
tiLT3yfpAgMBAAGjggLpMIIC5TAMBgNVHRMBAf8EAjAAMB8GA1UdIwQYMBaAFKhL
tPQLp7Zb1KAohRCdBBMzxKf3MDcGCCsGAQUFBwEBBCswKTAnBggrBgEFBQcwAYYb
aHR0cDovL29jc3AuYW5kZXNzY2QuY29tLmNvMIIB4wYDVR0gBIIB2jCCAdYwggHS
Bg0rBgEEAYH0SAECCQIFMIIBvzBBBggrBgEFBQcCARY1aHR0cDovL3d3dy5hbmRl
c3NjZC5jb20uY28vZG9jcy9EUENfQW5kZXNTQ0RfVjIuNS5wZGYwggF4BggrBgEF
BQcCAjCCAWoeggFmAEwAYQAgAHUAdABpAGwAaQB6AGEAYwBpAPMAbgAgAGQAZQAg
AGUAcwB0AGUAIABjAGUAcgB0AGkAZgBpAGMAYQBkAG8AIABlAHMAdADhACAAcwB1
AGoAZQB0AGEAIABhACAAbABhAHMAIABQAG8AbADtAHQAaQBjAGEAcwAgAGQAZQAg
AEMAZQByAHQAaQBmAGkAYwBhAGQAbwAgAGQAZQAgAFAAZQByAHMAbwBuAGEAIABK
AHUAcgDtAGQAaQBjAGEAIAAoAFAAQwApACAAeQAgAEQAZQBjAGwAYQByAGEAYwBp
APMAbgAgAGQAZQAgAFAAcgDhAGMAdABpAGMAYQBzACAAZABlACAAQwBlAHIAdABp
AGYAaQBjAGEAYwBpAPMAbgAgACgARABQAEMAKQAgAGUAcwB0AGEAYgBsAGUAYwBp
AGQAYQBzACAAcABvAHIAIABBAG4AZABlAHMAIABTAEMARDAdBgNVHSUEFjAUBggr
BgEFBQcDAgYIKwYBBQUHAwQwRgYDVR0fBD8wPTA7oDmgN4Y1aHR0cDovL3d3dy5h
bmRlc3NjZC5jb20uY28vaW5jbHVkZXMvZ2V0Q2VydC5waHA/Y3JsPTEwHQYDVR0O
BBYEFL9BXJHmFVE5c5Ai8B1bVBWqXsj7MA4GA1UdDwEB/wQEAwIE8DANBgkqhkiG
9w0BAQsFAAOCAgEAb/pa7yerHOu1futRt8QTUVcxCAtK9Q00u7p4a5hp2fVzVrhV
QIT7Ey0kcpMbZVPgU9X2mTHGfPdbR0hYJGEKAxiRKsmAwmtSQgWh5smEwFxG0TD1
chmeq6y0GcY0lkNA1DpHRhSK368vZlO1p2a6S13Y1j3tLFLqf5TLHzRgl15cfauV
inEHGKU/cMkjLwxNyG1KG/FhCeCCmawATXWLgQn4PGgvKcNrz+y0cwldDXLGKqri
w9dce2Zerc7OCG4/XGjJ2PyZOJK9j1VYIG4pnmoirVmZbKwWaP4/TzLs6LKaJ4b6
6xLxH3hUtoXCzYQ5ehYyrLVwCwTmKcm4alrEht3FVWiWXA/2tj4HZiFoG+I1OHKm
gkNv7SwHS7z9tFEFRaD3W3aD7vwHEVsq2jTeYInE0+7r2/xYFZ9biLBrryl+q22z
M5W/EJq6EJPQ6SM/eLqkpzqMEF5OdcJ5kIOxLbrIdOh0+grU2IrmHXr7cWNP6MSc
SL7KSxhjPJ20F6eqkO1Z/LAxqNslBIKkYS24VxPbXu0pBXQvu+zAwD4SvQntIG45
y/67h884I/tzYOEJi7f6/NFAEuV+lokw/1MoVsEgFESASI9sN0DfUniabyrZ3nX+
LG3UFL1VDtDPWrLTNKtb4wkKwGVwqtAdGFcE+/r/1WG0eQ64xCq0NLutCxg=
-----END CERTIFICATE-----

"
;
echo "certificado <pre>";
var_dump($publicKey2);
echo "</pre>certificado<br><br><br> ";



$certData2   = openssl_x509_parse($publicKey2);


$certDigest2 = base64_encode(openssl_x509_fingerprint($publicKey2, "sha512", true));


$certIssuer2 = array();
foreach ($certData2['issuer'] as $item=>$value) 
    {
      	$certIssuer2[] = $item . '=' . $value;
    }
	$certIssuer2 = implode(', ', array_reverse($certIssuer2));

echo "<br>certDigest2<br><br>";

				echo "base 64 diges cer ->  ". $certDigest2;

echo "<br>";
				echo "<pre>";
					var_dump($certIssuer2);
				echo "</pre>";
	
echo "<br>";
				echo "numero de serie -> ".$certData2['serialNumber'];
echo "<br>";
				echo "<pre>";
				var_dump($certData2['issuer'] );
				echo "</pre>";







exit();


echo "<br><br><pre>key ";
var_dump($key);
echo " key</pre><br><br>";


				echo $publicKey                 =$key["cert"];
				echo "<br><br><br>".$privateKey =$key["pkey"];
				echo "<br><br><pre>";
				$complem                        = openssl_pkey_get_details(openssl_pkey_get_private($privateKey));
				var_dump($complem );
				echo "</pre><br><br>";
				echo "<br><br><br>".$Modulus    = base64_encode($complem['rsa']['n']);
				echo "<br><br><br>".$Exponent   = base64_encode($complem['rsa']['e']);




/*
	$x = openssl_csr_get_subject('vacasenvuelo.com',true);

	var_dump($x);


	echo "Devuelve la clave púbilca de un CERT<br>";
*/