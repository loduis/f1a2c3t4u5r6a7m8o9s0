<?php
//variables 
	$token      = rand().'d52903f7d8b7';
	$Username   = '79cadac2-aa74-4ed1-95b3-1af07694027c';
	$password   = hash('sha256','Bello2010R');
	$nonce   	= base64_encode(rand());
    $wsdl 		= "https://facturaelectronica.dian.gov.co/habilitacion/B2BIntegrationEngine/FacturaElectronica/facturaElectronica.wsdl";
    $client 	= new SoapClient($wsdl, array("trace"=>1,"exceptions"=>0));
	date_default_timezone_set("America/Bogota");
	$created   = date('Y-m-d\TH:i:s.v\Z');  
	$xmlHeader = 
				'<wsse:Security  SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
						<wsse:UsernameToken>
								<wsse:Username>'.$Username.'</wsse:Username>
								<wsse:Password>'.$password.'</wsse:Password>
								<wsse:Nonce>'.$nonce.'</wsse:Nonce>
								<wsu:Created>'.$created .'</wsu:Created>
						</wsse:UsernameToken>
					</wsse:Security>';
	$url       = 'http://www.w3.org/2001/XMLSchema';
	$jabon     = new SoapVar($xmlHeader, XSD_ANYXML);
	$xHeader   = new SoapHeader($url,'Security', $jabon ,true);   		
//-----------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$date          = date('Y-m-d\TH:i:s');
//------------------------------------------nit
	$nit           ="890912995";	//nit de factura
//------------------------------------------nit	
//------------------------------------------AuthorizationPeriod //Facturas autorizadas
	$Prefix 			  ='PRUE';	//Prefijo
	$From   			  ='980000000';	//De
	$To     			  ='985000000';	//a
	$rango	  	   ="980000013";
	$InvoiceNumber = $Prefix.$rango;
//------------------------------------------AuthorizationPeriod // Facturas autorizadas	
//------------------------------------------InvoiceAuthorization
	$InvoiceAuthorization = '9000000033441155';	//Autorización de factura
//------------------------------------------InvoiceAuthorization
//------------------------------------------AuthorizationPeriod
	$StartDate            = '2018-04-06';	//fecha inicio resolución
	$EndDate              = '2028-04-06';	//Fecha final resolución
//------------------------------------------AuthorizationPeriod
//------------------------------------------IdentificationCode 
	$IdentificationCode = 'CO';	//Código de identificación
//------------------------------------------IdentificationCode
//------------------------------------------SoftwareProvider
	$ProviderID =$nit;	//identificacion del facturador ante la dian
	$SoftwareID ='79cadac2-aa74-4ed1-95b3-1af07694027c';	//identificacion del facturador ante la dian
//------------------------------------------SoftwareProvider
	$ClTec 		= 'dd85db55545bd6566f36b0fd3be9fd8555c36e';
//------------------------------------------Pin
	$Pin = 'Groldan'; //pin secreto 
//------------------------------------------Pin
//------------------------------------------SoftwareSecurityCode
	echo $SoftwareSecurityCode = hash('sha384',$SoftwareID.$Pin); //ESPECIFICACIÓN TÉCNICA DEL CÓDIGO DE SEGURIDAD DEL SOFTWARE
	//$SoftwareSecurityCode = hash('sha384','ff8d5e3f-6746-40cb-9621-d52903f7d8b73L3m3nt'); //ESPECIFICACIÓN TÉCNICA DEL CÓDIGO DE SEGURIDAD DEL SOFTWARE
//------------------------------------------SoftwareSecurityCode
//------------------------------------------KeyInfo
	$KeyInfo = $token; // <ds:KeyInfo Id="'.$KeyInfo.'"> confirmar :(
//------------------------------------------KeyInfo
//------------------------------------------X509Certificate
	$X509Certificate	= 	'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';
	// Firma del certificado
//------------------------------------------X509Certificate
//------------------------------------------SigningTime
	$SigningTime = date('Y-m-d\TH:i:s.v')."-05:00";		// Tiempo de firma
//------------------------------------------SigningTime
//------------------------------------------Productos___InvoiceLine___Línea de factura
		$id_producto         = '1';
		$cantidad            = '765';
		$descripcion         = 'Línea-1 PRUE980007161 f-s0001_900373115_0d2e2_R9000000500017960-PRUE-A_cufe';
		$Precio              = '1483.4518917264927';
//------------------------------------------Productos___InvoiceLine___Línea de factura
//------------------------------------------Cufe__Note
$IssueDate           =  date('Y-m-d'); //Fecha de asunto
$IssueTime           =  date('H:i:s');	//Tiempo de emisión
$LineExtensionAmount = '500.00'; //<!-- Valor de la factura sin IVA-->
$TaxExclusiveAmount  = '95.00';  //<!--Importe exclusivo de impuestos -->
$PayableAmount       = '595.00';  //<!-- Valor total de la factura con impuestos -->
$Nit                 =  $nit;	//nit facturador
$Note                = 'Nota'; 			//prueba de nota


////////////////////////////////////////////////////////  cufe
$NumFac = $InvoiceNumber;   //Número de factura.
//$FecFac = $IssueDate.$IssueTime; // Fecha de factura en formato (Java) YYYYmmddHHMMss
$FecFac = date('Ymd').date('His'); // Fecha de factura en formato (Java) YYYYmmddHHMMss
$ValFac = $LineExtensionAmount; //Valor Factura sin IVA, con punto decimal, con decimales a dos (2) dígitos, sin separadores de miles, ni símbolo pesos.

$CodImp1 = '01'; //  01  fe:Invoice/fe:TaxTotal[x]/fe:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID = 01
$ValImp1 = '95.00';//  Valor impuesto 01, con punto decimal, con decimales a dos (2)  dígitos, sin separadores de miles, ni símbolo pesos.    fe:Invoice/fe:TaxTotal[x]/fe:TaxSubtotal/cbc:   TaxAmount

$CodImp2 = '02';//  02  fe:Invoice/fe:TaxTotal[y]/fe:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID = 02
$ValImp2 = '0.00';//Valor impuesto 02, con punto decimal, con decimales a dos (2)  dígitos, sin separadores de miles, ni símbolo pesos. fe:Invoice/fe:TaxTotal[y]/fe:TaxSubtotal/cbc:TaxAmount

$CodImp3 = '03';//fe:Invoice/fe:TaxTotal[z]/fe:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID = 03
$ValImp3 = '0.00';// Valor impuesto 03, con punto decimal, con decimales a dos (2)  dígitos, sin separadores de miles, ni símbolo pesos.   fe:Invoice/fe:TaxTotal[z]/fe:TaxSubtotal/cbc:TaxAmount

$ValImp = $PayableAmount; //Valor total, con punto decimal, con decimales a dos (2) dígitos, sin separadores de miles, ni símbolo pesos.   fe:Invoice/fe:LegalMonetaryTotal/cbc:PayableAmount cantidad a pagar

$NitOFE = $Nit; //NIT del Facturador Electrónico sin puntos ni guiones, sin digito de verificación.   fe:Invoice/fe:AccountingSupplierParty/fe:Party/cac:PartyIdentification/cbc:ID

$TipAdq = '31';  // tipo de adquiriente, de acuerdo con el valor registrado en /fe:Invoice/fe:AccountingCustomerParty/fe:Party/cac:PartyIdentification/cbc:ID/@schemeID la tabla Tipos de documentos de identidad del «Anexo 001 Formato estándar XML de la Factura, notas débito y notas crédito electrónicos»; si no se determinó y es un NIT, entonces use el valor “O-99”, de lo contrario use “R-00-PN”. //fe:Invoice/fe:AccountingCustomerParty/fe:Party/cac:PartyIdentification/cbc:ID

$NumAdq = $nit; // Número de identificación del adquirente sin puntos ni guiones, sin digito de verificación. 

$ClTec  = $ClTec; //clave tenica de la resolucion

$cufe = sha1($NumFac.$FecFac.$ValFac.$CodImp1.$ValImp1.$CodImp2.$ValImp2.$CodImp3.$ValImp3.$ValImp.$NitOFE.$TipAdq.$NumAdq.$ClTec);

	/*$x = $NumFac.$FecFac.$ValFac.$CodImp1.$ValImp1.$CodImp2.$ValImp2.$CodImp3.$ValImp3.$ValPag.$NitOFE.$TipAdq.$NumAdq.$ClTec;
	$x = sha1($x);
	$cufe = $x;*/
//------------------------------------------Cufe__Note
//exit;



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$xml= '<?xml version="1.0" encoding="UTF-8"?>
<fe:Invoice xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" 
	xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" 
	xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" 
	xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" 
	xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" 
	xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" 
	xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" 
	xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" 
	xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" 
	xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" 
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
	xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">
	<ext:UBLExtensions>
<!--_____________________________________ini__ExtensionContent_1_____________________________________-->
		<ext:UBLExtension>
			<ext:ExtensionContent>
				<sts:DianExtensions>
					<sts:InvoiceControl>
						<sts:InvoiceAuthorization>'.$InvoiceAuthorization.'</sts:InvoiceAuthorization>
						<sts:AuthorizationPeriod>
							<cbc:StartDate>'.$StartDate.'</cbc:StartDate>
							<cbc:EndDate>'.$EndDate.'</cbc:EndDate>
						</sts:AuthorizationPeriod>
						<sts:AuthorizedInvoices>
							<sts:Prefix>'.$Prefix.'</sts:Prefix>
							<sts:From>'.$From.'</sts:From>
							<sts:To>'.$To.'</sts:To>
						</sts:AuthorizedInvoices>
					</sts:InvoiceControl>
					<sts:InvoiceSource>
						<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">'.$IdentificationCode.'</cbc:IdentificationCode>
					</sts:InvoiceSource>
					<sts:SoftwareProvider>
						<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$ProviderID.'
						</sts:ProviderID>
						<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$SoftwareID.'
						</sts:SoftwareID>						
						<!--
						<sts:ProviderID  
							schemeAgencyID="195"  
							schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"  
							schemeName="SoftwareMakerID"  
							schemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/anexo_v1_0.html#SoftwareMakerID">
								'.$ProviderID.'
						 </sts:ProviderID>
						 <sts:SoftwareID 
						 	schemeAgencyID="195"  
						 	schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"  
						 	schemeName="SoftwareID" 
						 	schemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/anexo_v1_0.html#sofwareID">
								'.$SoftwareID.'
						 </sts:SoftwareID>
						 -->
					</sts:SoftwareProvider>
						<!--<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$SoftwareSecurityCode.'</sts:SoftwareSecurityCode>-->
					<sts:SoftwareSecurityCode 
							schemeAgencyID="195" 
							schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)"
		 					schemeName="SoftwareSecurityCode"
							schemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/anexo_v1_0.html#SofwareSecurityCode">'.$SoftwareSecurityCode.'</sts:SoftwareSecurityCode>
				</sts:DianExtensions>
			</ext:ExtensionContent>
		</ext:UBLExtension>
<!--_____________________________________fin__ExtensionContent_1_____________________________________-->
<!--_____________________________________ini__ExtensionContent_2_____________________________________-->
		<ext:UBLExtension>
			<ext:ExtensionContent>
<!-- 
Signature  				// Elemento_raíz_de_la_firma._Puede_llevar_opcionalmente_identificador 
SignedInfo  			// Contiene toda la información sobre los datos firmados e información adicional para verificación de firmar 
CanonicalizationMethod 	// Método para generar una representación canónica que iguala los documentos XML sintácticamente equivalentes				
SignatureMethod			// Indica el algoritmo usado para firmar los datos	  
Reference  				// URI que indica el objeto (u objetos) firmados     	
Transforms				// Lista ordenada de transformaciones aplicadas a los datos antes de hacer el hash. Se usa en firmas enveloped 
						   para eliminar el elemento signature antes de calcular la firma  
DigestMethod 			// Algoritmo utilizado para obtener el hash del objeto 
DigestMethod    		// Algoritmo utilizado para obtener el hash del objeto 
DigestValue 			// Contiene el valor del hash del objeto 
-->
<ds:Signature Id="xmldsig-24d43742-0c80-4aa1-ae9c-c0b28b0ef51d" xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
<ds:SignedInfo>
<ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
<ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
<ds:Reference Id="xmldsig-24d43742-0c80-4aa1-ae9c-c0b28b0ef51d-ref0" URI="">
<ds:Transforms>
<ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
</ds:Transforms>
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
<ds:DigestValue>mq/BgqGqxbsDB+f0/cZqNo9gkl57KMuyzIp6Gk5v82ciaqgx2NIWbn8Ilm7UqvY2z4gnFklWjJ8bdgYW4MNNgQ==</ds:DigestValue>
</ds:Reference>
<ds:Reference URI="#xmldsig-87d128b5-aa31-4f0b-8e45-3d9cfa0eec26-keyinfo">
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
<ds:DigestValue>bAPLmu+InkU40yIZQ8ojH8CrdLRMszAqA5FP9TBPzewYBfUYXaYTNjjV2ADoQEIqWWDAIII7G/umCqYPm9jfhA==</ds:DigestValue>
</ds:Reference>
<ds:Reference Type="http://uri.etsi.org/01903#SignedProperties" URI="#xmldsig-24d43742-0c80-4aa1-ae9c-c0b28b0ef51d-signedprops">
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
<ds:DigestValue>7q5WsRPUEhEQU6XAT0WbVud6RLnErkQ+eBrw3pFddg9tV/qD/Kulg91iaTGFHoFnIm26yrWQIxIFyG07JlGP3w==</ds:DigestValue>
</ds:Reference>
</ds:SignedInfo>
<ds:SignatureValue Id="xmldsig-24d43742-0c80-4aa1-ae9c-c0b28b0ef51d-sigvalue">
Ft1F812vHID+zVt8osGvIxje5ylKFdwSeLWlPkvNBA0ZHGw5yxD+/NG+cAVkZsG/GsLgBVWgoxo6
pJJKTKSid9yXWh3YBw8UKw1hL1CWjj3LLKXT+bKUCSu726F3NoeSDi0MgVj3fr9avKXrAf/uHjPh
G/RYgs6y1SHGv6JV9MKDDw4vhERyVaUox+kQQp/ldFo90xdXP9aw/OVXPFzcDT9WfvAQAJ+o6Ynl
iJX9tWWcUhN+EtHCOYN85hOR32VKo4Hx8luE3glk75YOqGx/OsFLZmMmtOdTeN+FTUa6/nX+t/bu
ZdylCc3PZfWOI4K4/JMGFRD4zNKh4yogKeZ2oA==
</ds:SignatureValue>
<ds:KeyInfo Id="xmldsig-87d128b5-aa31-4f0b-8e45-3d9cfa0eec26-keyinfo">
<ds:X509Data>
<ds:X509Certificate>
MIIIQDCCBiigAwIBAgIIO1QwKogW+nEwDQYJKoZIhvcNAQELBQAwgbQxIzAhBgkqhkiG9w0BCQEW
FGluZm9AYW5kZXNzY2QuY29tLmNvMSMwIQYDVQQDExpDQSBBTkRFUyBTQ0QgUy5BLiBDbGFzZSBJ
STEwMC4GA1UECxMnRGl2aXNpb24gZGUgY2VydGlmaWNhY2lvbiBlbnRpZGFkIGZpbmFsMRMwEQYD
VQQKEwpBbmRlcyBTQ0QuMRQwEgYDVQQHEwtCb2dvdGEgRC5DLjELMAkGA1UEBhMCQ08wHhcNMTYw
ODA1MTcwMjAwWhcNMTcwODA1MTcwMTAwWjCB9jEdMBsGA1UECRMUQ0FSUkVSQSAxOCAgMTA5IEEg
MzAxKTAnBgkqhkiG9w0BCQEWGkZQT0xPQERBVEFFWFBSRVNTSU5UTVguQ09NMSowKAYDVQQDEyFE
QVRBIEVYUFJFU1MgTEFUSU5PQU1FUklDQSBTLkEuUy4xEzARBgNVBAUTCjkwMDk0OTgxMjIxGTAX
BgNVBAwTEFBFUlNPTkEgSlVSSURJQ0ExGTAXBgNVBAsTEFBlcnNvbmEgSnVyaWRpY2ExDzANBgNV
BAcTBkJPR09UQTEVMBMGA1UECBMMQ1VORElOQU1BUkNBMQswCQYDVQQGEwJDTzCCASIwDQYJKoZI
hvcNAQEBBQADggEPADCCAQoCggEBAJrMyimtI4EO7ZtGSn9oGmvlsL9rnfgQHyszgcFGK6FK57to
O3U74PR2yg8iV8xrChe2uEEonU0stksQjnRZBxEk5LDYhyFbjMopBh/IjidFN0jNZWKUukdz1qkh
vLOJ0aVD24Se2eO3KCIhofgGTBkYPEppWV0nv4qkkiJy4lYGLTMaBGMshk60R2H2YUPgdgzhI4co
5oNasIN39928OVcxwFj9aX5OYSZGet9pBOLlgMHkF+UeSDe7AEs4zYANfWPoAt0lnbVGa+ndGwRg
LTYI5MMt7HNJjp5E6BdaiYuIYFa40ZitDKHipoZJbW3w1OCRxoBD5+cKwiWC2e9w3+cCAwEAAaOC
AxAwggMMMDcGCCsGAQUFBwEBBCswKTAnBggrBgEFBQcwAYYbaHR0cDovL29jc3AuYW5kZXNzY2Qu
Y29tLmNvMB0GA1UdDgQWBBRPTxd++2QlZp7f0JGuuL3/sVqVUTAMBgNVHRMBAf8EAjAAMB8GA1Ud
IwQYMBaAFKhLtPQLp7Zb1KAohRCdBBMzxKf3MIIB4wYDVR0gBIIB2jCCAdYwggHSBg0rBgEEAYH0
SAECCQIBMIIBvzCCAXgGCCsGAQUFBwICMIIBah6CAWYATABhACAAdQB0AGkAbABpAHoAYQBjAGkA
8wBuACAAZABlACAAZQBzAHQAZQAgAGMAZQByAHQAaQBmAGkAYwBhAGQAbwAgAGUAcwB0AOEAIABz
AHUAagBlAHQAYQAgAGEAIABsAGEAcwAgAFAAbwBsAO0AdABpAGMAYQBzACAAZABlACAAQwBlAHIA
dABpAGYAaQBjAGEAZABvACAAZABlACAAUABlAHIAcwBvAG4AYQAgAEoAdQByAO0AZABpAGMAYQAg
ACgAUABDACkAIAB5ACAARABlAGMAbABhAHIAYQBjAGkA8wBuACAAZABlACAAUAByAOEAYwB0AGkA
YwBhAHMAIABkAGUAIABDAGUAcgB0AGkAZgBpAGMAYQBjAGkA8wBuACAAKABEAFAAQwApACAAZQBz
AHQAYQBiAGwAZQBjAGkAZABhAHMAIABwAG8AcgAgAEEAbgBkAGUAcwAgAFMAQwBEMEEGCCsGAQUF
BwIBFjVodHRwOi8vd3d3LmFuZGVzc2NkLmNvbS5jby9kb2NzL0RQQ19BbmRlc1NDRF9WMi4xLnBk
ZjBGBgNVHR8EPzA9MDugOaA3hjVodHRwOi8vd3d3LmFuZGVzc2NkLmNvbS5jby9pbmNsdWRlcy9n
ZXRDZXJ0LnBocD9jcmw9MTAOBgNVHQ8BAf8EBAMCBeAwHQYDVR0lBBYwFAYIKwYBBQUHAwIGCCsG
AQUFBwMEMCUGA1UdEQQeMByBGkZQT0xPQERBVEFFWFBSRVNTSU5UTVguQ09NMA0GCSqGSIb3DQEB
CwUAA4ICAQCOAKFd9wrh5GfMm1xnRBt4aSznUylfN2rPL4j3vL3K22VcMyIqheacHWBwsPM4baa4
NAG8Qazjv7MzZELBdApxEpc23A7GXp4pTBxTKWZKogRd1AAHdeIyUTcOBwtGlxh4NSh7ZYeK5PqY
i07IjytXMjlLG6yYKPO7oIS7TLhAKw00BxsyJxq072MwjCgd3aO4Q7eBV3xn817CbT8D3HTFCWIJ
yEI4XBINhsfHqzg8jkplouhR30qKBCOxiXH3bGGc6n/8uoNmT5P4cfXPmUPKm8SCfmAmGdupP5jT
slIvjS5K9NRI8+0V8MMmiyBysCogq0Svnn61QSSS3fibY3l42X2Fn/qOJW5f6cO/2dRVUD840nJI
oE+37yPpx9g2h88xXETV2uAu/XiO2JSqOHjRB21H9zx6GkXl7jOZiQZYKB0yhFhZn09rbE7Qi0+q
tqS7VWxtpNPdqTziIaQSD2ZFWk036D3nd/TFEBWfs3JCklvy/0VhV4008WsKRfs9MlZT06xCHB0Q
CFFtb1ReftjG1QOTCP6JEGn7bBNvLBiqTXHtRCD0IyPH01rDHk7II6rpY0hTblAQDwSZ9oAK904P
QEnt0COnV+UidLBkhe4fMaATndQrax0c9rdxg9Bs+6BBJqb5h88OUbbiXnTix60Vm9nBZsy8NDTG
1AfiLihG3Q==
</ds:X509Certificate>
</ds:X509Data>
</ds:KeyInfo>
<ds:Object>
<xades:QualifyingProperties Target="#xmldsig-24d43742-0c80-4aa1-ae9c-c0b28b0ef51d" xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#">
<xades:SignedProperties Id="xmldsig-24d43742-0c80-4aa1-ae9c-c0b28b0ef51d-signedprops">
<xades:SignedSignatureProperties>
<xades:SigningTime>2018-05-15T11:35:00.477-05:00</xades:SigningTime>
<xades:SigningCertificate>
<xades:Cert>
<xades:CertDigest>
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
<ds:DigestValue>Dzj2DaxavyDu6gZDi/NGAZDBeLSWsIFTkOaEqGw3Gdu0kW0oYXCBYZYe2BHCz/qOIYwowfGH/180C/vljG2oYQ==</ds:DigestValue>
</xades:CertDigest>
<xades:IssuerSerial>
<ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD.,OU=Division de certificacion entidad final,CN=CA ANDES SCD S.A. Clase II,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
<ds:X509SerialNumber>4275094905511410289</ds:X509SerialNumber>
</xades:IssuerSerial>
</xades:Cert>
<xades:Cert>
<xades:CertDigest>
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
<ds:DigestValue>TZdLsy//YK5nRSfiz/SOgMlTbU3DEfCk6CUDf8EI4rhzURHg71mfjB7++WC4eav/HCq14hQdgo0rGL/t+Gt28A==</ds:DigestValue>
</xades:CertDigest>
<xades:IssuerSerial>
<ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
<ds:X509SerialNumber>7958418607150926283</ds:X509SerialNumber>
</xades:IssuerSerial>
</xades:Cert>
<xades:Cert>
<xades:CertDigest>
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
<ds:DigestValue>5fhNFBE6/8oBbUSwDj3N9RVEkrOW6ePre2qHKN0w67IbMKmh49a3PYjFj+ZF04uaW6n9kQKGFg+1
NIFlHRua1Q==</ds:DigestValue>
</xades:CertDigest>
<xades:IssuerSerial>
<ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName>
<ds:X509SerialNumber>3248112716520923666</ds:X509SerialNumber>
</xades:IssuerSerial>
</xades:Cert>
</xades:SigningCertificate>
<xades:SignaturePolicyIdentifier>
<xades:SignaturePolicyId>
<xades:SigPolicyId>
<xades:Identifier>https://facturaelectronica.dian.gov.co/politicadefirma/v1/politicadefirmav1.pdf</xades:Identifier>
</xades:SigPolicyId>
<xades:SigPolicyHash>
<ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha512"/>
<ds:DigestValue>5CL0Atx0jWqWoGG7rhuKOU7RN/kXCnupNAZb+fMiUu8JFLaUZb7mWXBCO2lzgKuzUObeBz1nGXtL9+0Rqw8X+Q==</ds:DigestValue>
</xades:SigPolicyHash>
</xades:SignaturePolicyId>
</xades:SignaturePolicyIdentifier>
<xades:SignerRole>
<xades:ClaimedRoles>
<xades:ClaimedRole>supplier</xades:ClaimedRole>
</xades:ClaimedRoles>
</xades:SignerRole>
</xades:SignedSignatureProperties>
</xades:SignedProperties>
</xades:QualifyingProperties>
</ds:Object>
</ds:Signature>		
	<!--**********************__INI_Signature_Elemento_raíz_de_la_firma._Puede_llevar_opcionalmente_identificador__****************************-->
			</ext:ExtensionContent>
		</ext:UBLExtension>
<!--_____________________________________fin__ExtensionContent_2_____________________________________-->
	</ext:UBLExtensions>
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- -->
	<cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID> <!-- ID de versión de UBL -->
	<cbc:ProfileID>DIAN 1.0</cbc:ProfileID> 	 <!-- Perfil Id -->
	<cbc:ID>'.$NumFac.'</cbc:ID><!--_____________________________________ini__CUFE_____________________________________-->
	<cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$cufe.'</cbc:UUID>
<!--_____________________________________fin__CUFE_____________________________________-->
	<cbc:IssueDate>'.$IssueDate.'</cbc:IssueDate> 	<!-- 1957-08-13 -->
	<cbc:IssueTime>'.$IssueTime.'</cbc:IssueTime> 	<!-- 09:30:47+05:00 -->
	<cbc:InvoiceTypeCode listAgencyID="195" listAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" listSchemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/InvoiceType">1</cbc:InvoiceTypeCode>
	<cbc:Note>'.$Note.'</cbc:Note>
	<cbc:DocumentCurrencyCode>COP</cbc:DocumentCurrencyCode>
<!--________________________________________ini__Proveedor_____________________________________-->
			<fe:AccountingSupplierParty>
				<cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>
				<fe:Party>
				<!--_____________________________________ini__nit_____________________________________-->
					<cac:PartyIdentification>
						<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$Nit.'</cbc:ID>
					</cac:PartyIdentification>
				<!--_____________________________________fin__nit_____________________________________-->
					<cac:PartyName>
						<cbc:Name>PJ - 900373115 - Adquiriente FE</cbc:Name>
					</cac:PartyName>
					<fe:PhysicalLocation>
						<fe:Address>
							<cbc:Department>Distrito Capital</cbc:Department>
							<cbc:CitySubdivisionName>Centro</cbc:CitySubdivisionName>
							<cbc:CityName>Bogotá</cbc:CityName>
							<cac:AddressLine>
								<cbc:Line>carrera 8 Nº 6C - 78</cbc:Line>
							</cac:AddressLine>
							<cac:Country>
								<cbc:IdentificationCode>CO</cbc:IdentificationCode>
							</cac:Country>
						</fe:Address>
					</fe:PhysicalLocation>
					<fe:PartyTaxScheme>
						<cbc:TaxLevelCode>2</cbc:TaxLevelCode>
						<cac:TaxScheme/>
					</fe:PartyTaxScheme>
					<fe:PartyLegalEntity>
						<cbc:RegistrationName>PJ - 900373115</cbc:RegistrationName>
					</fe:PartyLegalEntity>
				</fe:Party>
			</fe:AccountingSupplierParty>
<!--________________________________________fin__Proveedor_____________________________________-->
<!--________________________________________ini__cliente_______________________________________-->
			<fe:AccountingCustomerParty>
				<cbc:AdditionalAccountID>2</cbc:AdditionalAccountID>
				<fe:Party>
					<cac:PartyIdentification>
						<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$Nit.'</cbc:ID>
					</cac:PartyIdentification>
					<fe:PhysicalLocation>
						<fe:Address>
							<cbc:Department>Valle del Cauca</cbc:Department>
							<cbc:CitySubdivisionName>Centro</cbc:CitySubdivisionName>
							<cbc:CityName>Toribio</cbc:CityName>
							<cac:AddressLine>
								<cbc:Line>carrera 8 Nº 6C - 46</cbc:Line>
							</cac:AddressLine>
							<cac:Country>
								<cbc:IdentificationCode>CO</cbc:IdentificationCode>
							</cac:Country>
						</fe:Address>
					</fe:PhysicalLocation>
					<fe:PartyTaxScheme>
						<cbc:TaxLevelCode>0</cbc:TaxLevelCode>
						<cac:TaxScheme/>
					</fe:PartyTaxScheme>
					<fe:Person>
						<cbc:FirstName>Primer-N</cbc:FirstName>
						<cbc:FamilyName>Apellido-11333000</cbc:FamilyName>
						<cbc:MiddleName>Segundo-N</cbc:MiddleName>
					</fe:Person>
				</fe:Party>
			</fe:AccountingCustomerParty>
<!--________________________________________fin__cliente_______________________________________-->
<!--_____________________________________inicio__impuestos_____________________________________-->
<!--__________________________________inicio__impuesto__numero_1_______________________________-->
		<fe:TaxTotal>
			<cbc:TaxAmount currencyID="COP">'.$ValImp1.'</cbc:TaxAmount>
			<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>
			<fe:TaxSubtotal>
				<cbc:TaxableAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:TaxableAmount>
				<cbc:TaxAmount currencyID="COP">'.$ValImp1.'</cbc:TaxAmount><!-- valor total de los  impuestos 1-->
				<cbc:Percent>19</cbc:Percent>
				<cac:TaxCategory>
					<cac:TaxScheme>
						<cbc:ID>'.$CodImp1.'</cbc:ID><!--nuemero del impuesto  con código 01 -->
					</cac:TaxScheme>
				</cac:TaxCategory>
			</fe:TaxSubtotal>
		</fe:TaxTotal>
<!--____________________________________fin__impuesto__numero_1_______________________________-->
<!--__________________________________inicio__impuesto__numero_2_______________________________-->
		<fe:TaxTotal>
			<cbc:TaxAmount currencyID="COP">'.$ValImp2.'</cbc:TaxAmount>
			<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>
			<fe:TaxSubtotal>
				<cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount>
				<cbc:TaxAmount currencyID="COP">'.$ValImp2.'</cbc:TaxAmount><!-- valor total de los  impuestos 2-->
				<cbc:Percent>0</cbc:Percent>
				<cac:TaxCategory>
					<cac:TaxScheme>
						<cbc:ID>'.$CodImp2.'</cbc:ID><!--nuemero del impuesto  con código 02 -->
					</cac:TaxScheme>
				</cac:TaxCategory>
			</fe:TaxSubtotal>
		</fe:TaxTotal>
<!--______________________________________fin__impuesto__numero_2_____________________________-->
<!--__________________________________inicio__impuesto__numero_3_______________________________-->
		<fe:TaxTotal>
			<cbc:TaxAmount currencyID="COP">'.$ValImp3.'</cbc:TaxAmount>
			<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>
			<fe:TaxSubtotal>
				<cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount>
				<cbc:TaxAmount currencyID="COP">'.$ValImp3.'</cbc:TaxAmount><!-- valor total de los  impuestos 3-->
				<cbc:Percent>0</cbc:Percent>
				<cac:TaxCategory>
					<cac:TaxScheme>
						<cbc:ID>'.$CodImp3.'</cbc:ID><!--nuemero del impuesto  con código 03 -->
					</cac:TaxScheme>
				</cac:TaxCategory>
			</fe:TaxSubtotal>
		</fe:TaxTotal>
<!--______________________________________fin__impuesto__numero_3_____________________________-->
<!--___________________________________________fin__impuestos_________________________________-->
<!--____________________________________________ini__Total____________________________________-->
	<fe:LegalMonetaryTotal>
		<cbc:LineExtensionAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:LineExtensionAmount><!--Valor de la factura sin IVA-->
		<cbc:TaxExclusiveAmount currencyID="COP">'.$TaxExclusiveAmount.'</cbc:TaxExclusiveAmount> 	<!--impuestos -->
		<cbc:PayableAmount currencyID="COP">'.$PayableAmount.'</cbc:PayableAmount> 					<!--Valor total de la factura con impuestos -->
	</fe:LegalMonetaryTotal>
<!--_____________________________________________fin__Total___________________________________-->
<!--____________________________________________ini__Detalles_________________________________-->	
	<fe:InvoiceLine>
		<cbc:ID>1</cbc:ID>
		<cbc:InvoicedQuantity>1</cbc:InvoicedQuantity><!--cantidad-->
		<cbc:LineExtensionAmount currencyID="COP">500.00</cbc:LineExtensionAmount><!--total catidad * valor-->
		<fe:Item>
			<cbc:Description>zapapico sin cabo r:31005-50-herragor</cbc:Description><!--descripcion-->
		</fe:Item>
		<fe:Price>
			<cbc:PriceAmount currencyID="COP">500.00</cbc:PriceAmount><!--valor unidad-->
		</fe:Price>
	</fe:InvoiceLine>
<!--____________________________________________fin__Detalles_________________________________-->
</fe:Invoice>
<!-- productoooooooooooooooooooooooooo
//////////////////////////////////////////////////////////	
	<fe:InvoiceLine>
		<cbc:ID>'.$id_producto.'</cbc:ID>
		<cbc:InvoicedQuantity>'.$cantidad.'</cbc:InvoicedQuantity>
		<cbc:LineExtensionAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:LineExtensionAmount>
		<fe:Item>
			<cbc:Description>'.$descripcion.'</cbc:Description>
		</fe:Item>
		<fe:Price>
			<cbc:PriceAmount currencyID="COP">'.$Precio.'</cbc:PriceAmount>
		</fe:Price>
	</fe:InvoiceLine>
//////////////////////////////////////////////////////////
productoooooooooooooooooooooooooo-->';

$obj_xml = new SimpleXMLElement($xml);
$documento_xml = $obj_xml->asXML(); //el xml de salidad

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//																											 //
//													Fin_Creamos_Xml										     //
//																						   					 //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//																											 //
//													Inicio_Creamos_ZIP									     //
//																						   					 //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//nobre del archivo de salidad
	
	$nit_10         = str_pad($nit, 10, "0", STR_PAD_LEFT);   //se añaden ceros a la izquierda hasta completar 10 digitos 
	$rango_ex       = dechex($rango);//pasamos el numero de factura a exadecimal
	$num_fac        = str_pad($rango_ex, 10, "0", STR_PAD_LEFT); //se añaden ceros a la izquierda hasta completar 10 digitos 

	$tipo_documento = "face_f";
	$tipo_de_zip	= "ws_f";

	$nombre_xml 	=  $tipo_documento.$nit_10.$num_fac; 	 // Nombre para usar en el xml y el zip	
	$nombre_zip 	=  $tipo_de_zip.$nit_10.$num_fac; 			 // Nombre para usar en el xml y el zip
	$zip            =  new ZipArchive();		  			 // Instanciar clase zipArchive
	$filename       =  $nombre_zip.".zip";	  		 		 // Nombre del zip $nombre_zip_xml concatenado con .zip
			if ($zip->open($filename, ZipArchive::CREATE)!==TRUE)
				{
			  		exit("No se puedo abrir <$filename>\n"); 		   // En caso de tener problemas de lectura 
				}
		$zip->addFromString($nombre_xml.".xml", $documento_xml); 		 // Se crear archivo XML dentro del zip
		echo "Numero de ficheros: " . $zip->numFiles . "\n"; 	 // Se imprime estos valores solo en desarrollo
		echo "Estado:" . $zip->status . "\n";					 // Se imprime estos valores solo en desarrollo
		$zip->close();																		 // Cerramos el zip
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$content = base64_encode(file_get_contents($filename));
	echo "<br><br>".$content."<br><br>";


    /*$parameters= array( 'NIT'           => $nit,
						'InvoiceNumber' => $InvoiceNumber,
						'IssueDate'     => $date,
						'Document'      => $content);
    //					'Document'      => 'cid:ws_f0900332178003b023383.zip');*/
    //----------------------------------------------------------------------------------------
$date    	= date('Y-m-d\TH:i:s');
$parameters =
				'<ns1:EnvioFacturaElectronicaPeticion>
					<ns1:NIT>'.$nit.'</ns1:NIT>
					<ns1:InvoiceNumber>'.$InvoiceNumber.'</ns1:InvoiceNumber>
					<ns1:IssueDate>'.$date.'</ns1:IssueDate>
					<ns1:Document>'.$content.'</ns1:Document>
					</ns1:EnvioFacturaElectronicaPeticion>
				';

     $parameters = new SoapVar($parameters, XSD_ANYXML);

	$client->__setSoapHeaders($xHeader);

    $value = $client->EnvioFacturaElectronica($parameters);
   /* echo "---------------------------------------paran---------------------------------------------------<br><pre>"; 
    var_dump($client->EnvioFacturaElectronica($parameters));
    echo "---------------------------------------paran---------------------------------------------------<br></pre>"; 
    echo "**************************************////*************************************************";*/
    print "<pre>\n";
    print "<br />\n Request : ".htmlspecialchars($client->__getLastRequest());
    print "</pre>";
    
echo "---------------------------------------Response---------------------------------------------------<br><pre>";    
    print "<br>".htmlspecialchars($client->__getLastResponse());
echo "</pre><br>---------------------------------------Response---------------------------------------------------";

//echo"valores<br>".$value."<br>";
echo "------------------------------------------------------------------------------------------<br><pre>";
    var_dump($value);
echo "</pre>";   
echo "------------------------------------------------------------------------------------------<br><pre>";
    var_dump($client);
echo "</pre>";   
    ?>




<?php  
  $vars = get_defined_vars();  
  echo "-----------------------------------definidas------------------------------------------------------<br><pre>";
  print_r($vars);  
  echo "------------------------------------------------------------------------------------------<br></pre>";
?>