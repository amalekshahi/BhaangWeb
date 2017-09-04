<?php
/**
 * Collection of Campaign objects.
 *
 * <b>The following example shows how to get a campaign.</b>
 * <code>
 * $campaigns = Campaigns::Get();
 * $campaign = $campaigns->getById(10);
 * echo "Campaign: {$campaign->getName()}";
 * // Output: Campaign: A Client's Campaign Name
 * </code>
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version 1.0
 */
class Campaigns
{
    ////////////////////////////////////////////////////////////////////////////
    // STATIC INTERFACE

    /**
     * Returns the Campaign list from LWC.
     * @return Campaigns
     */
    static public function Get()
    {
        $campaigns = new Campaigns();

        $result = LWC::Singleton()->getCampaigns();

        if( @$result['status'] != 'Success' )
            return $campaigns;

        foreach( $result['data'] as $campaign )
            $campaigns->add( new Campaign($campaign['campaignID'], $campaign['campaignName']) );

        return $campaigns;
    }

    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Get the Campaign count in this list.
     * @return int number of campaigns
     */
    public function count()
    {
        return $this->_campaigns->count();
    }

    /**
     * Returns the Campaign at the specified index.
     * @param int $index specified index
     * @return Campaign or false.
     */
    public function getAt($index)
    {
        return $this->_campaigns->offsetGet($index);
    }

    /**
     * Returns a campaign by Id.
     * @param int $id id of campaign
     * @return Campaign or null
     */
    public function getById($id)
    {
        $i = $this->_campaigns->getIterator();
        while( $i->valid() ){
            if( $i->current()->getId() == (int)$id )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns a campaign by name.
     * @param string $name name of campaign
     * @return Campaign or null
     */
    public function getByName($name)
    {
        $i = $this->_campaigns->getIterator();
        while( $i->valid() ){
            if( $i->current()->getName() == (string)$name )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns a copy of the Campaign list as an array.
     * @return array an array copy of campaigns
     */
    public function getArrayCopy()
    {
        return $this->_campaigns->getArrayCopy();
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Method

    /**
     * @var ArrayObject
     */
    private $_campaigns;

    private function  __construct()
    {
        $this->_campaigns = new ArrayObject();
    }

    private function add(Campaign $campaign)
    {
        $this->_campaigns->append($campaign);
    }
}

/**
 * Campaign Class.
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version 1.0
 */
class Campaign
{
    /**
     * Return the ID of the Campaign on LWC.
     * @return int id of campaign
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Return the name of the Campaign on LWC.
     * @return string name of campaign
     */
    public function getName() {
        return $this->_name;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Methods

    private $_id;
    private $_name;

    /**
     * Create a new Campaign object.
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

