<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

////////////////////////////////////////////////////////////////// helper
if ( ! function_exists('vector_plano'))
{
    function vector_plano($ruta)
    {
// inicio f open
$gestor = fopen($ruta, "r");//open file txt
if ($gestor)//valinadmos que halla una ruta a un documento 
{//if ini gestor
	$contador=0; //contadores
	$vector = array();
		while ($linea = fgets($gestor)) 
			{	
				$linea = explode("==",$linea);
				if ($linea['1']=='' or $linea['1']==null) 
						{ 
							echo "documento no cumple con especificaciones"; exit();
						}
					if ($linea['1'])
							{
								$linea['1'] = str_replace(' ', '', $linea['1']);
							}
						if (array_key_exists($linea['1'], $vector)) 
							{
								$detalle =[						
											'Produ_Codigo_Producto'           =>  trim($linea['27']),
											'Produ_Nombre_Producto'           =>  trim($linea['28']),
											'Produ_Presentacion'              =>  trim($linea['29']),
											'Produ_PorcentajeIVA'             =>  trim($linea['30']),
											'Produ_Precio_Unitario'           =>  trim($linea['31']),
											'Cantidad'                        =>  trim($linea['32']),
											'Dscto1'                          =>  trim($linea['33']),
											'Dscto2'                          =>  trim($linea['34']),
											'Parcial'                         =>  trim($linea['35']),
										 ];
								array_push($vector[$linea['1']]["detalle"], $detalle);
							}
						else
							{
								$vector[$linea['1']] = array(
														'Fac_Enca_Prefijo'				  =>  trim($linea['0']),
														'Fac_Enca_Numero'                 =>  trim($linea['1']),
														'Fac_Enca_Fecha'                  =>  trim($linea['2']),
														'Fac_Enca_Vencimiento'            =>  trim($linea['3']),
														'Fac_Enca_Condicion'              =>  trim($linea['4']),
														'Fac_Enca_Vendedor'               =>  trim($linea['5']),
														'Fac_Enca_Tercero_Codigo_Tercero' =>  trim($linea['6']),
														'Fac_Enca_Tercero_Nombre_Tercero' =>  trim($linea['7']),
														'Fac_Enca_Tercero_Telefono'       =>  trim($linea['8']),
														'Fac_Enca_Tercero_email'          =>  trim($linea['9']),
														'Fac_Enca_Tercero_Direccion'      =>  trim($linea['10']),
														'Fac_Enca_Direccion2'             =>  trim($linea['11']),
														'Fac_Enca_Tercero_Ciudad'         =>  trim($linea['12']),
														'Fac_Enca_Tercero_Pais'           =>  trim($linea['13']),
														'Fac_Enca_Tercero_Identificacion' =>  trim($linea['14']),
														'Fac_Enca_Emp_Codigo_Tercero'     =>  trim($linea['15']),
														'Fac_Enca_Emp_Nombre_Tercero'     =>  trim($linea['16']),
														'Fac_Enca_Emp_Telefono'           =>  trim($linea['17']),
														'Fac_Enca_Emp_Direccion'          =>  trim($linea['18']),
														'Fac_Enca_Emp_Identificacion'     =>  trim($linea['19']),
														'Fac_Enca_Resolucion'             =>  trim($linea['20']),
														'Fac_Enca_Elaborado'              =>  trim($linea['21']),
														'Fac_Enca_Pedido'                 =>  trim($linea['22']),
														'Fac_Enca_Tipo_ID'                =>  trim($linea['23']),
														'Fac_Enca_Tipo_Persona'           =>  trim($linea['24']),
														'Fac_Enca_Hora'                   =>  trim($linea['25']),
														'Fac_Enca_Clave_Tecnica'          =>  trim($linea['26']),
														'Fac_Totales_Gravado_19'          =>  trim($linea['36']),
														'Fac_Totales_Gravado_5'           =>  trim($linea['37']),
														'Fac_Totales_Exento'              =>  trim($linea['38']),
														'Fac_Totales_Antes_Impuestos'     =>  trim($linea['39']),
														'Fac_Totales_IVA_19'              =>  trim($linea['40']),
														'Fac_Totales_IVA_5'               =>  trim($linea['41']),
														'Fac_Totales_Valor_Total'         =>  trim($linea['42']),
														'Fac_Enca_Observaciones'          =>  trim($linea['43']),
														'detalle' 		 				  => [],
														);
														//'Fac_Enca_Emp_Codigo_Tercero'     =>  trim($linea['44']),

										$detalle =[
													'Produ_Codigo_Producto'           =>  trim($linea['27']),
													'Produ_Nombre_Producto'           =>  trim($linea['28']),
													'Produ_Presentacion'              =>  trim($linea['29']),
													'Produ_PorcentajeIVA'             =>  trim($linea['30']),
													'Produ_Precio_Unitario'           =>  trim($linea['31']),
													'Cantidad'                        =>  trim($linea['32']),
													'Dscto1'                          =>  trim($linea['33']),
													'Dscto2'                          =>  trim($linea['34']),
													'Parcial'                         =>  trim($linea['35']),
												 ];
								array_push($vector[$linea['1']]["detalle"], $detalle);
							}


				$contador++;
			}

		//prefuntamos si el puntero esta en la ultima linea 
		if (!feof($gestor)) 
		{
			echo "Error: fallo inesperado de fgets()\n";
		}
		//cerramos el documento
	fclose($gestor);
}//if ini gestor	

	////final fopen
	//retornamos vector
    return $vector;
    }   
}



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if ( ! function_exists('xml_generar'))
{
    function xml_generar($vector,$empresa)
    {
    	/*
echo "<pre>";
				print_r($vector);
echo "</pre>";
echo "<pre>";
				var_dump($empresa);
echo "</pre>";*/
$InvoiceAuthorization   = $empresa["0"]["InvoiceAuthorization"];//Autorización de factura

$StartDate              = $empresa["0"]["StartDate"];//fecha inicio resolución
$EndDate                = $empresa["0"]["EndDate"];//Fecha final resolución

$From                   = $empresa["0"]["From"];//De
$To                     = $empresa["0"]["To"];//a

$SoftwareID             = $empresa["0"]["SoftwareID"];//identificacion del facturador ante la dian

$Pin                    = $empresa["0"]["Pin"];//pin secreto 
$SoftwareSecurityCode   =  hash('sha384',$SoftwareID.$Pin);

$ClTec                  = $empresa["0"]["ClTec"];


/*$nit                    = "900332178";//nit de factura
$rango                  = "980000107";
$IdentificationCode     = 'CO';//Código de identificación


$id_producto            = '1';
$cantidad               = '765';
$descripcion            = 'Línea-1 PRUE980007161 f-s0001_900373115_0d2e2_R9000000500017960-PRUE-A_cufe';

$Nit                    =   $nit;//nit facturador
*/
$con = 0;
///////////////if ini
foreach ($vector as $key_facturas => $value_facturas) 
{
	$ProviderID         = $value_facturas["Fac_Enca_Emp_Codigo_Tercero"];//identificacion del facturador ante la dian
	$nit 				= $ProviderID;
	$Prefix             = $value_facturas["Fac_Enca_Prefijo"];//Prefijo
	$InvoiceNumber      = $Prefix.$value_facturas["Fac_Enca_Numero"];

	$LineExtensionAmount    = $value_facturas['Fac_Totales_Antes_Impuestos'];//<!-- Valor de la factura sin IVA-->
	$TaxExclusiveAmount     = $value_facturas['Fac_Totales_IVA_19']+ $value_facturas['Fac_Totales_IVA_5']; //<!--Importe exclusivo de impuestos -->
	$PayableAmount          = $value_facturas['Fac_Totales_Valor_Total']; //<!-- Valor total de la factura con impuestos -->
	$Note                   = $value_facturas['Fac_Enca_Observaciones'];//prueba de nota

	$fecha = strtotime(str_replace(" ","/",$value_facturas['Fac_Enca_Fecha'].$value_facturas['Fac_Enca_Hora'])) ;
	//$hora  = 	strtotime($value_facturas['Fac_Enca_Hora']);	


	$IssueDate = date('Y-m-d' ,$fecha);//F 
	$IssueTime = date('H:i:s' ,$fecha);//T
	$FecFac    = date('YmdHis',$fecha);// Fecha de factura en formato (Java) YYYYmmddHHMMss
	
	/*echo "<br>-------------------------<br>";
	echo "<br>".$IssueDate;
	echo "<br>".$IssueTime;
	echo "<br>".$FecFac;*/
	

		//var_dump($value_facturas);
	 $xml =
	'<fe:Invoice '. 
	'xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" '.
	'xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" '.
	'xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" '.
	'xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" '.
	'xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" '.
	//'xmlns:ds="http://www.w3.org/2000/09/xmldsig#" '.
	'xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" '.
	//'xmlns:fe="' . self::$SCHEMA_NS[$this->version] . '" '.
	'xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" '.
	'xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" '.
	'xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" '.
	'xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" '.
	'xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" '.
	'xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" '.
	'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" '.
	'xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">';
		//<!--_________________________________________ini__Extensions_firma________________________________________________-->
	$xml .='<ext:UBLExtensions>';
		//<!--_____________________________________ini__ExtensionContent_info_factura_____________________________________-->
	$xml .='<ext:UBLExtension>'.
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
				  '<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">CO</cbc:IdentificationCode>'.
				'</sts:InvoiceSource>'.
				'<sts:SoftwareProvider>'.
				  '<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$ProviderID.'</sts:ProviderID>'.
				  '<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$SoftwareID.'</sts:SoftwareID>'.
				'</sts:SoftwareProvider>'.
				'<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeName="SoftwareSecurityCode" schemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/anexo_v1_0.html#SofwareSecurityCode">'.$SoftwareSecurityCode.'</sts:SoftwareSecurityCode>'.
			  '</sts:DianExtensions>'.
			'</ext:ExtensionContent>'.
		  '</ext:UBLExtension>';
		//<!--_____________________________________fin__ExtensionContent_info_factura_____________________________________-->
		//<!--_____________________________________ini__ExtensionContent_firma_factura____________________________________-->
	$xml .= '<ext:UBLExtension>'.
			  '<ext:ExtensionContent></ext:ExtensionContent>'.
			'</ext:UBLExtension>';
	//<!--_____________________________________fin__ExtensionContent_firma_factura____________________________________-->
	$xml .='</ext:UBLExtensions>';
		//<!--_________________________________________fin__Extensions_firma________________________________________________-->
	//________________________________________________________ cufe_______________________________________
	$NumFac = $InvoiceNumber;   //Número de factura.
	$FecFac = $FecFac; // Fecha de factura en formato (Java) YYYYmmddHHMMss
	$ValFac = $LineExtensionAmount; //Valor Factura sin IVA, con punto decimal, con decimales a dos (2) dígitos, sin separadores de miles, ni símbolo pesos.
	$CodImp1 = '01'; //  01  fe:Invoice/fe:TaxTotal[x]/fe:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID = 01
	$ValImp1 = '95.00';//  Valor impuesto 01, con punto decimal, con decimales a dos (2)  dígitos, sin separadores de miles, ni símbolo pesos.    fe:Invoice/fe:TaxTotal[x]/fe:TaxSubtotal/cbc:   TaxAmount
	$CodImp2 = '02';//  02  fe:Invoice/fe:TaxTotal[y]/fe:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID = 02
	$ValImp2 = '0.00';//Valor impuesto 02, con punto decimal, con decimales a dos (2)  dígitos, sin separadores de miles, ni símbolo pesos. fe:Invoice/fe:TaxTotal[y]/fe:TaxSubtotal/cbc:TaxAmount
	$CodImp3 = '03';//fe:Invoice/fe:TaxTotal[z]/fe:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID = 03
	$ValImp3 = '0.00';// Valor impuesto 03, con punto decimal, con decimales a dos (2)  dígitos, sin separadores de miles, ni símbolo pesos.   fe:Invoice/fe:TaxTotal[z]/fe:TaxSubtotal/cbc:TaxAmount
	$ValImp = $PayableAmount; //Valor total, con punto decimal, con decimales a dos (2) dígitos, sin separadores de miles, ni símbolo pesos.   fe:Invoice/fe:LegalMonetaryTotal/cbc:PayableAmount cantidad a pagar
	$NitOFE = $nit; //NIT del Facturador Electrónico sin puntos ni guiones, sin digito de verificación.   fe:Invoice/fe:AccountingSupplierParty/fe:Party/cac:PartyIdentification/cbc:ID
	$TipAdq = '31';  // tipo de adquiriente, de acuerdo con el valor registrado en /fe:Invoice/fe:AccountingCustomerParty/fe:Party/cac:PartyIdentification/cbc:ID/@schemeID la tabla Tipos de documentos de identidad del «Anexo 001 Formato estándar XML de la Factura, notas débito y notas crédito electrónicos»; si no se determinó y es un NIT, entonces use el valor “O-99”, de lo contrario use “R-00-PN”. //fe:Invoice/fe:AccountingCustomerParty/fe:Party/cac:PartyIdentification/cbc:ID
	$NumAdq = $nit; // Número de identificación del adquirente sin puntos ni guiones, sin digito de verificación. 
	$ClTec  = $ClTec; //clave tenica de la resolucion
	$cufe = sha1($NumFac.$FecFac.$ValFac.$CodImp1.$ValImp1.$CodImp2.$ValImp2.$CodImp3.$ValImp3.$ValImp.$NitOFE.$TipAdq.$NumAdq.$ClTec);
		//<!--_________________________________________ini__UBL_factura_____________________________________________________-->
	$xml .='<cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID>'.
			'<cbc:ProfileID>DIAN 1.0</cbc:ProfileID>   '.
			'<cbc:ID>'.$InvoiceNumber.'</cbc:ID>'.
			'<cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$cufe.'</cbc:UUID>'.
			'<cbc:IssueDate>'.$IssueDate.'</cbc:IssueDate>  '.
			'<cbc:IssueTime>'.$IssueTime.'</cbc:IssueTime>  '.
			'<cbc:InvoiceTypeCode listAgencyID="195" listAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" listSchemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/InvoiceType">1</cbc:InvoiceTypeCode>'.
			'<cbc:Note>'.$Note.'</cbc:Note>'.
			'<cbc:DocumentCurrencyCode>COP</cbc:DocumentCurrencyCode>'.
				'<fe:AccountingSupplierParty>'.
				  '<cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>'.
//////////////////////////////////////////////////////ini facturador
					  '<fe:Party>     '.
						'<cac:PartyIdentification>'.
						  '<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$value_facturas['Fac_Enca_Emp_Codigo_Tercero'].'</cbc:ID>'.
						'</cac:PartyIdentification>'.
						  '<cac:PartyName>'.
						  '<cbc:Name>'.$value_facturas['Fac_Enca_Emp_Nombre_Tercero'].'</cbc:Name>'.
						'</cac:PartyName>'.
						'<fe:PhysicalLocation>'.
						  '<fe:Address>'.
							'<cbc:Department>ANTIOQUIA</cbc:Department>'.
							'<cbc:CitySubdivisionName></cbc:CitySubdivisionName>'.
							'<cbc:CityName>MEDELLIN</cbc:CityName>'.
							'<cac:AddressLine>'.
							  '<cbc:Line>'.$value_facturas['Fac_Enca_Emp_Direccion'] .'</cbc:Line>'.
							'</cac:AddressLine>'.
							'<cac:Country>'.
							  '<cbc:IdentificationCode>CO</cbc:IdentificationCode>'.
							'</cac:Country>'.
						  '</fe:Address>'.
						'</fe:PhysicalLocation>'.
						'<fe:PartyTaxScheme>'.
							//////////////////////////_se_usa_2_regimen_comun
						  '<cbc:TaxLevelCode>2</cbc:TaxLevelCode>'.
							//////////////////////////_se_usa_2_regimen_comun
						  '<cac:TaxScheme>'.
						  '</cac:TaxScheme>'.
						'</fe:PartyTaxScheme>'.
						'<fe:PartyLegalEntity>'.
						  '<cbc:RegistrationName>'.$value_facturas['Fac_Enca_Emp_Nombre_Tercero'].'</cbc:RegistrationName>'.
						'</fe:PartyLegalEntity>'.
					  '</fe:Party>'.
//////////////////////////////////////////////////////fin facturador
					'</fe:AccountingSupplierParty>'.
					'<fe:AccountingCustomerParty>'.
					  '<cbc:AdditionalAccountID>2</cbc:AdditionalAccountID>'.
//////////////////////////////////////////////////////ini tercero					  
					  '<fe:Party>'.
						'<cac:PartyIdentification>'.
						  	'<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="'.
						  			$value_facturas['Fac_Enca_Tipo_ID'].'">'.
						  			$value_facturas["Fac_Enca_Tercero_Codigo_Tercero"].
			  				'</cbc:ID>'.
						'</cac:PartyIdentification>'.
						'<fe:PhysicalLocation>'.
						  '<fe:Address>'.
							'<cbc:Department>'.$value_facturas['Fac_Enca_Direccion2'].'</cbc:Department>'.
							'<cbc:CitySubdivisionName></cbc:CitySubdivisionName>'.
							'<cbc:CityName>'.$value_facturas['Fac_Enca_Tercero_Ciudad'] .'</cbc:CityName>'.
							'<cac:AddressLine>'.
							  '<cbc:Line>'.$value_facturas['Fac_Enca_Tercero_Direccion'] .'</cbc:Line>'.
							'</cac:AddressLine>'.
							'<cac:Country>'.
							  '<cbc:IdentificationCode>CO</cbc:IdentificationCode>'.
							'</cac:Country>'.
						  '</fe:Address>'.
						'</fe:PhysicalLocation>'.
						'<fe:PartyTaxScheme>'.
						  '<cbc:TaxLevelCode>0</cbc:TaxLevelCode>'.
						  '<cac:TaxScheme>'.
						  '</cac:TaxScheme>'.
						'</fe:PartyTaxScheme>'.
						'<fe:Person>'.
						  '<cbc:FirstName>'.$value_facturas['Fac_Enca_Tercero_Nombre_Tercero'].'</cbc:FirstName>'.
						  '<cbc:FamilyName>'.$value_facturas['Fac_Enca_Tercero_Nombre_Tercero'].'</cbc:FamilyName>'.
						  '<cbc:MiddleName>'.$value_facturas['Fac_Enca_Tercero_Nombre_Tercero'].'</cbc:MiddleName>'.
						'</fe:Person>'.
					  '</fe:Party>'.
//////////////////////////////////////////////////////fin tercero					  
					'</fe:AccountingCustomerParty>'.

				  '<fe:TaxTotal>'.
					'<cbc:TaxAmount currencyID="COP">'.$ValImp1.'</cbc:TaxAmount>'.
					'<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>'.
					'<fe:TaxSubtotal>'.
					  '<cbc:TaxableAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:TaxableAmount>'.
					  '<cbc:TaxAmount currencyID="COP">'.$ValImp1.'</cbc:TaxAmount>'.
					  '<cbc:Percent>19</cbc:Percent>'.
					  '<cac:TaxCategory>'.
						'<cac:TaxScheme>'.
						  '<cbc:ID>'.$CodImp1.'</cbc:ID>'.
						'</cac:TaxScheme>'.
					  '</cac:TaxCategory>'.
					'</fe:TaxSubtotal>'.
				  '</fe:TaxTotal>'.


				  '<fe:TaxTotal>'.
					'<cbc:TaxAmount currencyID="COP">'.$ValImp2.'</cbc:TaxAmount>'.
					'<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>'.
					'<fe:TaxSubtotal>'.
					  '<cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount>'.
					  '<cbc:TaxAmount currencyID="COP">'.$ValImp2.'</cbc:TaxAmount>'.
					  '<cbc:Percent>0</cbc:Percent>'.
					  '<cac:TaxCategory>'.
						'<cac:TaxScheme>'.
						  '<cbc:ID>'.$CodImp2.'</cbc:ID>'.
						'</cac:TaxScheme>'.
					  '</cac:TaxCategory>'.
					'</fe:TaxSubtotal>'.
				  '</fe:TaxTotal>'.


				  '<fe:TaxTotal>'.
					'<cbc:TaxAmount currencyID="COP">'.$ValImp3.'</cbc:TaxAmount>'.
					'<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>'.
					'<fe:TaxSubtotal>'.
					  '<cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount>'.
					  '<cbc:TaxAmount currencyID="COP">'.$ValImp3.'</cbc:TaxAmount>'.
					  '<cbc:Percent>0</cbc:Percent>'.
					  '<cac:TaxCategory>'.
						'<cac:TaxScheme>'.
						  '<cbc:ID>'.$CodImp3.'</cbc:ID>'.
						'</cac:TaxScheme>'.
					  '</cac:TaxCategory>'.
					'</fe:TaxSubtotal>'.
				  '</fe:TaxTotal>'.


				'<fe:LegalMonetaryTotal>';
				$LineExtensionAmount  = $value_facturas["Fac_Totales_Antes_Impuestos"];
				$TaxExclusiveAmount   = $value_facturas["Fac_Totales_IVA_19"]+$value_facturas["Fac_Totales_IVA_5"];
				$PayableAmount 		  = $LineExtensionAmount + $TaxExclusiveAmount;

		$xml .=  '<cbc:LineExtensionAmount currencyID="COP">'.$LineExtensionAmount  .'</cbc:LineExtensionAmount>'.
				  '<cbc:TaxExclusiveAmount currencyID="COP">'.$TaxExclusiveAmount.'</cbc:TaxExclusiveAmount>  '.
				  '<cbc:PayableAmount currencyID="COP">'.$PayableAmount.'</cbc:PayableAmount>           '.
				'</fe:LegalMonetaryTotal>';
		if (isset($value_facturas['detalle']))
					{					
						$numero_iten = 1;
						// recorremos Vetor $value_facturas['detalle']
						foreach ($value_facturas['detalle'] as $detalles_factura => $value_detalles)
							{								
								$calculo_ejemplo = $value_detalles['Cantidad'] * $value_detalles['Produ_Precio_Unitario'];
								$xml .=
									'<fe:InvoiceLine>'.
									  '<cbc:ID>'.$numero_iten.'</cbc:ID>'.
									  '<cbc:InvoicedQuantity>'.$value_detalles['Cantidad'].'</cbc:InvoicedQuantity>'.
									  '<cbc:LineExtensionAmount currencyID="COP">'.$calculo_ejemplo.'</cbc:LineExtensionAmount>'.
										  '<fe:Item>'.
											 '<cbc:Description>'.$value_detalles['Produ_Nombre_Producto'].'</cbc:Description>'.
										  '</fe:Item>'.
									  '<fe:Price>'.
										'<cbc:PriceAmount currencyID="COP">'.$value_detalles['Produ_Precio_Unitario'].'</cbc:PriceAmount>'.
									  '</fe:Price>'.
									'</fe:InvoiceLine>';
								$numero_iten++;					
							}
					}	
	//<!--_________________________________________fin__UBL_factura_____________________________________________________-->
		// Close invoice and document
		$xml .= '</fe:Invoice>';
		$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $xml;

$vector_xml[$con]=array(
						"factura_numero" =>$value_facturas["Fac_Enca_Numero"],
						"tercero_numero" =>$value_facturas["Fac_Enca_Tercero_Codigo_Tercero"],
						"tercero_nombre" =>$value_facturas['Fac_Enca_Tercero_Nombre_Tercero'],
						"factura_fecha"  =>$FecFac,
						"PayableAmount"  =>$PayableAmount,
						"xml"            =>$xml
						);

$con++;
}
return $vector_xml;
/*
echo "<pre>";
var_dump($vector_xml);
echo "</pre>";*/
////////////////if fin
    }
}

