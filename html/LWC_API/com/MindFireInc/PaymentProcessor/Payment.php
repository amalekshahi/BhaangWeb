<?php
/**
 * Abstract Class for Payment Processors.
 * 
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version 1.0
 */
abstract class Payment
{
    private $_firstName='', $_lastName='';
    private $_street='', $_street2='', $_city='', $_state='', $_zip='', $_country='';
    private $_email='', $_phone='';
    private $_shipFirstName='', $_shipLastName='';
    private $_shipStreet='', $_shipStreet2='', $_shipCity='', $_shipState='', $_shipZip='', $_shipCountry='';
    private $_currencyCode='USD';
    private $_amount=0, $_description='', $_invoice='';
    private $_itemAmount=0, $_shipAmount=0, $_handlingAmount=0, $_taxAmount=0;
    
    public function  __construct() {
        $this->_currencyCode = 'USD';
    }
    
    /**
     * Billing first name.
     * @param string $name
     * @return string
     */
    public function firstName($name=null) {
        if( !is_null($name) )
            $this->_firstName = (string)$name;
        return $this->_firstName;
    }
    /**
     * Billing last name.
     * @param string $name
     * @return string
     */
    public function lastName($name=null) {
        if( !is_null($name) )
            $this->_lastName = (string)$name;
        return $this->_lastName;
   }
    /**
     * Billing street address.
     * @param string $street
     * @return string
     */
    public function street($street=null) {
        if( !is_null($street) )
            $this->_street = (string)$street;
        return $this->_street;
    }
    /**
     * Billing street address2.
     * @param string $street
     * @return string
     */
    public function street2($street=null) {
        if( !is_null($street) )
            $this->_street2 = (string)$street;
        return $this->_street2;
    }
    /**
     * Billing City.
     * @param string $city
     * @return string
     */
    public function city($city=null) {
        if( !is_null($city) )
            $this->_city = (string)$city;
        return $this->_city;
    }
    /**
     * Billing state.
     * @param string $country
     * @return string
     */
    public function state($state=null) {
        if( !is_null($state) )
            $this->_state = (string)$state;
        return $this->_state;
    }
    /**
     * Billing zip.
     * @param string $zip
     * @return string
     */
    public function zip($zip=null) {
        if( !is_null($zip) )
            $this->_zip = (string)$zip;
        return $this->_zip;
    }
    /**
     * Billing country.
     * @param string $country
     * @return string
     */
    public function country($country=null) {
        if( !is_null($country) )
            $this->_country = (string)$country;
        return $this->_country;
    }
    
    /**
     * Contact email address.  Receipt is sent to here.
     * @param string $email
     * @return string
     */
    public function email($email=null) {
        if( !is_null($email) )
            $this->_email = (string)$email;
        return $this->_email;
    }
    /**
     * Contact phone.
     * @param string $phone
     * @return string
     */
    public function phone($phone=null) {
        if( !is_null($phone) )
            $this->_phone = (string)$phone;
        return $this->_phone;
    }
    
    /**
     * Shipping first name.
     * @param string $name
     * @return string
     */
    public function shippingFirstName($name=null) {
        if( !is_null($name) )
            $this->_shipFirstName = (string)$name;
        return $this->_shipFirstName;
    }
    /**
     * Shipping last name.
     * @param string $name
     * @return string
     */
    public function shippingLastName($name=null) {
        if( !is_null($name) )
            $this->_shipLastName = (string)$name;
        return $this->_shipLastName;
    }
    /**
     * Shipping street address.
     * @param string $street
     * @return string
     */
    public function shippingStreet($street=null) {
        if( !is_null($street) )
            $this->_shipStreet = (string)$street;
        return $this->_shipStreet;
    }
    /**
     * Shipping street address2.
     * @param string $street
     * @return string
     */
    public function shippingStreet2($street=null) {
        if( !is_null($street) )
            $this->_shipStreet2 = (string)$street;
        return $this->_shipStreet2;
    }
    /**
     * Shipping city.
     * @param string $city
     * @return string
     */
    public function shippingCity($city=null) {
        if( !is_null($city) )
            $this->_shipCity = (string)$city;
        return $this->_shipCity;
    }
    /**
     * Shipping state.
     * @param string $state
     * @return string
     */
    public function shippingState($state=null) {
        if( !is_null($state) )
            $this->_shipState = (string)$state;
        return $this->_shipState;
    }
    /**
     * Shipping zip.
     * @param string $zip
     * @return string
     */
    public function shippingZip($zip=null) {
        if( !is_null($zip) )
            $this->_shipZip = (string)$zip;
        return $this->_shipZip;
    }
    /**
     * Shipping country.
     * @param string $country
     * @return string
     */
    public function shippingCountry($country=null) {
        if( !is_null($country) )
            $this->_shipCountry = (string)$country;
        return $this->_shipCountry;
    }
    
    /**
     * Currency code.
     * @param string $ccode
     * @return string
     */
    public function currencyCode($ccode=null) {
        if( !is_null($ccode) )
            $this->_currencyCode = (string)$ccode;
        return $this->_currencyCode;
    }

    /**
     * Order description.
     * @param string $desc
     * @return string
     */
    public function description($desc=null) {
        if( !is_null($desc) )
            $this->_description = (string)$desc;
        return $this->_description;
    }
    /**
     * Order invoice.
     * @param string $inv
     * @return string
     */
    public function invoice($inv=null) {
        if( !is_null($inv) )
            $this->_invoice = (string)$inv;
        return $this->_invoice;
    }

    /**
     * Amount of total order.
     * @param float $amount
     * @return float
     */
    public function amount($amount=null) {
        if( !is_null($amount) )
            $this->_amount = (float)$amount;
        return $this->_amount;
    }
    /**
     * Amount of subtotal.
     * @param float $amount
     * @return float
     */
    public function itemAmount($amount=null) {
        if( !is_null($amount) )
            $this->_itemAmount = (float)$amount;
        return $this->_itemAmount;
    }
    /**
     * Shipping amount.
     * @param float $amount
     * @return float
     */
    public function shippingAmount($amount=null) {
        if( !is_null($amount) )
            $this->_shipAmount = (float)$amount;
        return $this->_shipAmount;
    }
    /**
     * Handling amount.
     * @param float $amount
     * @return float
     */
    public function handlingAmount($amount=null) {
        if( !is_null($amount) )
            $this->_handlingAmount = (float)$amount;
        return $this->_handlingAmount;
    }
    /**
     * Tax amount.
     * @param float $amount
     * @return float
     */
    public function taxAmount($amount=null) {
        if( !is_null($amount) )
            $this->_taxAmount = (float)$amount;
        return $this->_taxAmount;
    }

    /**
     * Set credit card information.
     * @param string $type
     * @param string $number
     * @param string $expDate
     * @param string $cvv
     */
    public function setCreditCard($type, $number, $expDate, $cvv=null) {
        $this->_ccType = (string)$type;
        $this->_ccNumber =  (string)$number;
        $this->_ccExpDate = (string)$expDate;
        $this->_ccCVV = (string)$cvv;
    }
    
    /**
     * Send the data to the payment processor.
     * @param bool $isTest
     * return bool
     */
    abstract function Process($isTest=false);
    /**
     * Get the Transaction ID of a successful transaction.
     * return string
     */
    abstract function getTransactionId();
    /**
     * Get the response code from a transaction attempt.
     * return string
     */
    abstract function getResponseCode();
    /**
     * Get the response message from a transaction attempt.
     * return string
     */
    abstract function getResponseMessage();
}


