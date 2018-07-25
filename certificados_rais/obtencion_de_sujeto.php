<?php 

/*
$publicKey = NULL;

$pfx              = file_get_contents('persona_juridica_pruebas_vigente.p12');
$clavecertificado = 'persona_juridica_pruebas1';
//$pkcs12_read = openssl_pkcs12_read($pfx, $key, $clavecertificado);


openssl_pkcs12_read($pfx, $key, $clavecertificado);


*/
$publicKey1  = "-----BEGIN CERTIFICATE-----
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
-----END CERTIFICATE-----";
$publicKey2  = "-----BEGIN CERTIFICATE-----
MIIGrTCCBJWgAwIBAgIIYO/0pT85fvowDQYJKoZIhvcNAQELBQAwgaExIzAhBgkq
hkiG9w0BCQEWFGluZm9AYW5kZXNzY2QuY29tLmNvMR8wHQYDVQQDExZST09UIENB
IEFOREVTIFNDRCBTLkEuMSIwIAYDVQQLExlEaXZpc2lvbiBkZSBjZXJ0aWZpY2Fj
aW9uMRIwEAYDVQQKEwlBbmRlcyBTQ0QxFDASBgNVBAcTC0JvZ290YSBELkMuMQsw
CQYDVQQGEwJDTzAeFw0xODA3MTYxNDMzNDRaFw0yMTA4MDkxNDA1MzhaMIG0MSMw
IQYJKoZIhvcNAQkBFhRpbmZvQGFuZGVzc2NkLmNvbS5jbzEjMCEGA1UEAxMaQ0Eg
QU5ERVMgU0NEIFMuQS4gQ2xhc2UgSUkxMDAuBgNVBAsTJ0RpdmlzaW9uIGRlIGNl
cnRpZmljYWNpb24gZW50aWRhZCBmaW5hbDETMBEGA1UEChMKQW5kZXMgU0NELjEU
MBIGA1UEBxMLQm9nb3RhIEQuQy4xCzAJBgNVBAYTAkNPMIICIjANBgkqhkiG9w0B
AQEFAAOCAg8AMIICCgKCAgEA1TZmBmaPHG4A2lNdXXBElS5SvaxCgIdQkrcFr63J
ZTFZE4l/8oXQE8Uw7v0M4/wklj9efwegO4j2bza3Uyl4Lkn7Meq6SOt542qy5JWB
wqWHAvn7QUfBbTR/OPAC9l2sWHksvyfy0gr8Dez0BUei9DhEvIJRS4e0xRrQMDkE
6lmfl9WbVdLI6+pRMn8+t53UKIQwaJcsitKIXIDEk3iE+m+TeVLM/5keuA6ZLU85
o0qoRuxOVnuxF5waI8vDaVFEfM5I93+by/zZI9gc7Wmc0aTClq5UwqUCubnyzW5r
V85QxLvdIFKYvcCLMr1PkIVrVDlzEKqBoI1lUar/ByobPeFCh18AZ63gQSD0Flsf
gx4hHiatfFG0Dv6DpDGrHNKEorO6BexR6533am2rPXUf9OcqepAtVl5OBVuHGDBb
vTaFMnhQTyyiOFUVrKMIbFVqfEXgQ8le5JcgFkWr+2vb9JtO5ZrglkPxaRaIQTza
N74J8/kGzZUYt5oFebESOfrAlkxrDEW7k6xnRD7SwgZT/deumGZ5bJvdwjj4ZY5d
DkQEnUiq5EhLEKTMVPD/Lyc0z+sGc4yHhxycNWr7GJszGdBsbNK3EMv17rvcHMYr
RGfVlljJlJvBwSu0JAhgmm7XhJ5pO3z5FKVo/X5MW/vZPbcpg/j86fjYgNzAmBij
tEECAwEAAaOB0zCB0DAPBgNVHRMBAf8EBTADAQH/MB8GA1UdIwQYMBaAFN0Rklqp
bAQM/jSiWL/rHfvfCLBvMDcGCCsGAQUFBwEBBCswKTAnBggrBgEFBQcwAYYbaHR0
cDovL29jc3AuYW5kZXNzY2QuY29tLmNvMDQGA1UdHwQtMCswKaAnoCWGI2h0dHA6
Ly9jcmwuYW5kZXNzY2QuY29tLmNvL1JhaXouY3JsMB0GA1UdDgQWBBSoS7T0C6e2
W9SgKIUQnQQTM8Sn9zAOBgNVHQ8BAf8EBAMCAYYwDQYJKoZIhvcNAQELBQADggIB
AGG3vzJPKbVzmP573tSBuDG2G06445zGe8cBQ1aHickejat6H49ZrF0q6OFd3weD
u3iV+HaJRvsmBCqsYqapb7iIiCcxf+ETwEBTGox39lpnMqIpqZ9Jk77DuUsAUMJV
9ZV5F36g0KUqQxPa7dACDHLMuJX/K/+JL7vT2h7qCu49Baz8ShxipwxWbZWaOTUv
si1Cx41Md0owL5eT/QgRn+eZBvAfu06n3M+URDNX4gOul+R1A89KXQhnTHdOODkZ
ss9f4NVnkpJYPySZsaE5SAhBhHgdbxKUafsJwmuYuW7Qr3ix8Ph8QOVlKDlTrX5Y
YWB9l3O0Fr0GZW5HEdpTB6IWcQAhCudDndc7zstje4VHF68TNFxAKt/CpSxXejiY
p1FxMvwfJBhqq53llvbzr6inDiCg07m/2ND7ONmULbQNX3mKImC+VzBxq0MRvD0o
cyrchkk8uEGJFPRErwePb5/8R9Hh8jHX7Kyvj0sTYnnOYOItAtCkDjgBIxrEEt7b
Y8wVNs6OKJjxw3oG3S1YBbgUDQzU8ahB6n5eJwgQ6jU84e3SbATWQ0vVt/folQuV
W25aXePkx1Rj/awrpx7Iaqm7i4TRJ8B5Lt4ihgo1tFkmyYQe+u2zxrC1Md1PMibZ
FqOEru5Gf3P5tTz4dn/LErI/6mg6Ew7Z+eAAKbyk/z7P
-----END CERTIFICATE-----
";
$publicKey3  = "-----BEGIN CERTIFICATE-----
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
-----END CERTIFICATE-----";
/*echo "certificado <pre>";
var_dump($publicKey2);
echo "</pre>certificado<br><br><br> ";
*/
/////////////////////////////////////////////////////  cer 1 //////////////////////////////////////////////////////
$certData1   = openssl_x509_parse($publicKey1);
$certDigest1 = base64_encode(openssl_x509_fingerprint($publicKey1, "sha512", true));
$certIssuer1 = array();
foreach ($certData1['issuer'] as $item=>$value) 
    {
      	$certIssuer1[] = $item . '=' . $value;
    }
	$certIssuer1 = implode(', ', array_reverse($certIssuer1));
echo "<br>certDigest1<br><br>";
				echo "base 64 diges cer ->  ". $certDigest1;
echo "<br>";
				echo "<pre>";
					var_dump($certIssuer1);
				echo "</pre>";
echo "<br>";
				echo "numero de serie -> ".$certData1['serialNumber'];
echo "<br>";
				echo "<pre>";
				var_dump($certData1['issuer'] );
				echo "</pre>";
/////////////////////////////////////////////////////  cer 3 //////////////////////////////////////////////////////
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
/////////////////////////////////////////////////////  cer 3 //////////////////////////////////////////////////////
$certData3   = openssl_x509_parse($publicKey3);
$certDigest3 = base64_encode(openssl_x509_fingerprint($publicKey3, "sha512", true));
$certIssuer3 = array();
foreach ($certData3['issuer'] as $item=>$value) 
    {
      	$certIssuer3[] = $item . '=' . $value;
    }
	$certIssuer3 = implode(', ', array_reverse($certIssuer3));
echo "<br>certDigest3<br><br>";
				echo "base 64 diges cer ->  ". $certDigest3;
echo "<br>";
				echo "<pre>";
					var_dump($certIssuer3);
				echo "</pre>";
echo "<br>";
				echo "numero de serie -> ".$certData3['serialNumber'];
echo "<br>";
				echo "<pre>";
				var_dump($certData3['issuer'] );
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