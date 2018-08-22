<?php

//namespace josemmo\Facturae;

/**
 * Facturae
 *
 * This file contains everything you need to create invoices.
 *
 * @package avalohack\Facturamos
 * @version 0.0.1
 * @license http://www.opensource.org/licenses/mit-license.php  MIT License
 * @author  avalohack
 */


/**
 * Facturae
 *
 * Standalone class designed to create full compliance Facturae files from
 * scratch, without the need of any other tools for signing.
 */
class Facturae {

  /* CONSTANTS */
  const SCHEMA_3_2 = "3.2";
  const SCHEMA_3_2_1 = "3.2.1";
  const SCHEMA_3_2_2 = "3.2.2";
  const SIGN_POLICY_3_1 = array(
    "name" => "Política de Firma FacturaE v3.1",
    "url" => "https://facturaelectronica.dian.gov.co/politicadefirma/v2/politicadefirmav2.pdf",
    "digest" => "sbcECQ7v+y/m3OcBCJyvmkBhtFs="
  );

  const PAYMENT_CASH = "01";
  const PAYMENT_TRANSFER = "04";

  const TAX_IVA = "01";
  const TAX_IPSI = "02";
  const TAX_IGIC = "03";
  const TAX_IRPF = "04";
  const TAX_OTHER = "05";
  const TAX_ITPAJD = "06";
  const TAX_IE = "07";
  const TAX_RA = "08";
  const TAX_IGTECM = "09";
  const TAX_IECDPCAC = "10";
  const TAX_IIIMAB = "11";
  const TAX_ICIO = "12";
  const TAX_IMVDN = "13";
  const TAX_IMSN = "14";
  const TAX_IMGSN = "15";
  const TAX_IMPN = "16";
  const TAX_REIVA = "17";
  const TAX_REIGIC = "18";
  const TAX_REIPSI = "19";
  const TAX_IPS = "20";
  const TAX_RLEA = "21";
  const TAX_IVPEE = "22";
  const TAX_IPCNG = "23";
  const TAX_IACNG = "24";
  const TAX_IDEC = "25";
  const TAX_ILTCAC = "26";
  const TAX_IGFEI = "27";
  const TAX_IRNR = "28";
  const TAX_ISS = "29";

  const UNIT_DEFAULT = "01";
  const UNIT_HOURS = "02";
  const UNIT_KILOGRAMS = "03";
  const UNIT_LITERS = "04";
  const UNIT_OTHER = "05";
  const UNIT_BOXES = "06";
  const UNIT_TRAYS = "07";
  const UNIT_BARRELS = "08";
  const UNIT_JERRICANS = "09";
  const UNIT_BAGS = "10";
  const UNIT_CARBOYS = "11";
  const UNIT_BOTTLES = "12";
  const UNIT_CANISTERS = "13";
  const UNIT_TETRABRIKS = "14";
  const UNIT_CENTILITERS = "15";
  const UNIT_CENTIMITERS = "16";
  const UNIT_BINS = "17";
  const UNIT_DOZENS = "18";
  const UNIT_CASES = "19";
  const UNIT_DEMIJOHNS = "20";
  const UNIT_GRAMS = "21";
  const UNIT_KILOMETERS = "22";
  const UNIT_CANS = "23";
  const UNIT_BUNCHES = "24";
  const UNIT_METERS = "25";
  const UNIT_MILIMETERS = "26";
  const UNIT_6PACKS = "27";
  const UNIT_PACKAGES = "28";
  const UNIT_PORTIONS = "29";
  const UNIT_ROLLS = "30";
  const UNIT_ENVELOPES = "31";
  const UNIT_TUBS = "32";
  const UNIT_CUBICMETERS = "33";
  const UNIT_SECONDS = "34";
  const UNIT_WATTS = "35";
  const UNIT_KWH = "36";


  /* PRIVATE CONSTANTS */
  private static $SCHEMA_NS = array(
    self::SCHEMA_3_2   => "http://www.facturae.es/Facturae/2009/v3.2/Facturae",
    self::SCHEMA_3_2_1 => "http://www.dian.gov.co/contratos/facturaelectronica/v1",
    self::SCHEMA_3_2_2 => "http://www.facturae.gob.es/formato/Versiones/Facturaev3_2_2.xml"
  );
  private static $DECIMALS = array(
    null => [
      null => ["min"=>2, "max"=>2],
      "UnitPriceWithoutTax" => ["min"=>2, "max"=>8]
    ],
    self::SCHEMA_3_2 => [
      null => ["min"=>2, "max"=>2],
      "UnitPriceWithoutTax" => ["min"=>6, "max"=>6],
      "TotalCost" => ["min"=>6, "max"=>6],
      "GrossAmount" => ["min"=>6, "max"=>6]
    ]
  );
  private static $USER_AGENT = "FacturaePHP/1.2.5";

  /* ATTRIBUTES */



  private $currency = "EUR";

  private $version = null;
  private $header = array(
    "serie" => null,
    "number" => null,
    "issueDate" => null,
    "dueDate" => null,
    "startDate" => null,
    "endDate" => null,
    "paymentMethod" => null,
    "paymentIBAN" => null
  );
  private $parties = array(
    "seller" => null,
    "buyer" => null
  );
  private $items = array();
  private $legalLiterals = array();

  private $signTime = null;
  private $timestampServer = null;
  private $timestampUser = null;
  private $timestampPass = null;
  private $signPolicy = null;
  private $publicKey = null;
  private $privateKey = null;


  /**
   * Construct
   *
   * @param string $schemaVersion If omitted, latest version available
   */
  public function __construct($schemaVersion=self::SCHEMA_3_2_1) {
    $this->setSchemaVersion($schemaVersion);
  }


  /**
   * Generate random ID
   *
   * This method is used for generating random IDs required when signing the
   * document.
   *
   * @return int Random number
   */
  private function random() {
    if (function_exists('random_int')) {
      return random_int(0x10000000, 0x7FFFFFFF);
    } else {
      return rand(100000, 999999);
    }
  }


  /**
   * Pad
   *
   * @param  float       $val   Input value
   * @param  string|null $field Field
   * @return string             Padded value
   */
  private function pad($val, $field=null) {
    // Get decimals
    $vKey = isset(self::$DECIMALS[$this->version]) ? $this->version : null;
    $decimals = self::$DECIMALS[$vKey];
    if (!isset($decimals[$field])) $field = null;
    $decimals = $decimals[$field];

    // Pad value
    $res = number_format(round($val, $decimals['max']), $decimals['max'], ".", "");
    for ($i=0; $i<$decimals['max']-$decimals['min']; $i++) {
      if (substr($res, -1) !== "0") break;
      $res = substr($res, 0, -1);
    }
    return $res;
  }


  /**
   * Is withheld tax
   *
   * This method returns if a tax type is, by default, a withheld tax
   *
   * @param  string  $taxCode Tax
   * @return boolean          Is withheld
   */
  public static function isWithheldTax($taxCode) {
    return in_array($taxCode, [self::TAX_IRPF]);
  }


  /**
   * Set schema version
   *
   * @param string $schemaVersion Facturae schema version to use
   */
  public function setSchemaVersion($schemaVersion) {
    $this->version = $schemaVersion;
  }


  /**
   * Set seller
   *
   * @param FacturaeParty $seller Seller information
   */
  public function setSeller($seller) 
  {
    $this->parties['seller'] = $seller;
  }


  /**
   * Set buyer
   *
   * @param FacturaeParty $buyer Buyer information
   */
  public function setBuyer($buyer) {
    $this->parties['buyer'] = $buyer;
  }


  /**
   * Set invoice number
   *
   * @param string     $serie  Serie code of the invoice
   * @param int|string $number Invoice number in given serie
   */
  public function setNumber($serie, $number) {
    $this->header['serie'] = $serie;
    $this->header['number'] = $number;
  }


  /**
   * Set issue date
   *
   * @param int|string $date Issue date
   */
  public function setIssueDate($date) {
    $this->header['issueDate'] = is_string($date) ? strtotime($date) : $date;
  }


  /**
   * Set due date
   *
   * @param int|string $date Due date
   */
  public function setDueDate($date) {
    $this->header['dueDate'] = is_string($date) ? strtotime($date) : $date;
  }


  /**
   * Set billing period
   *
   * @param int|string $date Start date
   * @param int|string $date End date
   */
  public function setBillingPeriod($startDate=null, $endDate=null) {
    $d_start = is_string($startDate) ? strtotime($startDate) : $startDate;
    $d_end = is_string($endDate) ? strtotime($endDate) : $endDate;
    $this->header['startDate'] = $d_start;
    $this->header['endDate'] = $d_end;
  }


  /**
   * Set dates
   *
   * This is a shortcut for setting both issue and due date in a single line
   *
   * @param int|string $issueDate Issue date
   * @param int|string $dueDate Due date
   */
  public function setDates($issueDate, $dueDate=null) {
    $this->setIssueDate($issueDate);
    $this->setDueDate($dueDate);
  }


  /**
   * Set payment method
   *
   * @param string $method Payment method
   * @param string $iban   Bank account in case of bank transfer
   */
  public function setPaymentMethod($method=self::PAYMENT_CASH, $iban=null) {
    $this->header['paymentMethod'] = $method;
    if (!is_null($iban)) $iban = str_replace(" ", "", $iban);
    $this->header['paymentIBAN'] = $iban;
  }


  /**
   * Add item
   *
   * Adds an item row to invoice. The fist parameter ($desc), can be an string
   * representing the item description or a 2 element array containing the item
   * description and an additional string of information.
   *
   * @param FacturaeItem|string|array $desc      Item to add or description
   * @param float                     $unitPrice Price per unit, taxes included
   * @param float                     $quantity  Quantity
   * @param int                       $taxType   Tax type
   * @param float                     $taxRate   Tax rate
   */
  // public function addItem($desc, $unitPrice=null, $quantity=1, $taxType=null, $taxRate=null) {
  //   if ($desc instanceOf FacturaeItem) {
  //     $item = $desc;
  //   } else {
  //     $item = new FacturaeItem([
  //       "name" => is_array($desc) ? $desc[0] : $desc,
  //       "description" => is_array($desc) ? $desc[1] : null,
  //       "quantity" => $quantity,
  //       "unitPrice" => $unitPrice,
  //       "taxes" => array($taxType => $taxRate)
  //     ]);
  //   }
  //   array_push($this->items, $item);
  // }


  /**
   * Add legal literal
   *
   * @param string $message Legal literal reference
   */
  public function addLegalLiteral($message) {
    $this->legalLiterals[] = $message;
  }


  /**
   * Get totals
   *
   * @return array Invoice totals
   */
  public function getTotals() {
    // Define starting values
    $totals = array(
      "taxesOutputs" => array(),
      "taxesWithheld" => array(),
      "invoiceAmount" => 0,
      "grossAmount" => 0,
      "grossAmountBeforeTaxes" => 0,
      "totalTaxesOutputs" => 0,
      "totalTaxesWithheld" => 0
    );

    // Run through every item
    foreach ($this->items as $itemObj) {
      $item = $itemObj->getData();
      $totals['invoiceAmount'] += $item['totalAmount'];
      $totals['grossAmount'] += $item['grossAmount'];
      $totals['totalTaxesOutputs'] += $item['totalTaxesOutputs'];
      $totals['totalTaxesWithheld'] += $item['totalTaxesWithheld'];

      // Get taxes
      foreach (["taxesOutputs", "taxesWithheld"] as $taxGroup) {
        foreach ($item[$taxGroup] as $type=>$tax) {
          if (!isset($totals[$taxGroup][$type]))
            $totals[$taxGroup][$type] = array();
          if (!isset($totals[$taxGroup][$type][$tax['rate']]))
            $totals[$taxGroup][$type][$tax['rate']] = array("base"=>0, "amount"=>0);
          $totals[$taxGroup][$type][$tax['rate']]['base'] +=
            $item['totalAmountWithoutTax'];
          $totals[$taxGroup][$type][$tax['rate']]['amount'] += $tax['amount'];
        }
      }
    }

    // Fill rest of values
    $totals['grossAmountBeforeTaxes'] = $totals['grossAmount'];

    return $totals;
  }


  /**
   * Set sign time
   *
   * @param int|string $time Time of the signature
   */
  public function setSignTime($time) {
    $this->signTime = is_string($time) ? strtotime($time) : $time;
  }


  /**
   * Set timestamp server
   *
   * @param string $server Timestamp Authority URL
   * @param string $user   TSA User
   * @param string $pass   TSA Password
   */
  public function setTimestampServer($server, $user=null, $pass=null) {
    $this->timestampServer = $server;
    $this->timestampUser = $user;
    $this->timestampPass = $pass;
  }


  /**
   * Load a PKCS#12 Certificate Store
   *
   * @param  string  $pkcs12File The certificate store file name
   * @param  string  $pkcs12Pass Encryption password for unlocking the PKCS#12 file
   * @return boolean             Success
   */
  private function loadPkcs12($pkcs12File, $pkcs12Pass="") {
    if (!is_file($pkcs12File)) return false;

    // Extract public and private keys from store
    if (openssl_pkcs12_read(file_get_contents($pkcs12File), $certs, $pkcs12Pass)) {
      $this->publicKey = openssl_x509_read($certs['cert']);
      $this->privateKey = openssl_pkey_get_private($certs['pkey']);
    }

    return (!empty($this->publicKey) && !empty($this->privateKey));
  }


  /**
   * Load a X.509 certificate and PEM encoded private key
   *
   * @param  string  $publicPath  Path to public key PEM file
   * @param  string  $privatePath Path to private key PEM file
   * @param  string  $passphrase  Private key passphrase
   * @return boolean              Success
   */
  private function loadX509($publicPath, $privatePath, $passphrase="") {
    if (is_file($publicPath) && is_file($privatePath)) {
      $this->publicKey = openssl_x509_read(file_get_contents($publicPath));
      $this->privateKey = openssl_pkey_get_private(
        file_get_contents($privatePath),
        $passphrase
      );
    }
    return (!empty($this->publicKey) && !empty($this->privateKey));
  }


  /**
   * Sign
   *
   * @param  string  $publicPath  Path to public key PEM file or PKCS#12 certificate store
   * @param  string  $privatePath Path to private key PEM file (should be null in case of PKCS#12)
   * @param  string  $passphrase  Private key passphrase
   * @param  array   $policy      Facturae sign policy
   * @return boolean              Success
   */


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // atributos de avalo inicio

    /*public $fecha_full   = null;
    public $date         = null;
    public $IssueDate    = null;
    public $IssueTime    = null;
    public $FecFac       = null;
    public $created      = null;
    public $SigningTime  = null;*/


  public function  fecha() 
  {
     date_default_timezone_set("America/Bogota"); //zona horaria
     $fecha_full     = time(); ///fecha en timestamp
     $fecha['date']        = date('Y-m-d\TH:i:s',    $fecha_full);  
     $fecha['IssueDate']   = date('Y-m-d',           $fecha_full);//F  
     $fecha['IssueTime']   = date('H:i:s',           $fecha_full);//T
     $fecha['FecFac']      = date('YmdHis',          $fecha_full); // Fecha d  
     $fecha['created']     = date('Y-m-d\TH:i:s.v\Z',$fecha_full);    
     $fecha['SigningTime'] = date('Y-m-d\TH:i:s.v',  $fecha_full)."-05:00";
     return $fecha;
  }




  // atributos de avalo fin
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  public function sign($publicPath, $privatePath=null, $passphrase="", $policy=self::SIGN_POLICY_3_1) {
    $this->publicKey = null;
    $this->privateKey = null;
    $this->signPolicy = $policy;

    // Generate random IDs
    $this->signatureID                 = '16baa8f7-2e89-4ff9-b736-7e642ce066c3'; //$this->random();
    $this->signedInfoID                = $this->random();
    $this->signedPropertiesID          = $this->random();
    $this->signatureValueID            = '16baa8f7-2e89-4ff9-b736-7e642ce066c3';//$this->random();
    $this->certificateID               = '16baa8f7-2e89-4ff9-b736-7e642ce066c3';//$this->random();
    $this->referenceID                 = '16baa8f7-2e89-4ff9-b736-7e642ce066c3';//$this->random();
    $this->signatureSignedPropertiesID = $this->random();
    $this->signatureObjectID           = $this->random();

    // Load public and private keys
    if (empty($privatePath)) {
      return $this->loadPkcs12($publicPath, $passphrase);
    } else {
      return $this->loadX509($publicPath, $privatePath, $passphrase);
    }
  }


  /**
   * Get XML NameSpaces
   *
   * NOTE: Should be defined in alphabetical order
   *
   * @return string XML NameSpaces
   */
  private function getNamespaces() {
    $xmlns = array();
    $xmlns[] = 'xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"';
    $xmlns[] = 'xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"';
    $xmlns[] = 'xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001"';
    $xmlns[] = 'xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001"';
    $xmlns[] = 'xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003"';
    $xmlns[] = 'xmlns:ds="http://www.w3.org/2000/09/xmldsig#"';
    $xmlns[] = 'xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"';
    $xmlns[] = 'xmlns:fe="' . self::$SCHEMA_NS[$this->version] . '"';
    $xmlns[] = 'xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2"';
    $xmlns[] = 'xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures"';
    $xmlns[] = 'xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2"';
    $xmlns[] = 'xmlns:xades="http://uri.etsi.org/01903/v1.3.2#"';
    $xmlns[] = 'xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#"';
    $xmlns[] = 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
    //$xmlns[] = 'xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1../xsd/DIAN_UBL.xsdurn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsdurn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd"';



    //$xmlns[] = 'xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1"';



    $xmlns = implode(' ', $xmlns);
    return $xmlns;
  }


  /**
   * Inject timestamp
   *
   * @param  string $signedXml Signed XML document
   * @return string            Signed and timestamped XML document
   */
  private function injectTimestamp($signedXml) {
    // Prepare data to timestamp
    $payload = explode('<ds:SignatureValue', $signedXml)[1];
    $payload = explode('</ds:SignatureValue>', $payload)[0];
    $payload = '<ds:SignatureValue ' . $this->getNamespaces() . $payload . '</ds:SignatureValue>';

    // Create TimeStampQuery in ASN1 using SHA-1
    $tsq = "302c0201013021300906052b0e03021a05000414";
    $tsq .= hash('sha1', $payload);
    $tsq .= "0201000101ff";
    $tsq = hex2bin($tsq);

    // Await TimeStampRequest
    $chOpts = array(
      CURLOPT_URL => $this->timestampServer,
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_BINARYTRANSFER => 1,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_FOLLOWLOCATION => 1,
      CURLOPT_CONNECTTIMEOUT => 0,
      CURLOPT_TIMEOUT => 10, // 10 seconds timeout
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => $tsq,
      CURLOPT_HTTPHEADER => array("Content-Type: application/timestamp-query"),
      CURLOPT_USERAGENT => self::$USER_AGENT
    );
    if (!empty($this->timestampUser) && !empty($this->timestampPass)) {
      $chOpts[CURLOPT_USERPWD] = $this->timestampUser . ":" . $this->timestampPass;
    }
    $ch = curl_init();
    curl_setopt_array($ch, $chOpts);
    $tsr = curl_exec($ch);
    if ($tsr === false) throw new \Exception('cURL error: ' . curl_error($ch));
    curl_close($ch);

    // Validate TimeStampRequest
    $responseCode = substr($tsr, 6, 3);
    if ($responseCode !== "\02\01\00") { // Bytes for INTEGER 0 in ASN1
      throw new \Exception('Invalid TSR response code');
    }

    // Extract TimeStamp from TimeStampRequest and inject into XML document
    $timeStamp = substr($tsr, 9);
    $tsXml = '<xades:UnsignedProperties Id="Signature' . $this->signatureID . '-UnsignedProperties' . $this->random() . '">' .
               '<xades:UnsignedSignatureProperties>' .
                 '<xades:SignatureTimeStamp Id="Timestamp-' . $this->random() . '">' .
                   '<ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315">' .
                   '</ds:CanonicalizationMethod>' .
                   '<xades:EncapsulatedTimeStamp>' . "\n" .
                     str_replace("\r", "", chunk_split(base64_encode($timeStamp), 76)) .
                   '</xades:EncapsulatedTimeStamp>' .
                 '</xades:SignatureTimeStamp>' .
               '</xades:UnsignedSignatureProperties>' .
             '</xades:UnsignedProperties>';
    $signedXml = str_replace('</xades:QualifyingProperties>', $tsXml . '</xades:QualifyingProperties>', $signedXml);
    return $signedXml;
  }


  /**
   * Inject signature
   *
   * @param  string $xml Unsigned XML document
   * @return string      Signed XML document
   */
  private function injectSignature($xml,$fecha_SigningTime) {
    // Make sure we have all we need to sign the document
    if (empty($this->publicKey) || empty($this->privateKey)) return $xml;

    // Normalize document
    $xml = str_replace("\r", "", $xml);

    // Define namespace
    $xmlns = $this->getNamespaces();

    // Prepare signed properties
    $signTime = is_null($this->signTime) ? time() : $this->signTime;
    $certData = openssl_x509_parse($this->publicKey);
    $certDigest = openssl_x509_fingerprint($this->publicKey, "sha1", true);
    $certDigest = base64_encode($certDigest);
    $certIssuer = array();
    foreach ($certData['issuer'] as $item=>$value) {
      $certIssuer[] = $item . '=' . $value;
    }
    $certIssuer = implode(',', $certIssuer);

    // Generate signed properties
    $prop = '<xades:SignedProperties Id="xmldsig-' . $this->signatureID .
            '-signedprops">' .
              '<xades:SignedSignatureProperties>' .
               // '<xades:SigningTime>' . date('c', $signTime) . '</xades:SigningTime>' .
                '<xades:SigningTime>' .  $fecha_SigningTime . '</xades:SigningTime>' .
                '<xades:SigningCertificate>' .
 //certi 1               
                  '<xades:Cert>' .
                    '<xades:CertDigest>' .
                      '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod>' .
                      '<ds:DigestValue>' . $certDigest . '</ds:DigestValue>' .
                    '</xades:CertDigest>' .
                    '<xades:IssuerSerial>' .
                     // '<ds:X509IssuerName>' . $certIssuer . '</ds:X509IssuerName>' .
                      '<ds:X509IssuerName>' . 'C=CO,L=Bogota D.C.,O=Andes SCD.,OU=Division de certificacion entidad final,CN=CA ANDES SCD S.A. Clase II,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f' . '</ds:X509IssuerName>' .
                      '<ds:X509SerialNumber>' . $certData['serialNumber'] . '</ds:X509SerialNumber>' .
                    '</xades:IssuerSerial>' .
                  '</xades:Cert>' .
 //certi 1 
 //certi 2
                  '<xades:Cert>' .
                    '<xades:CertDigest>' .
                      '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod>' .
                      '<ds:DigestValue>' . 'ydBrkDUi4OLwpDJACttO8PSuHdE=' . '</ds:DigestValue>' .
                    '</xades:CertDigest>' .
                    '<xades:IssuerSerial>' .
                      '<ds:X509IssuerName>' . 'C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f' . '</ds:X509IssuerName>' .
                      //'<ds:X509IssuerName>' . 'emailAddress=info@andesscd.com.co,CN=ROOT CA ANDES SCD S.A.,OU=Division de certificacion entidad final,O=Andes SCD.,L=Bogota D.C.,C=CO' . '</ds:X509IssuerName>' .
                      '<ds:X509SerialNumber>' . '8136867327090815624' . '</ds:X509SerialNumber>' .
                    '</xades:IssuerSerial>' .
                  '</xades:Cert>' .
 //certi 2
 //certi 3
                  '<xades:Cert>' .
                    '<xades:CertDigest>' .
                      '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod>' .
                      '<ds:DigestValue>' . 'OXeITae4OgBq7RWNUGqshhvKGk8=' . '</ds:DigestValue>' .
                    '</xades:CertDigest>' .
                    '<xades:IssuerSerial>' .
                       '<ds:X509IssuerName>' . 'C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f' . '</ds:X509IssuerName>' .           
//                      '<ds:X509IssuerName>' . 'emailAddress=info@andesscd.com.co,CN=ROOT CA ANDES SCD S.A.,OU=Division de certificacion entidad final,O=Andes SCD.,L=Bogota D.C.,C=CO' . '</ds:X509IssuerName>' .
                      '<ds:X509SerialNumber>' . '3184328748892787122'. '</ds:X509SerialNumber>' .
                    '</xades:IssuerSerial>' .
                  '</xades:Cert>' .
 //certi 3
                '</xades:SigningCertificate>' .
                '<xades:SignaturePolicyIdentifier>' .
                  '<xades:SignaturePolicyId>' .
                    '<xades:SigPolicyId>' .
                      '<xades:Identifier>' . $this->signPolicy['url'] . '</xades:Identifier>' .
                     // '<xades:Description>' . $this->signPolicy['name'] . '</xades:Description>' .
                    '</xades:SigPolicyId>' .
                    '<xades:SigPolicyHash>' .
                      '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"></ds:DigestMethod>' .
                      '<ds:DigestValue>' . $this->signPolicy['digest'] . '</ds:DigestValue>' .
                    '</xades:SigPolicyHash>' .
                  '</xades:SignaturePolicyId>' .
                '</xades:SignaturePolicyIdentifier>' .
                '<xades:SignerRole>' .
                  '<xades:ClaimedRoles>' .
                    '<xades:ClaimedRole>supplier</xades:ClaimedRole>' .
                  '</xades:ClaimedRoles>' .
                '</xades:SignerRole>' .
              '</xades:SignedSignatureProperties>' .
              /*'<xades:SignedDataObjectProperties>' .
                '<xades:DataObjectFormat ObjectReference="#Reference-ID-' . $this->referenceID . '">' .
                  '<xades:Description>Factura electrónica</xades:Description>' .
                  '<xades:MimeType>text/xml</xades:MimeType>' .
                '</xades:DataObjectFormat>' .
              '</xades:SignedDataObjectProperties>' .*/
            '</xades:SignedProperties>';

    // Prepare key info
    $publicPEM = "";
    openssl_x509_export($this->publicKey, $publicPEM);
    $publicPEM = str_replace("-----BEGIN CERTIFICATE-----", "", $publicPEM);
    $publicPEM = str_replace("-----END CERTIFICATE-----", "", $publicPEM);
    $publicPEM = str_replace("\n", "", $publicPEM);
    $publicPEM = str_replace("\r", "", chunk_split($publicPEM, 76));

    $privateData = openssl_pkey_get_details($this->privateKey);
    $modulus = chunk_split(base64_encode($privateData['rsa']['n']), 76);
    $modulus = str_replace("\r", "", $modulus);
    $exponent = base64_encode($privateData['rsa']['e']);

    // Generate KeyInfo
    $kInfo = '<ds:KeyInfo Id="xmldsig-' . $this->certificateID . '-keyinfo">' . "\n" .
               '<ds:X509Data>' . "\n" .
                 '<ds:X509Certificate>' . "\n" . $publicPEM . '</ds:X509Certificate>' . "\n" .
               '</ds:X509Data>' . "\n" .
              /* '<ds:KeyValue>' . "\n" .
                 '<ds:RSAKeyValue>' . "\n" .
                   '<ds:Modulus>' . "\n" . $modulus . '</ds:Modulus>' . "\n" .
                   '<ds:Exponent>' . $exponent . '</ds:Exponent>' . "\n" .
                 '</ds:RSAKeyValue>' . "\n" .
               '</ds:KeyValue>' . "\n" .*/
             '</ds:KeyInfo>';

    // Calculate digests
    $propDigest = base64_encode(sha1(str_replace('<xades:SignedProperties',
      '<xades:SignedProperties ' . $xmlns, $prop), true));
    $kInfoDigest = base64_encode(sha1(str_replace('<ds:KeyInfo',
      '<ds:KeyInfo ' . $xmlns, $kInfo), true));
    $documentDigest = base64_encode(sha1($xml, true));

    // Generate SignedInfo
    $sInfo = '<ds:SignedInfo>' . "\n" .
               '<ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315">' .
               '</ds:CanonicalizationMethod>' . "\n" .
               '<ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1">' .
               '</ds:SignatureMethod>' . "\n" .
     /*$sInfo = '<ds:SignedInfo Id="Signature-SignedInfo' . $this->signedInfoID . '">' . "\n" .
               '<ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315">' .
               '</ds:CanonicalizationMethod>' . "\n" .
               '<ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1">' .
               '</ds:SignatureMethod>' . "\n" .*/
//reference 1
               '<ds:Reference Id="xmldsig-' . $this->referenceID . '-ref0" URI="">' . "\n" .
                 '<ds:Transforms>' . "\n" .
                   '<ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature">' .
                   '</ds:Transform>' . "\n" .
                 '</ds:Transforms>' . "\n" .
                 '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">' .
                 '</ds:DigestMethod>' . "\n" .
                 '<ds:DigestValue>' . $documentDigest . '</ds:DigestValue>' . "\n" .
               '</ds:Reference>' . "\n" .
//reference 1
//reference 2
               '<ds:Reference URI="#xmldsig-' . $this->certificateID . '-keyinfo">' . "\n" .
                 '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">' .
                 '</ds:DigestMethod>' . "\n" .
                 '<ds:DigestValue>' . $kInfoDigest . '</ds:DigestValue>' . "\n" .
               '</ds:Reference>' . "\n" .
//reference 2
//reference 3               
               '<ds:Reference ' .
               'Type="http://uri.etsi.org/01903#SignedProperties" ' .
               'URI="#xmldsig-' . $this->signatureID . '-signedprops">' . "\n" .
                 '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">' .
                 '</ds:DigestMethod>' . "\n" .
                 '<ds:DigestValue>' . $propDigest . '</ds:DigestValue>' . "\n" .
               '</ds:Reference>' . "\n" .
//reference 3   
             '</ds:SignedInfo>';

    // Calculate signature
    $signaturePayload = str_replace('<ds:SignedInfo', '<ds:SignedInfo ' . $xmlns, $sInfo);
    openssl_sign($signaturePayload, $signatureResult, $this->privateKey);
    $signatureResult = chunk_split(base64_encode($signatureResult), 76);
    $signatureResult = str_replace("\r", "", $signatureResult);

    // Make signature
    $sig = '<ds:Signature Id="xmldsig-' . $this->signatureID . '" ' .
            'xmlns:ds="http://www.w3.org/2000/09/xmldsig#" '.
            '>' . "\n" .
            //'<ds:Signature Id="xmldsig-' . $this->signatureID . '">' . "\n" .
             $sInfo . "\n" .
             '<ds:SignatureValue Id="xmldsig-' . $this->signatureValueID . '-sigvalue">' . "\n" .
               $signatureResult .
             '</ds:SignatureValue>' . "\n" .
             $kInfo . "\n" .
             //'<ds:Object Id="Signature' . $this->signatureID . '-Object' . $this->signatureObjectID . '">' .
             '<ds:Object>' .
               '<xades:QualifyingProperties Target="#xmldsig-' . $this->signatureID . '" '.
                  'xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" '.
                  'xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" '.
                  ' >' .
                 $prop .
               '</xades:QualifyingProperties>' .
             '</ds:Object>' .
           '</ds:Signature>';

/*    // Make signature
    $sig = '<ds:Signature xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" Id="Signature' . $this->signatureID . '">' . "\n" .
             $sInfo . "\n" .
             '<ds:SignatureValue Id="SignatureValue' . $this->signatureValueID . '">' . "\n" .
               $signatureResult .
             '</ds:SignatureValue>' . "\n" .
             $kInfo . "\n" .
             //'<ds:Object Id="Signature' . $this->signatureID . '-Object' . $this->signatureObjectID . '">' .
             '<ds:Object>' .
               '<xades:QualifyingProperties Target="#Signature' . $this->signatureID . '">' .
                 $prop .
               '</xades:QualifyingProperties>' .
             '</ds:Object>' .
           '</ds:Signature>';*/



    // Inject signature
    $xml = str_replace('<ext:ExtensionContent></ext:ExtensionContent>', '<ext:ExtensionContent>' .$sig . '</ext:ExtensionContent>', $xml);

    // Inject timestamp
    if (!empty($this->timestampServer)) {
      $xml = $this->injectTimestamp($xml);
    }

    return $xml;
  }


  /**
   * Export
   *
   * Get Facturae XML data
   *
   * @param  string     $filePath Path to save invoice
   * @return string|int           XML data|Written file bytes
   */
  public function export($filePath=null,$Username,$password,$nit,$xml,$InvoiceNumber,$IssueDate)
  {
   



      $xml = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '' ,$xml);
      $xml = str_replace("\n", '', $xml);
      $xml = str_replace("\r", '', $xml);
     $fecha = $this->fecha(); // creamos una fecha general para no recrear fechas
     
  
    // Add signature
    $xml = $this->injectSignature($xml,$fecha['SigningTime']);
    // Prepend content type
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $xml;

    // Save document
   // if (!is_null($filePath)) return file_put_contents($filePath, $xml);


$obj_xml = new SimpleXMLElement($xml);
$documento_xml = $obj_xml->asXML(); //el xml de salidad

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                                                                                           //
//                          Fin_Creamos_Xml                                                                  //
//                                                                                                           //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                                                                                           //
//                          Inicio_Creamos_ZIP                                                               //
//                                                                                                           //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//nobre del archivo de salidad

$nit_10         = str_pad($nit, 10, "0", STR_PAD_LEFT);   //se añaden ceros a la izquierda hasta completar 10 digitos 
$rango_ex       = dechex($InvoiceNumber);//pasamos el numero de factura a exadecimal
$num_fac        = str_pad($rango_ex, 10, "0", STR_PAD_LEFT); //se añaden ceros a la izquierda hasta completar 10 digitos 

$tipo_documento = "face_f";
$tipo_de_zip  = "ws_f";

$nombre_xml   =  $tipo_documento.$nit_10.$num_fac;   // Nombre para usar en el xml y el zip 
$nombre_zip   =  $tipo_de_zip.$nit_10.$num_fac;        // Nombre para usar en el xml y el zip
$zip            =  new ZipArchive();             // Instanciar clase zipArchive
$filename       =  $nombre_zip.".zip";             // Nombre del zip $nombre_zip_xml concatenado con .zip
if ($zip->open($filename, ZipArchive::CREATE)!==TRUE)
{
exit("No se puedo abrir <$filename>\n");       // En caso de tener problemas de lectura 
}
$zip->addFromString($nombre_xml.".xml", $documento_xml);     // Se crear archivo XML dentro del zip
//echo "Numero de ficheros: " . $zip->numFiles . "\n";   // Se imprime estos valores solo en desarrollo
//echo "Estado:" . $zip->status . "\n";          // Se imprime estos valores solo en desarrollo
$zip->close();                                     // Cerramos el zip
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$ruta = __DIR__."/../../../$filename";


//echo $ruta;
$content = base64_encode(file_get_contents($ruta));
//echo "<br><br>".$content."<br><br>";


//exit();


//variables 
  $token      = rand().'d52903f7d8b7';
  $Username   =  $Username;
  $password   = hash('sha256',$password);
  $nonce    = base64_encode(rand());
    $wsdl     = "https://facturaelectronica.dian.gov.co/habilitacion/B2BIntegrationEngine/FacturaElectronica/facturaElectronica.wsdl";
    $client   = new SoapClient($wsdl, array("trace"=>1,"exceptions"=>0));
   $xmlHeader = 
        '<wsse:Security  SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
            <wsse:UsernameToken>
                <wsse:Username>'.$Username.'</wsse:Username>
                <wsse:Password>'.$password.'</wsse:Password>
                <wsse:Nonce>'.$nonce.'</wsse:Nonce>
                <wsu:Created>'.$fecha['created'] .'</wsu:Created>
            </wsse:UsernameToken>
          </wsse:Security>';
  $url       = 'http://www.w3.org/2001/XMLSchema';
  $jabon     = new SoapVar($xmlHeader, XSD_ANYXML);
  $xHeader   = new SoapHeader($url,'Security', $jabon ,true);    



/*$parameters= array( 'NIT'           => $nit,
'InvoiceNumber' => $InvoiceNumber,
'IssueDate'     => $date,
'Document'      => $content);
//          'Document'      => 'cid:ws_f0900332178003b023383.zip');*/
//----------------------------------------------------------------------------------------
$parameters =
'<ns1:EnvioFacturaElectronicaPeticion>
<ns1:NIT>'.$nit.'</ns1:NIT>
<ns1:InvoiceNumber>'.$InvoiceNumber.'</ns1:InvoiceNumber>
<ns1:IssueDate>'.$IssueDate.'</ns1:IssueDate>
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
                // print "<pre>\n";
                // print "<br />\n Request : ".htmlspecialchars($client->__getLastRequest());
                // print "</pre>";

// echo "---------------------------------------Response---------------------------------------------------<br><pre>";    
      $respuesta = htmlspecialchars($client->__getLastResponse());
// echo "</pre><br>---------------------------------------Response---------------------------------------------------";

//echo"valores<br>".$value."<br>";
// echo "------------------------------------------------------------------------------------------<br><pre>";
// var_dump($value);
// echo "</pre>";   
// echo "------------------------------------------------------------------------------------------<br><pre>";
// var_dump($client);
// echo "</pre>";   
 
// $vars = get_defined_vars();  
// echo "-----------------------------------definidas------------------------------------------------------<br><pre>";
// print_r($vars);  
// echo "------------------------------------------------------------------------------------------<br></pre>";

//echo $respuesta;
    return $respuesta;
  }

}
