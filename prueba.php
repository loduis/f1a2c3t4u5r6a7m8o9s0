<?php 

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

//$x=$fac->fecha();
//var_dump($x);

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
    echo "-----------------------------------";
       echo $x."<br>";
    echo "-----------------------------------";
}

// Ya solo queda firmar la factura ...
//$fac->sign(  "clavepublica.pem",  "claveprivada.pem",  "persona_juridica_pruebas1");
$fac->sign("persona_juridica_pruebas_vigente.p12", NULL, "persona_juridica_pruebas1");
//$fac->sign("463458.p12", NULL, "-fI95*zVu_");

// ... y exportarlo a un archivo
$fac->export("salida3.2.2.xml");
$totales = $fac->getTotals();


echo "<pre>";
var_dump($totales);
echo "</pre>";
