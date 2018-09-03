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
  public function addItem($desc, $unitPrice=null, $quantity=1, $taxType=null, $taxRate=null) {
    if ($desc instanceOf FacturaeItem) {
      $item = $desc;
    } else {
      $item = new FacturaeItem([
        "name" => is_array($desc) ? $desc[0] : $desc,
        "description" => is_array($desc) ? $desc[1] : null,
        "quantity" => $quantity,
        "unitPrice" => $unitPrice,
        "taxes" => array($taxType => $taxRate)
      ]);
    }
    array_push($this->items, $item);
  }


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
public function export($filePath=null) 
{
//       // Prepare document
$xml ='<fe:DebitNote '. 
  'xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" '.
  'xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" '.
  'xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" '.
  'xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" '.
  'xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" '.
  //'xmlns:ds="http://www.w3.org/2000/09/xmldsig#" '.
  'xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" '.
  'xmlns:fe="' . self::$SCHEMA_NS[$this->version] . '" '.
  'xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" '.
  'xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" '.
  'xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" '.
  'xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" '.
  'xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" '.
  'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" '.
  'xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">';
//'>';


//-----------------------------------------------------------------------------------------
  $fecha = $this->fecha(); // creamos una fecha general para no recrear fechas
/*
    echo "<pre>";
    var_dump($fecha);
    echo "</pre>";
*/
$nit                    = "900332178";//nit de factura
$Prefix                 = 'PRUE';//Prefijo
$From                   = '980000000';//De
$To                     = '985000000';//a
$rango                  = "980000111";
$InvoiceNumber          =  $Prefix.$rango;
$InvoiceAuthorization   = '9000000105596663';//Autorización de factura
$StartDate              = '2018-02-14';//fecha inicio resolución
$EndDate                = '2028-02-14';//Fecha final resolución
$IdentificationCode     = 'CO';//Código de identificación
$ProviderID             = $nit;//identificacion del facturador ante la dian
$SoftwareID             = 'ff8d5e3f-6746-40cb-9621-d52903f7d8b7';//identificacion del facturador ante la dian
$ClTec                  = 'dd85db55545bd6566f36b0fd3be9fd8555c36e';
$Pin                    = '3L3m3nt';//pin secreto 
$SoftwareSecurityCode   =  hash('sha384',$SoftwareID.$Pin);
$KeyInfo                =  $SoftwareID;// <ds:KeyInfo Id  = "'.$KeyInfo.'"> confirmar :(
$id_producto            = '1';
$cantidad               = '765';
$descripcion            = 'Línea-1 PRUE980007161 f-s0001_900373115_0d2e2_R9000000500017960-PRUE-A_cufe';
$Precio                 = '1483.4518917264927';
$LineExtensionAmount    = '500.00';//<!-- Valor de la factura sin IVA-->
$TaxExclusiveAmount     = '95.00'; //<!--Importe exclusivo de impuestos -->
$PayableAmount          = '595.00'; //<!-- Valor total de la factura con impuestos -->
$Nit                    =   $nit;//nit facturador
$Note                   = 'Nota';//prueba de nota
//_________________________________________________________ cufe_______________________________________
$NumFac = $InvoiceNumber;   //Número de factura.
//$FecFac = $FecFac; // Fecha de factura en formato (Java) YYYYmmddHHMMss
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
$cufe = sha1($NumFac.$fecha['FecFac'].$ValFac.$CodImp1.$ValImp1.$CodImp2.$ValImp2.$CodImp3.$ValImp3.$ValImp.$NitOFE.$TipAdq.$NumAdq.$ClTec);
//_________________________________________________________ cufe_______________________________________

//<!--_________________________________________ini__Extensions_firma________________________________________________-->
//     $xml .='<ext:UBLExtensions>';
//         //<!--_____________________________________ini__ExtensionContent_info_factura_____________________________________-->
//         $xml .='<ext:UBLExtension>'.
//                 '<ext:ExtensionContent>'.
//                   '<sts:DianExtensions>'.
//                     '<sts:InvoiceControl>'.
//                       '<sts:InvoiceAuthorization>'.$InvoiceAuthorization.'</sts:InvoiceAuthorization>'.
//                       '<sts:AuthorizationPeriod>'.
//                         '<cbc:StartDate>'.$StartDate.'</cbc:StartDate>'.
//                         '<cbc:EndDate>'.$EndDate.'</cbc:EndDate>'.
//                       '</sts:AuthorizationPeriod>'.
//                       '<sts:AuthorizedInvoices>'.
//                         '<sts:Prefix>'.$Prefix.'</sts:Prefix>'.
//                         '<sts:From>'.$From.'</sts:From>'.
//                         '<sts:To>'.$To.'</sts:To>'.
//                       '</sts:AuthorizedInvoices>'.
//                     '</sts:InvoiceControl>'.
//                     '<sts:InvoiceSource>'.
//                       '<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">'.$IdentificationCode.'</cbc:IdentificationCode>'.
//                     '</sts:InvoiceSource>'.
//                     '<sts:SoftwareProvider>'.
//                       '<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$ProviderID.'</sts:ProviderID>'.
//                       '<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$SoftwareID.'</sts:SoftwareID>'.
//                     '</sts:SoftwareProvider>'.
//                     '<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeName="SoftwareSecurityCode" schemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/anexo_v1_0.html#SofwareSecurityCode">'.$SoftwareSecurityCode.'</sts:SoftwareSecurityCode>'.
//                   '</sts:DianExtensions>'.
//                 '</ext:ExtensionContent>'.
//               '</ext:UBLExtension>';
//         //<!--_____________________________________fin__ExtensionContent_info_factura_____________________________________-->
//         //<!--_____________________________________ini__ExtensionContent_firma_factura____________________________________-->
//         $xml .= '<ext:UBLExtension>'.
//                   '<ext:ExtensionContent></ext:ExtensionContent>'.
//                 '</ext:UBLExtension>';
//         //<!--_____________________________________fin__ExtensionContent_firma_factura____________________________________-->
//     $xml .='</ext:UBLExtensions>';
// //<!--_________________________________________fin__Extensions_firma________________________________________________-->
// //<!--_________________________________________ini__UBL_factura_____________________________________________________-->
//     $xml .='<cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID>'.
//             '<cbc:ProfileID>DIAN 1.0</cbc:ProfileID>   '.
//             '<cbc:ID>'.$NumFac.'</cbc:ID>'.
//             '<cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$cufe.'</cbc:UUID>'.
//             '<cbc:IssueDate>'.$fecha['IssueDate'].'</cbc:IssueDate>  '.
//             '<cbc:IssueTime>'.$fecha['IssueTime'].'</cbc:IssueTime>  '.
//             '<cbc:InvoiceTypeCode listAgencyID="195" listAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" listSchemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/InvoiceType">1</cbc:InvoiceTypeCode>'.
//             '<cbc:Note>'.$Note.'</cbc:Note>'.
//             '<cbc:DocumentCurrencyCode>COP</cbc:DocumentCurrencyCode>'.
//                 '<fe:AccountingSupplierParty>'.
//                   '<cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>'.
//                   '<fe:Party>     '.
//                     '<cac:PartyIdentification>'.
//                       '<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$Nit.'</cbc:ID>'.
//                     '</cac:PartyIdentification>'.
//                       '<cac:PartyName>'.
//                       '<cbc:Name>PJ - 900373115 - Adquiriente FE</cbc:Name>'.
//                     '</cac:PartyName>'.
//                     '<fe:PhysicalLocation>'.
//                       '<fe:Address>'.
//                         '<cbc:Department>Distrito Capital</cbc:Department>'.
//                         '<cbc:CitySubdivisionName>Centro</cbc:CitySubdivisionName>'.
//                         '<cbc:CityName>Bogotá</cbc:CityName>'.
//                         '<cac:AddressLine>'.
//                           '<cbc:Line>carrera 8 Nº 6C - 78</cbc:Line>'.
//                         '</cac:AddressLine>'.
//                         '<cac:Country>'.
//                           '<cbc:IdentificationCode>CO</cbc:IdentificationCode>'.
//                         '</cac:Country>'.
//                       '</fe:Address>'.
//                     '</fe:PhysicalLocation>'.
//                     '<fe:PartyTaxScheme>'.
//                       '<cbc:TaxLevelCode>0</cbc:TaxLevelCode>'.
//                       '<cac:TaxScheme>'.
//                       '</cac:TaxScheme>'.
//                     '</fe:PartyTaxScheme>'.
//                     '<fe:PartyLegalEntity>'.
//                       '<cbc:RegistrationName>PJ - 900373115</cbc:RegistrationName>'.
//                     '</fe:PartyLegalEntity>'.
//                   '</fe:Party>'.
//                 '</fe:AccountingSupplierParty>'.
//                 '<fe:AccountingCustomerParty>'.
//                   '<cbc:AdditionalAccountID>2</cbc:AdditionalAccountID>'.
//                   '<fe:Party>'.
//                     '<cac:PartyIdentification>'.
//                       '<cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">'.$Nit.'</cbc:ID>'.
//                     '</cac:PartyIdentification>'.
//                     '<fe:PhysicalLocation>'.
//                       '<fe:Address>'.
//                         '<cbc:Department>Valle del Cauca</cbc:Department>'.
//                         '<cbc:CitySubdivisionName>Centro</cbc:CitySubdivisionName>'.
//                         '<cbc:CityName>Toribio</cbc:CityName>'.
//                         '<cac:AddressLine>'.
//                           '<cbc:Line>carrera 8 Nº 6C - 46</cbc:Line>'.
//                         '</cac:AddressLine>'.
//                         '<cac:Country>'.
//                           '<cbc:IdentificationCode>CO</cbc:IdentificationCode>'.
//                         '</cac:Country>'.
//                       '</fe:Address>'.
//                     '</fe:PhysicalLocation>'.
//                     '<fe:PartyTaxScheme>'.
//                       '<cbc:TaxLevelCode>0</cbc:TaxLevelCode>'.
//                       '<cac:TaxScheme>'.
//                       '</cac:TaxScheme>'.
//                     '</fe:PartyTaxScheme>'.
//                     '<fe:Person>'.
//                       '<cbc:FirstName>Primer-N</cbc:FirstName>'.
//                       '<cbc:FamilyName>Apellido-11333000</cbc:FamilyName>'.
//                       '<cbc:MiddleName>Segundo-N</cbc:MiddleName>'.
//                     '</fe:Person>'.
//                   '</fe:Party>'.
//                 '</fe:AccountingCustomerParty>'.



//               '<fe:TaxTotal>'.
//                 '<cbc:TaxAmount currencyID="COP">'.$ValImp1.'</cbc:TaxAmount>'.
//                 '<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>'.
//                 '<fe:TaxSubtotal>'.
//                   '<cbc:TaxableAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:TaxableAmount>'.
//                   '<cbc:TaxAmount currencyID="COP">'.$ValImp1.'</cbc:TaxAmount>'.
//                   '<cbc:Percent>19</cbc:Percent>'.
//                   '<cac:TaxCategory>'.
//                     '<cac:TaxScheme>'.
//                       '<cbc:ID>'.$CodImp1.'</cbc:ID>'.
//                     '</cac:TaxScheme>'.
//                   '</cac:TaxCategory>'.
//                 '</fe:TaxSubtotal>'.
//               '</fe:TaxTotal>'.

//               '<fe:TaxTotal>'.
//                 '<cbc:TaxAmount currencyID="COP">'.$ValImp2.'</cbc:TaxAmount>'.
//                 '<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>'.
//                 '<fe:TaxSubtotal>'.
//                   '<cbc:TaxableAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:TaxableAmount>'.
//                   '<cbc:TaxAmount currencyID="COP">'.$ValImp2.'</cbc:TaxAmount>'.
//                   '<cbc:Percent>5</cbc:Percent>'.
//                   '<cac:TaxCategory>'.
//                     '<cac:TaxScheme>'.
//                       '<cbc:ID>'.$CodImp2.'</cbc:ID>'.
//                     '</cac:TaxScheme>'.
//                   '</cac:TaxCategory>'.
//                 '</fe:TaxSubtotal>'.
//               '</fe:TaxTotal>'.


//               '<fe:TaxTotal>'.
//                 '<cbc:TaxAmount currencyID="COP">'.$ValImp3.'</cbc:TaxAmount>'.
//                 '<cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator>'.
//                 '<fe:TaxSubtotal>'.
//                   '<cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount>'.
//                   '<cbc:TaxAmount currencyID="COP">'.$ValImp3.'</cbc:TaxAmount>'.
//                   '<cbc:Percent>0</cbc:Percent>'.
//                   '<cac:TaxCategory>'.
//                     '<cac:TaxScheme>'.
//                       '<cbc:ID>'.$CodImp3.'</cbc:ID>'.
//                     '</cac:TaxScheme>'.
//                   '</cac:TaxCategory>'.
//                 '</fe:TaxSubtotal>'.
//               '</fe:TaxTotal>'.

//             '<fe:LegalMonetaryTotal>'.
//               '<cbc:LineExtensionAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:LineExtensionAmount>'.
//               '<cbc:TaxExclusiveAmount currencyID="COP">'.$TaxExclusiveAmount.'</cbc:TaxExclusiveAmount>  '.
//               '<cbc:PayableAmount currencyID="COP">'.$PayableAmount.'</cbc:PayableAmount>           '.
//             '</fe:LegalMonetaryTotal>'.
//             '<fe:InvoiceLine>'.
//               '<cbc:ID>1</cbc:ID>'.
//               '<cbc:InvoicedQuantity>1</cbc:InvoicedQuantity>'.
//               '<cbc:LineExtensionAmount currencyID="COP">500.00</cbc:LineExtensionAmount>'.
//               '<fe:Item>'.
//                 '<cbc:Description>cascos d2</cbc:Description>'.
//               '</fe:Item>'.
//               '<fe:Price>'.
//                 '<cbc:PriceAmount currencyID="COP">500.00</cbc:PriceAmount>'.
//               '</fe:Price>'.
//             '</fe:InvoiceLine>';
// //<!--_________________________________________fin__UBL_factura_____________________________________________________-->
//     // Close invoice and document
//     $xml .= '</fe:Invoice>';

    //$xml= '<fe:Invoice xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd"><ext:UBLExtensions><ext:UBLExtension><ext:ExtensionContent><sts:DianExtensions><sts:InvoiceControl><sts:InvoiceAuthorization>9000000105596663</sts:InvoiceAuthorization><sts:AuthorizationPeriod><cbc:StartDate>2018-02-14</cbc:StartDate><cbc:EndDate>2028-02-14</cbc:EndDate></sts:AuthorizationPeriod><sts:AuthorizedInvoices><sts:Prefix>PRUE</sts:Prefix><sts:From>980000000</sts:From><sts:To>985000000</sts:To></sts:AuthorizedInvoices></sts:InvoiceControl><sts:InvoiceSource><cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">CO</cbc:IdentificationCode></sts:InvoiceSource><sts:SoftwareProvider><sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">900332178</sts:ProviderID><sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">ff8d5e3f-6746-40cb-9621-d52903f7d8b7</sts:SoftwareID></sts:SoftwareProvider><sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeName="SoftwareSecurityCode" schemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/anexo_v1_0.html#SofwareSecurityCode">c590bebf67471c586bae888c9db5694444f3be2ce4e73eee7a7fb1d7322916d15da2bfa73a237c6ca18712e4152a5625</sts:SoftwareSecurityCode></sts:DianExtensions></ext:ExtensionContent></ext:UBLExtension><ext:UBLExtension><ext:ExtensionContent></ext:ExtensionContent></ext:UBLExtension></ext:UBLExtensions><cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID><cbc:ProfileID>DIAN 1.0</cbc:ProfileID>   <cbc:ID>PRUE980000107</cbc:ID><cbc:UUID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">48febb6c0060aca1c3dc4b0161596990f5f9689a</cbc:UUID><cbc:IssueDate>2018-08-16</cbc:IssueDate>  <cbc:IssueTime>11:56:54</cbc:IssueTime>  <cbc:InvoiceTypeCode listAgencyID="195" listAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" listSchemeURI="http://www.dian.gov.co/contratos/facturaelectronica/v1/InvoiceType">1</cbc:InvoiceTypeCode><cbc:Note>ARQUITECTU</cbc:Note><cbc:DocumentCurrencyCode>COP</cbc:DocumentCurrencyCode><fe:AccountingSupplierParty><cbc:AdditionalAccountID>1</cbc:AdditionalAccountID><fe:Party>     <cac:PartyIdentification><cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">900332178</cbc:ID></cac:PartyIdentification><cac:PartyName><cbc:Name>ALMACEN FERRETERIA AMISTAD</cbc:Name></cac:PartyName><fe:PhysicalLocation><fe:Address><cbc:Department>ANTIOQUIA</cbc:Department><cbc:CitySubdivisionName></cbc:CitySubdivisionName><cbc:CityName>MEDELLIN</cbc:CityName><cac:AddressLine><cbc:Line>CRA 50 # 42 - 107</cbc:Line></cac:AddressLine><cac:Country><cbc:IdentificationCode>CO</cbc:IdentificationCode></cac:Country></fe:Address></fe:PhysicalLocation><fe:PartyTaxScheme><cbc:TaxLevelCode>2</cbc:TaxLevelCode><cac:TaxScheme></cac:TaxScheme></fe:PartyTaxScheme><fe:PartyLegalEntity><cbc:RegistrationName>ALMACEN FERRETERIA AMISTAD</cbc:RegistrationName></fe:PartyLegalEntity></fe:Party></fe:AccountingSupplierParty><fe:AccountingCustomerParty><cbc:AdditionalAccountID>2</cbc:AdditionalAccountID><fe:Party><cac:PartyIdentification><cbc:ID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)" schemeID="31">800093117</cbc:ID></cac:PartyIdentification><fe:PhysicalLocation><fe:Address><cbc:Department>ANTIOQUIA</cbc:Department><cbc:CitySubdivisionName></cbc:CitySubdivisionName><cbc:CityName>ENVIGADO</cbc:CityName><cac:AddressLine><cbc:Line>CL 36 SUR 23 96</cbc:Line></cac:AddressLine><cac:Country><cbc:IdentificationCode>CO</cbc:IdentificationCode></cac:Country></fe:Address></fe:PhysicalLocation><fe:PartyTaxScheme><cbc:TaxLevelCode>0</cbc:TaxLevelCode><cac:TaxScheme></cac:TaxScheme></fe:PartyTaxScheme><fe:Person><cbc:FirstName>ARQUITECTURA Y CONCRETO S.A.S</cbc:FirstName><cbc:FamilyName>ARQUITECTURA Y CONCRETO S.A.S</cbc:FamilyName><cbc:MiddleName>ARQUITECTURA Y CONCRETO S.A.S</cbc:MiddleName></fe:Person></fe:Party></fe:AccountingCustomerParty><fe:TaxTotal><cbc:TaxAmount currencyID="COP">22982.00</cbc:TaxAmount><cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator><fe:TaxSubtotal><cbc:TaxableAmount currencyID="COP">172010.00</cbc:TaxableAmount><cbc:TaxAmount currencyID="COP">22982.00</cbc:TaxAmount><cbc:Percent>19</cbc:Percent><cac:TaxCategory><cac:TaxScheme><cbc:ID>01</cbc:ID></cac:TaxScheme></cac:TaxCategory></fe:TaxSubtotal></fe:TaxTotal><fe:TaxTotal><cbc:TaxAmount currencyID="COP">2553.00</cbc:TaxAmount><cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator><fe:TaxSubtotal><cbc:TaxableAmount currencyID="COP">172010.00</cbc:TaxableAmount><cbc:TaxAmount currencyID="COP">2553.00</cbc:TaxAmount><cbc:Percent>5</cbc:Percent><cac:TaxCategory><cac:TaxScheme><cbc:ID>02</cbc:ID></cac:TaxScheme></cac:TaxCategory></fe:TaxSubtotal></fe:TaxTotal><fe:TaxTotal><cbc:TaxAmount currencyID="COP">0.00</cbc:TaxAmount><cbc:TaxEvidenceIndicator>false</cbc:TaxEvidenceIndicator><fe:TaxSubtotal><cbc:TaxableAmount currencyID="COP">0.00</cbc:TaxableAmount><cbc:TaxAmount currencyID="COP">0.00</cbc:TaxAmount><cbc:Percent>0</cbc:Percent><cac:TaxCategory><cac:TaxScheme><cbc:ID>03</cbc:ID></cac:TaxScheme></cac:TaxCategory></fe:TaxSubtotal></fe:TaxTotal><fe:LegalMonetaryTotal><cbc:LineExtensionAmount currencyID="COP">172010.00</cbc:LineExtensionAmount><cbc:TaxExclusiveAmount currencyID="COP">25535</cbc:TaxExclusiveAmount>  <cbc:PayableAmount currencyID="COP">197545.00</cbc:PayableAmount>           </fe:LegalMonetaryTotal><fe:InvoiceLine><cbc:ID>1</cbc:ID><cbc:InvoicedQuantity>30.0</cbc:InvoicedQuantity><cbc:LineExtensionAmount currencyID="COP">19770</cbc:LineExtensionAmount><fe:Item><cbc:Description>BISAG.3X3 C16 CP HO ST          INDUMA X24 UDS</cbc:Description></fe:Item><fe:Price><cbc:PriceAmount currencyID="COP">659.0</cbc:PriceAmount></fe:Price></fe:InvoiceLine><fe:InvoiceLine><cbc:ID>2</cbc:ID><cbc:InvoicedQuantity>6.0</cbc:InvoicedQuantity><cbc:LineExtensionAmount currencyID="COP">18054</cbc:LineExtensionAmount><fe:Item><cbc:Description>CABO MADERA P/PALA</cbc:Description></fe:Item><fe:Price><cbc:PriceAmount currencyID="COP">3009.0</cbc:PriceAmount></fe:Price></fe:InvoiceLine><fe:InvoiceLine><cbc:ID>3</cbc:ID><cbc:InvoicedQuantity>5.0</cbc:InvoicedQuantity><cbc:LineExtensionAmount currencyID="COP">51050</cbc:LineExtensionAmount><fe:Item><cbc:Description>PALA GARLANCHA No.4 SIN CABO    R:6056-40 HERRAGRO</cbc:Description></fe:Item><fe:Price><cbc:PriceAmount currencyID="COP">10210.0</cbc:PriceAmount></fe:Price></fe:InvoiceLine><fe:InvoiceLine><cbc:ID>4</cbc:ID><cbc:InvoicedQuantity>6.0</cbc:InvoicedQuantity><cbc:LineExtensionAmount currencyID="COP">83136</cbc:LineExtensionAmount><fe:Item><cbc:Description>TEJA ZINC 3.05 X .80 ONDULADA</cbc:Description></fe:Item><fe:Price><cbc:PriceAmount currencyID="COP">13856.0</cbc:PriceAmount></fe:Price></fe:InvoiceLine></fe:Invoice>';
    // Add signature
    // $xml = $this->injectSignature($xml,$fecha['SigningTime']);
    // Prepend content type

// $xml='<fe:DebitNote xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ccts="urn:oasis:names:specification:ubl:schema:xsd:CoreComponentParameters-2" xmlns:sdt="urn:oasis:names:specification:ubl:schema:xsd:SpecializedDatatypes-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';

$xml .='<ext:UBLExtensions>'.
    '<ext:UBLExtension>'.
      '<ext:ExtensionContent>'.
        '<sts:DianExtensions>'.
          '<sts:InvoiceSource>'.
            '<cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.0">CO</cbc:IdentificationCode>'.
          '</sts:InvoiceSource>'.
          '<sts:SoftwareProvider>'.
            '<sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$ProviderID.'</sts:ProviderID>'.
            '<sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$SoftwareID.'</sts:SoftwareID>'.
          '</sts:SoftwareProvider>'.
          '<sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Direccion de Impuestos y Aduanas Nacionales)">'.$SoftwareSecurityCode.'</sts:SoftwareSecurityCode>'.
        '</sts:DianExtensions>'.
      '</ext:ExtensionContent>'.
    '</ext:UBLExtension>';

$xml .= '<ext:UBLExtension>'.
                  '<ext:ExtensionContent></ext:ExtensionContent>'.
        '</ext:UBLExtension>';

$xml .='</ext:UBLExtensions>'.
  '<cbc:UBLVersionID>UBL 2.0</cbc:UBLVersionID>'.
  '<cbc:CustomizationID></cbc:CustomizationID> '.
  '<cbc:ProfileID>DIAN 1.0</cbc:ProfileID>'.
  '<cbc:ID>3</cbc:ID>'.
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
  '<cbc:DocumentCurrencyCode>COP</cbc:DocumentCurrencyCode>'.
  '<cac:DiscrepancyResponse>'.
    '<cbc:ReferenceID></cbc:ReferenceID>'.
    '<cbc:ResponseCode listName="concepto de notas débito" listSchemeURI="http://www.dian.gov.co/micrositios/fac_electronica/documentos/Anexo_Tecnico_001_Formatos_de_los_Documentos_XML_de_Facturacion_Electron.pdf" name="2:= gastos por cobrar">1</cbc:ResponseCode>'.
  '</cac:DiscrepancyResponse>'.
  '<cac:BillingReference>'.
    '<cac:InvoiceDocumentReference>'.
      '<cbc:ID schemeName="número de la factura a afectar">PRUE980000113</cbc:ID>'.
      '<cbc:UUID schemeName="CUFE de la factura de venta || factura de exportación"></cbc:UUID>'.
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
    '<cbc:AdditionalAccountID schemeName="tipos de persona; comprador: una persona natural">2</cbc:AdditionalAccountID>'.
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
    '<cbc:ID>1</cbc:ID>';
$nota = '61cd1e40e3f97ce2e5305512b5114add0f4504cc';
$NotaExplica = $nota;
$VrLinea     = $LineExtensionAmount;
$CCost       = '500.00';
$Desc        = 'cualquiercosa';
$uuid= sha1($NotaExplica.$VrLinea.$CCost.$Desc);

    
$xml .=
    '<cbc:UUID>'.$uuid.'</cbc:UUID>'.
    '<cbc:Note>'.$nota.'</cbc:Note>'.
    '<cbc:LineExtensionAmount currencyID="COP">'.$LineExtensionAmount.'</cbc:LineExtensionAmount>'.
    '<cbc:AccountingCost>'.$CCost.'</cbc:AccountingCost>'.
    '<cac:Item>'.
      '<cbc:Description>cualquiercosa</cbc:Description>'.
    '</cac:Item>'.

  '</cac:DebitNoteLine>'.

'</fe:DebitNote>';



    $xml = $this->injectSignature($xml,$fecha['SigningTime']);

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $xml;

    // Save document
    if (!is_null($filePath)) return file_put_contents($filePath, $xml);

 

$rango = 3;


//$obj_xml = new SimpleXMLElement($xml);
//$documento_xml = $obj_xml->asXML(); //el xml de salidad
$documento_xml = $xml;

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
$rango_ex       = dechex($rango);//pasamos el numero de factura a exadecimal
$num_fac        = str_pad($rango_ex, 10, "0", STR_PAD_LEFT); //se añaden ceros a la izquierda hasta completar 10 digitos 

$tipo_documento = "face_d";
$tipo_de_zip  = "ws_d";

$nombre_xml   =  $tipo_documento.$nit_10.$num_fac;   // Nombre para usar en el xml y el zip 
$nombre_zip   =  $tipo_de_zip.$nit_10.$num_fac;        // Nombre para usar en el xml y el zip
$zip            =  new ZipArchive();             // Instanciar clase zipArchive
$filename       =  $nombre_zip.".zip";             // Nombre del zip $nombre_zip_xml concatenado con .zip
if ($zip->open($filename, ZipArchive::CREATE)!==TRUE)
{
exit("No se puedo abrir <$filename>\n");       // En caso de tener problemas de lectura 
}
$zip->addFromString($nombre_xml.".xml", $documento_xml);     // Se crear archivo XML dentro del zip
echo "Numero de ficheros: " . $zip->numFiles . "\n";   // Se imprime estos valores solo en desarrollo
echo "Estado:" . $zip->status . "\n";          // Se imprime estos valores solo en desarrollo
$zip->close();                                     // Cerramos el zip
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$content = base64_encode(file_get_contents($filename));
echo "<br><br>".$content."<br><br>";

//variables 
  $token      = rand().'d52903f7d8b7';
  $Username   = 'ff8d5e3f-6746-40cb-9621-d52903f7d8b7';
  $password   = hash('sha256','Bello2010L');
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
<ns1:InvoiceNumber>3</ns1:InvoiceNumber>
<ns1:IssueDate>'.$fecha['IssueDate'].'T'.$fecha['IssueTime'].'</ns1:IssueDate>
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


    return $xml;
  }

}
