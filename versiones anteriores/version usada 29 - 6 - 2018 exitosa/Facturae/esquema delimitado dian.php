<!--_____________________________________ini__ExtensionContent_1_____________________________________-->
'<ext:UBLExtension>'.
	'<ext:ExtensionContent>'.
		'<sts:DianExtensions>'.
			'<sts:InvoiceControl>'.
				'<sts:InvoiceAuthorization>'.$InvoiceAuthorization.'</sts:InvoiceAuthorization>'.
				'<sts:AuthorizationPeriod>'.
					'<cbc:StartDate>'.$StartDate.'</cbc:StartDate>'.
					'<cbc:EndDate>'.$EndDate.'</cbc:EndDate>'.
				'</sts:AuthorizationPeriod>'.
				'<sts:AuthorizedInvoices>'.
					'<sts:Prefix>'.$Prefix.'</sts:Prefix>'.
					'<sts:From>'.$From.'</sts:From>'.
					'<sts:To>'.$To.'</sts:To>'.
				'</sts:AuthorizedInvoices>'.
			'</sts:InvoiceControl>'.
			'<sts:InvoiceSource>'.
				'<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">'.$IdentificationCode.'</cbc:IdentificationCode>'.
			'</sts:InvoiceSource>'.
			'<sts:SoftwareProvider>'.
				'<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$ProviderID.'</sts:ProviderID>'.
				'<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$SoftwareID.'</sts:SoftwareID>'.
			'</sts:SoftwareProvider>'.
			'<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeName="SoftwareSecurityCode" schemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/anexo_v1_0.html#SofwareSecurityCode">'.$SoftwareSecurityCode.'</sts:SoftwareSecurityCode>'.
		'</sts:DianExtensions>'.
	'</ext:ExtensionContent>'.
'</ext:UBLExtension>'.
<!--_____________________________________fin__ExtensionContent_1_____________________________________-->
<!--_____________________________________ini__ExtensionContent_2_____________________________________-->
'<ext:UBLExtension>'.
	'<ext:ExtensionContent></ext:ExtensionContent>'.
'</ext:UBLExtension>'.
<!--_____________________________________fin__ExtensionContent_2_____________________________________-->
<!--_____________________________________ini__factura_____-----------________________________________-->

<cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID>
<cbc:ProfileID>DIAN 1.0</cbc:ProfileID> 	 
<cbc:ID>'.$NumFac.'</cbc:ID>
<cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$cufe.'</cbc:UUID>
<cbc:IssueDate>'.$IssueDate.'</cbc:IssueDate> 	
<cbc:IssueTime>'.$IssueTime.'</cbc:IssueTime> 	
<cbc:InvoiceTypeCode listAgencyID="195" listAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" listSchemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/InvoiceType">1</cbc:InvoiceTypeCode>
<cbc:Note>'.$Note.'</cbc:Note>
<cbc:DocumentCurrencyCode>COP</cbc:DocumentCurrencyCode>
		<fe:AccountingSupplierParty>
			<cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>
			<fe:Party>			
				<cac:PartyIdentification>
					<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$Nit.'</cbc:ID>
				</cac:PartyIdentification>
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
					<cbc:TaxLevelCode>0</cbc:TaxLevelCode>
					<cac:TaxScheme/>
				</fe:PartyTaxScheme>
				<fe:PartyLegalEntity>
					<cbc:RegistrationName>PJ - 900373115</cbc:RegistrationName>
				</fe:PartyLegalEntity>
			</fe:Party>
		</fe:AccountingSupplierParty>
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
	<fe:TaxTotal>
		<cbc:TaxAmount currencyID="COP">'.$ValImp1.'</cbc:TaxAmount>
		<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>
		<fe:TaxSubtotal>
			<cbc:TaxableAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:TaxableAmount>
			<cbc:TaxAmount currencyID="COP">'.$ValImp1.'</cbc:TaxAmount>
			<cbc:Percent>19</cbc:Percent>
			<cac:TaxCategory>
				<cac:TaxScheme>
					<cbc:ID>'.$CodImp1.'</cbc:ID>
				</cac:TaxScheme>
			</cac:TaxCategory>
		</fe:TaxSubtotal>
	</fe:TaxTotal>
	<fe:TaxTotal>
		<cbc:TaxAmount currencyID="COP">'.$ValImp2.'</cbc:TaxAmount>
		<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>
		<fe:TaxSubtotal>
			<cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount>
			<cbc:TaxAmount currencyID="COP">'.$ValImp2.'</cbc:TaxAmount>
			<cbc:Percent>0</cbc:Percent>
			<cac:TaxCategory>
				<cac:TaxScheme>
					<cbc:ID>'.$CodImp2.'</cbc:ID>
				</cac:TaxScheme>
			</cac:TaxCategory>
		</fe:TaxSubtotal>
	</fe:TaxTotal>
	<fe:TaxTotal>
		<cbc:TaxAmount currencyID="COP">'.$ValImp3.'</cbc:TaxAmount>
		<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>
		<fe:TaxSubtotal>
			<cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount>
			<cbc:TaxAmount currencyID="COP">'.$ValImp3.'</cbc:TaxAmount>
			<cbc:Percent>0</cbc:Percent>
			<cac:TaxCategory>
				<cac:TaxScheme>
					<cbc:ID>'.$CodImp3.'</cbc:ID>
				</cac:TaxScheme>
			</cac:TaxCategory>
		</fe:TaxSubtotal>
	</fe:TaxTotal>
<fe:LegalMonetaryTotal>
	<cbc:LineExtensionAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:LineExtensionAmount>
	<cbc:TaxExclusiveAmount currencyID="COP">'.$TaxExclusiveAmount.'</cbc:TaxExclusiveAmount> 	
	<cbc:PayableAmount currencyID="COP">'.$PayableAmount.'</cbc:PayableAmount> 					
</fe:LegalMonetaryTotal>
<fe:InvoiceLine>
	<cbc:ID>1</cbc:ID>
	<cbc:InvoicedQuantity>1</cbc:InvoicedQuantity>
	<cbc:LineExtensionAmount currencyID="COP">500.00</cbc:LineExtensionAmount>
	<fe:Item>
		<cbc:Description>cascos d2</cbc:Description>
	</fe:Item>
	<fe:Price>
		<cbc:PriceAmount currencyID="COP">500.00</cbc:PriceAmount>
	</fe:Price>
</fe:InvoiceLine>


<!--_____________________________________ini__cierre______________________________________-->
</fe:Invoice>
<!--_____________________________________fin__cierre______________________________________-->

<?php
$date                 	=	date('Y-m-d\TH:i:s');
$nit                  	=	"900332178";//nit de factura
$Prefix               	=	'PRUE';//Prefijo
$From                 	=	'980000000';//De
$To                   	=	'985000000';//a
$rango                	=	"980000063";
$InvoiceNumber        	=	 $Prefix.$rango;
$InvoiceAuthorization 	=	'9000000105596663';//Autorización de factura
$StartDate            	=	'2018-02-14';//fecha inicio resolución
$EndDate              	=	'2028-02-14';//Fecha final resolución
$IdentificationCode   	=	'CO';//Código de identificación
$ProviderID           	=	$nit;//identificacion del facturador ante la dian
$SoftwareID           	=	'ff8d5e3f-6746-40cb-9621-d52903f7d8b7';//identificacion del facturador ante la dian
$ClTec                	=	'dd85db55545bd6566f36b0fd3be9fd8555c36e';
$Pin                  	=	'3L3m3nt';//pin secreto 
$SoftwareSecurityCode 	=	 hash('sha384',$SoftwareID.$Pin);
$KeyInfo              	=	 $SoftwareID;// <ds:KeyInfo Id	=	"'.$KeyInfo.'"> confirmar :(
$id_producto          	=	'1';
$cantidad             	=	'765';
$descripcion          	=	'Línea-1 PRUE980007161 f-s0001_900373115_0d2e2_R9000000500017960-PRUE-A_cufe';
$Precio               	=	'1483.4518917264927';
$IssueDate            	=	  date('Y-m-d');//Fecha de asunto
$IssueTime            	=	  date('H:i:s');//Tiempo de emisión
$LineExtensionAmount  	=	'500.00';//<!-- Valor de la factura sin IVA-->
$TaxExclusiveAmount   	=	'95.00'; //<!--Importe exclusivo de impuestos -->
$PayableAmount        	=	'595.00'; //<!-- Valor total de la factura con impuestos -->
$Nit                  	=	  $nit;//nit facturador
$Note                 	=	'Nota';//prueba de nota
//_________________________________________________________ cufe_______________________________________
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
//_________________________________________________________ cufe_______________________________________