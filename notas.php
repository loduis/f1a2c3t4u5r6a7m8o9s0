'<fe:DebitNote xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">'.
	'<ext:UBLExtensions>'.
		'<ext:UBLExtension>'.
			'<ext:ExtensionContent>'.
				'<sts:DianExtensions>'.
					'<sts:InvoiceSource>'.
						'<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">CO</cbc:IdentificationCode>'.
					'</sts:InvoiceSource>'.
					'<sts:SoftwareProvider>'.
						'<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeURI="http://www.unece.org/trade/untdid/d08a/tred/tred3055.htm" schemeName="NIT, RUT" schemeDataURI="www.dian.gov.co/contenidos/servicios/rut_preguntasfrecuentes.html">'.$ProviderID.'</sts:ProviderID>'.
						'<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeURI="http://www.unece.org/trade/untdid/d08a/tred/tred3055.htm" schemeName="Código de Activación" schemeDataURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Guia_del_usuario_Habilitacion_Adquirente.pdf">'.$SoftwareID.'</sts:SoftwareID>'.
					'</sts:SoftwareProvider>'.
					'<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeURI="http://www.unece.org/trade/untdid/d08a/tred/tred3055.htm" schemeName="Código de Seguridad del Software" schemeDataURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Anexo_Tecnico_003_Mecanismos_Sistema_Tecnico_de_Control.pdf">'.$SoftwareSecurityCode.'</sts:SoftwareSecurityCode>'.
				'</sts:DianExtensions>'.
			'</ext:ExtensionContent>'.
		'</ext:UBLExtension>'.
	'</ext:UBLExtensions>'.
	'<cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID>'.
	'<cbc:CustomizationID/>'.
	'<cbc:ProfileID>DIAN 1.0</cbc:ProfileID>'.
	'<cbc:ID>1</cbc:ID>'.
	'<cbc:IssueDate>'.$fecha['IssueDate'].'</cbc:IssueDate>  '.
    '<cbc:IssueTime>'.$fecha['IssueTime'].'</cbc:IssueTime>  '.

	'<cbc:Note>La ND no incluye el elemento UUID </cbc:Note>'.

	'<cbc:Note>Este documento ejemplifica la causación de intereses de mora a una factura electrónica específica.</cbc:Note>'.
	'<cbc:Note>El elemento xPath: /fe:DebitNote/cbc:ID contiene la identificación única de la Nota Débito</cbc:Note>'.

	'<cbc:Note>El valor debitado a la Factura del Deudor está en los elementos del fragmento xPath: /fe:DebitNote/fe:LegalMonetaryTotal/, compuesto por tres elementos. </cbc:Note>'.


	'<cbc:Note>Los intereses por mora causan el IVA. Por esta razón se incluye el fragmento xPath: /fe:DebitNote/fe:TaxTotal</cbc:Note>'.

	'<cbc:Note>El elemento xPath: /fe:DebitNote/cac:DiscrepancyResponse/cbc:ReferenceID debe estar presente y vacío.</cbc:Note>'.

	'<cbc:Note>El elemento xPath: /fe:DebitNote/cac:BillingReference/cac:InvoiceDocumentReference/cbc:ID es el primer identificador de la factura que será afectada</cbc:Note>'.
	'<cbc:Note>El elemento xPath: /fe:DebitNote/cac:BillingReference/cac:InvoiceDocumentReference/cbc:UUID es el segundo identificador de la factura que será afectada; solo aplica para aquellas facturas que registran el CUFE en el elemento ./cbc:UUID; no aplica para la factura de contingencia. Esta última factura debe excluir el ./cbc:UUID</cbc:Note>'.
	'<cbc:Note>El elemento xPath: /fe:DebitNote/cac:BillingReference/cac:InvoiceDocumentReference/cbc:IssueDate contendrá la fecha de la factura</cbc:Note>'.
	'<cbc:Note>El fragmento xPath: /fe:DebitNote/cac:BillingReference contiene los identificadores de una factura.</cbc:Note>'.
	'<cbc:DocumentCurrencyCode/>'.
	'<cac:DiscrepancyResponse>'.
		'<cbc:ReferenceID/>'.
		'<cbc:ResponseCode listName="concepto de notas débito" listSchemeURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Anexo_Tecnico_001_Formatos_de_los_Documentos_XML_de_Facturacion_Electron.pdf" name="2:= gastos por cobrar">1</cbc:ResponseCode>'.
	'</cac:DiscrepancyResponse>'.
	'<cac:BillingReference>'.
		'<cac:InvoiceDocumentReference>'.
			'<cbc:ID schemeName="número de la factura a afectar">PRUE980000114</cbc:ID>'.
			'<cbc:UUID schemeName="CUFE de la factura de venta || factura de exportación">61cd1e40e3f97ce2e5305512b5114add0f4504cc</cbc:UUID>'.
			'<cbc:IssueDate>2018-08-31</cbc:IssueDate>'.
		'</cac:InvoiceDocumentReference>'.
	'</cac:BillingReference>'.
	'<fe:AccountingSupplierParty>'.
		'<cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>'.

 '<fe:Party>'.
    '<cac:PartyIdentification>'.
      '<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$Nit.'</cbc:ID>'.
    '</cac:PartyIdentification>'.
      '<cac:PartyName>'.
      '<cbc:Name>PJ - 900373115 - Adquiriente FE</cbc:Name>'.
    '</cac:PartyName>'.
    '<fe:PhysicalLocation>'.
      '<fe:Address>'.
        '<cbc:Department>Distrito Capital</cbc:Department>'.
        '<cbc:CitySubdivisionName>Centro</cbc:CitySubdivisionName>'.
        '<cbc:CityName>Bogotá</cbc:CityName>'.
        '<cac:AddressLine>'.
          '<cbc:Line>carrera 8 Nº 6C - 78</cbc:Line>'.
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
    '<fe:PartyLegalEntity>'.
      '<cbc:RegistrationName>PJ - 900373115</cbc:RegistrationName>'.
    '</fe:PartyLegalEntity>'.
  '</fe:Party>'.
'</fe:AccountingSupplierParty>'.
	'<fe:AccountingCustomerParty>'.
		'<cbc:AdditionalAccountID schemeName="tipos de persona; comprador: una persona natural" schemeDataURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Anexo_Tecnico_001_Formatos_de_los_Documentos_XML_de_Facturacion_Electron.pdf">2</cbc:AdditionalAccountID>'.
'<fe:Party>'.
'<cac:PartyIdentification>'.
  '<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$Nit.'</cbc:ID>'.
'</cac:PartyIdentification>'.
'<fe:PhysicalLocation>'.
  '<fe:Address>'.
    '<cbc:Department>Valle del Cauca</cbc:Department>'.
    '<cbc:CitySubdivisionName>Centro</cbc:CitySubdivisionName>'.
    '<cbc:CityName>Toribio</cbc:CityName>'.
    '<cac:AddressLine>'.
      '<cbc:Line>carrera 8 Nº 6C - 46</cbc:Line>'.
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
  '<cbc:FirstName>Primer-N</cbc:FirstName>'.
  '<cbc:FamilyName>Apellido-11333000</cbc:FamilyName>'.
  '<cbc:MiddleName>Segundo-N</cbc:MiddleName>'.
'</fe:Person>'.
'</fe:Party>'.
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

	'<fe:LegalMonetaryTotal>'.
              '<cbc:LineExtensionAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:LineExtensionAmount>'.
              '<cbc:TaxExclusiveAmount currencyID="COP">'.$TaxExclusiveAmount.'</cbc:TaxExclusiveAmount>  '.
              '<cbc:PayableAmount currencyID="COP">'.$PayableAmount.'</cbc:PayableAmount>           '.
            '</fe:LegalMonetaryTotal>'.

	'<cac:DebitNoteLine>'.
		'<cbc:ID>1</cbc:ID>'.
		'<ns2:UUID>61cd1e40e3f97ce2e5305512b5114add0f4504cc</ns2:UUID>'
		'<cbc:DebitedQuantity>1</cbc:DebitedQuantity>'.
		'<cbc:LineExtensionAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:LineExtensionAmount>'.
		'<cac:TaxTotal>'.
			'<cbc:TaxAmount currencyID="COP">'.$TaxExclusiveAmount.'</cbc:TaxAmount>'.
			'<cac:TaxSubtotal>'.
				'<cbc:TaxableAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:TaxableAmount>'.
				'<cbc:TaxAmount currencyID="COP">'.$TaxExclusiveAmount.'</cbc:TaxAmount>'.
				'<cbc:Percent>19.00</cbc:Percent>'.
				'<cac:TaxCategory>'.
					'<cac:TaxScheme/>'.
				'</cac:TaxCategory>'.
			'</cac:TaxSubtotal>'.
		'</cac:TaxTotal>'.
		'<cac:Item>'.
			'<cbc:Description>cualquiercosa</cbc:Description>'.
		'</cac:Item>'.
		'<cac:Price>'.
			'<cbc:PriceAmount currencyID="COP">130000.00</cbc:PriceAmount>'.
		'</cac:Price>'.
	'</cac:DebitNoteLine>'.


'</fe:DebitNote>'


///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
///////////////////////////////////////////oll
'<fe:DebitNote xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 http://www.dian.gov.co/micrositios/fac_electronica/documentos/XSD/r0/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 http://www.dian.gov.co/micrositios/fac_electronica/documentos/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 http://www.dian.gov.co/micrositios/fac_electronica/documentos/common/UBL-QualifiedDatatypes-2.0.xsd" xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1">'.
	'<ext:UBLExtensions>'.
		'<ext:UBLExtension>'.
			'<ext:ExtensionContent>'.
				'<sts:DianExtensions>'.
					'<sts:InvoiceSource>'.
						'<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">CO</cbc:IdentificationCode>'.
					'</sts:InvoiceSource>'.
					'<sts:SoftwareProvider>'.
						'<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeURI="http://www.unece.org/trade/untdid/d08a/tred/tred3055.htm" schemeName="NIT, RUT" schemeDataURI="www.dian.gov.co/contenidos/servicios/rut_preguntasfrecuentes.html">'.$ProviderID.'</sts:ProviderID>'.
						'<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeURI="http://www.unece.org/trade/untdid/d08a/tred/tred3055.htm" schemeName="Código de Activación" schemeDataURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Guia_del_usuario_Habilitacion_Adquirente.pdf">'.$SoftwareID.</sts:SoftwareID>'.
					'</sts:SoftwareProvider>'.
					'<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeURI="http://www.unece.org/trade/untdid/d08a/tred/tred3055.htm" schemeName="Código de Seguridad del Software" schemeDataURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Anexo_Tecnico_003_Mecanismos_Sistema_Tecnico_de_Control.pdf">'.$SoftwareSecurityCode.'</sts:SoftwareSecurityCode>'.
				'</sts:DianExtensions>'.
			'</ext:ExtensionContent>'.
		'</ext:UBLExtension>'.
	'</ext:UBLExtensions>'.
	'<cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID>'.
	'<cbc:CustomizationID/>'.
	'<cbc:ProfileID>DIAN 1.0</cbc:ProfileID>'.
	'<cbc:ID>1</cbc:ID>'.
	'<cbc:IssueDate>2018-08-30</cbc:IssueDate>'.
	'<cbc:IssueTime>03:04:19</cbc:IssueTime>'.
	'<cbc:Note>La ND no incluye el elemento UUID </cbc:Note>'.
	'<cbc:Note>Este documento ejemplifica la causación de intereses de mora a una factura electrónica específica.</cbc:Note>'.
	'<cbc:Note>El elemento xPath: /fe:DebitNote/cbc:ID contiene la identificación única de la Nota Débito</cbc:Note>'.
	'<cbc:Note>El valor debitado a la Factura del Deudor está en los elementos del fragmento xPath: /fe:DebitNote/fe:LegalMonetaryTotal/, compuesto por tres elementos. </cbc:Note>'.
	'<cbc:Note>Los intereses por mora causan el IVA. Por esta razón se incluye el fragmento xPath: /fe:DebitNote/fe:TaxTotal</cbc:Note>'.
	'<cbc:Note>El elemento xPath: /fe:DebitNote/cac:DiscrepancyResponse/cbc:ReferenceID debe estar presente y vacío.</cbc:Note>'.
	'<cbc:Note>El elemento xPath: /fe:DebitNote/cac:BillingReference/cac:InvoiceDocumentReference/cbc:ID es el primer identificador de la factura que será afectada</cbc:Note>'.
	'<cbc:Note>El elemento xPath: /fe:DebitNote/cac:BillingReference/cac:InvoiceDocumentReference/cbc:UUID es el segundo identificador de la factura que será afectada; solo aplica para aquellas facturas que registran el CUFE en el elemento ./cbc:UUID; no aplica para la factura de contingencia. Esta última factura debe excluir el ./cbc:UUID</cbc:Note>'.
	'<cbc:Note>El elemento xPath: /fe:DebitNote/cac:BillingReference/cac:InvoiceDocumentReference/cbc:IssueDate contendrá la fecha de la factura</cbc:Note>'.
	'<cbc:Note>El fragmento xPath: /fe:DebitNote/cac:BillingReference contiene los identificadores de una factura.</cbc:Note>'.
	'<cbc:DocumentCurrencyCode/>'.
	'<cac:DiscrepancyResponse>'.
		'<cbc:ReferenceID/>'.
		'<cbc:ResponseCode listName="concepto de notas débito" listSchemeURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Anexo_Tecnico_001_Formatos_de_los_Documentos_XML_de_Facturacion_Electron.pdf" name="2:= gastos por cobrar">1</cbc:ResponseCode>'.
	'</cac:DiscrepancyResponse>'.
	'<cac:BillingReference>'.
		'<cac:InvoiceDocumentReference>'.
			'<cbc:ID schemeName="número de la factura a afectar">PRUE980000107</cbc:ID>'.
			'<cbc:UUID schemeName="CUFE de la factura de venta || factura de exportación">48febb6c0060aca1c3dc4b0161596990f5f9689a</cbc:UUID>'.
			'<cbc:IssueDate>2018-08-16</cbc:IssueDate>'.
		'</cac:InvoiceDocumentReference>'.
	'</cac:BillingReference>'.
	'<fe:AccountingSupplierParty>'.
		'<cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>'.
		'<fe:Party>'.
			'<cac:PartyIdentification>'.
				'<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31" schemeDataURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Anexo_Tecnico_001_Formatos_de_los_Documentos_XML_de_Facturacion_Electron.pdf" schemeName="tipos de documentos de identidad; 13: cédula de ciudadanía">'.$Nit.'</cbc:ID>'.
			'</cac:PartyIdentification>'.
			'<fe:PhysicalLocation>'.
				'<fe:Address/>'.
			'</fe:PhysicalLocation>'.
			'<fe:PartyTaxScheme>'.
				'<cbc:TaxLevelCode/>'.
				'<cac:TaxScheme/>'.
			'</fe:PartyTaxScheme>'.
			'<fe:Person>'.
				'<cbc:FirstName>Nombre</cbc:FirstName>'.
				'<cbc:FamilyName>Apellidos</cbc:FamilyName>'.
				'<cbc:MiddleName>segundo nombre</cbc:MiddleName>'.
			'</fe:Person>'.
		'</fe:Party>'.
	'</fe:AccountingSupplierParty>'.
	'<fe:AccountingCustomerParty>'.
		'<cbc:AdditionalAccountID schemeName="tipos de persona; comprador: una persona natural" schemeDataURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Anexo_Tecnico_001_Formatos_de_los_Documentos_XML_de_Facturacion_Electron.pdf">2</cbc:AdditionalAccountID>'.
		'<fe:Party>'.
			'<cac:PartyIdentification>'.
				'<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">900373088</cbc:ID>'.
			'</cac:PartyIdentification>'.
			'<cac:PartyName>'.
				'<cbc:Name>PJ - 800199436 - Adquiriente FE</cbc:Name>'.
			'</cac:PartyName>'.
			'<fe:PhysicalLocation>'.
				'<fe:Address>'.
					'<cbc:Department>Distrito Capital</cbc:Department>'.
					'<cbc:CitySubdivisionName>Centro</cbc:CitySubdivisionName>'.
					'<cbc:CityName>Bogotá</cbc:CityName>'.
					'<cac:AddressLine>'.
						'<cbc:Line>	carrera 8 Nº 6C - 78</cbc:Line>'.
					'</cac:AddressLine>'.
					'<cac:Country>'.
						'<cbc:IdentificationCode>CO</cbc:IdentificationCode>'.
					'</cac:Country>'.
				'</fe:Address>'.
			'</fe:PhysicalLocation>'.
			'<fe:PartyTaxScheme>'.
				'<cbc:TaxLevelCode>0</cbc:TaxLevelCode>'.
				'<cac:TaxScheme/>'.
			'</fe:PartyTaxScheme>'.
			'<fe:PartyLegalEntity>'.
				'<cbc:RegistrationName>PJ - 900373088</cbc:RegistrationName>'.
			'</fe:PartyLegalEntity>'.
		'</fe:Party>'.
	'</fe:AccountingCustomerParty>'.
	'<fe:TaxTotal>'.
		'<cbc:TaxAmount currencyID="COP">416521.64</cbc:TaxAmount>'.
		'<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>'.
		'<fe:TaxSubtotal>'.
			'<cbc:TaxableAmount currencyID="COP">2603260.22</cbc:TaxableAmount>'.
			'<cbc:TaxAmount currencyID="COP">416521.64</cbc:TaxAmount>'.
			'<cbc:Percent>16.00</cbc:Percent>'.
			'<cac:TaxCategory>'.
				'<cac:TaxScheme>'.
					'<cbc:ID>01</cbc:ID>'.
				'</cac:TaxScheme>'.
			'</cac:TaxCategory>'.
		'</fe:TaxSubtotal>'.
	'</fe:TaxTotal>'.
	'<fe:LegalMonetaryTotal>'.
		'<cbc:LineExtensionAmount currencyID="COP">260000.00</cbc:LineExtensionAmount>'.
		'<cbc:TaxExclusiveAmount currencyID="COP">416000.00</cbc:TaxExclusiveAmount>'.
		'<cbc:PayableAmount currencyID="COP">3016000.00</cbc:PayableAmount>'.
	'</fe:LegalMonetaryTotal>'.
	'<cac:DebitNoteLine>'.
		'<cbc:ID>1</cbc:ID>'.
		'<cbc:DebitedQuantity>20.00</cbc:DebitedQuantity>'.
		'<cbc:LineExtensionAmount currencyID="COP">2600000.00</cbc:LineExtensionAmount>'.
		'<cac:TaxTotal>'.
			'<cbc:TaxAmount currencyID="COP">416000.00</cbc:TaxAmount>'.
			'<cac:TaxSubtotal>'.
				'<cbc:TaxableAmount currencyID="COP">2600000.00</cbc:TaxableAmount>'.
				'<cbc:TaxAmount currencyID="COP">416000.00</cbc:TaxAmount>'.
				'<cbc:Percent>16.00</cbc:Percent>'.
				'<cac:TaxCategory>'.
					'<cac:TaxScheme/>'.
				'</cac:TaxCategory>'.
			'</cac:TaxSubtotal>'.
		'</cac:TaxTotal>'.
		'<cac:Item>'.
			'<cbc:Description>20 horas de monta carga para la labor con la mercancía facturada con el del 2015-11-11</cbc:Description>'.
		'</cac:Item>'.
		'<cac:Price>'.
			'<cbc:PriceAmount currencyID="COP">130000.00</cbc:PriceAmount>'.
		'</cac:Price>'.
	'</cac:DebitNoteLine>'.
'</fe:DebitNote>'.