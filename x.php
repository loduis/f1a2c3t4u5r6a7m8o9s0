<?php 



$xml= '<fe:Invoice xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd"><ext:UBLExtensions><ext:UBLExtension><ext:ExtensionContent><sts:DianExtensions><sts:InvoiceControl><sts:InvoiceAuthorization>9000000105596663</sts:InvoiceAuthorization><sts:AuthorizationPeriod><cbc:StartDate>2018-02-14</cbc:StartDate><cbc:EndDate>2028-02-14</cbc:EndDate></sts:AuthorizationPeriod><sts:AuthorizedInvoices><sts:Prefix>PRUE</sts:Prefix><sts:From>980000000</sts:From><sts:To>985000000</sts:To></sts:AuthorizedInvoices></sts:InvoiceControl><sts:InvoiceSource><cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">CO</cbc:IdentificationCode></sts:InvoiceSource><sts:SoftwareProvider><sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">900332178</sts:ProviderID><sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">ff8d5e3f-6746-40cb-9621-d52903f7d8b7</sts:SoftwareID></sts:SoftwareProvider><sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeName="SoftwareSecurityCode" schemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/anexo_v1_0.html#SofwareSecurityCode">c590bebf67471c586bae888c9db5694444f3be2ce4e73eee7a7fb1d7322916d15da2bfa73a237c6ca18712e4152a5625</sts:SoftwareSecurityCode></sts:DianExtensions></ext:ExtensionContent></ext:UBLExtension><ext:UBLExtension><ext:ExtensionContent></ext:ExtensionContent></ext:UBLExtension></ext:UBLExtensions><cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID><cbc:ProfileID>DIAN 1.0</cbc:ProfileID>   <cbc:ID>PRUE980000068</cbc:ID><cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">8b02a5007a7b4ab6a42279bc746140354b6ac8a3</cbc:UUID><cbc:IssueDate>2018-06-28</cbc:IssueDate>  <cbc:IssueTime>15:34:04</cbc:IssueTime>  <cbc:InvoiceTypeCode listAgencyID="195" listAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" listSchemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/InvoiceType">1</cbc:InvoiceTypeCode><cbc:Note>Nota</cbc:Note><cbc:DocumentCurrencyCode>COP</cbc:DocumentCurrencyCode><fe:AccountingSupplierParty><cbc:AdditionalAccountID>1</cbc:AdditionalAccountID><fe:Party>     <cac:PartyIdentification><cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">900332178</cbc:ID></cac:PartyIdentification><cac:PartyName><cbc:Name>PJ - 900373115 - Adquiriente FE</cbc:Name></cac:PartyName><fe:PhysicalLocation><fe:Address><cbc:Department>Distrito Capital</cbc:Department><cbc:CitySubdivisionName>Centro</cbc:CitySubdivisionName><cbc:CityName>Bogotá</cbc:CityName><cac:AddressLine><cbc:Line>carrera 8 Nº 6C - 78</cbc:Line></cac:AddressLine><cac:Country><cbc:IdentificationCode>CO</cbc:IdentificationCode></cac:Country></fe:Address></fe:PhysicalLocation><fe:PartyTaxScheme><cbc:TaxLevelCode>0</cbc:TaxLevelCode><cac:TaxScheme></cac:TaxScheme></fe:PartyTaxScheme><fe:PartyLegalEntity><cbc:RegistrationName>PJ - 900373115</cbc:RegistrationName></fe:PartyLegalEntity></fe:Party></fe:AccountingSupplierParty><fe:AccountingCustomerParty><cbc:AdditionalAccountID>2</cbc:AdditionalAccountID><fe:Party><cac:PartyIdentification><cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">900332178</cbc:ID></cac:PartyIdentification><fe:PhysicalLocation><fe:Address><cbc:Department>Valle del Cauca</cbc:Department><cbc:CitySubdivisionName>Centro</cbc:CitySubdivisionName><cbc:CityName>Toribio</cbc:CityName><cac:AddressLine><cbc:Line>carrera 8 Nº 6C - 46</cbc:Line></cac:AddressLine><cac:Country><cbc:IdentificationCode>CO</cbc:IdentificationCode></cac:Country></fe:Address></fe:PhysicalLocation><fe:PartyTaxScheme><cbc:TaxLevelCode>0</cbc:TaxLevelCode><cac:TaxScheme></cac:TaxScheme></fe:PartyTaxScheme><fe:Person><cbc:FirstName>Primer-N</cbc:FirstName><cbc:FamilyName>Apellido-11333000</cbc:FamilyName><cbc:MiddleName>Segundo-N</cbc:MiddleName></fe:Person></fe:Party></fe:AccountingCustomerParty><fe:TaxTotal><cbc:TaxAmount currencyID="COP">95.00</cbc:TaxAmount><cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator><fe:TaxSubtotal><cbc:TaxableAmount currencyID="COP">500.00</cbc:TaxableAmount><cbc:TaxAmount currencyID="COP">95.00</cbc:TaxAmount><cbc:Percent>19</cbc:Percent><cac:TaxCategory><cac:TaxScheme><cbc:ID>01</cbc:ID></cac:TaxScheme></cac:TaxCategory></fe:TaxSubtotal></fe:TaxTotal><fe:TaxTotal><cbc:TaxAmount currencyID="COP">0.00</cbc:TaxAmount><cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator><fe:TaxSubtotal><cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount><cbc:TaxAmount currencyID="COP">0.00</cbc:TaxAmount><cbc:Percent>0</cbc:Percent><cac:TaxCategory><cac:TaxScheme><cbc:ID>02</cbc:ID></cac:TaxScheme></cac:TaxCategory></fe:TaxSubtotal></fe:TaxTotal><fe:TaxTotal><cbc:TaxAmount currencyID="COP">0.00</cbc:TaxAmount><cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator><fe:TaxSubtotal><cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount><cbc:TaxAmount currencyID="COP">0.00</cbc:TaxAmount><cbc:Percent>0</cbc:Percent><cac:TaxCategory><cac:TaxScheme><cbc:ID>03</cbc:ID></cac:TaxScheme></cac:TaxCategory></fe:TaxSubtotal></fe:TaxTotal><fe:LegalMonetaryTotal><cbc:LineExtensionAmount currencyID="COP">500.00</cbc:LineExtensionAmount><cbc:TaxExclusiveAmount currencyID="COP">95.00</cbc:TaxExclusiveAmount>  <cbc:PayableAmount currencyID="COP">595.00</cbc:PayableAmount>           </fe:LegalMonetaryTotal><fe:InvoiceLine><cbc:ID>1</cbc:ID><cbc:InvoicedQuantity>1</cbc:InvoicedQuantity><cbc:LineExtensionAmount currencyID="COP">500.00</cbc:LineExtensionAmount><fe:Item><cbc:Description>cascos d2</cbc:Description></fe:Item><fe:Price><cbc:PriceAmount currencyID="COP">500.00</cbc:PriceAmount></fe:Price></fe:InvoiceLine></fe:Invoice>';


$d = sha1($xml, true);

echo "<pre>";
var_dump($d);
echo "</pre>";

$d = sha1($xml);
echo "<pre>";
var_dump($d);
echo "</pre>";


$documentDigest = base64_encode(sha1($xml, true));
echo "<pre>";
var_dump($documentDigest);
echo "</pre>";
 
$SoftwareID             = 'ff8d5e3f-6746-40cb-9621-d52903f7d8b7';
$Pin                    = '3L3m3nt';
$SoftwareSecurityCode   =  hash('sha384',$SoftwareID.$Pin, true);
$SoftwareSecurityCode2   =  hash('sha384',$SoftwareID.$Pin);


echo $SoftwareSecurityCode."<br>";
echo $SoftwareSecurityCode2."<br>";




echo "firmas cer<br><br><br><br><br><br>";

$data = openssl_x509_parse(file_get_contents('certificados_rais/certificado.crt'));

$certData = openssl_x509_parse($data);

var_dump($certData);
/* 
// or 
print_r(openssl_x509_parse( openssl_x509_read($cert) ) ); 
*/ 
exit();

$publicKey = openssl_x509_read(file_get_contents($publicKey));
    $certData = openssl_x509_parse($publicKey);
    $certDigest = openssl_x509_fingerprint($publicKey, "sha1", true);
    $certDigest = base64_encode($certDigest);
   


    $certIssuer = array();

    foreach ($certData['issuer'] as $item=>$value) 
	    {
	      $certIssuer[] = $item . '=' . $value;
	    }
    $certIssuer = implode(',', $certIssuer);


    // Generate signed properties
    $prop = 
    '<xades:Cert>' .'<br>'.
    '<xades:CertDigest>' .'<br>'.
      '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod>' .'<br>'.
      '<ds:DigestValue>' . $certDigest . '</ds:DigestValue>' .'<br>'.
    '</xades:CertDigest>' .'<br>'.
    '<xades:IssuerSerial>' .'<br>'.
      '<ds:X509IssuerName>' . $certIssuer . '</ds:X509IssuerName>' .'<br>'.
      '<ds:X509SerialNumber>' . $certData['serialNumber'] . '</ds:X509SerialNumber>' .'<br>'.
    '</xades:IssuerSerial>' .'<br>'.
  '</xades:Cert>';


 ?>