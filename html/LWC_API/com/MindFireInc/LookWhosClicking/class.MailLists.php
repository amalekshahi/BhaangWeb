<?php
/**
 * Collection of MailList objects.
 *
 * <b>The following is an example of how to get a mail list.</b>
 * <code>
 * $mailList = MailLists::Singleton()->getByName('Mail List Name');
 * echo "List Id: {$mailList->getId()}";
 * // Output: List Id: 10
 * </code>
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version 1.0
 */
class MailLists
{
    const EXPORT_METHOD_EMAIL = 'email';
    const EXPORT_METHOD_URL = 'URL';
    const EXPORT_METHOD_FTP = 'FTP';

    const LIST_DELIMITER_CSV = 'CSV';
    const LIST_DELIMITER_TAB = 'TXT';

    ////////////////////////////////////////////////////////////////////////////
    // STATIC INTERFACE

    static private $_instance;
    
    /**
     * Singleton for MailLists Class.
     * @return MailLists
     * @version 1.0
     */
    static public function Singleton()
    {
        if( self::$_instance == null )
            self::$_instance = new MailLists();
        return self::$_instance;
    }

    /**
     * Creates a new Mail List and inserts new Prospects.
     * @param string $listName new or existing list name
     * @param array $properties an array of ProspectProps
     * @param string $filePath the path to save the file
     * @param string $urlDir the URL directory to find the mail file
     * @param string $email the email to send results to
     * @param string $username username for credentials, if necessary
     * @param string $password password for credentials, if necessary
     * @return int number of successful inserts
     * @throws Unsupported Method Exception
     */
    static public function Create($listName, $propertiesArray, $filePath='', $urlDir='', $email='', $username='', $password='')
    {
        // Validate $propertiesArray
        if( !(is_array($propertiesArray) && count($propertiesArray) && $propertiesArray[0] instanceof ProspectProps) ){
            Log::Error('The $propertiesArray parameter is not valid.', false);
            return;
        }

        // Create (hopefully) unique filename.
        $filename = 'list_'. @LWC::CLIENT_ID() .'_'. @LWC::CAMPAIGN_ID() .'_'. microtime(true)*10000 .'.txt';

        // Set default values for $filePath and $urlDir
        if( $filePath == '' )
            $filePath = dirname(__FILE__).'/../../../import_lists/';
        if( $urlDir == '' )
            $urlDir = 'http://proweb.mindfireinc.com/LWC_API/import_lists/';

        // Validate $filePath
        $filePath = realpath($filePath);
        if( !is_dir($filePath) || !is_writable($filePath) ){
            Log::Error('Directory does not exist or is not writeable: '. $filePath, false);
            return;
        }

        $filePath .= '/'.$filename;
        $urlDir .= '/'.$filename;

        // Setup file header
        $headerKeys = ProspectProps::getSchemaArray();
        $headerKeys = array_diff($headerKeys, array('userID', 'password', 'url'));
        $fileContents = join("\t", $headerKeys)."\r\n";

        // Write lines for file
        foreach( $propertiesArray as $props ){
            $propsArray = $props->getArrayCopy();
            $fieldsArray = array();
            foreach( $headerKeys as $key )
                $fieldsArray[] = $propsArray[$key];
            $fileContents .= join("\t", $fieldsArray)."\r\n";
        }

        // Save file to $filePath
        if( !@file_put_contents($filePath, $fileContents) ){
            Log::Error('Could not save file: '.$filePath, false);
            return;
        }

        $result = LWC::Singleton()->insertProspects($listName, $urlDir, MailLists::LIST_DELIMITER_TAB, $email);
        /*
        [status] => Success
        [errorID] => 0
        [errorDesc] => Success
        [listID] => 104
        [outputLocation] => https://proservicenonbill.lwcdirect.com/LWC_00821/exports/export_Test Import List120.TXT
        [numSuccess] => 20
        [numFailed] => 0
        [numDuplicate] => 0
        */

        @unlink($filePath);

        if( @$result['status'] == 'Success' )
            return $result['numSuccess'];
        
        return false;
    }
    
    /**
     * Exports a selection of Prospects to a file.
     * @param Query $query
     * @param ProspectProps $properties
     * @param string $EXPORT_METHOD
     * @param string $emailAddress
     * @param bool $isZipped
     * @throws Unsupported Method Exception
     */
    static public function Export(Query $query, ProspectProps $properties=null, $LIST_METHOD_CONST='email', $emailAddress='', $isZipped=true)
    {
        // TODO: Export()
        throw new Exception('Unsupported Method Exception');
    }

    /**
     * Returns the number of rows the Query would export.
     * @param Query $query test Query
     * @return int number of affected rows
     * @throws Unsupported Method Exception
     */
    static public function ExportTest(Query $query)
    {
        // TODO: ExportTest()
        throw new Exception('Unsupported Method Exception');
    }

    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Get the MailList count in this list.
     * @return int number of MailLists
     */
    public function count()
    {
        return $this->_lists->count();
    }

    /**
     * Returns the MailList at the specified index.
     * @param int $index index of mail list
     * @return MailList or false.
     */
    public function getAt($index)
    {
        return $this->_lists->offsetGet((int)$index);
    }

    /**
     * Finds and returns a mail list by Id.
     * @param int $id id of mail list
     * @return MailList or null
     */
    public function getById($id)
    {
        $i = $this->_lists->getIterator();
        while( $i->valid() ){
            if( $i->current()->getId() == (int)$id )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Finds and returns a mail list by name.
     * @param string $name name of mail list
     * @return MailList or null
     */
    public function getByName($name)
    {
        $i = $this->_lists->getIterator();
        while( $i->valid() ){
            if( $i->current()->getName() == (string)$name )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns a copy of the MailList list as an array.
     * @return array an array of MailList objects
     */
    public function getArrayCopy()
    {
        return $this->_lists->getArrayCopy();
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Method

    /**
     * @var ArrayObject
     */
    private $_lists;

    private function  __construct()
    {
        $this->_lists = new ArrayObject();
        
        $result = LWC::Singleton()->getLists();
        if( @$result['status'] == 'Success' )
            foreach( $result['data'] as $list )
                $this->_lists->append( new MailList($list['listID'], $list['listName']) );
    }

}

/**
 * This class interfaces with the Mail Lists in a LWC campaign.
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version 1.0
 */
class MailList
{
    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Updates the Query defined Prospect list's properties.
     * @param Query $query defines what Prospects will be returned
     * @param ProspectProps $properties Properties to update
     * @return int number of affected rows
     */
    public function BatchProspectUpdate(Query $query, ProspectProps $properties)
    {
        $fields = array();
        foreach( $properties->getArrayCopy() as $key => $value )
            $fields[] = array('fieldName' => $key, 'fieldValue' => $value);

        $result = LWC::Singleton()->updateProspects($this->getId(), $query->toString(), $fields);

        if( @$result['status'] != 'Success' )
            return 0;

        return (int)@$result['numRecord'];
    }
    
    /**
     * Delete one or more Prospects from the targeted Mail List.
     * @param Query $query identify Prospects
     * @return int number of affected rows
     */
    public function BatchProspectDelete(Query $query)
    {
        if( $query->toString() == '' )
            return 0;

        $result = LWC::Singleton()->deleteProspects($this->getId(), $query->toString());

        if( @$result['status'] != 'Success' )
            return 0;

        return (int)@$result['numRecord'];
    }

    /**
     * Inserts new Prospects into the Mail File.
     * @param ProspectProps $props
     * @throws Unsupported Method Exception
     */
    public function BatchProspectInsert(ProspectProps $props)
    {
        // TODO: BatchProspectInsert()
        throw new Exception('Unsupported Method Exception');
    }

    /**
     * Returns the number of rows the Query would affect.
     * @param Query $query test Query
     * @return int number of affected rows
     */
    public function BatchProspectTest(Query $query)
    {
        if( $query->toString() == '' )
            return 0;

        $result = LWC::Singleton()->getAffectedCount($this->getId(), $query->toString());

        if( @$result['status'] != 'Success' )
            return 0;

        return (int)@$result['numRecord'];
    }

    /**
     * Return the ID of the mail list on LWC.
     * @return int id of mail list
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Return the name of the mail list on LWC.
     * @return string name of mail list
     */
    public function getName() {
        return $this->_name;
    }
    
    ////////////////////////////////////////////////////////////////////////////
    // Private Methods
    
    private $_id;
    private $_name;

    /**
     * Create a new MailList object.
     * <b>Using this Constructor will break your code on future releases.
     * This Contructor is not future-safe and is only to be used by the package.
     * In PHP 5.3+, it will be changed to package visible.</b>
     * @param int $id
     * @param String $name
     * @internal
     */
    public function __construct($id, $name)
    {
        $this->_id = (int)$id;
        $this->_name = (string)$name;
    }

}

