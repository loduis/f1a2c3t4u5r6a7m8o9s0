<?php 
  $date          = date('Y-m-d\TH:i:s');
//------------------------------------------nit
  $nit           ="900332178";  //nit de factura
//------------------------------------------nit 
//------------------------------------------AuthorizationPeriod //Facturas autorizadas
  $Prefix         ='PRUE';  //Prefijo
  $From           ='980000000'; //De
  $To             ='985000000'; //a
  echo "<br>".$rango         ="980000063";
  $InvoiceNumber = $Prefix.$rango;
//------------------------------------------AuthorizationPeriod // Facturas autorizadas 
//------------------------------------------InvoiceAuthorization
  $InvoiceAuthorization = '9000000105596663'; //Autorización de factura
//------------------------------------------InvoiceAuthorization
//------------------------------------------AuthorizationPeriod
  $StartDate            = '2018-02-14'; //fecha inicio resolución
  $EndDate              = '2028-02-14'; //Fecha final resolución
//------------------------------------------AuthorizationPeriod
//------------------------------------------IdentificationCode 
  $IdentificationCode = 'CO'; //Código de identificación
//------------------------------------------IdentificationCode
//------------------------------------------SoftwareProvider
  $ProviderID =$nit;  //identificacion del facturador ante la dian
  $SoftwareID ='ff8d5e3f-6746-40cb-9621-d52903f7d8b7';  //identificacion del facturador ante la dian
//------------------------------------------SoftwareProvider
  $ClTec    = 'dd85db55545bd6566f36b0fd3be9fd8555c36e';
//------------------------------------------Pin
  $Pin    = '3L3m3nt'; //pin secreto 
//------------------------------------------Pin
//------------------------------------------SoftwareSecurityCode
  echo "<br>".$SoftwareSecurityCode = hash('sha384',$SoftwareID.$Pin); //ESPECIFICACIÓN TÉCNICA DEL CÓDIGO DE SEGURIDAD DEL SOFTWARE
  echo "<br>".$SoftwareSecurityCode = '38b060a751ac96384cd9327eb1b1e36a21fdb71114be07434c0cc7bf63f6e1da274edebfe76f65fbd51ad2f14898b95b';
  //$SoftwareSecurityCode = hash('sha384','ff8d5e3f-6746-40cb-9621-d52903f7d8b73L3m3nt'); //ESPECIFICACIÓN TÉCNICA DEL CÓDIGO DE SEGURIDAD DEL SOFTWARE
//------------------------------------------SoftwareSecurityCode
//------------------------------------------KeyInfo
  $KeyInfo = $SoftwareID; // <ds:KeyInfo Id="'.$KeyInfo.'"> confirmar :(
//------------------------------------------KeyInfo
//------------------------------------------Productos___InvoiceLine___Línea de factura
    $id_producto         = '1';
    $cantidad            = '765';
    $descripcion         = 'Línea-1 PRUE980007161 f-s0001_900373115_0d2e2_R9000000500017960-PRUE-A_cufe';
    $Precio              = '1483.4518917264927';
//------------------------------------------Productos___InvoiceLine___Línea de factura
//------------------------------------------Cufe__Note
$IssueDate           =  date('Y-m-d'); //Fecha de asunto
$IssueTime           =  date('H:i:s');  //Tiempo de emisión
$LineExtensionAmount = '500.00'; //<!-- Valor de la factura sin IVA-->
$TaxExclusiveAmount  = '95.00';  //<!--Importe exclusivo de impuestos -->
$PayableAmount       = '595.00';  //<!-- Valor total de la factura con impuestos -->
$Nit                 =  $nit; //nit facturador
$Note                = 'Nota';      //prueba de nota


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

require_once __DIR__."/src/Facturae.php";
//require_once __DIR__."/src/FacturaeCentre.php";
require_once __DIR__."/src/FacturaeItem.php";
require_once __DIR__."/src/FacturaeParty.php";

// Creamos la factura
// Creamos la factura
// Creamos la factura
// usar la 3.2.2 $fac = new Facturae(Facturae::SCHEMA_3_2_2);
$fac = new Facturae(); // usa la 3.2

// Asignamos el número EMP2017120003 a la factura
// Nótese que Facturae debe recibir el lote y el
// número separados

//avalo
/*$fac->InvoiceControl($InvoiceAuthorization, $StartDate, $EndDate, $Prefix, $From, $To);
$fac->InvoiceSource($IdentificationCode);
$fac->SoftwareProvider($ProviderID,$SoftwareID);
$fac->SoftwareSecurityCode($SoftwareSecurityCode);*/
//avalo





$fac->setNumber('EMP201712', '0003');

// Asignamos el 01/12/2017 como fecha de la factura
$fac->setIssueDate('2017-12-01');

// Incluimos los datos del vendedor
$fac->setSeller(new FacturaeParty([
  "taxNumber" => "A00000000",
  "name"      => "Perico de los Palotes S.A.",
  "address"   => "C/ Falsa, 123",
  "postCode"  => "123456",
  "town"      => "Madrid",
  "province"  => "Madrid"
]));

// Incluimos los datos del comprador,
// con finos demostrativos el comprador será
// una persona física en vez de una empresa
$fac->setBuyer(new FacturaeParty([
  "isLegalEntity" => false,       // Importante!
  "taxNumber"     => "00000000A",
  "name"          => "Antonio",
  "firstSurname"  => "García",
  "lastSurname"   => "Pérez",
  "address"       => "Avda. Mayor, 7",
  "postCode"      => "654321",
  "town"          => "Madrid",
  "province"      => "Madrid"
]));

// Añadimos los productos a incluir en la factura
// En este caso, probaremos con tres lámpara por
// precio unitario de 20,14€ con 21% de IVA ya incluído
$i = 0;
for ($i=0; $i < 2 ; $i++)
{ 
    $x = $fac->addItem("Lámpara de pie", 20.14+$i, 3, Facturae::TAX_IVA, 21);
    echo $x."<br>";
}

// Ya solo queda firmar la factura ...
//$fac->sign(  "clavepublica.pem",  "claveprivada.pem",  "persona_juridica_pruebas1");
$fac->sign("persona_juridica_pruebas_vigente.p12", NULL, "persona_juridica_pruebas1");

// ... y exportarlo a un archivo
$fac->export("salida3.2.2.xml");
$totales = $fac->getTotals();


echo "<pre>";
var_dump($totales);
echo "</pre>";
