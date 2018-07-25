<?php 


$publicKey = NULL;

$pfx              = file_get_contents('persona_juridica_pruebas_vigente.p12');
$clavecertificado = 'persona_juridica_pruebas1';
//$pkcs12_read = openssl_pkcs12_read($pfx, $key, $clavecertificado);


openssl_pkcs12_read($pfx, $key, $clavecertificado);





$publicKey2  = "-----BEGIN CERTIFICATE-----
MIIIYDCCBkigAwIBAgIIIHpLoQAt/NswDQYJKoZIhvcNAQELBQAwgbQxIzAhBgkqhkiG9w0BCQEW
FGluZm9AYW5kZXNzY2QuY29tLmNvMSMwIQYDVQQDExpDQSBBTkRFUyBTQ0QgUy5BLiBDbGFzZSBJ
STEwMC4GA1UECxMnRGl2aXNpb24gZGUgY2VydGlmaWNhY2lvbiBlbnRpZGFkIGZpbmFsMRMwEQYD
VQQKEwpBbmRlcyBTQ0QuMRQwEgYDVQQHEwtCb2dvdGEgRC5DLjELMAkGA1UEBhMCQ08wHhcNMTgw
NzE2MTYwMTAwWhcNMjAwNzE1MTYwMDAwWjCCARUxHTAbBgNVBAkTFENhbGxlIEZhbHNhIE5vIDEy
IDM0MTgwNgYJKoZIhvcNAQkBFilwZXJzb25hX2p1cmlkaWNhX3BydWViYXMxQGFuZGVzc2NkLmNv
bS5jbzEpMCcGA1UEAxMgVVNVQVJJTyBQUlVFQkFTIFBFUlNPTkEgSlVSSURJQ0ExEjAQBgNVBAUT
CTExMTExMTExNjEZMBcGA1UEDBMQUEVSU09OQSBKVVJJRElDQTErMCkGA1UECxMiRW1pdGlkbyBw
b3IgQW5kZXMgU0NEIENyYSAyNyA4NiA0MzEPMA0GA1UEBxMGQk9HT1RBMRUwEwYDVQQIEwxDVU5E
SU5BTUFSQ0ExCzAJBgNVBAYTAkNPMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAv3SD
wo6bh7ze3uAQWnuTzYXwqFTNllalBLT+EOR7U1Vz16lEInR+8HaXXdLwLkm6lOKe11JRQfSKTdw/
YMFNpoFShVQ6qQNmI/cMrmd3/pUGpLLDwUw9KkCLjKQpVyl/uGpjQn5Buk/0ToC5sYHwdn+Pakap
ccDxnrIMNJIXI9Dlb3AgF+DT6RDi0zXQkeXoMY8ozmN276s2lVj6F5jR7keF2QoyGvl2Ep0IXdSx
nH3fM/WlqKLeo/mPXzxPHcjwLbKsekY2qurZmd49Jj0ug3058YVSFL/7Uiw5cWKql38PqdJPFtbV
q3ZTBGNs/aTOE8R7JUaU0tuvim73RYAV7wIDAQABo4IDEDCCAwwwDAYDVR0TAQH/BAIwADAfBgNV
HSMEGDAWgBSoS7T0C6e2W9SgKIUQnQQTM8Sn9zA3BggrBgEFBQcBAQQrMCkwJwYIKwYBBQUHMAGG
G2h0dHA6Ly9vY3NwLmFuZGVzc2NkLmNvbS5jbzA0BgNVHREELTArgSlwZXJzb25hX2p1cmlkaWNh
X3BydWViYXMxQGFuZGVzc2NkLmNvbS5jbzCCAeMGA1UdIASCAdowggHWMIIB0gYNKwYBBAGB9EgB
AgkCCDCCAb8wQQYIKwYBBQUHAgEWNWh0dHA6Ly93d3cuYW5kZXNzY2QuY29tLmNvL2RvY3MvRFBD
X0FuZGVzU0NEX1YyLjkucGRmMIIBeAYIKwYBBQUHAgIwggFqHoIBZgBMAGEAIAB1AHQAaQBsAGkA
egBhAGMAaQDzAG4AIABkAGUAIABlAHMAdABlACAAYwBlAHIAdABpAGYAaQBjAGEAZABvACAAZQBz
AHQA4QAgAHMAdQBqAGUAdABhACAAYQAgAGwAYQBzACAAUABvAGwA7QB0AGkAYwBhAHMAIABkAGUA
IABDAGUAcgB0AGkAZgBpAGMAYQBkAG8AIABkAGUAIABQAGUAcgBzAG8AbgBhACAASgB1AHIA7QBk
AGkAYwBhACAAKABQAEMAKQAgAHkAIABEAGUAYwBsAGEAcgBhAGMAaQDzAG4AIABkAGUAIABQAHIA
4QBjAHQAaQBjAGEAcwAgAGQAZQAgAEMAZQByAHQAaQBmAGkAYwBhAGMAaQDzAG4AIAAoAEQAUABD
ACkAIABlAHMAdABhAGIAbABlAGMAaQBkAGEAcwAgAHAAbwByACAAQQBuAGQAZQBzACAAUwBDAEQw
HQYDVR0lBBYwFAYIKwYBBQUHAwIGCCsGAQUFBwMEMDcGA1UdHwQwMC4wLKAqoCiGJmh0dHA6Ly9j
cmwuYW5kZXNzY2QuY29tLmNvL0NsYXNlSUkuY3JsMB0GA1UdDgQWBBRUjWJQVEFntgwevlajYYAt
AnoaUzAOBgNVHQ8BAf8EBAMCBPAwDQYJKoZIhvcNAQELBQADggIBAEpVBAUxFC11Q6jrz2Zuy1Cb
WOV3wGXHRc9kqv0IYIm9hTWN53lWKT6oJ/uL+wPKCFvNwBCChmWcB1NpsY42m1Q7aEa2K3fJWTN4
QCPoNUPJs+VhGUYXV6FgLPYyWcJjtaA4AZ31tHZXEcFZ0CG8cu4bEqPmKriu05Gg/7IL3UGQyZQs
SJyaSwAzAR+/ShLHitH8tzmuo4iHvM6Mt2QBEpd9j5P6ZIeDKhKGkjRoUMdEVbJncG2555cjQEho
cONJcCmYT7yr7I8wVnC2oLkMX2EB1i5FHnWvA83z72Tjy/XIYrcPCPbqT7sMgM+z5U21RNo22JtZ
MMJpQyjNsmGa/ohnyqv4Rdmc/NDWGOMwi/YDvjjXfOtxZtI/mKhUkGyiNryCA7Lb/FSVyPViuLPB
cuuCGC0ushwoNGUqsf4ZLrIp42743iu0SlPkar2d3bHMzxbr7M327WXlWD1xCSql0HpBN7//AZgy
oQJNqnPxUoQ1UY/NBuX1Kzho7KlwmXKJv3jPdvDRshp0E975f+yIv9iqRKaIWAV6YspePevl1Z+f
eKofOdrYs0u1kwwnlAiTBOGuGOVvgU0DVkyaKqagIu33LfttVrXipIl62AP6XrZdLf89u5Jo3nMv
+HW2Y3MvmDsNIOOs+c9D6G9mu1rhbIa0CLRqbQ3Twf5FLR0pe+wo
-----END CERTIFICATE-----";
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

				echo "base 64 diges cer ". $certDigest2;

echo "<br>";
				echo "<pre>";
					var_dump($certIssuer2);
				echo "</pre>";
	
echo "<br>";
				echo "numero de serie ".$certData2['serialNumber'];
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