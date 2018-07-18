'<cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID>'.
'<cbc:ProfileID>DIAN 1.0</cbc:ProfileID> 	 '.
'<cbc:ID>'.$NumFac.'</cbc:ID>'.
'<cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$cufe.'</cbc:UUID>'.
'<cbc:IssueDate>'.$IssueDate.'</cbc:IssueDate> 	'.
'<cbc:IssueTime>'.$IssueTime.'</cbc:IssueTime> 	'.
'<cbc:InvoiceTypeCode listAgencyID="195" listAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" listSchemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/InvoiceType">1</cbc:InvoiceTypeCode>'.
'<cbc:Note>'.$Note.'</cbc:Note>'.
'<cbc:DocumentCurrencyCode>COP</cbc:DocumentCurrencyCode>'.
		'<fe:AccountingSupplierParty>'.
			'<cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>'.
			'<fe:Party>			'.
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
			'<cbc:AdditionalAccountID>2</cbc:AdditionalAccountID>'.
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
'<fe:LegalMonetaryTotal>'.
	'<cbc:LineExtensionAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:LineExtensionAmount>'.
	'<cbc:TaxExclusiveAmount currencyID="COP">'.$TaxExclusiveAmount.'</cbc:TaxExclusiveAmount> 	'.
	'<cbc:PayableAmount currencyID="COP">'.$PayableAmount.'</cbc:PayableAmount> 					'.
'</fe:LegalMonetaryTotal>'.
'<fe:InvoiceLine>'.
	'<cbc:ID>1</cbc:ID>'.
	'<cbc:InvoicedQuantity>1</cbc:InvoicedQuantity>'.
	'<cbc:LineExtensionAmount currencyID="COP">500.00</cbc:LineExtensionAmount>'.
	'<fe:Item>'.
		'<cbc:Description>cascos d2</cbc:Description>'.
	'</fe:Item>'.
	'<fe:Price>'.
		'<cbc:PriceAmount currencyID="COP">500.00</cbc:PriceAmount>'.
	'</fe:Price>'.
'</fe:InvoiceLine>'.
