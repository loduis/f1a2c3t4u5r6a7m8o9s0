<?php
	$NumFac = $InvoiceNumber;   //Número de factura.
	$FecFac = $FecFac; // Fecha de factura en formato (Java) YYYYmmddHHMMss
	$ValFac = $LineExtensionAmount; //Valor Factura sin IVA, con punto decimal, con decimales a dos (2) dígitos, sin separadores de miles, ni símbolo pesos.
	$CodImp1 = '01'; //  01  fe:Invoice/fe:TaxTotal[x]/fe:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID = 01
	$ValImp1 = $value_facturas['Fac_Totales_IVA_19'];//  Valor impuesto 01, con punto decimal, con decimales a dos (2)  dígitos, sin separadores de miles, ni símbolo pesos.    fe:Invoice/fe:TaxTotal[x]/fe:TaxSubtotal/cbc:   TaxAmount
	$CodImp2 = '0';//  02  fe:Invoice/fe:TaxTotal[y]/fe:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID = 02
	$ValImp2 = $value_facturas['Fac_Totales_IVA_5'];//Valor impuesto 02, con punto decimal, con decimales a dos (2)  dígitos, sin separadores de miles, ni símbolo pesos. fe:Invoice/fe:TaxTotal[y]/fe:TaxSubtotal/cbc:TaxAmount
	$CodImp3 = '03';//fe:Invoice/fe:TaxTotal[z]/fe:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID = 03
	$ValImp3 = '0.00';// Valor impuesto 03, con punto decimal, con decimales a dos (2)  dígitos, sin separadores de miles, ni símbolo pesos.   fe:Invoice/fe:TaxTotal[z]/fe:TaxSubtotal/cbc:TaxAmount
	$ValImp = $PayableAmount; //Valor total, con punto decimal, con decimales a dos (2) dígitos, sin separadores de miles, ni símbolo pesos.   fe:Invoice/fe:LegalMonetaryTotal/cbc:PayableAmount cantidad a pagar
	$NitOFE = $nit; //NIT del Facturador Electrónico sin puntos ni guiones, sin digito de verificación.   fe:Invoice/fe:AccountingSupplierParty/fe:Party/cac:PartyIdentification/cbc:ID
	$TipAdq = $value_facturas['Fac_Enca_Tipo_ID'];  // tipo de adquiriente, de acuerdo con el valor registrado en /fe:Invoice/fe:AccountingCustomerParty/fe:Party/cac:PartyIdentification/cbc:ID/@schemeID la tabla Tipos de documentos de identidad del «Anexo 001 Formato estándar XML de la Factura, notas débito y notas crédito electrónicos»; si no se determinó y es un NIT, entonces use el valor “O-99”, de lo contrario use “R-00-PN”. //fe:Invoice/fe:AccountingCustomerParty/fe:Party/cac:PartyIdentification/cbc:ID
	$NumAdq = $value_facturas["Fac_Enca_Tercero_Codigo_Tercero"]; // Número de identificación del adquirente sin puntos ni guiones, sin digito de verificación. 
	$ClTec  = $ClTec; //clave tenica de la resolucion
	$cufe = sha1($NumFac.$FecFac.$ValFac.$CodImp1.$ValImp1.$CodImp2.$ValImp2.$CodImp3.$ValImp3.$ValImp.$NitOFE.$TipAdq.$NumAdq.$ClTec);




echo "<br> ________NumFac. ------>".$NumFac."<br>";
echo "<br> ________FecFac. ------>".$FecFac."<br>";
echo "<br> ________ValFac. ------>".$ValFac."<br>";
echo "<br> ________CodImp1 ------>".$CodImp1."<br>";
echo "<br> ________ValImp1 ------>".$ValImp1."<br>";
echo "<br> ________CodImp2 ------>".$CodImp2."<br>";
echo "<br> ________ValImp2 ------>".$ValImp2."<br>";
echo "<br> ________CodImp3 ------>".$CodImp3."<br>";
echo "<br> ________ValImp3 ------>".$ValImp3."<br>";
echo "<br> ________ValImp. ------>".$ValImp."<br>";
echo "<br> ________NitOFE. ------>".$NitOFE."<br>";
echo "<br> ________TipAdq. ------>".$TipAdq."<br>";
echo "<br> ________NumAdq. ------>".$NumAdq."<br>";
echo "<br> ________ClTec.  ------>".$ClTec."<br>";