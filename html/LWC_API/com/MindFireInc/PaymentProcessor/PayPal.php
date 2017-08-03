<?php
require_once('Payment.php');

/**
 * Process a payment via PayPal.
 * 
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version 1.0
 */
final class PayPal extends Payment
{
    const CCTYPE_VISA = 'Visa', CCTYPE_MASTERCARD = 'MasterCard', CCTYPE_DISCOVER = 'Discover', CCTYPE_AMEX = 'Amex';

    private $_username, $_password, $_signature;
    private $_transId, $_respCode, $_respMsg;
    private $_ccNumber, $_ccType, $_ccExpDate, $_ccCVV;

    /**
     * Initialize PayPal class.
     * @param string $username
     * @param string $password
     * @param string $signature
     */
    public function __construct($username, $password, $signature) {
        parent::__construct();
        $this->_transId = '';
        $this->_respCode = '';
        $this->_respMsg = '';
        $this->_ccType = '';
        $this->_ccNumber = 0;
        $this->_ccExpDate = 0;
        $this->_ccCVV = 0;
        $this->_username = $username;
        $this->_password = $password;
        $this->_signature = $signature;
    }

    /**
     * Send the data to the payment processor.
     * return bool
     */
    public function Process($isTest=false)
    {
        $params = array(
            'USER' => $isTest ? 'sdk-three_api1.sdk.com' : $this->_username,
            'PWD' => $isTest ? 'QFZCWN5HZM8VBG7Q' : $this->_password,
            'VERSION' => '3.2',
            'SIGNATURE' => $isTest ? 'A-IzJhZZjhg29XQ2qnhapuwxIDzyAZQ92FRP5dqBzVesOkzbdUONzmOU' : $this->_signature,
            'METHOD' => 'DoDirectPayment',
            'PAYMENTACTION' => 'Sale',
            'IPADDRESS' => @$_SERVER['REMOTE_ADDR'],
            'DESC' => $this->description(),
            'INVNUM' => $this->invoice(),
            'AMT' => $this->amount(),
            'ITEMAMT' => $this->itemAmount(),
            'SHIPPINGAMT' => $this->shippingAmount(),
            'HANDLINGAMT' => $this->handlingAmount(),
            'TAXAMT' => $this->taxAmount(),
            'CREDITCARDTYPE' => $this->_ccType,
            'ACCT' => $this->_ccNumber,
            'EXPDATE' => $this->_ccExpDate,
            'CVV2' => $this->_ccCVV,
            'FIRSTNAME' => $this->firstName(),
            'LASTNAME' => $this->lastName(),
            'STREET' => $this->street(),
            'STREET2' => $this->street2(),
            'CITY' => $this->city(),
            'STATE' => $this->state(),
            'COUNTRYCODE' => $this->country(),
            'ZIP' => $this->zip(),
            'SHIPTONAME' => $this->shippingFirstName() .' '. $this->shippingLastName(),
            'SHIPTOSTREET' => $this->shippingStreet(),
            'SHIPTOSTREET2' => $this->shippingStreet2(),
            'SHIPTOCITY' => $this->shippingCity(),
            'SHIPTOSTATE' => $this->shippingState(),
            'SHIPTOCOUNTRY' => $this->shippingCountry(),
            'SHIPTOZIP' => $this->shippingZip(),
            'EMAIL' => $this->email(),
            'PHONENUM' => $this->phone(),
            'CURRENCYCODE' => $this->currencyCode(),
            'BUTTONSOURCE' => 'MindFireInc'
        );
        //var_dump($params);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $isTest ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp');
        curl_setopt($curl, CURLOPT_PORT, 443);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));

        $result = curl_exec($curl);

        curl_close($curl);
        
        $resultArray = array();
        parse_str($result, $resultArray);
        //var_dump($resultArray);

        if( strpos(@$resultArray['ACK'], 'Success') !== false )
        {
            $this->_transId = @$resultArray['TRANSACTIONID'];
            $this->_respCode = 1;
            $this->_respMsg = @$resultArray['L_LONGMESSAGE0'];
            return true;
        } else {
            $this->_transId = 0;
            $this->_respCode = @$resultArray['L_ERRORCODE0'];
            $msg = '';
            if (@$resultArray['AVSCODE'] != 'Y')
                $msg = 'Address verification did not match. ';
            if (@$resultArray['CVV2MATCH'] != 'M')
                $msg .= 'CVC code did not match. ';
            $msg .= @$resultArray['L_LONGMESSAGE0'];
            $this->_respMsg = $msg;
            return false;
        }
    }

    /**
     * Set credit card information.
     * @param string $CCTYPE
     * @param string $number
     * @param string $expDate MMYYYY
     * @param string $cvv
     */
    public function setCreditCard($CCTYPE, $number, $expDate, $cvv=null) {
        $this->_ccType = (string)$CCTYPE;
        $this->_ccNumber =  (string)$number;
        $this->_ccExpDate = (string)$expDate;
        $this->_ccCVV = (string)$cvv;
    }

    /**
     * Get the Transaction ID of a successful transaction.
     * return string
     */
    public function getTransactionId() {
        return $this->_transId;
    }
    /**
     * Get the response code from a transaction attempt.
     * return string 1 is success, 0 is failure
     */
    public function getResponseCode() {
        return $this->_respCode;
    }
    /**
     * Get the error response message from a transaction attempt.
     * return string
     */
    public function getResponseMessage() {
        return $this->_respMsg;
    }

}

