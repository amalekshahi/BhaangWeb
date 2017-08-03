<?php
/**
 * Look Who's Clicking PHP API - Web Services Toolkit for PHP.
 *
 * <b>This is an unofficial library that is not supported by MindFire Inc.</b>
 *
 * <b>This is a low level API to interface with the LWC Web Service.
 * It is strongly suggested that you use the higher level classes.</b>
 *
 * <b>The following example shows how to configure the API.</b>
 * <code>
 * require_once('com/MindFireInc/LookWhosClicking/class.LWC.php');
 *
 * LWC::API_KEY('ABCDEFGHIJKLMN');
 * LWC::CLIENT_ID(200);
 * LWC::CAMPAIGN_ID(10);
 * LWC::WSDL('http://SUBDOMAIN.lwcdirect.com/services/LWC?wsdl');
 * </code>
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version v1.0 - August 4, 2010
 * @copyright Copyright (c) 2010 Patrick Martin
 */
final class LWC
{
    static private $_API_KEY = '';
    static private $_CAMPAIGN_ID = 0;
    static private $_CLIENT_WSDL = 'http://lwcdirect.com/services/LWC?wsdl';
    static private $_CLIENT_ID = 0;
    static private $_instance;


    static private $_DEBUG = false;

    ////////////////////////////////////////////////////////////////////////////
    // STATIC INTERFACE

    /**
     * Sets and returns Client API key.
     * Get the API key from MindFire Inc. <support@mindfireinc.com>
     * @param string $key Client API key
     * @return string Client API key
     */
    static public function API_KEY($key = ''){
        if( $key != '' )
            self::$_API_KEY = (string)$key;
        return self::$_API_KEY;
    }

    /**
     * Sets and returns Campaign Id.
     * @param int $id Campaign Id
     * @return int Campaign Id
     */
    static public function CAMPAIGN_ID($id = 0){
        if( $id != 0 )
            self::$_CAMPAIGN_ID = (int)$id;
        return self::$_CAMPAIGN_ID;
    }

    /**
     * Sets and returns URL for WSDL XML doc.
     * Set this to the Campaign URL in LWC's Global Properties.
     * The WSDL default URL is {@link http://lwcdirect.com/services/LWC?wsdl}.
     * For extra safety, use http://CAMPAIGNDOMAIN/services/LWC?wsdl.
     * @param string $wsdl URL to WSDL XML document
     * @return string URL of WSDL XML document
     */
    static public function WSDL($wsdl = ''){
        if( $wsdl != '' )
            self::$_CLIENT_WSDL = $wsdl;
        return self::$_CLIENT_WSDL;
    }

    /**
     * Sets and returns the Client Id.
     * @param int $id Client Id
     * @return int Client Id
     */
    static public function CLIENT_ID($id = 0){
        if( $id != 0 )
            self::$_CLIENT_ID = (int)$id;
        return self::$_CLIENT_ID;
    }

    /**
     * Show or hide debugging output.
     * @param bool $isDebug show debugging output
     * @return bool showing debugging output
     */
    static public function Debug($isDebug = null)
    {
        if( isset($isDebug) )
            self::$_DEBUG = (bool)$isDebug;
        return self::$_DEBUG;
    }

    /**
     * Lazy instantiation of LWC constructor.
     * <b>This is a low level API to interface with the LWC Web Service.
     * It is strongly recommended you use the higher level classes.</b>
     * @return LWC
     */
    static public function Singleton()
    {
        if( self::$_instance == null )
            self::$_instance = new LWC();
        return self::$_instance;
    }

    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Returns a Prospect list from LWC Web Service.
     * <b>This is a low level API to interface with the LWC Web Service.
     * It is strongly suggested to use the higher level classes.</b>
     * @param string $sqlWhere MySQL WHERE clause.
     * @param array $props Prospect fields to include in reponse
     * @return array response from LWC Web Service
     * @see Prospects::Get()
     */
    public function getProspects($sqlWhere, $props=null)
    {
        $arguments = array(
            'sqlWhere' => "<![CDATA[$sqlWhere]]>",
            'prospectFields' => isset($props) ? $props : array()
        );
        $result = $this->soapCall('getProspects', $arguments);
        return $result;
    }

    /**
     * Updates one or more Prospects on the target List.
     * <b>This is a low level API to interface with the LWC Web Service.
     * It is strongly suggested that you use the higher level classes.</b>
     * @param int $listId List Id
     * @param string $sqlWhere MySQL WHERE clause.
     * @param array $prospectFieldValues field values to update
     * @return array response from LWC Web Service
     * @see Prospects::Update(), Prospect::Update()
     */
    public function updateProspects($listId, $sqlWhere, $prospectFieldValues)
    {
        $result = $this->soapCall('updateProspects', array(
            'listID' => (int)$listId,
            'sqlWhere' => "<![CDATA[$sqlWhere]]>",
            'prospectFieldValue' => $prospectFieldValues
        ));
        return $result;
    }

    /**
     * Deletes one or more Prospects from the target List.
     * <b>This is a low level API to interface with the LWC Web Service.
     * It is strongly suggested that you use the higher level classes.</b>
     * @param int $listId List Id
     * @param string $sqlWhere MySQL WHERE clause.
     * @return array response from LWC Web Service
     * @see Prospects::Delete(), Prospect::Delete()
     */
    public function deleteProspects($listId, $sqlWhere)
    {
        $args = array(
            'listID' => (int)$listId,
            'sqlWhere' => "<![CDATA[$sqlWhere]]>"
        );
        $result = $this->soapCall('deleteProspects', $args);
        return $result;
    }

    /**
     * Tells the LWC App to upload and insert a Prospect Mail File.
     * <b>This is a low level API to interface with the LWC Web Service.
     * It is strongly suggested that you use the higher level classes.</b>
     * @param string $listName existing or new list name
     * @param string $fileURL the URL where the file is located
     * @param string $format the format of the file
     * @param string $email the email to send results
     * @param string $username if credentials are required, use this username
     * @param string $password if credentials are required, use this password
     * @return array
     * @throws Unsupported Method Exception
     */
    public function insertProspects($listName, $fileURL, $format='csv', $email='', $username='', $password='')
    {
        $result = $this->soapCall('insertProspects', array(
            'listName' => (string)$listName,
            'fileInputLocation' => (string)$fileURL,
            'credential' => array('user' => (string)$username, 'password' => (string)$password),
            'outputFormat' => (string)$format,
            'email' => (string)$email
        ));
        return $result;
    }

    /**
     * Returns how many Prospects would be pulled by the SQL query.
     * <b>This is an internal low level API to interface with the LWC Web Service.
     * It is strongly suggested to use the higher level classes.</b>
     * @param int $listId List Id
     * @param string $sqlWhere SQL WHERE clause
     * @return array response from LWC Web Service
     */
    public function getAffectedCount($listId, $sqlWhere)
    {
        $result = $this->soapCall('getAffectedCount', array(
            'listID' => (int)$listId,
            'sqlWhere' => "<![CDATA[$sqlWhere]]>"
        ));
        return $result;
    }

    /**
     * Returns the Mail Lists in the Campaign.
     * <b>This is a low level API to interface with the LWC Web Service.
     * It is strongly suggested to use the higher level classes.</b>
     * @return array response from LWC Web Service
     * @see MailLists::Get()
     */
    public function getLists()
    {
        $result = $this->soapCall('getLists');
        return $result;
    }

    /**
     * Export a Mail List.
     * <b>This is a low level API to interface with the LWC Web Service.
     * It is strongly suggested to use the higher level classes.</b>
     * @return array
     * @throws Unsupported Method Exception
     */
    public function exportList()
    {
        // TODO: exportList()
        throw new Exception('Unsupported Method Exception');

        $result = $this->soapCall('exportList');
        return $result;
    }

    /**
     * Get the number of rows returned by exportList().
     * <b>This is a low level API to interface with the LWC Web Service.
     * It is strongly suggested to use the higher level classes.</b>
     * @param string $sqlWhere
     * @return array
     * @throws Unsupported Method Exception
     */
    public function getExportCount($sqlWhere)
    {
        // TODO: getExportCount()
        throw new Exception('Unsupported Method Exception');

        $result = $this->soapCall('getExportCount', array(
            'sqlWhere' => "<![CDATA[$sqlWhere]]>"
        ));
        return $result;
    }

    /**
     * Returns a list of all Campaigns.
     * <b>This is a low level API to interface with the LWC Web Service.
     * It is strongly suggested to use the higher level classes.</b>
     * @return array response from LWC Web Service
     * @see Campaigns::Get()
     */
    public function getCampaigns()
    {
        $result = $this->soapCall('getCampaigns');
        return $result;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Methods

    private $soap;

    /**
     * Instantiate LWC object.
     */
    private function __construct()
    {
        $this->soap = new soapclientNusoap(self::$_CLIENT_WSDL, true);
    }

    private function soapCall($operation, $args=null)
    {
        $arguments = array(
            'clientKey' => '<![CDATA['. self::$_API_KEY. ']]>',
            'campaignID' => self::$_CAMPAIGN_ID
        );
        if( $args != null )
            $arguments = array_merge($arguments, $args);
        $result = $this->soap->call($operation, $arguments);

        if( self::$_DEBUG ){
            echo '<pre>',
                 '==================================================',
                 "\n\r",
                 'OPERATION: ', $operation, "\n\r";
            print_r($arguments);
            print_r($result);
            echo '==================================================',
                 '</pre>';
        }

        return $result;
    }
    
}

date_default_timezone_set('America/Los_Angeles');
require_once('nusoap-php5/lib/nusoap.php');
require_once('class.Query.php');
require_once('class.Prospects.php');
require_once('class.Campaigns.php');
require_once('class.Survey.php');
require_once('class.Activity.php');
require_once('class.MailLists.php');
require_once(dirname(__FILE__).'/../Logger/class.Log.php');
