<?php
/**
 * Collection of Prospect objects.
 *
 * <b>The following examples will demonstrate how to use this class.</b>
 * <code>
 * // A Query to get two users, one with Id 100 and one with URL 'JOHNDOE'.
 * $query = Query::Build()->andId(100)->orUrl('JOHNDOE');
 *
 * // Returns all properties, survey answers and activity data.
 * $prospects = Prospects::Get($query);
 * 
 * // Returns only User Id and First Name.
 * $props = new ProspectProps(ProspectProps::ID);
 * $props->add(ProspectProps::LAST_NAME);
 * $prospects = Prospects::Get($query, $props, false, false);
 *
 * // Get the first Prospect.
 * $prospect = $prospects->getAt(0);
 * echo "<p>Prospect First Name: {$prospect->getFirstName()}</p>";
 *
 * // Update the Prospect's First and Last Name.
 * $properties = new ProspectProps(ProspectProps::FIRST_NAME, 'John');
 * $properties->add(ProspectProps::LAST_NAME, 'Sample');
 * $prospect->Update($properties);
 * echo "<p>Prospect First Name: {$prospect->getFirstName()}</p>";
 *
 * // Update both Prospects' Prefix.
 * $propsects->Update(new ProspectProps(ProspectProps::PREFIX, 'Mr.'));
 * </code>
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version 1.0.1 - August 12, 2010
 */
class Prospects
{
    ////////////////////////////////////////////////////////////////////////////
    // STATIC INTERFACE

    /**
     * Pulls one or more Prospect objects from the Campaign.
     * @param Query $query defines which Prospect objects will be returned
     * @param ProspectProps $props the properties to include, or null for all
     * @param bool $hasSurvey has Survey responses included
     * @param bool $hasActivity has Activity data included
     * @return Prospects
     * @see ProspectProps, Prospect, Query, Survey, Activity
     */
    static public function Get(Query $query, ProspectProps $props = null, $hasSurvey = true, $hasActivity = true)
    {
        $propArray = array();

        if( isset($props) )
        {
            $propArray = array_merge( array_keys($props->getArrayCopy()),
                array('userID', 'listId', 'listName', 'numOfVisit', 'firstVisitDate', 'upDateFlag')
            );

            if( $hasSurvey )
                $propArray[] = 'survey';
            if( $hasActivity )
                $propArray[] = 'activity';
        }

        $result = LWC::Singleton()->getProspects($query->toString(), $propArray);

        $prospects = new Prospects();

        if( @$result['status'] != 'Success' || (int)@$result['count'] < 1 )
            return $prospects;

        for( $i = 0 ; $i < (int)@$result['count'] ; $i++ )
        {
            $prospects->_prospects->append(
                    new Prospect(
                            $result['fieldName'],
                            $result['data'][$i]['fieldValue'],
                            new Survey(@$result['data'][$i]['survey']),
                            new Activity(@$result['data'][$i]['activity'])
                    )
            );
        }

        return $prospects;
    }

    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Get the Prospect count in this list.
     * @return int number of Prospects
     */
    public function count()
    {
        return $this->_prospects->count();
    }

    /**
     * Returns the Prospect at the specified index.
     * @param int $index index of Prospect
     * @return Prospect or false
     */
    public function getAt($index)
    {
        return $this->_prospects->offsetGet($index);
    }

    /**
     * Returns the Prospect with the specified id.
     * @param int $id id of prospect
     * @return Prospect or null
     */
    public function getById($id)
    {
        $i = $this->_prospects->getIterator();
        while( $i->valid() ){
            if( $i->current()->getId() == (int)$id )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns the Prospect with the specified url.
     * @param string $url url of prospect
     * @return Prospect or null
     */
    public function getByUrl($url)
    {
        $i = $this->_prospects->getIterator();
        while( $i->valid() ){
            if( strtolower($i->current()->getUrl()) == strtolower($url) )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns the Prospect with the specified property.
     * @param String $PROSPECT_PROP_CONST
     * @param mixed $value
     * @return Prospect or null
     */
    public function getByProp($PROSPECT_PROP_CONST, $value)
    {
        $value = ProspectProps::Validate($PROSPECT_PROP_CONST, $value);
        $i = $this->_prospects->getIterator();
        while( $i->valid() ){
            if( $i->current()->getByProp($PROSPECT_PROP_CONST) == $value )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns a copy of the Prospect list as an array.
     * @return array an array of Prospects
     */
    public function getArrayCopy()
    {
        return $this->_prospects->getArrayCopy();
    }

    /**
     * Returns the Query that forms this Prospect list.
     * @return Query or null
     */
    public function getQuery()
    {
        if( $this->_prospects->count() == 0 )
            return null;

        $query = Query::Build();
        $i = $this->_prospects->getIterator();
        while( $i->valid() ){
            $query->orId( $i->current()->getId() );
            $i->next();
        }

        return $query;
    }

    /**
     * Updates all Prospect properties in collection across all Mail Lists.
     * If this collection spans multiple Mail Lists, multiple SOAP calls will be made.
     * If you don't need to pull down the Prospect objects first, MailList::BatchUpdate()
     * will offer better performance.
     * @param MailList $list targeted Mail List
     * @param Query $query defines what Prospects will be returned
     * @param ProspectProps $properties Properties to update
     * @return bool true if update was successful
     * @throws Message describes Mail List Id that errored and which succeeded.
     * @see MailList::BatchUpdate()
     */
    public function Update(ProspectProps $properties)
    {
        if( $this->count() == 0 )
            return false;
        
        $fields = array();
        foreach( $properties->getArrayCopy() as $key => $value )
            $fields[] = array('fieldName' => $key, 'fieldValue' => $value);
        
        $mailListIds = array();
        foreach( $this->getArrayCopy() as $prospect )
            $mailListIds[] = $prospect->getMailList()->getId();
        array_unique($mailListIds);

        $successIds = '';
        foreach( $mailListIds as $id )
        {
            $result = LWC::Singleton()->updateProspects(
                    $id, $this->getQuery()->toString(), $fields
            );
            if( @$result['status'] == 'Success' )
                $successIds += ";$id";
            else {
                Log::Error("Error on List ID $id. Successful updates $successIds");
                throw new Exception("Error on List ID $id. Successful updates $successIds");
            }
        }
        
        foreach( $this->getArrayCopy() as $prospect )
            $prospect->internalUpdate($properties);
        
        return true;
    }

    /**
     * Deletes all Prospects in collection across all Mail Lists.
     * After the delete, this collection is cleared.
     * If this collection spans multiple Mail Lists, multiple SOAP calls will be made.
     * If you don't need to pull down the Prospect objects, MailList::BatchDelete()
     * will offer better performance.
     * @return bool true if delete was successful
     * @throws Message describes Mail List Id that errored and which succeeded.
     * @see MailList::BatchDelete()
     */
    public function Delete()
    {
        if( $this->count() == 0 )
            return false;

        $mailListIds = array();
        foreach( $this->getArrayCopy() as $prospect )
            $mailListIds[] = $prospect->getMailList()->getId();
        array_unique($mailListIds);

        $successIds = '';
        foreach( $mailListIds as $id )
        {
            $result = LWC::Singleton()->deleteProspects(
                    $id, $this->getQuery()->toString()
            );
            if( @$result['status'] == 'Success' )
                $successIds += ";$id";
            else {
                Log::Error("Error on List ID $id. Successful deletes $successIds");
                throw new Exception("Error on List ID $id. Successful deletes $successIds");
            }
        }

        $this->_prospects->_prospects = new ArrayObject();
        
        return true;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Methods

    /**
     * @var ArrayObject
     */
    private $_prospects;

    private function  __construct()
    {
        $this->_prospects = new ArrayObject();
    }

    /**
     *
     * @param Prospect $prospect
     */
    private function add(Prospect $prospect)
    {
        $this->_prospects->append($prospect);
    }

}

/**
 * Class interfaces with Prospects in LWC Mail Lists.
 *
 * <b>The following examples will demonstrate how to use this class.</b>
 * <code>
 * // A Query to get one user with Id 100.
 * $query = Query::Build()->andId(100);
 *
 * // Returns all properties, survey answers and activity data.
 * $prospect = Prospect::Get($query);
 * 
 * // Update Prospect's Custom 1.
 * $prospect->Update(new ProspectProps(ProspectProps::CUSTOM_01, 'New value'));
 *
 * // Delete Prospect.
 * $prospect->Delete();
 * </code>
 * 
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @see ProspectProps, Survey, Activity
 * @version 1.1 - August 12, 2010
 */
class Prospect
{
    ////////////////////////////////////////////////////////////////////////////
    // STATIC PUBLIC INTERFACE

    /**
     * Pulls one Prospect from the Campaign.
     * @param Query $query defines which Prospect will be returned
     * @param ProspectProps $props the properties to include, or null for all
     * @param bool $hasSurvey has Survey responses included
     * @param bool $hasActivity has Activity data included
     * @return Prospect or false
     * @see ProspectProps, Query, Survey, Activity
     */
    static public function Get(Query $query, ProspectProps $props = null, $hasSurvey = true, $hasActivity = true)
    {
        $prospects = Prospects::Get($query, $props, $hasSurvey, $hasActivity);

        return $prospects->getAt(0);
    }

    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Updates the Prospect's properties in the Mail List.
     * @param ProspectProps $properties properties to update
     * @return bool true if the update succeeds, or false
     * @see MailList::BatchUpdate()
     */
    public function Update(ProspectProps $properties)
    {
        $fields = array();
        foreach( $properties->getArrayCopy() as $key => $value )
            $fields[] = array('fieldName' => $key, 'fieldValue' => $value);

        $result = LWC::Singleton()->updateProspects(
                $this->getMailList()->getId(),
                Query::Build()->andId($this->getId())->toString(),
                $fields
        );

        if( @$result['status'] != 'Success' )
            return false;

        $this->internalUpdate($properties);
        
        return true;
    }

    /**
     * Deletes the Prospect from the Mail List.
     * After the delete, this object is invalid.
     * @return bool true if the delete succeeds, or false
     * @see MailList::BatchDelete()
     */
    public function Delete()
    {
        if( $this->_dataArray == null )
            return false;

        $result = LWC::Singleton()->deleteProspects(
                $this->getMailList()->getId(),
                Query::Build()->andId($this->getId())->toString()
        );

        if( @$result['status'] != 'Success' )
            return false;

        $this->_dataArray = null;
        $this->_survey = null;
        $this->_activity = null;
        $this->_mailList = null;
        
        return true;
    }

    /**
     * Has the Prospect updated the data.
     * @return bool
     */
    public function isUpdated(){
        return $this->_dataArray['updateFlag'] == 'TRUE';
    }

    /**
     *
     * @return Survey
     */
    public function getSurvey(){
        return $this->_survey;
    }

    /**
     *
     * @return Activity
     */
    public function getActivity(){
        return $this->_activity;
    }

    /**
     *
     * @return MailList
     */
    public function getMailList(){
        return $this->_mailList;
    }

    /**
     *
     * @return int
     */
    public function getCampaignId(){
        return (int)$this->_dataArray['capaignID'];
    }

    /**
     *
     * @return int
     */
    public function getId(){
        return (int)$this->_dataArray[ProspectProps::ID];
    }

    /**
     *
     * @return string Max 30
     */
    public function getFirstName(){
        return $this->_dataArray[ProspectProps::FIRST_NAME];
    }

    /**
     *
     * @return string Max 40
     */
    public function getLastName(){
        return $this->_dataArray[ProspectProps::LAST_NAME];
    }

    /**
     *
     * @return string Max 30
     */
    public function getMiddleName(){
        return $this->_dataArray[ProspectProps::MIDDLE_NAME];
    }

    /**
     *
     * @return string Max 10
     */
    public function getPrefix(){
        return $this->_dataArray[ProspectProps::PREFIX];
    }

    /**
     *
     * @return string Max 10
     */
    public function getSuffix(){
        return $this->_dataArray[ProspectProps::SUFFIX];
    }

    /**
     *
     * @return string Max 50
     */
    public function getAddress(){
        return $this->_dataArray[ProspectProps::ADDRESS];
    }

    /**
     *
     * @return string Max 50
     */
    public function getAddress2(){
        return $this->_dataArray[ProspectProps::ADDRESS_2];
    }

    /**
     *
     * @return string Max 100
     */
    public function getCity(){
        return $this->_dataArray[ProspectProps::CITY];
    }

    /**
     *
     * @return string Max 10
     */
    public function getState(){
        return $this->_dataArray[ProspectProps::STATE];
    }

    /**
     *
     * @return string Max 10
     */
    public function getZip(){
        return $this->_dataArray[ProspectProps::ZIP];
    }

    /**
     *
     * @return string Max 10
     */
    public function getZipPlus4(){
        return $this->_dataArray[ProspectProps::ZIP_PLUS_4];
    }

    /**
     *
     * @return string Max 30
     */
    public function getCountry(){
        return $this->_dataArray[ProspectProps::COUNTRY];
    }

    /**
     *
     * @return string Max 30
     */
    public function getPhone(){
        return $this->_dataArray[ProspectProps::PHONE];
    }
    
    /**
     *
     * @return string Max 30
     */
    public function getPhone2(){
        return $this->_dataArray[ProspectProps::PHONE_2];
    }
    
    /**
     *
     * @return string Max 30
     */
    public function getFax(){
        return $this->_dataArray[ProspectProps::FAX];
    }
    
    /**
     *
     * @return string Max 100
     */
    public function getEmail(){
        return $this->_dataArray[ProspectProps::EMAIL];
    }
    
    /**
     *
     * @return string Max 50
     */
    public function getPassword(){
        return $this->_dataArray[ProspectProps::PASSWORD];
    }
   
    /**
     *
     * @return string Max 100
     */
    public function getUrl(){
        return $this->_dataArray[ProspectProps::URL];
    }
    
    /**
     *
     * @return string Max 50
     */
    public function getCompany(){
        return $this->_dataArray[ProspectProps::COMPANY];
    }
    
    /**
     *
     * @return string Max 50
     */
    public function getTitle(){
        return $this->_dataArray[ProspectProps::TITLE];
    }

    /**
     *
     * @return char
     */
    public function getSeedFlag(){
        return $this->_dataArray[ProspectProps::SEED_FLAG];
    }

    /**
     *
     * @return string
     */
    public function getDestinationURL(){
        return $this->_dataArray[ProspectProps::DESTINATION_URL];
    }

    /**
     * Returns date and time of first visit, or null in never.
     * @return DateTime or null
     */
    public function getFirstVisitDate(){
        if( $this->_dataArray['firstVisitDate'] == '' )
            return null;
        return new DateTime($this->_dataArray['firstVisitDate']);
    }

    /**
     * Number of times the Prospect visited.
     * @return int
     */
    public function getNumOfVisits(){
        return (int)$this->_dataArray['numOfVisits'];
    }

    /**
     * Returns value from CUSTOM_01.
     * @return string Max 255
     */
    public function getCustom01(){
        return $this->_dataArray[ProspectProps::CUSTOM_01];
    }
    
    /**
     * Returns value from CUSTOM_02.
     * @return string Max 255
     */
    public function getCustom02(){
        return $this->_dataArray[ProspectProps::CUSTOM_02];
    }
    
    /**
     * Returns value from CUSTOM_03.
     * @return string Max 255
     */
    public function getCustom03(){
        return $this->_dataArray[ProspectProps::CUSTOM_03];
    }
    
    /**
     * Returns value from CUSTOM_04.
     * @return string Max 255
     */
    public function getCustom04(){
        return $this->_dataArray[ProspectProps::CUSTOM_04];
    }
    
    /**
     * Returns value from CUSTOM_05.
     * @return string Max 255
     */
    public function getCustom05(){
        return $this->_dataArray[ProspectProps::CUSTOM_05];
    }
    
    /**
     * Returns value from CUSTOM_06.
     * @return string Max 255
     */
    public function getCustom06(){
        return $this->_dataArray[ProspectProps::CUSTOM_06];
    }
    
    /**
     * Returns value from CUSTOM_07.
     * @return string Max 255
     */
    public function getCustom07(){
        return $this->_dataArray[ProspectProps::CUSTOM_07];
    }
    
    /**
     * Returns value from CUSTOM_08.
     * @return string Max 255 Max 255
     */
    public function getCustom08(){
        return $this->_dataArray[ProspectProps::CUSTOM_08];
    }
    
    /**
     * Returns value from CUSTOM_09.
     * @return string Max 255
     */
    public function getCustom09(){
        return $this->_dataArray[ProspectProps::CUSTOM_09];
    }
    
    /**
     * Returns value from CUSTOM_10.
     * @return string Max 255
     */
    public function getCustom10(){
        return $this->_dataArray[ProspectProps::CUSTOM_10];
    }
    
    /**
     * Returns value from CUSTOM_11.
     * @return string Max 255
     */
    public function getCustom11(){
        return $this->_dataArray[ProspectProps::CUSTOM_11];
    }
    
    /**
     * Returns value from CUSTOM_12.
     * @return string Max 255
     */
    public function getCustom12(){
        return $this->_dataArray[ProspectProps::CUSTOM_12];
    }
    
    /**
     * Returns value from CUSTOM_13.
     * @return string Max 255
     */
    public function getCustom13(){
        return $this->_dataArray[ProspectProps::CUSTOM_13];
    }
    
    /**
     * Returns value from CUSTOM_14.
     * @return string Max 255
     */
    public function getCustom14(){
        return $this->_dataArray[ProspectProps::CUSTOM_14];
    }
    
    /**
     * Returns value from CUSTOM_15.
     * @return string Max 255
     */
    public function getCustom15(){
        return $this->_dataArray[ProspectProps::CUSTOM_15];
    }
    
    /**
     * Returns value from CUSTOM_16.
     * @return string Max 255
     */
    public function getCustom16(){
        return $this->_dataArray[ProspectProps::CUSTOM_16];
    }
    
    /**
     * Returns value from CUSTOM_17.
     * @return string Max 255
     */
    public function getCustom17(){
        return $this->_dataArray[ProspectProps::CUSTOM_17];
    }
    
    /**
     * Returns value from CUSTOM_18.
     * @return string Max 255
     */
    public function getCustom18(){
        return $this->_dataArray[ProspectProps::CUSTOM_18];
    }
    
    /**
     * Returns value from CUSTOM_19.
     * @return string Max 255
     */
    public function getCustom19(){
        return $this->_dataArray[ProspectProps::CUSTOM_19];
    }
    
    /**
     * Returns value from CUSTOM_20.
     * @return string Max 255
     */
    public function getCustom20(){
        return $this->_dataArray[ProspectProps::CUSTOM_20];
    }

    /**
     * Returns the value of the specified property.
     * @param string $PROPERTY_CONST property of prospect
     * @return mixed value of property
     */
    public function getByProp($PROPERTY_CONST){
        ProspectProps::Validate($PROPERTY_CONST);
        return $this->_dataArray[$PROPERTY_CONST];
    }
    
    ////////////////////////////////////////////////////////////////////////////
    // Package Methods

    private $_dataArray;
    private $_survey;
    private $_activity;
    private $_mailList;

    /**
     * Create a new Prospect object.
     * <b>INTERNAL METHOD.
     * Using this Constructor will break your code on future releases.
     * This Contructor is not future-safe and is only to be used by the package.
     * In PHP 5.3+, it will be changed to package visible.</b>
     * @param string $keys
     * @param string|int $values
     * @param Survey $survey
     * @param Activity $activity
     * @internal
     */
    public function __construct($keys, $values, Survey $survey, Activity $activity)
    {
        $this->_dataArray = array_combine($keys, $values);
        $this->_survey = $survey;
        $this->_activity = $activity;
        $this->_mailList = new MailList($this->_dataArray['listId'], $this->_dataArray['listName']);
    }
    
    /**
     * <b>INTERNAL METHOD.
     * Using this Constructor will break your code on future releases.
     * This Contructor is not future-safe and is only to be used by the package.
     * In PHP 5.3+, it will be changed to package visible.</b>
     * @param $properties
     * @internal
     */
    public function internalUpdate(ProspectProps $properties)
    {
        foreach( $properties->getArrayCopy() as $key => $value )
            $this->_dataArray[$key] = $value;
    }

}

/**
 * Collection of Prospect properties.
 *
 * <b>The following example shows how to use this class.</b>
 * <code>
 * $properties = new ProspectProps(ProspectProps::FIRST_NAME, 'John');
 * $properties->add(ProspectProps::LAST_NAME, 'Sample');
 * $prospect->Update($properties);
 * echo "<p>Prospect First Name: {$prospect->getFirstName()}</p>";
 * </code>
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version 1.0
 */
class ProspectProps
{
    const ID = 'userID';
    const FIRST_NAME = 'firstName';
    const MIDDLE_NAME = 'middleName';
    const LAST_NAME = 'lastName';
    const PREFIX = 'prefix';
    const SUFFIX = 'suffix';
    const COMPANY = 'company';
    const TITLE = 'title';
    const ADDRESS = 'address1';
    const ADDRESS_2 = 'address2';
    const CITY = 'city';
    const STATE = 'state';
    const ZIP = 'zip';
    const ZIP_PLUS_4 = 'plus4';
    const COUNTRY = 'country';
    const PHONE = 'phone';
    const PHONE_2 = 'phone2';
    const FAX = 'fax';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    /**
     * The user's unique subdomain, without the domain name. String(30).
     */
    const URL = 'url';
    //const PRIORITY_CODE = 'priorityCode';
    //const GROUP_CODE = 'groupCode';
    //const SEED_FLAG = 'seedFlag';
    const DESTINATION_URL = 'destinationURL';
    //const PAGE_VISITED = 'pageVisited';
    //const ACCESS_TIME = 'accessTime';
    //const IP_ADDRESS = 'ipAddress';
    //const USER_AGENT = 'userAgent';
    const CUSTOM_01 = 'custom1';
    const CUSTOM_02 = 'custom2';
    const CUSTOM_03 = 'custom3';
    const CUSTOM_04 = 'custom4';
    const CUSTOM_05 = 'custom5';
    const CUSTOM_06 = 'custom6';
    const CUSTOM_07 = 'custom7';
    const CUSTOM_08 = 'custom8';
    const CUSTOM_09 = 'custom9';
    const CUSTOM_10 = 'custom10';
    const CUSTOM_11 = 'custom11';
    const CUSTOM_12 = 'custom12';
    const CUSTOM_13 = 'custom13';
    const CUSTOM_14 = 'custom14';
    const CUSTOM_15 = 'custom15';
    const CUSTOM_16 = 'custom16';
    const CUSTOM_17 = 'custom17';
    const CUSTOM_18 = 'custom18';
    const CUSTOM_19 = 'custom19';
    const CUSTOM_20 = 'custom20';

    static private $_schema = array(
        'userID'            => array( 'int' ),
        'firstName'         => array( 'string', 30 ),
        'middleName'        => array( 'string', 30 ),
        'lastName'          => array( 'string', 40 ),
        'prefix'            => array( 'string', 10 ),
        'suffix'            => array( 'string', 10 ),
        'company'           => array( 'string', 50 ),
        'title'             => array( 'string', 50 ),
        'address1'          => array( 'string', 50 ),
        'address2'          => array( 'string', 50 ),
        'city'              => array( 'string', 100 ),
        'state'             => array( 'string', 10 ),
        'zip'               => array( 'string', 10 ),
        'plus4'             => array( 'string', 10 ),
        'country'           => array( 'string', 30 ),
        'phone'             => array( 'string', 30 ),
        'phone2'            => array( 'string', 30 ),
        'fax'               => array( 'string', 30 ),
        'email'             => array( 'string', 100 ),
        'password'          => array( 'string', 50 ),
        'url'               => array( 'string', 100 ),
        //'priorityCode'      => array( 'string', 50 ),
        //'groupCode'         => array( 'string', 50 ),
        //'seedFlag'          => array( 'string', 1 ),
        'destinationURL'    => array( 'string', 255 ),
        //'pageVisited'       => array( 'string', 30 ),
        //'accessTime'        => array( 'int' ),
        //'ipAddress'         => array( 'string', 20 ),
        //'userAgent'         => array( 'string', 150 ),
        'custom1'           => array( 'string', 255 ),
        'custom2'           => array( 'string', 255 ),
        'custom3'           => array( 'string', 255 ),
        'custom4'           => array( 'string', 255 ),
        'custom5'           => array( 'string', 255 ),
        'custom6'           => array( 'string', 255 ),
        'custom7'           => array( 'string', 255 ),
        'custom8'           => array( 'string', 255 ),
        'custom9'           => array( 'string', 255 ),
        'custom10'          => array( 'string', 255 ),
        'custom11'          => array( 'string', 255 ),
        'custom12'          => array( 'string', 255 ),
        'custom13'          => array( 'string', 255 ),
        'custom14'          => array( 'string', 255 ),
        'custom15'          => array( 'string', 255 ),
        'custom16'          => array( 'string', 255 ),
        'custom17'          => array( 'string', 255 ),
        'custom18'          => array( 'string', 255 ),
        'custom19'          => array( 'string', 255 ),
        'custom20'          => array( 'string', 255 )
    );

    /**
     * Return the property headers.
     * @return array property headers
     */
    static public function getSchemaArray()
    {
        return array_keys(self::$_schema);
    }

    /**
     * Throws an exception if Prospect property is invalid.
     * Returns the value cast and truncated to fit the required type.
     *
     * @param string $PROPERTY_CONST ProspectProps constant
     * @param mixed $value property value
     * @return mixed the property value
     */
    static public function Validate($PROPERTY_CONST, $value = null)
    {
        if( !array_key_exists($PROPERTY_CONST, self::$_schema) ){
            Log::Error('Invalid Prospect Parameter');
            throw new Exception('Invalid Prospect Parameter');
        }

        $schema = self::$_schema[$PROPERTY_CONST];
        switch( $schema[0] )
        {
            case 'string':
                $value = substr($value, 0, $schema[1]);
                break;
            case 'bool':
                $value = (bool)$value;
                break;
            default: // int
                $value = (int)$value;
        }

        return $value;
    }

    private $_properties;

    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE
    
    /**
     * Create a Prospect property list.
     * @param string $PROPERTY_CONST ProspectProps constant
     * @param mixed $value property value
     */
    public function __construct($PROPERTY_CONST, $value = null)
    {
        $value = ProspectProps::Validate($PROPERTY_CONST, $value);
        $this->_properties = new ArrayObject();
        $this->add($PROPERTY_CONST, $value);
    }

    /**
     * Add a property or replaces and existing property.
     * @param string $PROPERTY_CONST ProspectProps constant
     * @param mixed $value property value
     * @return mixed
     */
    public function add($PROPERTY_CONST, $value = null)
    {
        $value = ProspectProps::Validate($PROPERTY_CONST, $value);
        $this->_properties->offsetSet($PROPERTY_CONST, $value);
        return $value;
    }

    /**
     * Removes a property.
     * @param string $PROPERTY_CONST ProspectProps constant
     */
    public function remove($PROPERTY_CONST)
    {
        ProspectProps::Validate($prop);
        $this->_properties->offsetUnset($prop);
    }

    /**
     * Returns a property by ProspectProps constant
     * @param string $PROPERTY_CONST ProspectProps constant
     * @return mixed $value property value
     */
    public function get($PROPERTY_CONST)
    {
        ProspectProps::Validate($PROPERTY_CONST);
        return $this->_properties->offsetGet($PROPERTY_CONST);
    }

    /**
     * Returns a copy of the properties as an array.
     * @return array a copy of the properties as an array
     */
    public function getArrayCopy()
    {
        return $this->_properties->getArrayCopy();
    }

}

